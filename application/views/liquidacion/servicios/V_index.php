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
            <a href="#!" class="breadcrumb">Liquidaciones de Servicios</a>
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
            <div class="input-field col s12 m6 l3">
                <input id="liquidacion" type="number" min="1" maxlength="9" name="liquidacion" class="validate">
                <label class="active" for="liquidacion">Liquidación</label> 
            </div>
            <div class="input-field col s12 m6 l3">
                <input id="orden_compra" type="text" maxlength="20" name="orden_compra" class="validate">
                <label class="active" for="orden_compra">Orden de Compra</label> 
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
                    <option value="0">Pendiente O/C</option>
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
                <th class="center-align">FECHA</th>
                <th class="center-align">O/C</th>
                <th class="center-align">ORDENES</th>
                <th class="center-align">MON</th>
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
    href="<?= base_url()?>liq_servicios/nuevo"><i class="material-icons">add</i></a>

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

<!-- Agregar OC -->
<div id="modalAgregarOC" class="modal">
    <form id="frmAgregarOC" action="<?= base_url() ?>liq_servicios/updateoc" method="post">
        <div class="modal-content">
            <h4>Asignar Orden de Compra</h4>
            <div class="row">
                <input id="ocempresa" type="hidden" name="ocempresa">
                <input id="ocliquidacion" type="hidden" name="ocliquidacion">
                <div class="input-field col s12">
                    <input id="orden_compra" type="text" name="orden_compra" placeholder=" " class="validate">
                    <label for="orden_compra">Orden de Compra del Cliente</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
            <input type="submit" class="modal-close btn" value="ACEPTAR">
        </div>
    </form>
</div>

 <!-- Ver ordenes -->
 <div id="modalOrdenes" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="left">Ordenes liquidadas</h4>
        <input type="hidden" id="liquidacion" >
        <div class="section">
            <table class="striped" style="font-size: 12px;">
                <thead class="blue-grey darken-1" style="color: white">
                    <tr>
                        <th class="center-align">ORDEN</th>          
                        <th class="center-align">FECHA</th>
                        <th class="left-align">SERVICIO</th>
                        <th class="left-align">PROYECTO</th>
                        <th class="center-align">HORAS</th>
                        <th class="center-align">MON</th>
                        <th class="right-align">PRECIO X HORA</th>
                        <th class="right-align">SUB TOTAL</th>
                    </tr>
                </thead>
                <tbody id="ordenes">            
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

        var url = 'liq_servicios/buscar';
        $fecha_desde = $('#desde').val();
        $fecha_desde = $fecha_desde.split('/');
        
        $fecha_hasta = $('#hasta').val();
        $fecha_hasta = $fecha_hasta.split('/');
        var cliente = $('#cliente').val();
        var sede = $('#sede').val();

        var orden_compra = '%'; 
        if($('#orden_compra').val() != '')
        {
            orden_compra = '%' + $('#orden_compra').val() + '%';
        }

        var liquidacion = '0'; 
        if($('#liquidacion').val() != '')
        {
            liquidacion = $('#liquidacion').val();
        }
        
        var situacion = $('#situacion').val();
        
        var data = {
                    empresa: <?= $empresa->EMPRES_N_ID ?>, 
                    desde: $fecha_desde[2] + $fecha_desde[1] + $fecha_desde[0],
                    hasta: $fecha_hasta[2] + $fecha_hasta[1] + $fecha_hasta[0],
                    cliente: cliente,
                    sede: sede,
                    orden_compra: orden_compra,
                    liquidacion: liquidacion,
                    situacion: situacion,                    
                    tipo: 'S'
                    };
        
        $('#resultados').html('');
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

                    if(element.CLIENT_C_REQUIERE_OC == 1)
                    {
                        if(element.LIQCAB_C_SITUACION < 2)
                        {
                            $orden_compra = `${element.LIQCAB_C_ORDEN_COMPRA} <i class="material-icons" style="vertical-align: middle; cursor: pointer" onclick="agregarOC(${element.EMPRES_N_ID},${element.LIQCAB_N_ID})">speaker_notes</i>`
                        }else{
                            $orden_compra = `${element.LIQCAB_C_ORDEN_COMPRA} <i class="material-icons" style="vertical-align: middle; cursor: pointer; color: #999999">speaker_notes</i>`
                        }
                    }else{
                        $orden_compra = `${element.LIQCAB_C_ORDEN_COMPRA} <i class="material-icons tooltipped"  data-position="bottom" data-tooltip="No requiere O/C" style="vertical-align: middle; cursor: pointer; color: #999999">speaker_notes</i>`
                    }

                    $ver_ordenes = `${element.SERVIC_N_CANTIDAD} <i class="material-icons" style="vertical-align: middle; cursor: pointer" onclick="verOrdenes(${element.EMPRES_N_ID},${element.LIQCAB_N_ID})">event_note</i>`

                    $('#resultados').append(`   
                        <tr>
                            <td class="center-align">${element.LIQCAB_N_ID}</td>
                            <td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
                            <td class="left-align">${element.SEDE_C_DESCRIPCION}</td>
                            <td class="center-align">${element.LIQCAB_C_FECHA}</td>
                            <td class="right-align">${$orden_compra}</td>
                            <td class="center-align">
                                ${$ver_ordenes}                
                            </td>
                            <td class="center-align">${element.SERVIC_C_MONEDA}</td>
                            <td class="right-align">${element.SERVIC_N_IMPORTE}</td>
                            <td class="center-align">${$situacion}</td>
                            <td class="center-align">
                                <a href="liq_servicios/reporte/${element.LIQCAB_N_ID}" target="_blank">
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
        $('#btnConfirmar').attr('href', 'liq_servicios/'+$empresa+'/'+$liquidacion+'/eliminar')
    }

    function agregarOC($empresa,$liquidacion)
    {
        console.log('confirmar eliminar')
        $('#modalAgregarOC').modal('open');
        $('#ocempresa').val($empresa)
        $('#ocliquidacion').val($liquidacion)
        //$('#frmAgregarOC').attr('action', 'liq_servicios/'+$empresa+'/'+$liquidacion+'/updateoc')
    }

    function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

    function verOrdenes($empresa,$liquidacion)
    {
        console.log('Estoy buscando.. ')

        $('.preloader-background').css({'display': 'block'});
        $('#liquidacion').val($liquidacion)
        let url = 'api/execsp';
        let sp = 'LIQUIDACION_LIS_REPORTE_SERVICIOS';
        let empresa = $empresa;
        let liquidacion = $liquidacion;
        data = {sp, empresa, liquidacion};
        
        $('#ordenes').html('');
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
            for (let index = 0; index < data.length; index++) {
                const element = data[index];

                $('#ordenes').append(`   
                                        <tr>
                                            <td class="center-align">${element.ORDSER_N_ID}</td>
                                            <td class="center-align">${element.ORDSER_D_FECHA}</td>
                                            <td class="left-align">${element.SERVIC_C_DESCRIPCION}</td>
                                            <td class="left-align">${element.ORDSER_C_COD_PROYECTO}</td>
                                            <td class="center-align">${element.ORDSER_N_HORAS}</td>
                                            <td class="center-align">${element.MONEDA_C_SIMBOLO}</td>
                                            <td class="right-align">${element.ORDSER_N_PRECIO_UNIT}</td>
                                            <td class="right-align">${element.ORDSER_N_PRECIO_TOTAL}</td>
                                        </tr>
                                    `);
            }
            $('#modalOrdenes').modal('open');
            $('.preloader-background').css({'display': 'none'});                            
        });
    }
</script>