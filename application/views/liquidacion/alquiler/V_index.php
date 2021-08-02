<?php 
    $fechaDesde = new DateTime();
    $fechaDesde->modify('first day of this month');    
	
	
	$fechaHasta = new DateTime();
    $fechaHasta->modify('first day of this month');
	$intervalo = new DateInterval('P1M');
	$fechaHasta->add($intervalo);
	
    //$fechaHasta = new DateTime();
?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Liquidaciones de Alquiler</a>
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

<!-- Buscador -->
<div class="section container center" style="padding-top: 0px">
    <div class="row" style="margin-bottom: 0px">
        <form action="<?= base_url() ?>tarifas" method="post">

            <div class="input-field col s12 m6 l6">
                <select id="cliente" name="cliente">
                    <option value="0" selected>Todos los Clientes</option>
                    <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                            <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Clientes</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="liquidacion" type="number" min="1" maxlength="9" name="liquidacion" class="validate">
                <label class="active" for="liquidacion">Liquidación</label> 
            </div>
            <div class="input-field col s12 m6 l3">
                <select id="sede" name="sede">
                    <option value="0" selected>Todas las Sedes</option>
                    <?php if($sedes): ?>
                        <?php foreach($sedes as $sede): ?> 
                            <option value="<?= $sede->SEDE_N_ID ?>"><?= $sede->SEDE_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Sedes</label>
            </div>
            <div class="input-field col s6 m6 l3">
                <select id="situacion">
                    <option value="" selected>Cualquier Situación</option>
                    <option value="0">Pendiente de O/C</option>
                    <option value="1">Liquidado</option>
                    <option value="2">En Navasoft</option>
                </select>
                <label>Situación</label>
            </div>
            <div class="input-field col s12 m6 l3">
                <input id="desde" type="text" value="<?= $fechaDesde->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="desde">Desde</label> 
            </div>
            <div class="input-field col s12 m6 l3">
                <input id="hasta" type="text" value="<?= $fechaHasta->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="hasta">Hasta</label> 
            </div>

            <div class="input-field col l12">
                <div class="btn-small" id="btnBuscar">Buscar
                </div>
            </div>
        </form>
    </div>    
</div>

<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="center-align">LIQUID.</th>
                <th class="left-align">CLIENTE</th>
                <th class="left-align">SEDE</th>
                <th class="center-align">PERIODOS</th>
                <th class="center-align">MONEDA</th>
                <th class="right-align">SUB TOTAL</th>
                <th class="center-align">SITUACION</th>
                <th class="center-align">IMPRIMIR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody id="resultados">
        </tbody>
    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" 
    href="<?= base_url()?>liq_alquiler/nuevo"><i class="material-icons">add</i></a>

<!-- Confirmar Eliminar -->
<div id="modalEliminar" class="modal">
    <div class="modal-content">
      <h4>Eliminar</h4>
      <p>¿Está seguro que desea elimniar el registro?</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
      <a id="btnConfirmar" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>

<!-- Ver periodos -->
<div id="modalPeriodos" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="left">Periodos</h4>
        <div class="section">
            <table class="striped" style="font-size: 12px;">
                <thead class="blue-grey darken-1" style="color: white">
                    <tr>
                        <th class="center-align">ACUERDO</th>
                        <th class="left-align">UBICACION</th>
                        <th class="center-align">F. INICIO</th>
                        <th class="center-align">F. TERMINO</th>
                        <th class="right-align">AREA</th>
                        <th class="center-align">MON</th>
                        <th class="right-align">PRECIO</th>
                        <th class="right-align">SUB TOTAL</th>
                    </tr>
                </thead>
                <tbody id="periodos">            
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Aceptar</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnBuscar = document.getElementById("btnBuscar"); 
        btnBuscar.addEventListener("click", buscar, false);
        
        liquidacion = getParameterByName('li')

        if(liquidacion != '')
        {
            $('#liquidacion').val(liquidacion)
            M.updateTextFields();
            buscar();
        }
    });

    function buscar()
    {
        console.log('Estoy buscando.. ')
        M.toast({html: 'Buscando resultado...', classes: 'rounded'});
        $('.preloader-background').css({'display': 'block'});
        $('#resultados').html('');

        let url = '<?= base_url() ?>api/execsp';
        let sp = 'LIQUIDACION_LIS_ALQUILER';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;

        $fecha_desde = $('#desde').val();
        $fecha_desde = $fecha_desde.split('/');
        let desde = $fecha_desde[2] + $fecha_desde[1] + $fecha_desde[0];
        
        $fecha_hasta = $('#hasta').val();
        $fecha_hasta = $fecha_hasta.split('/');
        let hasta = $fecha_hasta[2] + $fecha_hasta[1] + $fecha_hasta[0];

        let cliente = $('#cliente').val();
        let sede = $('#sede').val();

        let liquidacion = '0'; 
        if($('#liquidacion').val() != ''){
            liquidacion = $('#liquidacion').val();
        }
        
        let situacion = $('#situacion').val();        
        let data = {sp, empresa, desde, hasta, cliente, sede, liquidacion, situacion};        
        
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
            $('#total').html(data.length);
            if(data.length > 0)
            {
                M.toast({html: 'Cargando Liquidaciones', classes: 'rounded'});
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                
                    console.log(element)
                    $situacion = '';
                    $eliminar = `<i class="material-icons" style="cursor: pointer; color: #999999">delete</i>`
                    if(element.LIQCAB_C_SITUACION == 0)
                    {
                        $eliminar = `<i class="material-icons" style="cursor: pointer" onclick="confirmarEliminar(${element.EMPRES_N_ID},${element.LIQCAB_N_ID})">delete</i>`
                        $situacion = `<p style="color: #EE9A08;"><b>${element.LIQCAB_C_SITUACION_DES}</b><i class="material-icons" style="cursor: pointer"></i></p>`;
                    }else
                    if(element.LIQCAB_C_SITUACION == 1)
                    {
                        $eliminar = `<i class="material-icons" style="cursor: pointer" onclick="confirmarEliminar(${element.EMPRES_N_ID},${element.LIQCAB_N_ID})">delete</i>`
                        $situacion = `<p style="color: #1EB635;"><b>${element.LIQCAB_C_SITUACION_DES}</b><i class="material-icons" style="cursor: pointer"></i></p>`;                    
                    }else
                    if(element.LIQCAB_C_SITUACION == 2)
                    {
                        $eliminar = `<i class="material-icons tooltipped" style="color: #999999" data-position="bottom" data-tooltip="No puede eliminar, ya está en Navasoft">delete</i>`
                        $situacion = `<p style="color: #4690F5;"><b>${element.LIQCAB_C_SITUACION_DES}</b><i class="material-icons" style="cursor: pointer"></i></p>`;
                    }

                    $ver_ordenes = `${element.CANTIDAD_DETALLES} <i class="material-icons" style="vertical-align: middle; cursor: pointer" onclick="verPeriodos(${element.LIQCAB_N_ID})">event_note</i>`
                
                    $('#resultados').append(`   
                        <tr>
                            <td class="center-align">${element.LIQCAB_N_ID}</td>
                            <td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
                            <td class="left-align">${element.SEDE_C_DESCRIPCION}</td>
                            <td class="center-align">
                                ${$ver_ordenes}                
                            </td>
                            <td class="center-align">${element.MONEDA_C_SIMBOLO}</td>
                            <td class="right-align">${element.TOTAL}</td>
                            <td class="center-align">${$situacion}</td>
                            <td class="center-align">
                                <a href="liq_alquiler/reporte/${element.LIQCAB_N_ID}" target="_blank">
                                    <i class="material-icons">monetization_on</i>
                                </a>
                            </td>                        
                            <td class="center-align">
                                ${$eliminar}
                            </td>
                        </tr>
                                        `);
                }
            }else{
                M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
            }
            $('.preloader-background').css({'display': 'none'});                            
            $('.tooltipped').tooltip();
        });
    }

    function confirmarEliminar($empresa,$liquidacion)
    {
        console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'liq_alquiler/'+$empresa+'/'+$liquidacion+'/eliminar')
    }

  
    function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

    function verPeriodos(liquidacion)
    {
        console.log('Estoy buscando.. ')

        $('.preloader-background').css({'display': 'block'});
        
        let url = 'api/execsp';
        let sp = 'LIQUIDACION_LIS_REPORTE_ALQUILER';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        data = {sp, empresa, liquidacion};
        
        $('#periodos').html('');
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
            $('#total').html(data.length);
         
            for (let index = 0; index < data.length; index++) {
                const element = data[index];

                $('#periodos').append(`   
                                        <tr>
                                            <td class="center-align">${element.ALQUIL_N_ID}</td>
                                            <td class="left-align">${element.UBICAC_C_DESCRIPCION}</td>
                                            <td class="center-align">${element.ALQDET_C_FECHA_INICIO}</td>
                                            <td class="center-align">${element.ALQDET_C_FECHA_FINAL}</td>
                                            <td class="right-align">${element.ALQDET_N_AREA}</td>
                                            <td class="center-align">${element.MONEDA_C_SIMBOLO}</td>
                                            <td class="right-align">${element.ALQDET_N_PRECIO_UNIT}</td>
                                            <td class="right-align">${element.ALQDET_N_PRECIO_TOTAL}</td>
                                        </tr>
                                    `);
            }
            $('#modalPeriodos').modal('open');
            $('.preloader-background').css({'display': 'none'});                            
        });
    }
    
</script>