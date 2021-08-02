<style>
#modal1 { width: 75% !important ; height: 75% !important ; }
i.icon-white {
    color: #FFFFFF;
}
#modalIngreso {width: 65% !important ;height: 65% !important ; }

#modalSalida {width: 65% !important ;height: 65% !important ; }


</style> 
<?php 
    $fechaDesde = new DateTime();
	$fechaDesde->modify('-1 day');
    //$fechaDesde->modify('-1 month');
    //$fechaDesde->modify('first day of this month'); 
	
	$fechaHasta = new DateTime();
    //$fechaHasta->modify('first day of this month');
	//$intervalo = new DateInterval('P1M');
	//$fechaHasta->add($intervalo);
    //$fechaHasta = new DateTime();
	$fecha = new DateTime(); 
	
	$hora = new DateTime();
	
	//echo $categoria->CATEGO_N_ID;
    $vcategoria	= $categoria->CATEGO_N_ID;
?>

<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Ingreso y Salida</a>
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
<div class="section container center" style="padding-top: 0px">
    <div class="row" style="margin-bottom: 0px">
        <form action="<?= base_url() ?>clientes" method="post">
            <div class="input-field col s12 m6 l4">
                <input id="dni" maxlength="20" type="text" name="dni"  class="validate">
                <label class="active" for="dni">Número de Documento</label> 
            </div>
			<div class="input-field col s12 m6 l4">
                <!--<input id="empresa_visitante" maxlength="50" type="text" name="empresa_visitante"  class="validate" autocomplete="off">-->
				<input id="empresa_visitante" maxlength="50" type="text" name="empresa_visitante"  class="autocomplete validate" autocomplete="off" >
				<!--<input id="idempresa_visitante" name="idempresa_visitante" type="text">-->
                <label class="active" for="empresa_visitante">Empresa</label> 
            </div>		
			
			<div class="input-field col s12 m6 l4">
                <input id="apellido_visitante" maxlength="50" type="text" class="validate">
                <label class="active" for="apellido_visitante">Apellido Visitante</label> 
            </div>
	
			<div class="input-field col s12 m6 l4">
                <input id="placa_" maxlength="50" type="text" class="validate">
                <label class="active" for="placa_">Placa</label> 
            </div>
		
			<div class="input-field col s12 m6 l4">
                <input id="desde" type="text" value="<?= $fechaDesde->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="desde">Desde</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="hasta" type="text" value="<?= $fechaHasta->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="hasta">Hasta</label> 
            </div>
			<div class="input-field col s12 m6 l4">
                <select id="situacion" required>
                    <option value="0">Todos</option>
                    <option value="1">Por Salir</option>
                </select>
                <label for="tipo_documento">Situación</label>
            </div>
			<div class="input-field col s12 m6 l4">
				<select id="tipo_ingreso" required>
				<option value="0">Todos</option>
					<?php foreach ($tipo_ingreso as $row):?>
						<option value="<?= $row->TIPING_N_ID?>"> <?= $row->TIPING_C_DESCRIPCION ?> </option>
					<?php endforeach; ?>
				</select>
				<label for="tipo_ingreso">Tipo de Ingreso</label>
			</div>
            <div class="input-field col s4">
                <div class="btn-small" id="btnBuscar" onclick="buscar()" >Buscar</div>
				<!--<a href="<?php echo base_url(); ?>movimientopersona/reporte"  class="btn-small" onclick="MovimientoPersona()"   target="_blank">Descargar excel</a>-->
				<!--<a class="btn-small" onclick="MovimientoPersona()"   target="_blank">Descargar excel</a>-->
            </div>
        </form>
    </div>    
</div> 

<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="left-align">REGISTRADO</th>
				<th class="left-align">DNI</th>
				<th class="left-align">EMPRESA</th>
				<th class="left-align">NOMBRES</th>
                <th class="left-align">APELLIDOS</th>
				<th class="left-align">TIPO</th>
				<th class="center-align">FECHA</th>
				<th class="center-align">LLEGADA</th>
				<th class="center-align">INGRESO</th>
				<th class="center-align">SALIDA</th>
				<th class="center-align">IMPRIMIR</th>
				<th class="left-align">ELIMINAR</th>
				<th class="left-align">VER</th>				
            </tr>
        </thead>
        <tbody id="resultados">   
        </tbody>
    </table>
</div>

<?php
if($vcategoria==3){
?>
<a class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" href="<?= base_url()?>ingreso/nuevoalterno" id="addbutton"><i class="material-icons">add</i></a>
<?php 
}
//else{
?>
<!--<a class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" href="<?= base_url()?>ingreso/nuevoalterno" id="addbutton" ><i class="material-icons">add</i></a>
-->
<?php	
//}
?>



<!-- Modal Structure -->
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

<div id="modalIngreso" class="modal">
    <div class="modal-content">
        <h4>Ingreso</h4>
        <p>¿Está seguro que desea confirmar el INGRESO ?</p>
		
		
		<div class="row">
		
		
		<!--<div class="input-field col s6 m6 l2">-->
		<input placeholder=" " id="fech" type="hidden" value="<?= $fecha->format('Y-m-d') ?>" style="width:100px;"disabled>
		<!--
		<label for="fech" id="fech_"  >Fecha Actual</label>
		</div>
		-->
		<!--<div class="input-field col s6 m6 l2">-->
		<input placeholder=" " id="hora" type="hidden" value="<?= $hora->format('H:i:s') ?>" class="timepicker" style="width:100px;" disabled >
		<!--
		<label for="hora" id="horala">Hora</label>
		</div>
		-->
		
		<div class="input-field col s6 m6 l4">
		<input type='datetime-local' id='fechahorai' name='fechahorai' value="" ondblclick="EditarIngreso()" readonly>
		<label class="active" for="fechahorai" id="labelfechahorai" disabled >Fecha Actual</label>
		</div>
		<!--
		<div class="input-field col s6 m6 l2">
		<input type='datetime-local' id='fechahora' name='fechahora' value='' disabled>
		</div>
		-->
		
		<input id="estadoingreso" type="hidden" name="estadoingreso" value="0">
		<input id="idmovimientoing" type="hidden" name="idmovimientoing" value="0">
		

		

		<!--
		<input type="datetime-local" id="meeting-time" value="2018-06-12T19:30">
		-->
		
		<!---
		<div class="input-field col s6 m6 l2">
		<div class="btn-small" id="btneditaring" onclick="EditarIngreso()" >Editar</div>
		</div>
		-->
		
		</div>
		
		
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
        <a id="botonConfirmar" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>

<div id="modalSalida" class="modal">
    <div class="modal-content">
        <h4>Salida</h4>
        <p>¿Está seguro que desea confirmar la SALIDA?</p>
		
		
		<div class="row">
		
		<!--<div class="input-field col s6 m6 l2">-->
		<input placeholder=" " id="fech2" type="hidden" value="<?= $fecha->format('Y-m-d') ?>" style="width:100px;"disabled>
		<!--
		<label for="fech2" id="fech2_"  >Fecha Actual</label>
		</div>
		--->
		
		<!--<div class="input-field col s6 m6 l2">-->
	    <input placeholder=" " id="hora2" type="hidden" value="<?= $hora->format('H:i:s') ?>" class="timepicker" style="width:100px;" disabled >
		<!--
		<label for="hora2" id="horala2">Hora</label>
		</div>
		-->
		
		<div class="input-field col s7 m7 l7">
		<input type='datetime-local' id='fechahoras' name='fechahoras' value="" ondblclick="EditarSalida()" readonly>
		<label class="active" for="fechahoras" id="labelfechahoras" disabled >Fecha Actual</label>
		</div>
		
		<input id="estadosalida" type="hidden" name="estadosalida" value="0">
		<input id="idmovimientosal" type="hidden" name="idmovimientosal" value="0">
			
		<div class="input-field col s6">
				<select id="tipo_salida" >
					<option value="0">Seleccionar Tipo de Salida</option>
					<?php foreach ($tipo_ingreso as $row): ?>
						<option value="<?= $row->TIPING_N_ID?>"><?= $row->TIPING_C_DESCRIPCION ?> </option>
					<?php endforeach; ?>
				</select>
				<label>Tipo de Salida</label>
		</div>
		
		
		<div id="divvehicularsalida" >
			
		<div id="divtipo_unidad">
			<div class="input-field col s6">
				<select id="tipo_unidadsalida">
					<option value="0">Seleccionar Tipo de Unidad</option>
					<?php foreach ($tipo_unidad as $row): ?>
						<option value="<?= $row->TIPUNI_N_ID?>"><?= $row->TIPUNI_C_DESCRIPCION ?> </option>
					<?php endforeach; ?>
				</select>
				<label>Tipo de Unidad</label>
			</div>
		</div>
		
		
		<div id="divtipo_unidad2" style="display: none;">
			<div class="input-field col s6">
				 <input id="txttipo_unidadsalida" type="text" value=" " name="txttipo_unidadsalida"  disabled readonly >
				 <input id="idtipo_unidadsalida" type="hidden" value=" " name="idtipo_unidadsalida"  disabled readonly >
				<label>Tipo de Unidad</label>
			</div>
		</div>
			
	
			<div class="input-field col s12 m6 l3">
				<input id="placasalida" maxlength="7" type="text" onkeypress="PlacaUnidad(this)" placeholder="xxx-xxx"    >
				<label class="active" for="placasalida">Placa</label>
			</div>
			
			<div class="input-field col s12 m6 l3">
				<input id="placasalida2" maxlength="7" type="text" placeholder="xxx-xxx"     >
				<label class="active" for="placasalida2">Placa 2</label>
			</div>
			
		</div>	
		
		
		<div class="input-field col s6" >
                <input id="temperaturasalida" type="number" value="" name="temperaturasalida" >
				<label class="active" for="temperaturasalida">Temperatura</label>
		</div>
		
		
		
		<div class="input-field col s12">
			<!--<textarea id="observaciones" maxlength="100" class="materialize-textarea" ></textarea>-->
			<input id="observacionsalida" maxlength="200" type="text" value=" " >
			<label for="observacionsalida">Observaciones</label>
        </div>
		

		
		</div>
		
		
		
		
		
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
        <a id="botonConfirmarSalida" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>


<div id="modal1" class="modal">
    <div class="modal-content">
	
	<!---->
	<div class="row">
	<!--
		<div class="input-field col s12 m6 l3">
			<input placeholder=" " id="fecha" type="text" class="validate" readonly >
			<label for="fecha">Fecha Actual</label>
		</div>
		-->
		<div class="input-field col s12 m6 l3">
		<input id="tdocumento" type="text" name="tdocumento" value=" " readonly disabled >
			<label for="tdocumento">Tipo de Documento</label>
		</div>	
		<div class="input-field col s12 m6 l3">
			<!--<input id="documento" type="text" class="validate" onchange="buscar()" onfocusout="buscar()">-->
			<input id="ndocumento" type="text" name="ndocumento" value=" "  readonly disabled  >
			<label for="ndocumento">Número de Documento</label>
		</div>
			
	</div>

	<div class="row">
		<div class="col s8">
			<!--<form action="<?= base_url() ?>ingreso/crear" method="post" id="form">-->
			<div class="input-field col s12" >
				<input class="ancho" id="empresa" type="text" value=" " readonly disabled>	
				<label class="active" for="empresa">Empresa Visitante</label>
			</div>	

			<div class="input-field col s6" >
				<input type="hidden" id="persona_id">
				<input  id="apellidos" type="text" value=" " name="apellidos" readonly disabled >
				<label class="active" for="apellidos">Apellidos</label>
			</div>
			
			<div class="input-field col s6"  >
				<input class="ancho" id="nombres" type="text" value=" " name="nombres" readonly disabled>
				<label class="active" for="nombres">Nombres</label>
			</div>
						
			<div class="input-field col s6" >
				<input id="scrt_ini" type="text" value=" " name="scrt_ini" class="datepicker" disabled readonly >
                <label class="active" for="scrt_ini">SCTR Inicio</label>
			</div>
			
			<div class="input-field col s6"  >
				<input id="scrt_fin" type="text" value=" " name="scrt_fin" class="datepicker" disabled readonly>
                <label class="active" for="scrt_fin">SCTR Vencimiento</label> 
			</div>		

		<!--</form>-->
		
		
			<div class="input-field col s6">
				<input  id="tipo_ingreso_" type="text" value=" " name="tipo_ingreso_" readonly disabled >
				<label>Tipo de Ingreso</label>
			</div>
			
			
			<!---->	
			
			<div id="divvehicular" >
			
			<div class="input-field col s6">
			<input  id="tipo_unidad" type="text" value=" " name="tipo_unidad" readonly disabled >
				<label>Tipo de Unidad</label>
			</div>
		
		
			<div class="input-field col s12 m6 l3">
				<input id="placa" maxlength="20" type="text" value=" " disabled  >
				<label class="active" for="placa">Placa</label>
			</div>
			
			<div class="input-field col s12 m6 l3">
				<input id="placa2" maxlength="20" type="text" value=" " disabled  >
				<label class="active" for="placa2">Placa2</label>
			</div>
			
			<div class="input-field col s12 m6 l3">
				<input id="bruto" maxlength="20" type="text" value=" " disabled  >
				<label class="active" for="bruto">Bruto</label>
			</div>
			
			<div class="input-field col s12 m6 l3">
				<input id="tara" maxlength="20" type="text" value=" " disabled  >
				<label class="active" for="tara">Tara</label>
			</div>
			
			<div class="input-field col s12 m6 l3">
				<input id="neto" maxlength="20" type="text" value=" " disabled  >
				<label class="active" for="neto">Neto</label>
			</div>
			
			</div>
			
			<!---->	
			
			<div class="input-field col s6">
			
			<input  id="motivo" type="text" value=" " name="motivo" readonly disabled >
				<label>Motivo de la Visita</label>
			</div>

			<div class="input-field col s12 ">
			<input class="ancho" id="empresavisitada" type="text" value=" " name="empresavisitada" readonly disabled>
			<label class="active" for="empresavisitada">Empresa Visitada</label>
			</div>
			
			<div class="input-field col s12">
			
			<input class="ancho" id="personacontacto" type="text" value=" " name="personacontacto" readonly disabled>
			<label class="active" for="personacontacto">Persona de Contácto</label>
			</div>
		</div>
		<div class="col s4">
			<img id="foto" style="width:100%"  src="<?= base_url()?>assets/images/sin-imagen.jpg"/>
			<p id="bloqueado" class="center"></p>
			<p id="sctr" class="center"></p>
			<p id="ingreso" class="center"></p>
		</div>
	</div>
	
	<div class="row">
		<div class="input-field col s12 m6 l4">
			<input id="remision" maxlength="200" type="text" value=" " >
			<label class="active" for="remision">Guía Remisión</label>
		</div>
		<div class="input-field col s12 m6 l4">
			<input id="obra" maxlength="200" type="text" value=" " >
			<label class="active"  for="obra">Obra</label>
		</div>
		<div class="input-field col s12 m6 l4">
			<input id="orden_compra" maxlength="200" type="text" value=" " >
			<label class="active"  for="orden_compra" >Orden de Compra</label>
		</div> 
		
		<div class="input-field col s8">
			<!--<textarea id="descripcion" maxlength="100" class="materialize-textarea" ></textarea>-->
			<input id="descripcion" maxlength="200" type="text" value=" "  >
			<label for="descripcion">Descripcion</label>
        </div>
				
		<div class="input-field col s4">
			<!--<textarea id="observaciones" maxlength="100" class="materialize-textarea" ></textarea>-->
			<input id="observaciones" maxlength="200" type="text" value=" " >
			<label for="observaciones">Observaciones</label>
        </div>
	</div>
	
	<div class="input-field col s12">
		<input type="hidden" id="idmovimiento">
        <div class="btn-small" id="BtnGuardar" onclick="guardar()" >Guardar</div>
    </div>

 <!--Fin-->
 
</div>	
</div>	


<div id="modal2" class="modal">
	<div class="modal-content">
	  
	  	<div class="row">
	  
			<div class="input-field col s12 m6 l3">
			<input id="tdocumento2" type="text" name="tdocumento2" value=" " readonly disabled >
			<label for="tdocumento2">Tipo de Documento</label>
			</div>

			<div class="input-field col s12 m6 l3">
			<input id="ndocumento2" type="text" name="ndocumento2" value=" "  readonly disabled  >
			<label for="ndocumento2">Número de Documento</label>
			</div>		
	  
	  	</div>
		
		<div class="row">
		
		<div class="col s8">
			<div class="input-field col s12" >
			<input class="ancho" id="empresa2" type="text" value=" " readonly disabled>	
			<label class="active" for="empresa2">Empresa Visitante</label>
			</div>	

			<div class="input-field col s6" >
			<input  id="apellidos2" type="text" value=" " name="apellidos2" readonly disabled >
			<label class="active" for="apellidos2">Apellidos</label>
			</div>

			<div class="input-field col s6"  >
			<input class="ancho" id="nombres2" type="text" value=" " name="nombres2" readonly disabled>
			<label class="active" for="nombres2">Nombres</label>
			</div>
			
			<div class="input-field col s6">
				<input  id="tipo_ingreso2" type="text" value=" " name="tipo_ingreso2" readonly disabled >
				<label>Tipo de Ingreso</label>
			</div>
			
			<div id="divvehicular2" >
			
			<div class="input-field col s6">
			<input  id="tipo_unidad2" type="text" value=" " name="tipo_unidad2" readonly disabled >
				<label>Tipo de Unidad</label>
			</div>
		
		
			<div class="input-field col s12 m6 l3">
				<input id="placa_2" maxlength="20" type="text" value=" " disabled  >
				<label class="active" for="placa_2">Placa</label>
			</div>
			
			<div class="input-field col s12 m6 l3">
				<input id="placa2_2" maxlength="20" type="text" value=" " disabled  >
				<label class="active" for="placa2_2">Placa2</label>
			</div>			
			</div>
			
			<div class="input-field col s6">
				<input  id="temperatura2" type="text" value=" " name="temperatura2" readonly disabled >
				<label>Temperatura</label>
			</div>
			
		</div>
		<div class="col s4">
			<img id="foto2" style="width:100%"  src="<?= base_url()?>assets/images/sin-imagen.jpg"/>
			<!--
			<p id="bloqueado" class="center"></p>
			<p id="sctr" class="center"></p>
			<p id="ingreso" class="center"></p>
			-->
		</div>
	
	
		</div>
		
		<div class="row">
	
		<div class="input-field col s12">
			<input id="observaciones2" maxlength="200" type="text" value=" " readonly disabled >
			<label for="observaciones2">Observaciones</label>
        </div>
		</div>
	
	
	
	
	
	
	</div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
		let  altercategoria = <?= $categoria->CATEGO_N_ID ?>;
		
	if(altercategoria==7 || altercategoria==4 || altercategoria==15 || altercategoria==16  ){
	$("#addbutton").attr("disabled",true);	
}
		
		//cargar siempre la pagina
		buscar();
		
		let n = getParameterByName('id');
		
		console.log("ingresa a carga automatica");
		
		
		if(n != '')
		{
			document.getElementById('dni').value = n;
			M.updateTextFields();
			buscar();
		}
		
	
$('#modal1').modal({
   onCloseStart(){
	   $("#remision").attr("disabled",false);
	   $("#obra").attr("disabled",false);
	   $("#orden_compra").attr("disabled",false);
	   $("#observaciones").attr("disabled",false);
	   $("#descripcion").attr("disabled",false);
	   $("#BtnGuardar").attr("disabled",false);
	   document.getElementById('tdocumento').value = "";
		document.getElementById('ndocumento').value = "";
		document.getElementById('empresa').value = "";
		document.getElementById('nombres').value = "";
		document.getElementById('apellidos').value = "";
		document.getElementById('scrt_ini').value = "";
		document.getElementById('scrt_fin').value = "";
		document.getElementById('tipo_ingreso_').value = "";
		document.getElementById('tipo_unidad').value = ""; 
		document.getElementById('placa').value = "";
		document.getElementById('bruto').value = "";
		document.getElementById('tara').value = "";
		document.getElementById('neto').value = "";
		document.getElementById('motivo').value = "";
		document.getElementById('empresavisitada').value = "";
		document.getElementById('personacontacto').value = "";
		document.getElementById('remision').value = "";
		document.getElementById('obra').value = "";
		document.getElementById('orden_compra').value = "";
		document.getElementById('observaciones').value = "";
		document.getElementById('descripcion').value = "";
		document.getElementById('foto').src = "assets/images/sin-imagen.jpg";
	   
	   
        },
   onCloseEnd(){

        },
});
		
	
$('.timepicker').timepicker({
		twelveHour : false,
});


///
let url = '<?= base_url() ?>api/execsp';
	let sp = "CLIENTE_ESCLIENTE_LIS";
	
	let idempresa = <?= $empresa->EMPRES_N_ID ?>;
	let idcliente = 2;
	
	let data = {sp, idempresa, idcliente};
	
	fetch(url, {

			method: "POST",
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json'
			}
		})
		.then(function(response){
			return response.json();
		})
		.then(function(data){
			if(data.length > 0 ){
			
			var clientArray = data;
			var clientList = {};
			for (var i = 0; i < clientArray.length; i++) {
			clientList[clientArray[i].CLIENT_C_RAZON_SOCIAL] = null;
			}
			$('input.autocomplete').autocomplete({
			data: clientList,
			onAutocomplete: function(val) {
			// Callback function when value is autcompleted.
			
			idCliente(val);
      
			//Here you then can do whatever you want, val tells you what got clicked so you can push to another page etc...
			},
		
			});
			//console.log(data);
			}else{
			
			console.log("no hay data");
			
			
				//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
			//var r = confirm("Desea registrar un nuevo visitante");
				
			}
			///$('.preloader-background').css({'display': 'none'});                            
	  });
			
			
//
$("#divvehicularsalida").hide();
			
//tipo_salida			
$("#tipo_salida").change(function() {
var t_salida=parseInt($("#tipo_salida" ).val());

if(t_salida==2)
{	
//console.log("cambio vehicular");
//$("#tipo_unidadsalida").prop("disabled", false);
//$("#tipo_unidadsalida").formSelect(); // update material select			   
//$("#placasalida").attr("disabled",false);
//$("#placasalida2").attr("disabled",false);
$("#divvehicularsalida").show();		
}
else{
	//console.log("cambio peatonal");
$("#divvehicularsalida").hide();
//$("#tipo_unidadsalida").prop("disabled", true);
//$("#tipo_unidadsalida").formSelect();
//$("#placa").attr("disabled",true);
//$("#placa2").attr("disabled",true);			   
//$("#bruto").attr("disabled",true);	
//$("#tara").attr("disabled",true);	
//$("#neto").attr("disabled",true);
}

});			
			
 //keyup
	  $("#placasalida").keyup(function() {
		//$("#placa").length;
		//console.log($("#placa").val().length);
		
		if($("#placasalida").val().length==3)
		{
			$("#placasalida").val();
			$("#placasalida").val($("#placasalida").val()+"-");
		}
	 });
	  
	  
	  //keyup
	  $("#placasalida2").keyup(function() {
		
		if($("#placasalida2").val().length==3)
		{
			$("#placasalida2").val();
			$("#placasalida2").val($("#placasalida2").val()+"-");
		}
	 });			
	


$("#selectsector").change(function () {  
//console.log($("#selectsector").val());
var sede = $("#selectsector").val() ;
location.replace('login/'+sede+'/cambiosede');
});  
			
			
});
	 
   
function buscar(){
			
		
		M.toast({html: 'Buscando resultado...', classes: 'rounded'});
		$('.preloader-background').css({'display': 'block'});
		let url = '<?= base_url() ?>api/execsp';
		
		let sp = 'MOVIMIENTO_PERSONA_LIS';
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let categoria = <?= $categoria->CATEGO_N_ID ?>;
		//console.log(categoria);
		let usuario = <?= $session->USUARI_N_ID ?>;
	
		let dni = "";
		
		//let dni = document.getElementById('dni').value;
		if(document.getElementById('dni').value != ''){
			//dni =  parseInt(document.getElementById('dni').value );
	      dni = document.getElementById('dni').value;
		}
		
		let placa = '%';
		if(document.getElementById('placa_').value != ''){
		   placa = document.getElementById('placa_').value + '%';
		}
		
		
		//let empresa_visita = '%';
		
		/*
		let empresa_visita = '%';
		if(document.getElementById('empresa_visita').value != ''){
			empresa_visita = document.getElementById('empresa_visita').value + '%';
		}
		*/
		
		
		let apellido = '%';
		if(document.getElementById('apellido_visitante').value != ''){
			apellido = document.getElementById('apellido_visitante').value + '%';
		}
		let empresa_visitante = '%';
		if(document.getElementById('empresa_visitante').value != ''){
			empresa_visitante = document.getElementById('empresa_visitante').value + '%';
		}		
		$fecha_desde = $('#desde').val();
		$fecha_desde = $fecha_desde.split('/');
		let fecha_desde=  $fecha_desde[2] + $fecha_desde[1] + $fecha_desde[0];
		$fecha_hasta = $('#hasta').val();
		$fecha_hasta = $fecha_hasta.split('/');
		let fecha_hasta= $fecha_hasta[2] + $fecha_hasta[1] + $fecha_hasta[0];
		let situacion = document.getElementById('situacion').value;
		let tipo_ingreso = parseInt(document.getElementById('tipo_ingreso').value);
	 	//let	data = {sp, empresa, dni, empresa_visita,apellido,empresa_visitante,fecha_desde,fecha_hasta,situacion,tipo_ingreso};	
	 	let	data = {sp, empresa, dni,empresa_visitante ,apellido,placa,fecha_desde,fecha_hasta,situacion,tipo_ingreso,usuario};	
        
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
			//console.log(data);
			if(data.length > 0)
			{
				M.toast({html: 'Cargando Ingresos y Salidas', classes: 'rounded'});
				for (let index = 0; index < data.length; index++) {
					const element = data[index]; 

					
					if(categoria=='3')
					{
						$ver = `<button class="waves-effect waves-light btn" onclick="Ver2(this)" attr_id="${element.MOVPER_N_ID}" >VER</button>`;
					}
					else
					{
						$ver = `<button class="waves-effect waves-light btn" onclick="Ver(this)" attr_id="${element.MOVPER_N_ID}" >VER</button>`;
					}
					
					//let varver = element.CLIENT_N_ID_VISITA;
					
					//console.log(varver);


					let ingreso = ``;
					let salida = ``;
					
					let $eliminar ;
					
					if( element.MOVPER_C_SITUACION  == '0'){
						$eliminar = `<span style="cursor:pointer; color:#039be5" class="material-icons" onclick="eliminar(${element.MOVPER_N_ID})">delete</span>`;	
						if(element.HORA_INGRESO == '')
						{
							ingreso = `<span style="cursor:pointer;; color:#039be5" onclick="confirmarIngreso(${element.MOVPER_N_ID})"  style="cursor:pointer" class="material-icons">directions_walk</span>`;
						}
					}else if( element.MOVPER_C_SITUACION  == '1'){
						$eliminar = `<span style="color:grey" class="material-icons">delete</span>`;
						if(element.FECHA_HORA_SALIDA == '')
						{
							salida = `<span style="color:#039be5" onclick="confirmarSalida(${element.MOVPER_N_ID})" style="cursor:pointer" class="material-icons">directions_walk</span>`;
						}
					}else{
						$eliminar = `<span style="color:grey" class="material-icons">delete</span>`;
					}
					$('#resultados').append(`   		
							<tr>
								<td class="left-align">${element.USUARI_C_USERNAME}</	td>
								<td class="left-align">${element.PERSON_C_DOCUMENTO}</	td>
								<td class="left-align">${element.RAZON_SOCIAL_VISITANTE}</td>
								<td class="left-align">${element.PERSON_C_NOMBRE}</td>
								<td class="left-align">${element.PERSON_C_APELLIDOS}</td>
								<td style="text-align">${element.TIPING_C_DESCRIPCION}</td> 
								<td class="center-align">${element.FECHA_INGRESO}</td>
								<td class="center-align" ondblclick='EventoLlegada(this)' id='tdllegada_${element.MOVPER_N_ID}' attr_id='${element.MOVPER_N_ID}' attr_fecha='${element.FECHA_INGRESO}'>${element.HORA_LLEGADA}</td>
								<td class="center-align" ondblclick='EventoIngreso(this)' id='tdingreso_${element.MOVPER_N_ID}' attr_id='${element.MOVPER_N_ID}' attr_fecha='${element.FECHA_INGRESO}' >${element.HORA_INGRESO} ${ingreso}</td>
								<td class="center-align" ondblclick='EventoSalida(this)' id='tdsalida_${element.MOVPER_N_ID}' attr_id='${element.MOVPER_N_ID}' attr_fecha='${element.FECHA_INGRESO}'>${element.FECHA_HORA_SALIDA}${salida} </td>
								<td class="center-align">
									<a href="ingreso/reporte/${element.MOVPER_N_ID}" target="_blank">
										<i class="material-icons">event_note</i>
									</a>
								</td> 
								<td class="center-align">${$eliminar} </td> 
								<td class="center-align">${$ver}</td> 
							</tr>
					`);
				}
			}
			else{
                M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
            }
            $('.preloader-background').css({'display': 'none'});                            
        });
	}
	
	function confirmarIngreso($id)
	{
		console.log('confirmar ingreso')
		$('#modalIngreso').modal('open');
		$('#idmovimientoing').val($id);
		//fechahora
		
		var vhora=$("#hora").val();
			vhora = vhora.substr(0,5);

		//fin hora
			
		vdatetime = $("#fech" ).val() +"T" + vhora;
		
		//console.log(vdatetime);
		
		$("#fechahorai").val(vdatetime);
		//$("#fechahora").prop("disabled", false);
		$('#botonConfirmar').attr('href', 'ingreso/'+$id+'/confirmar_ingreso')
		
		
	}

	function confirmarSalida($id)
	{
		//console.log('confirmar ingreso')
		$('#modalSalida').modal('open');
		$('#idmovimientosal').val($id);
		//fechahora
		var vhora=$("#hora2").val();
			vhora = vhora.substr(0,5);
		//fin hora
		
		vdatetime = $("#fech2" ).val() +"T" + vhora;
		
		$("#fechahoras").val(vdatetime);
		//$('#botonConfirmarSalida').attr('href', 'salida/'+$id+'/confirmar_salida');
		$("#botonConfirmarSalida").removeAttr("href");
		$('#botonConfirmarSalida').attr('onclick', 'GrabarSalida()');
		
	}

	function eliminar($id)
	{
		console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'ingreso/'+$id+'/eliminar')		
	}
	
	async function Ver(e)
	{
		//console.log(e);
		//console.log(idsolabas);
		
		
		let url = '<?= base_url() ?>api/execsp';
		let sp = "MOVIMIENTO_PERSONA_DATA";
		let idmovimiento = $(e).attr('attr_id');
		document.getElementById('idmovimiento').value = idmovimiento;
		
		data = {sp, idmovimiento};
		
		fetch(url, {

			method: "POST",
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json'
			}
		})
		.then(function(response){
			return response.json();
		})
		.then(function(data){
			if(data.length > 0 ){
				M.toast({html: 'Obteniendo datos...', classes: 'rounded'});

			console.log(data);

				//console.log(data[0].MOVPER_N_ID);
				//console.log(data[0].PERSON_N_ID);
				
				document.getElementById('tdocumento').value = data[0].TIPDOC_C_ABREVIATURA;
				document.getElementById('ndocumento').value = data[0].PERSON_C_DOCUMENTO;
				document.getElementById('empresa').value = data[0].RAZON_SOCIAL_VISITANTE;
				document.getElementById('nombres').value = data[0].PERSON_C_NOMBRE;
				document.getElementById('apellidos').value = data[0].PERSON_C_APELLIDOS;
				document.getElementById('scrt_ini').value = data[0].PERSON_C_FECHA_SCTR_INI;
				document.getElementById('scrt_fin').value = data[0].PERSON_C_FECHA_SCTR_FIN;
				document.getElementById('tipo_ingreso_').value = data[0].TIPING_C_DESCRIPCION;
				document.getElementById('tipo_unidad').value = data[0].TIPUNI_C_DESCRIPCION; 
				document.getElementById('placa').value = data[0].PLACA;
				document.getElementById('placa2').value = data[0].PLACA2;
				document.getElementById('bruto').value = data[0].BRUTO;
				document.getElementById('tara').value = data[0].TARA;
				document.getElementById('neto').value = data[0].NETO;
				document.getElementById('motivo').value = data[0].MOTVIS_C_DESCRIPCION;
				document.getElementById('empresavisitada').value = data[0].RAZON_SOCIAL_VISITA;
				document.getElementById('personacontacto').value = data[0].CONTACTO;
				document.getElementById('remision').value = data[0].MOVPER_C_GUIA_REMISION;
				document.getElementById('obra').value = data[0].MOVPER_C_OBRA;
				document.getElementById('orden_compra').value = data[0].MOVPER_C_ORDEN_COMPRA;
				document.getElementById('observaciones').value = data[0].MOVPER_C_OBSERVACIONES;
				document.getElementById('descripcion').value = data[0].MOVPER_C_DESCRIPCION;
				let idsituacion =  data[0].MOVPER_C_SITUACION;
				//console.log(idsituacion);
				
				if(idsituacion=="2"){
					$("#BtnGuardar").attr("disabled",true);
					$("#remision").attr("disabled",true);
					$("#obra").attr("disabled",true);
					$("#orden_compra").attr("disabled",true);
					$("#observaciones").attr("disabled",true);
					$("#descripcion").attr("disabled",true);
				}
				document.getElementById('idmovimiento').value = idmovimiento;
				
				
				let foto = "";
				
				if(data[0].PERSON_C_FOTO != '')
				{
					foto = '<?= base_url()?>uploads/'+data[0].PERSON_C_FOTO;
					document.getElementById('foto').src = foto;
				}
				
				
				let tipoingreso = data[0].TIPING_N_ID;
				
				if(tipoingreso==1){
					$("#divvehicular").hide();
				}
				else{
					$("#divvehicular").show();
				}
					
				
				
				if(document.getElementById('remision').value!="" && document.getElementById('obra').value!="" && document.getElementById('orden_compra').value!="" && document.getElementById('observaciones').value!="" && document.getElementById('descripcion').value!=""){
					$("#BtnGuardar").attr("disabled",true);
				}
				
				//if(document.getElementById('remision').value!=""){
				//	$("#remision").attr("disabled",true);
				//}
				
				//if(document.getElementById('obra').value!=""){
				//	$("#obra").attr("disabled",true);
				//}
				
				//if(document.getElementById('orden_compra').value!=""){
				//	$("#orden_compra").attr("disabled",true);
				//}
				
				//if(document.getElementById('observaciones').value!=""){
				//	$("#observaciones").attr("disabled",true);
				//}
				
				if(document.getElementById('descripcion').value!=""){
					$("#descripcion").attr("disabled",true);
				}
				
				//M.updateTextFields();
			}else{
				//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
				//var r = confirm("Desea registrar un nuevo visitante");
				
			
			}
			//$('.preloader-background').css({'display': 'none'});                            
		});	
				
		await	$('#modal1').modal('open');	
				
	}
	
	
	async function Ver2(e)
	{
		//console.log("ingreso");			
		let url = '<?= base_url() ?>api/execsp';
		let sp = "MOVIMIENTO_PERSONA_DATA2";
		let idmovimiento = $(e).attr('attr_id');
		document.getElementById('idmovimiento').value = idmovimiento;
		
		
		data = {sp, idmovimiento};
		
		//console.log("ver2");
		
		
		fetch(url, {

			method: "POST",
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json'
			}
		})
		.then(function(response){
			return response.json();
		})
		.then(function(data){
			if(data.length > 0 ){
				M.toast({html: 'Obteniendo datos...', classes: 'rounded'});

			console.log(data);
			
			document.getElementById('tdocumento2').value = data[0].TIPDOC_C_ABREVIATURA;
			document.getElementById('ndocumento2').value = data[0].PERSON_C_DOCUMENTO;
			document.getElementById('empresa2').value = data[0].RAZON_SOCIAL_VISITANTE;
			document.getElementById('nombres2').value = data[0].PERSON_C_NOMBRE;
			document.getElementById('apellidos2').value = data[0].PERSON_C_APELLIDOS;
			document.getElementById('tipo_ingreso2').value = data[0].TIPING_C_DESCRIPCION;
			document.getElementById('tipo_unidad2').value = data[0].TIPUNI_C_DESCRIPCION; 
			document.getElementById('placa_2').value = data[0].PLACA;
			document.getElementById('placa2_2').value = data[0].PLACA2;
			document.getElementById('temperatura2').value = data[0].TEMPERATURA;
			document.getElementById('observaciones2').value = data[0].MOVPER_C_OBSERVACIONES;
			
			if(data[0].PERSON_C_FOTO != '')
			{
					foto2 = '<?= base_url()?>uploads/'+data[0].PERSON_C_FOTO;
					document.getElementById('foto2').src = foto2;
			}
			
			
			let tipoingreso = data[0].TIPING_N_ID;
				
			if(tipoingreso==1)
			{
			$("#divvehicular2").hide();
			}
			else{
			$("#divvehicular2").show();
			}
			
			
			
			
			
			}
			else{
				//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
				//var r = confirm("Desea registrar un nuevo visitante");
			}
                           
		});	
				
		await $('#modal2').modal('open');
		
		
		
		
	}
	
	
	
	
	
	
	function guardar(){
		console.log("Guardo la data");
		
		//let idmovimiento = document.getElementById("idmovimiento").value;
		
		let url = '<?= base_url() ?>api/execsp';
		let sp = "MOVIMIENTO_PERSONA_UDP2";
		let idmovimiento = document.getElementById("idmovimiento").value;
		let remision = document.getElementById("remision").value;
		let obra = document.getElementById("obra").value;
		let orden_compra = document.getElementById("orden_compra").value;
		let descripcion = document.getElementById("descripcion").value;
		let observaciones = document.getElementById("observaciones").value;
		
		data = {sp, idmovimiento,remision,obra,orden_compra,descripcion,observaciones};		
		
		//INICIO
		fetch(url, {

			method: "POST",
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json'
			}
		})
		.then(function(response){
			return response.json();
		})
		.then(function(data){
			if(data.length > 0 ){
				//M.toast({html: 'Se...', classes: 'rounded'});				
			    console.log("actualizo data");
				location.reload();
				//M.updateTextFields();
				
			}else{
				//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
				//var r = confirm("Desea registrar un nuevo visitante");
				
			
			}
			//$('.preloader-background').css({'display': 'none'});                            
		});	
		//FIN
		location.reload();
	}
	
	
function EditarIngreso(){
		console.log("ingresa aqui");
		document.getElementById('estadoingreso').value = 1;
		$("#fechahorai").attr("disabled",false);
		$("#fechahorai").removeAttr("readonly");
		$("#btneditaring").attr("disabled",true);
		//$("#hora").attr("disabled",false);
		//$("#fech").attr("disabled",false);
		$("#botonConfirmar").removeAttr("href");
		$('#botonConfirmar').attr('onclick', 'GrabarIngreso()');
		//$('#botonConfirmar').attr('href', 'ingreso/'+$id+'/confirmar_ingreso');
}

function EditarSalida(){
		document.getElementById('estadosalida').value = 1;
		$("#fechahoras").attr("disabled",false);
		$("#fechahoras").removeAttr("readonly");
		$("#btneditarsal").attr("disabled",true);
		//$("#hora2").attr("disabled",false);
		//$("#fech2").attr("disabled",false);
		$("#botonConfirmarSalida").removeAttr("href");
		$('#botonConfirmarSalida').attr('onclick', 'GrabarSalida()');
}

	
	
function GrabarIngreso(){
		
	let url = '<?= base_url() ?>api/execsp';
	let sp = "MOVIMIENTO_PERSONA_DATAFECHAEDIT";
	
	let estadoingreso = document.getElementById('estadoingreso').value;
	//let fech = document.getElementById('fech').value;
	//let hora = document.getElementById('hora').value;
	let idmovimientoing = document.getElementById('idmovimientoing').value;
	let estado = 1;
	let vdatetime = document.getElementById('fechahorai').value;
		vdatetime = vdatetime + ":00";
	// vdatetime = vdatetime.substr(0,10)+" "+vdatetime.substr(11,5);
		
	
	//console.log(vdatetime);
	//return false;
	
	

	let data = {sp, idmovimientoing, vdatetime ,estadoingreso,estado};
	
		fetch(url, {

			method: "POST",
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json'
			}
		})
		.then(function(response){
			return response.json();
		})
		.then(function(data){
			if(data.length > 0 ){
				//console.log("hay data sdasdadadasd");
			}else{
			
			//console.log("no hay data  dsdacvdq");
				//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
			//var r = confirm("Desea registrar un nuevo visitante");
				
			}
			$('.preloader-background').css({'display': 'none'});                            
	  })
	  
	  //console.log("");
	  location.reload();
}

function GrabarSalida(){
		
	let url = '<?= base_url() ?>api/execsp';
	let sp = "MOVIMIENTO_PERSONA_EDITSALIDA";
	
	let usuario = <?= $session->USUARI_N_ID ?>;
	let estadosalida = document.getElementById('estadosalida').value;
	//let fech = document.getElementById('fech2').value;
	//let hora = document.getElementById('hora2').value;
	let idmovimientosal = document.getElementById('idmovimientosal').value;
	let estado = 2;
	
	let tipo_salida = document.getElementById('tipo_salida').value;
	let tipo_unidad = parseInt(document.getElementById("tipo_unidadsalida").value);
		
		if(tipo_unidad==""){
			tipo_unidad = $("#idtipo_unidadsalida").val();
			
			//console.log("ingreso a tipo unidad vacio");
		}	
	
	
	
	
	let placasalida = document.getElementById('placasalida').value;
	let placasalida2 = document.getElementById('placasalida2').value;
	let observacionsalida = document.getElementById('observacionsalida').value;
	let temperaturasalida = document.getElementById('temperaturasalida').value;
	
	
	console.log("tipo_salida:" + tipo_salida);
	console.log("tipo_unidad:" + tipo_unidad);
	console.log("placasalida:" + placasalida);
	console.log("placasalida2:" + placasalida2);
	console.log("observacionsalida:" + observacionsalida);
	console.log("temperaturasalida:" + temperaturasalida);
	//return false;
	
	let vdatetime = document.getElementById('fechahoras').value;
		vdatetime = vdatetime + ":00";
		//return vdatetime;
		//vdatetime = vdatetime.substr(0,10)+" "+vdatetime.substr(11,5);
	
	console.log(estadosalida);
	console.log(idmovimientosal);
	console.log(estado);
	console.log(vdatetime);
	//return false;	

	let data = {sp, idmovimientosal, vdatetime ,estadosalida,estado,tipo_salida,tipo_unidad,placasalida,placasalida2,observacionsalida,temperaturasalida,usuario};
	
		fetch(url, {

			method: "POST",
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json'
			}
		})
		.then(function(response){
			return response.json();
		})
		.then(function(data){
			if(data.length > 0 ){
				//console.log("hay data sdasdadadasd");
			}else{
			
			//console.log("no hay data  dsdacvdq");
				//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
			//var r = confirm("Desea registrar un nuevo visitante");
				
			}
			$('.preloader-background').css({'display': 'none'});                            
	  });
	  
	  //console.log("");
	  location.reload();
}

function EventoLlegada(e){
	
	//obtener fecha de sistema  y comparar fecha de dos dias mas de la fecha ingreso ejem: 04/02/2021 = 04/02/2021  y si es mayor que solo termine en false.
	let fecha_ingreso = $(e).attr('attr_fecha');
	
	//console.log(fecha_ingreso);
	var xMonth =fecha_ingreso.substring(3, 5);
	//console.log(xMonth);
	var xDay =fecha_ingreso.substring(0, 2);
	//console.log(xDay);
	var xYear=fecha_ingreso.substring(6,10);
	//console.log(xYear);
	
	var xDate = xYear + "-" + xMonth + "-" + xDay;
	
	var d = new Date(xDate);
	//var d = new Date("2021-02-05");
	
	d.setDate((d.getDate()) + 2);
	//d.setDate((d.getDate());
	
	//console.log(d);
	
	let dayfin = d.getDate();
				
	if(dayfin < 10){
	dayfin = `0${dayfin}`;
	}
	else{
	dayfin = `${dayfin}`;
	}
				
	let monthfin = d.getMonth()+1 ;

	if(monthfin < 10){
	monthfin=`0${monthfin}`;
	}else{
	monthfin=`${monthfin}`;
	}
	
	let yearfin = d.getFullYear();
	
	var fecharesto = dayfin +"/"+monthfin+"/"+yearfin;
	
	console.log(fecharesto);
	
	
	var fechasis = new Date();
	//fechasis = fechasis.getDate() + "/"  + (fechasis.getMonth() +1) + "/" + fechasis.getFullYear();

	let day = fechasis.getDate();

	if(day < 10){
	day = `0${day}`;
	}
	else{
	day = `${day}`;
	}

	let month = fechasis.getMonth()+1 ;

	if(month < 10){
	month=`0${month}`;
	}else{
	month=`${month}`;
	}

	let year = fechasis.getFullYear();

	var vfechasis = day +"/"+month+"/"+year;
	
	console.log(vfechasis);
	
	
	if (compare_dates(vfechasis,fecharesto))
	{ 
	return false;
	//console.log("ingreso");	
	}	
	
	
	////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	//console.log(e);
	let idmovimiento = $(e).attr('attr_id');
	//console.log(idmovimiento);
	//return false;
	//console.log($("#tdingreso_92").text());
	//console.log();
	let hora = $("#tdllegada_"+idmovimiento).text();
	hora = hora.trim(); 
	
	$("#tdllegada_"+idmovimiento).text("");
	
	//$("#tdingreso_92").text("mensaje de prueba");
	$("#tdllegada_"+idmovimiento).append("<input type='time' id='horall' name='horall' value='" + hora + "' onkeypress='HoraEditLlegada(this)' attr_id='"+idmovimiento+"' required>");
	//console.log("1");
}





function EventoIngreso(e){
	
	//obtener fecha de sistema  y comparar fecha de dos dias mas de la fecha ingreso ejem: 04/02/2021 = 04/02/2021  y si es mayor que solo termine en false.
	let fecha_ingreso = $(e).attr('attr_fecha');
	
	//console.log(fecha_ingreso);
	var xMonth =fecha_ingreso.substring(3, 5);
	//console.log(xMonth);
	var xDay =fecha_ingreso.substring(0, 2);
	//console.log(xDay);
	var xYear=fecha_ingreso.substring(6,10);
	//console.log(xYear);
	
	var xDate = xYear + "-" + xMonth + "-" + xDay;
	
	var d = new Date(xDate);
	//var d = new Date("2021-02-05");
	
	d.setDate((d.getDate()) + 2);
	//d.setDate((d.getDate());
	
	//console.log(d);
	
	let dayfin = d.getDate();
				
	if(dayfin < 10){
	dayfin = `0${dayfin}`;
	}
	else{
	dayfin = `${dayfin}`;
	}
				
	let monthfin = d.getMonth()+1 ;

	if(monthfin < 10){
	monthfin=`0${monthfin}`;
	}else{
	monthfin=`${monthfin}`;
	}
	
	let yearfin = d.getFullYear();
	
	var fecharesto = dayfin +"/"+monthfin+"/"+yearfin;
	
	console.log(fecharesto);
	
	
	var fechasis = new Date();
	//fechasis = fechasis.getDate() + "/"  + (fechasis.getMonth() +1) + "/" + fechasis.getFullYear();

	let day = fechasis.getDate();

	if(day < 10){
	day = `0${day}`;
	}
	else{
	day = `${day}`;
	}

	let month = fechasis.getMonth()+1 ;

	if(month < 10){
	month=`0${month}`;
	}else{
	month=`${month}`;
	}

	let year = fechasis.getFullYear();

	var vfechasis = day +"/"+month+"/"+year;
	
	console.log(vfechasis);
	
	
	if (compare_dates(vfechasis,fecharesto))
	{ 
	return false;
	//console.log("ingreso");	
	}
	
	
	
	
	
	
	
	
	
	
	
	//////////////////////////////////////////////////////////////////////////
		
	console.log(e);
	let idmovimiento = $(e).attr('attr_id');
	//console.log(idmovimiento);
	//return false;
	//console.log($("#tdingreso_92").text());
	//console.log();
	let hora = $("#tdingreso_"+idmovimiento).text();
	hora = hora.trim(); 
	
	$("#tdingreso_"+idmovimiento).text("");
	
	//$("#tdingreso_92").text("mensaje de prueba");
	$("#tdingreso_"+idmovimiento).append("<input type='time' id='horai' name='horai' value='" + hora + "' onkeypress='HoraEditIngreso(this)' attr_id='"+idmovimiento+"' required>");
	//console.log("1");
}


function EventoSalida(e){
	
	//obtener fecha de sistema  y comparar fecha de dos dias mas de la fecha ingreso ejem: 04/02/2021 = 04/02/2021  y si es mayor que solo termine en false.
	let fecha_ingreso = $(e).attr('attr_fecha');
	
	//console.log(fecha_ingreso);
	var xMonth =fecha_ingreso.substring(3, 5);
	//console.log(xMonth);
	var xDay =fecha_ingreso.substring(0, 2);
	//console.log(xDay);
	var xYear=fecha_ingreso.substring(6,10);
	//console.log(xYear);
	
	var xDate = xYear + "-" + xMonth + "-" + xDay;
	
	var d = new Date(xDate);
	//var d = new Date("2021-02-05");
	
	d.setDate((d.getDate()) + 2);
	//d.setDate((d.getDate());
	
	//console.log(d);
	
	let dayfin = d.getDate();
				
	if(dayfin < 10){
	dayfin = `0${dayfin}`;
	}
	else{
	dayfin = `${dayfin}`;
	}
				
	let monthfin = d.getMonth()+1 ;

	if(monthfin < 10){
	monthfin=`0${monthfin}`;
	}else{
	monthfin=`${monthfin}`;
	}
	
	let yearfin = d.getFullYear();
	
	var fecharesto = dayfin +"/"+monthfin+"/"+yearfin;
	
	console.log(fecharesto);
	
	
	var fechasis = new Date();
	//fechasis = fechasis.getDate() + "/"  + (fechasis.getMonth() +1) + "/" + fechasis.getFullYear();

	let day = fechasis.getDate();

	if(day < 10){
	day = `0${day}`;
	}
	else{
	day = `${day}`;
	}

	let month = fechasis.getMonth()+1 ;

	if(month < 10){
	month=`0${month}`;
	}else{
	month=`${month}`;
	}

	let year = fechasis.getFullYear();

	var vfechasis = day +"/"+month+"/"+year;
	
	console.log(vfechasis);
	
	
	if (compare_dates(vfechasis,fecharesto))
	{ 
	return false;
	//console.log("ingreso");	
	}
		
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
	//console.log(e);
	let idmovimiento = $(e).attr('attr_id');
	let hora = $("#tdsalida_"+idmovimiento).text();
	hora = hora.trim(); 
	
	hora=hora.substr(6,4)+"-"+hora.substr(3,2)+"-"+hora.substr(0,2)+"T"+hora.substr(11,5)
	
	
	console.log(hora);
	
	$("#tdsalida_"+idmovimiento).text("");
	
	//$("#tdingreso_92").text("mensaje de prueba");
	$("#tdsalida_"+idmovimiento).append("<input type='datetime-local' id='horas' name='horas' value='" + hora + "' onkeypress='HoraEditSalida(this)' attr_id='"+idmovimiento+"' required>");
	//console.log("1");
}


function HoraEditIngreso(e) {
	if (event.key === "Enter") {
        event.preventDefault();
	
		//let idmovimiento = $(e).attr('attr_id');
		//let v_horaingreso_mov = document.getElementById('vhora').value;
		let date = new Date()

		let day = date.getDate()
		let month = date.getMonth() + 1
		let year = date.getFullYear()
		
		//let fecha = `${year}-${month}-${day}`;
		let fecha = `${day}/${month}/${year}`;
		
		
		
		
		M.toast({html: 'Actualizando hora ingreso...', classes: 'rounded'});
		$('.preloader-background').css({'display': 'block'});
		let url = '<?= base_url() ?>api/execsp';
		
		let sp = 'MOVIMIENTO_PERSONA_HORAINGRESO';
		let v_horaingreso_mov = document.getElementById('horai').value;
		let vdatetime = fecha + " " +  v_horaingreso_mov;
		let idmovimiento = $(e).attr('attr_id');
		//console.log(vdatetime);
		//console.log(idmovimiento);
		//return false;
		
		
		let	data = {sp,idmovimiento, vdatetime};
		
		//let empresa = <?= $empresa->EMPRES_N_ID ?>;
		
		fetch(url, {
					method: 'POST', // or 'PUT'
					body: JSON.stringify(data), // data can be `string` or {object}!
					headers:{'Content-Type': 'application/json'}
		})
		.then(function(response) {
					return response.json();
		})
		.then(function(data){
					if(data.length > 0)
					{
						//M.toast({html: 'Cargando Ingresos y Salidas', classes: 'rounded'});
						console.log("realizo el proceso");
						
					}
					else{
						//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
					}
					//$('.preloader-background').css({'display': 'none'}); 
			//console.log("realizo el proceso2");	
			location.reload();
		 });
		
		
		
		console.log(idmovimiento);
		console.log(v_horaingreso_mov);
		console.log(vdatetime);
		//console.log("enter");
        // Do more work
    }
}

function HoraEditLlegada(e) {
	if (event.key === "Enter") {
        event.preventDefault();
	
		//let idmovimiento = $(e).attr('attr_id');
		//let v_horaingreso_mov = document.getElementById('vhora').value;
		let date = new Date()

		let day = date.getDate()
		let month = date.getMonth() + 1
		let year = date.getFullYear()
		
		let fecha = `${day}/${month}/${year}`;
		
		M.toast({html: 'Actualizando hora llegada...', classes: 'rounded'});
		$('.preloader-background').css({'display': 'block'});
		
		let url = '<?= base_url() ?>api/execsp';
		
		let sp = 'MOVIMIENTO_PERSONA_HORALLEGADA';
		let v_horallegada_mov = document.getElementById('horall').value;
		let vdatetime = fecha + " " +  v_horallegada_mov;
		//let vdatetime = "19/11/2020 17:55:00";
		let idmovimiento = $(e).attr('attr_id');
		
		//console.log(vdatetime);
		//console.log(idmovimiento);
		//return false;
		
		
		
		let	data = {sp,idmovimiento, vdatetime};
		
		//let empresa = <?= $empresa->EMPRES_N_ID ?>;
		
		fetch(url, {
					method: 'POST', // or 'PUT'
					body: JSON.stringify(data), // data can be `string` or {object}!
					headers:{'Content-Type': 'application/json'}
		})
		.then(function(response) {
					return response.json();
		})
		.then(function(data){
					if(data.length > 0)
					{
						//M.toast({html: 'Cargando Ingresos y Salidas', classes: 'rounded'});
						console.log("realizo el proceso");
						
					}
					else{
						//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
					}
					//$('.preloader-background').css({'display': 'none'}); 
			//console.log("realizo el proceso2");	
			location.reload();
		 });
		
		
		
		console.log(idmovimiento);
		console.log(v_horallegada_mov);
		console.log(vdatetime);
		//console.log("enter");
        // Do more work
    }
}


function HoraEditSalida(e) {
	if (event.key === "Enter") {
        event.preventDefault();
	
		let date = new Date()

		let day = date.getDate()
		let month = date.getMonth() + 1
		let year = date.getFullYear()
		
	    let fecha = `${day}/${month}/${year}`;
		
		M.toast({html: 'Actualizando hora salida...', classes: 'rounded'});
		$('.preloader-background').css({'display': 'block'});
		
		let url = '<?= base_url() ?>api/execsp';
		
		let sp = 'MOVIMIENTO_PERSONA_HORASALIDA';
		let v_horasalida_mov = document.getElementById('horas').value;
		let vdatetime = v_horasalida_mov;
		//2020-11-20T17:38:00
		vdatetime=vdatetime.substr(0,4)+"-"+vdatetime.substr(5,2)+"-"+vdatetime.substr(8,2)+"T"+vdatetime.substr(11,5)+":00";
		//vdatetime=vdatetime.substr(8,2)+"/"+vdatetime.substr(5,2)+"/"+vdatetime.substr(0,4)+" "+vdatetime.substr(11,5)+":00";
		
		//let vdatetime = "19/11/2020 17:55:00";
		let idmovimiento = $(e).attr('attr_id');
		
		//console.log(vdatetime);
		//console.log(idmovimiento);
		//return false;
				
		let	data = {sp,idmovimiento, vdatetime};
		
		//let empresa = <?= $empresa->EMPRES_N_ID ?>;
		
		fetch(url, {
					method: 'POST', // or 'PUT'
					body: JSON.stringify(data), // data can be `string` or {object}!
					headers:{'Content-Type': 'application/json'}
		})
		.then(function(response) {
					return response.json();
		})
		.then(function(data){
					if(data.length > 0)
					{
						//M.toast({html: 'Cargando Ingresos y Salidas', classes: 'rounded'});
						console.log("realizo el proceso");
						
					}
					else{
						//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
					}
					//$('.preloader-background').css({'display': 'none'}); 
			//console.log("realizo el proceso2");	
			location.reload();
		 });
		
		
		
		//console.log(idmovimiento);
		//console.log(v_horallegada_mov);
		//console.log(vdatetime);
		//console.log("enter");
        // Do more work
    }
}



function MovimientoPersona(){	
	//console.log("Ingreso MovimientoPersona");
	//?nombre=valor
	
	let empresa = <?= $empresa->EMPRES_N_ID ?>;
	
	let dni = "";
	if(document.getElementById('dni').value != ''){
      dni = document.getElementById('dni').value;
	}
	
	let empresa_visitante = '%';
	if(document.getElementById('empresa_visitante').value != ''){
	empresa_visitante = document.getElementById('empresa_visitante').value + '%';
	}
	
	
	//console.log(empresa_visitante);
	
	let apellido = '%';
		if(document.getElementById('apellido_visitante').value != ''){
			apellido = document.getElementById('apellido_visitante').value + '%';
	}
	
	let placa = '%';
		if(document.getElementById('placa_').value != ''){
			placa = document.getElementById('placa_').value + '%';
	}
	
	$fecha_desde = $('#desde').val();
	$fecha_desde = $fecha_desde.split('/');
	let fecha_desde=  $fecha_desde[2] + $fecha_desde[1] + $fecha_desde[0];
	$fecha_hasta = $('#hasta').val();
	$fecha_hasta = $fecha_hasta.split('/');
	let fecha_hasta= $fecha_hasta[2] + $fecha_hasta[1] + $fecha_hasta[0];
	
	let situacion = document.getElementById('situacion').value;
	let tipo_ingreso = parseInt(document.getElementById('tipo_ingreso').value);
	
	window.open("<?php echo base_url(); ?>ingreso/exportar?var1="+empresa+"&var2="+dni+"&var3="+empresa_visitante+"&var4="+apellido+"&var5="+placa+"&var6="+fecha_desde+"&var7="+fecha_hasta+"&var8="+situacion+"&var9="+tipo_ingreso, "_blank");
}

function idCliente(val){
		//console.log(val+"1");
		
		let url = '<?= base_url() ?>api/execsp';
		let sp = "CLIENTE_ID";
	
		let txtval = val;
		
		
		let data = {sp, txtval};
	
		
		fetch(url, {
			method: "POST",
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json'
			}
		})
		.then(function(response){
			return response.json();
		})
		.then(function(data){
			if(data.length > 0 ){
			console.log(data[0].CLIENT_N_ID);
			document.getElementById("idempresa_visitante").value = data[0].CLIENT_N_ID;

			}else{
			
			console.log("no hay data");
				
			}
                          
	  });		
	}
	
	
function compare_dates(fecha, fecha2)  //fechasis - fechafin // 05/02/2021 - 04/02/2021
{  
    var xMonth=fecha.substring(3, 5);  
    var xDay=fecha.substring(0, 2);  
    var xYear=fecha.substring(6,10);
		//console.log(xMonth);
		//console.log(xDay);
		//console.log(xYear);
		
	//var yMonth=fecha2.substring(3, 5);  
    //var yDay=fecha2.substring(0, 2);  
    //var yYear=fecha2.substring(6,10);
		
	var yMonth=fecha2.substring(3,5);  //str.substring(7,5); substring(5, 0)
    var yDay=fecha2.substring(0,2);  //substring(10,8) substring(0,4
    var yYear=fecha2.substring(6,10);  
		
		//console.log(fecha2);
		//console.log(yMonth);
		//console.log(yDay);
		//console.log(yYear);
	
    if (xYear > yYear)   //  2021 > 2021
    {  
		//console.log("entro anio");
        return(true); 
    }  
    else  
    {  
      if (xYear == yYear)  //2021 == 2021
      {   
		
		//console.log("mes validacion:"+xMonth);
		//console.log("1");
        if (xMonth > yMonth) //01 > 04  
        {  
			//console.log("2");
			//console.log("mes mayor");
            return(true); 
        }  
        else  
        {   
          if (xMonth == yMonth)  
          {  
            if (xDay > yDay)  {
			  //console.log("3");
			  //console.log("ingresa aqui");
              return(true);  
			}
			else if (xDay == yDay) {		
			//console.log("4");
			 //console.log("ingresa aqui2");
             return(false); 
			}
			else  
			console.log("5");
              return(false);  
          }  
          else 
		  	//console.log("6");
            return(false);  
        }  
      }  
      else  
	  	//console.log("7");
        return(false);  
    }  
}	


function PlacaUnidad(e){
		if (event.key === "Enter") {
		
			let url = '<?= base_url() ?>api/execsp';
			let sp = "PLACA_UNIDAD_DATA";
			let placa = $("#placasalida").val();
			
			let data = {sp, placa};
			
			
			fetch(url, {
			method: "POST",
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json'
			}
			})
			.then(function(response){
			return response.json();
			})
			.then(function(data){
			 
			 if(data.length > 0 ){
			console.log(data[0].TIPUNI_C_DESCRIPCION);
			
			$("#divtipo_unidad").hide();
			
			$("#divtipo_unidad2").show();

			$("#idtipo_unidadsalida").val(data[0].TIPUNI_N_ID);
			$("#txttipo_unidadsalida").val(data[0].TIPUNI_C_DESCRIPCION);
			
			$("#tipo_unidadsalida").prop("disabled", true);
			
			 }
			 
			 else{
				 
				 console.log("no hay data");
			 }
			
			
			
			});
		
		}
}
	


</script>
