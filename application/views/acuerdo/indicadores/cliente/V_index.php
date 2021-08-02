<?php 
    $fechaDesde = new DateTime();
    //$fechaDesde->modify('-1 month');
    $fechaDesde->modify('first day of this month'); 


	$fechaHasta = new DateTime();
    $fechaHasta->modify('first day of this month');
	$intervalo = new DateInterval('P1M');
	$fechaHasta->add($intervalo);	
    //$fechaHasta = new DateTime();
?>
<style>
    .column-filtros
    {
        position:absolute; 
        top: 128px; 
        bottom: 30px;
        overflow-y: scroll;
    }
    .lista-detalles
    {
        height: 150px;
        overflow-y: scroll;
    }
    h5
    {
        padding-left: 16px;
    }
</style>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Valorizaciones</a>
            <a href="#!" class="breadcrumb">Indicador Ventas por Cliente</a>
        </div>
    </div>
</nav>
<div class="section container row">
    <div class="col s12">
        <div class="section row">
            <div class="input-field col s12 m6 l4">
                <input id="desde" type="text" value="<?= $fechaDesde->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="desde">Desde</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="hasta" type="text" value="<?= $fechaHasta->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="hasta">Hasta</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <select id="moneda" name="moneda" required>
                    <option value="" disabled>Seleccionar Moneda</option>
                    <?php foreach ($monedas as $row): ?>
                        <option value="<?= $row->MONEDA_N_ID ?>"><?= $row->MONEDA_C_DESCRIPCION ?> (<?= $row->MONEDA_C_SIMBOLO ?>)</option>
                    <?php endforeach; ?>
                </select>
                <label>Moneda</label>
            </div>  
            <div class="col s12 m6 l4 section">
                <h5>Sedes</h5>
                <div id="sedes" class="lista-detalles">
                    <div class="input-field col s12">
                        <div class="switch">
                            <label>
                                <input id="checktotos" type="checkbox" class="sede" value="0" checked onclick="seleccionarTodos(this)">
                                <span class="lever"></span>
                                    Seleccionar todos
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4 section">
                <h5>Clientes</h5>
                <div id="clientes" class="lista-detalles">
                    <div class="input-field col s12">
                        <div class="switch">
                            <label>
                                <input id="checktotos" type="checkbox" class="cliente" value="0" checked onclick="seleccionarTodos(this)">
                                <span class="lever"></span>
                                    Seleccionar todos
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-field col s12">
                <div class="btn-small" id="btnBuscar">Buscar</div>
            </div>
        </div>        
    </div>
    <div id="grafico" class="col s12" style="display: none">
        <h4 class="center-align">Venta de Servicios por Cliente</h4>
        <div id="chart_div"></div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnBuscar = document.getElementById("btnBuscar"); 
        btnBuscar.addEventListener("click", buscar, false);
        $('#moneda').val("2")
        $('select').formSelect();
        sedes()
        google.charts.load('current', {packages: ['corechart', 'bar']});
    });
    
    async function sedes()
    {
        M.toast({html: 'Cargando Sedes...', classes: 'rounded'});
        $('.preloader-background').css({'display': 'block'});         

        let url = 'api/execsp';
        let sp = 'SEDE_LIS';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let sede = 0;
        let data = {sp, empresa, sede};

        await fetch(url, {
                    method: 'POST', // or 'PUT'
                    body: JSON.stringify(data), // data can be `string` or {object}!
                    headers:{
                        'Content-Type': 'application/json'
                        }
                    })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) 
        {
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                
                $('#sedes').append(`
                    <div class="input-field col s12">
                        <div class="switch">
                            <label>
                                <input type="checkbox" class="sede" value="${element.SEDE_N_ID}" checked>
                                <span class="lever"></span>
                                    ${element.SEDE_C_DESCRIPCION}
                            </label>
                        </div>
                    </div>
                    `)
            }
            clientes()
            $('.preloader-background').css({'display': 'none'});                
        });
    }

    function sedes_checkados()
    {
        let checados = $('.sede:checked')
        let sedes = '';
        for (let index = 0; index < checados.length; index++) {
            const element = checados[index];
            if(index > 0 && index < checados.length)
            {
                sedes = sedes + '|';
            }
            sedes = sedes + element.value;
        }
        return sedes;
    }

    function seleccionarTodos()
    {

    }

    async function clientes()
    {
        M.toast({html: 'Cargando Clientes...', classes: 'rounded'});
        $('.preloader-background').css({'display': 'block'});         

        let url = 'api/execsp';
        let sp = 'CLIENTE_ESCLIENTE_LIS';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let escliente = '1';
        let data = {sp, empresa, escliente};

        await fetch(url, {
                    method: 'POST', // or 'PUT'
                    body: JSON.stringify(data), // data can be `string` or {object}!
                    headers:{
                        'Content-Type': 'application/json'
                        }
                    })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) 
        {
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                
                $('#clientes').append(`
                    <div class="input-field col s12">
                        <div class="switch">
                            <label>
                                <input type="checkbox" class="cliente" value="${element.CLIENT_N_ID}" checked>
                                <span class="lever"></span>
                                    ${element.CLIENT_C_RAZON_SOCIAL}
                            </label>
                        </div>
                    </div>
                    `)
            }
            //servicios()
            $('.preloader-background').css({'display': 'none'});                
        });
    }

    function clientes_checkados()
    {
        let checados = $('.cliente:checked')
        let clientes = '';
        for (let index = 0; index < checados.length; index++) {
            const element = checados[index];
            if(index > 0 && index < checados.length)
            {
                clientes = clientes + '|';
            }
            clientes = clientes + element.value;
        }
        return clientes;
    }
   
    function seleccionarTodos(e)
    {
        /*
        var checados = $('#resultados').find('input:checkbox:checked');
        checados.length;
        */
        var checks = $('.' +$(e)[0].className);
        if($(e)[0].checked){
            for (let index = 0; index < checks.length; index++) {
                checks[index].checked = true;               
            }
        }else{
            for (let index = 0; index < checks.length; index++) {
                checks[index].checked = false;               
            }
        }
        //$('#resultados').find('input:checkbox')[0].checked = true
    }

    function buscar()
    {
        M.toast({html: 'Buscando resultado...', classes: 'rounded'});
        $('.preloader-background').css({'display': 'block'});    

        let fecha_desde = $('#desde').val();
        fecha_desde = fecha_desde.split('/');
        fecha_desde = fecha_desde[2] + fecha_desde[1] + fecha_desde[0];
        
        let fecha_hasta = $('#hasta').val();
        fecha_hasta = fecha_hasta.split('/');     
        fecha_hasta = fecha_hasta[2] + fecha_hasta[1] + fecha_hasta[0];

        let url = 'api/execsp';
        let sp = 'INDICADOR_LIS_ALQUILERES';
        let tipo = 'C';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let cliente = clientes_checkados();
        let sede = sedes_checkados();
        let moneda = parseInt($('#moneda').val());
        let data = {sp, tipo, empresa, cliente, sede, fecha_desde, fecha_hasta, moneda};

        fetch(url, {
                    method: 'POST', // or 'PUT'
                    body: JSON.stringify(data), // data can be `string` or {object}!
                    headers:{
                        'Content-Type': 'application/json'
                        }
                    })
        .then(function(response) {
            return response.json();
        })
        .then(function(data) 
        {
            console.log(data);
            //google.charts.setOnLoadCallback(drawGrafic);
            if(data.length > 0)
            {
                document.getElementById('grafico').style.display = 'block';
                drawGrafic(data)
            }
            else{
                document.getElementById('grafico').style.display = 'none';
                M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
            }
            $('.preloader-background').css({'display': 'none'});                
        });
    }

    function drawGrafic(data)
    {
        var array = [
                        ['Cliente', 'Sub Total', { role: 'style' }, { role: 'annotation' } ]
                    ]
        for (let index = 0; index < data.length; index++) {
            const element = data[index];
            const cliente = [element.CLIENT_C_RAZON_SOCIAL, parseFloat(element.ALQDET_N_PRECIO_UNIT), '#b87333', parseFloat(element.ALQDET_N_PRECIO_UNIT)]
            array.push(cliente);
        }
        var data = google.visualization.arrayToDataTable(array);
        var chart = new google.visualization.ColumnChart(
            document.getElementById('chart_div'));
        chart.draw(data);
    }
</script>