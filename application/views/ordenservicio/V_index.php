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
            <a href="#!" class="breadcrumb">Orden Servicio</a>
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
        <form action="<?= base_url() ?>ordenes" method="post" id="form">
            <div class="input-field col s12 m6 l6">
                <select id="cliente" name="cliente">
                    <option value="0"  selected>Todos los Clientes</option>     
                    <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                            <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Clientes</label>
            </div>
            <div class="input-field col s3">
                <input id="numero" type="number" min="1" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="numero"  class="validate">
                <label class="active" for="numero">Orden de Servicio</label> 
            </div>
            <div class="input-field col s3">
                <input id="solicitante" type="text" name="solicitante" maxlength="50" class="validate">
                <label class="active" for="solicitante">Solicitante</label> 
            </div>

            <div class="input-field col s12 m6 l3">
                <select id="sede" name="sede">
                    <option value="0"  selected>Todas las Sedes</option>
                    <?php if($sedes): ?>
                        <?php foreach($sedes as $sede): ?> 
                            <option value="<?= $sede->SEDE_N_ID ?>"><?= $sede->SEDE_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Sedes</label>
            </div>
            <div class="input-field col s6 m6 l3">
                <select id="servicio" name="servicio">
                    <option value="0"  selected>Todos los Servicios</option>
                    <?php if($servicios): ?>
                        <?php foreach($servicios as $servicio): ?> 
                            <option value="<?= $servicio->SERVIC_N_ID ?>"><?= $servicio->SERVIC_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Servicios</label>
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
                <div class="btn-small" id="btn_buscar">Buscar
                </div>
            </div>
        </form>
    </div>    
</div>

<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="center-align">ORDEN</th>
                <th class="left-align">SERVICIO</th>
                <th class="left-align">SEDE</th>
                <th class="left-align">CLIENTE</th>
                <th class="center-align">FECHA</th>
                <th class="center-align">HORAS</th>
                <th class="center-align">MON</th>
                <th class="right-align">PRECIO X HORA</th>
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
    href="<?= base_url()?>ordenservicio/nuevo"><i class="material-icons">add</i></a>

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("pagina")

        numero = getParameterByName('os')
        if(numero != '')
        {
            $('#numero').val(numero)
            M.updateTextFields();
            buscar()
        }
        var btn_buscar = document.getElementById("btn_buscar"); 
        btn_buscar.addEventListener("click", buscar, false); 
    });
    
    function buscar()
    {
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        var numero=0;
        var sede=0;
        var cliente=0;
        var servicio=0;

        if(document.getElementById('numero').value.trim() !='' )
        {
            numero= document.getElementById('numero').value.trim();
        }
        if(document.getElementById('sede').value.trim() !='' )
        {
            sede= document.getElementById('sede').value.trim();
        }
        if(document.getElementById('cliente').value.trim() !='' )
        {
            cliente= document.getElementById('cliente').value.trim();
        }
        if(document.getElementById('servicio').value.trim() !='' )
        {
            servicio= document.getElementById('servicio').value.trim();
        }

        $fecha_desde = $('#desde').val();
        $fecha_desde = $fecha_desde.split('/');
        
        $fecha_hasta = $('#hasta').val();
        $fecha_hasta = $fecha_hasta.split('/');

        var solicitante = '%'; 
        if($('#solicitante').val() != '')
        {
            solicitante = '%' + $('#solicitante').val() + '%';
        }

        console.log("Buscando")
        M.toast({html: 'Buscando resultado...', classes: 'rounded'});
        $('.preloader-background').css({'display': 'block'});
        var url = 'api/ordenservicio';
        var data = {
                    empresa: <?= $empresa->EMPRES_N_ID ?>, 
                    desde: $fecha_desde[2] + $fecha_desde[1] + $fecha_desde[0],
                    hasta: $fecha_hasta[2] + $fecha_hasta[1] + $fecha_hasta[0],
                    numero: numero,
                    sede: sede,
                    cliente: cliente,
                    servicio: servicio,
                    solicitante: solicitante
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
                M.toast({html: 'Cargando Ordenes de Servicio', classes: 'rounded'});
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    
                    if(element.ORDSER_C_SITUACION == 0)
                    {
                        $situacion = `<p style="color: #EE9A08;"><b>${element.ORDSER_C_SITUACION_DESCRIPCION}</b><i class="material-icons" style="cursor: pointer"></i></p>`;
                    }
                    if(element.ORDSER_C_SITUACION == 1)
                    {
                        $situacion = `<p style="color: #1EB635;"><b>${element.ORDSER_C_SITUACION_DESCRIPCION}</b><i class="material-icons" style="cursor: pointer"></i></p>`;
                    }

                    $eliminar = `<i class="material-icons" style="cursor: pointer" onclick="confirmarEliminar(${element.EMPRES_N_ID},${element.ORDSER_N_ID})">delete</i>`
                    if(element.ORDSER_C_SITUACION == 1)
                    {
                        $eliminar = `<i class="material-icons tooltipped" style="color: #999999" data-position="bottom" data-tooltip="No puede eliminar, tiene liquidación">delete</i>`
                    }

                    $('#resultados').append(`   
                        <tr>
                            <td class="center-align">${element.ORDSER_N_ID}</td>
                            <td class="left-align">${element.SERVIC_C_DESCRIPCION}</td>
                            <td class="left-align">${element.SEDE_C_DESCRIPCION}</td>
                            <td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
                            <td class="center-align">${element.ORDSER_D_FECHA}</td>
                            <td class="center-align">${element.ORDSER_N_HORAS}</td>
                            <td class="center-align">${element.MONEDA_C_SIMBOLO}</td>
                            <td class="right-align">${element.ORDSER_N_PRECIO_UNIT}</td>
                            <td class="center-align">
                                ${$situacion}
                            </td>
                            <td class="center-align">
                                <a href="ordenservicio/reporte/${element.ORDSER_N_ID}" target="_blank">
                                    <i class="material-icons">print</i>
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

    function confirmarEliminar($empresa,$servicio)
    {
        console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'ordenservicio/'+$empresa+'/'+$servicio+'/eliminar')
    }

    function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
</script>
