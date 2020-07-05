<?php 
    $fechaDesde = new DateTime();
    //$fechaDesde->modify('-1 month');
    $fechaDesde->modify('first day of this month');    
    $fechaHasta = new DateTime();
?>
<style>
    .column-filtros
    {
        position:absolute; 
        top: 128px; 
        bottom: 30px;
        overflow-y: scroll;
    }
    .column-result
    {
        position:absolute; 
        left: 34%!important;
    }
    h5
    {
        padding-left: 16px;
    }
</style>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Indicador por Cliente</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2">0</span>
                    </b>
                </div>
            </div>
        </ul>
    </div>
</nav>
<div class="row">
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
                    <option value="" disabled>Escoge una opción</option>
                    <?php foreach ($monedas as $row): ?>
                        <option value="<?= $row->MONEDA_N_ID ?>"><?= $row->MONEDA_C_DESCRIPCION ?> (<?= $row->MONEDA_C_SIMBOLO ?>)</option>
                    <?php endforeach; ?>
                </select>
                <label>Moneda</label>
            </div>  
            <div class="col s12 m6 l4 section">
                <h5>Sedes</h5>
                <div id="sedes"></div>
            </div>
            <div class="col s12 m6 l4 section">
                <h5>Clientes</h5>
                <div id="clientes"></div>
            </div>
            <div class="col s12 m6 l4 section">
                <h5>Servicios</h5>
                <div id="servicios"></div>
            </div>
            <div class="input-field col s12">
                <div class="btn-small" id="btnBuscar">Buscar</div>
            </div>
        </div>        
    </div>
    <div class="col s12">
        <div id="chart_div"></div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnBuscar = document.getElementById("btnBuscar"); 
        btnBuscar.addEventListener("click", buscar, false);
        sedes()
        
        
        
        google.charts.load('current', {packages: ['corechart', 'bar']});
        
    });
    async function sedes()
    {
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
            console.log(data)
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
    async function clientes()
    {
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
            console.log(data)
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
            console.log('Clientes cargados');
            servicios()
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
    function servicios()
    {
        $('.preloader-background').css({'display': 'block'});         

        let url = 'api/execsp';
        let sp = 'SERVICIO_LIS_ORDEN_SERVICIO';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let servicio = 0;
        let data = {sp, empresa, servicio};

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
            console.log(data)
            for (let index = 0; index < data.length; index++) {
                const element = data[index];
                
                $('#servicios').append(`
                    <div class="input-field col s12">
                        <div class="switch">
                            <label>
                                <input type="checkbox" class="servicio" value="${element.SERVIC_N_ID}" checked>
                                <span class="lever"></span>
                                    ${element.SERVIC_C_DESCRIPCION}
                            </label>
                        </div>
                    </div>
                    `)
            }
            console.log('Servicios Cargados');
            buscar();
            $('.preloader-background').css({'display': 'none'});                
        });
    }
    function servicios_checkados()
    {
        let checados = $('.servicio:checked')
        let servicios = '';
        for (let index = 0; index < checados.length; index++) {
            const element = checados[index];
            if(index > 0 && index < checados.length)
            {
                servicios = servicios + '|';
            }
            servicios = servicios + element.value;
        }
        return servicios;
    }
    function buscar()
    {
        $('.preloader-background').css({'display': 'block'});    
        let fecha_desde = $('#desde').val();
        fecha_desde = fecha_desde.split('/');
        fecha_desde = fecha_desde[2] + fecha_desde[1] + fecha_desde[0];
        
        let fecha_hasta = $('#hasta').val();
        fecha_hasta = fecha_hasta.split('/');     
        fecha_hasta = fecha_hasta[2] + fecha_hasta[1] + fecha_hasta[0];

        let url = 'api/execsp';
        let sp = 'INDICADOR_SERVICIOS_LIS';
        let tipo = 'C';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let cliente = clientes_checkados();
        let sede = sedes_checkados();
        let servicio = servicios_checkados();
        let moneda = parseInt($('#moneda').val());
        let data = {sp, tipo, empresa, cliente, sede, servicio, fecha_desde, fecha_hasta, moneda};

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
            console.log('encontré resultados')
            console.log(data)
            //google.charts.setOnLoadCallback(drawGrafic);
            drawGrafic(data)
            $('.preloader-background').css({'display': 'none'});                
        });
    }
    function drawGrafic(data)
    {
        var array = [
                        ['Cliente', 'Precio Total', { role: 'style' }, { role: 'annotation' } ]
                    ]
        for (let index = 0; index < data.length; index++) {
            console.log('vuelta ' + (index + 1));
            console.log(array);
            const element = data[index];
            const cliente = [element.CLIENT_C_RAZON_SOCIAL, parseFloat(element.ORDSER_N_PRECIO_TOTAL), '#b87333', parseFloat(element.ORDSER_N_PRECIO_TOTAL)]
            array.push(cliente);
            console.log(array);
        }
        var data = google.visualization.arrayToDataTable(array);
        var chart = new google.visualization.ColumnChart(
            document.getElementById('chart_div'));
        chart.draw(data);
    }
</script>