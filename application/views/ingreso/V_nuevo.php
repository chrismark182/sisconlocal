<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      	<div class="col s12">
        	<a href="#!" class="breadcrumb">Visitantes</a>
        	<a href="<?= base_url() ?>ingreso" class="breadcrumb">Ingreso</a>
        	<a href="#!" class="breadcrumb">Nuevo</a>
      	</div>
    </div>
</nav>
<?php 
    $fecha = new DateTime(); 
	$hora = new DateTime();
?>

<div class="section container">
	<div class="row">
		<div class="input-field col s12 m6 l3">
			<input placeholder=" " id="fecha" type="text" class="validate"  readonly >
			<label for="fecha" id="fechala">Fecha Actual</label>
		
			<input placeholder=" " id="fecha_" type="text" value="<?= $fecha->format('Y-m-d') ?>" style="display: none;width:100px;" readonly>
			<label for="fecha_" id="fechala_" style="display: none" >Fecha Actual</label>
			
			<input placeholder=" " id="hora" type="text" value="<?= $hora->format('H:i:s') ?>" class="timepicker" style="display: none;width:100px;" >
			<label for="hora" id="horala" style="display: none;padding-left:130px" >Hora</label>	
			
			
			<input type='datetime-local' id='fechahora' name='fechahora' value="" style="display: none">
			<label for="fechahora" id="labelfechahora" style="display: none" >Fecha Actual</label>
			
			<input id="vfecha" type="hidden" value="0">
		</div>
		
		<div class="input-field col s12 m6 l3" style="margin-top:-7px;" id="idtipodocumento">
		
			<input class="ancho" id="tipodocumento" type="text" value="" readonly>
			<br>
		    <div id="selectdocumento_" name="selectdocumento_">
				<select id="tdocumento" name="tdocumento" required>
					<option value="0">Seleccionar Tipo Documento</option>
					<?php foreach ($misdoc as $row): ?>
						<option value="<?= $row->TIPDOC_N_ID?>"> <?= $row->TIPDOC_C_ABREVIATURA ?> </option>
					<?php endforeach; ?>
				</select>
			</div>
			
			<label class="active" for="tdocumento" id="labeltdocumento">Tipo de Documento</label>
			
		</div>	
		
		<div class="input-field col s12 m6 l3">	
			<input id="ndocumento" type="text" name="ndocumento" class="validate" >
			<label for="ndocumento">Número de Documento</label>
		</div>
		
		<div class="input-field col s12 m6 l2">
		<button id="btnbusca" class="btn" onclick="buscar()" id_action="" >Buscar</button> 
		</div>
	</div>

	<div class="row">
		<div class="col s8">
			<div class="input-field col s12" >
				<input type="hidden" id="cliente_visita_id">
				<input type="hidden" id="ndocumento_" name="ndocumento_" >
				<input type="hidden" id="tdocumento_" name="tdocumento_">
				
				<input type="hidden" id="idupdate" name="idupdate" value="">
				
					<input type="text" id="autocomplete-input" class="autocomplete" autocomplete="off">
					<input type="hidden" id="cliente_" name="cliente_">
					<input class="ancho" id="empresa" type="text" value=""  ondblclick="EditarEmpresa()" readonly>
				<label class="active" for="empresa">Empresa Visitante</label>
			</div>	

			<div class="input-field col s6" >
				<input type="hidden" id="persona_id">
				<input  id="apellidos" type="text" value="" name="apellidos" readonly >
				<label class="active" for="apellidos">Apellidos</label>
			</div>
			<div class="input-field col s6"  >
				<input class="ancho" id="nombres" type="text" value="" name="nombres" readonly>
				<label class="active" for="nombres">Nombres</label>
			</div>
						
			<div class="input-field col s6" >
                <input id="scrt_ini" type="date" value="" name="scrt_ini"  disabled readonly >
				<label class="active" for="scrt_ini">SCTR Inicio</label>
			</div>
			
			<div class="input-field col s6"  >
				<input id="scrt_fin" type="date" value="" name="scrt_fin"  disabled readonly >
                <label class="active" for="scrt_fin">SCTR Vencimiento</label> 
			</div>
			
			
			<input type="hidden" id="name_file" name="foto" >
			
            <div class="file-field input-field col s12 m6 l12" id="divfoto" style="display:none;">
                <div class="btn">
                    <span>Foto</span>
                    <input id="archivo" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>		
		
			<div class="input-field col s6">
				<select id="tipo_ingreso" disabled  required>
					<option value="0">Seleccionar Tipo de Ingreso</option>
					<?php foreach ($tipo_ingreso as $row): ?>
						<option value="<?= $row->TIPING_N_ID?>"><?= $row->TIPING_C_DESCRIPCION ?> </option>
					<?php endforeach; ?>
				</select>
				<label>Tipo de Ingreso</label>
			</div>
			
			<div class="input-field col s6">
			<!--
				<input type="text" id="motivo" class="autocomplete3" autocomplete="off" disabled>
				<input type="hidden" id="idmotivo" name="idmotivo">
				<label>Motivo de la Visita</label>
			-->
			<input type="hidden" id="idmotivo" name="idmotivo">
			<input type="text" id="motivo" class="autocomplete3" autocomplete="off">
			<label class="active" for="motivo">Motivo de la Visita</label>
			</div>			
			
			<div id="divvehicular" >
			
		<div id="divtipo_unidad">
			<div class="input-field col s6">
				<select id="tipo_unidad" disabled required>
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
				 <input id="txttipo_unidad" type="text" value=" " name="txttipo_unidad"  disabled readonly >
				 <input id="idtipo_unidad" type="hidden" value=" " name="idtipo_unidad"  disabled readonly >
				<label>Tipo de Unidad</label>
			</div>
		</div>
		
		
		
			<div class="input-field col s12 m6 l3">
				<input id="placa" maxlength="7" type="text" onkeypress="PlacaUnidad(this)" placeholder="xxx-xxx" disabled   >
				<label class="active" for="placa">Placa</label>
			</div>
			
			<div class="input-field col s12 m6 l3">
				<input id="placa2" maxlength="7" type="text" placeholder="xxx-xxx"  disabled   >
				<label class="active" for="placa2">Placa 2</label>
			</div>
			
			
			<div class="input-field col s12 m6 l4">
				<input id="bruto" maxlength="20" type="text" disabled  >
				<label class="active" for="bruto">Bruto</label>
			</div>
			
			<div class="input-field col s12 m6 l4">
				<input id="tara" maxlength="20" type="text" disabled  >
				<label class="active" for="tara">Tara</label>
			</div>
			
			<div class="input-field col s12 m6 l4">
				<input id="neto" maxlength="20" type="text" disabled  >
				<label class="active" for="neto">Neto</label>
			</div>
			
			</div>	

			<div class="input-field col s12 ">
			
			<input type="text" id="autocomplete-input2" class="autocomplete2" autocomplete="off"   >
			<input type="hidden" id="cliente" name="cliente" >
			<label>Empresa Visitada</label>

			</div>
			<div class="input-field col s12  ">
				<select id="contacto" disabled required>
					<option value="0">Seleccionar Contácto</option>				
				</select>
				<label>Persona de Contácto</label>
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
			<input id="remision" maxlength="200" type="text" disabled  >
			<label class="active" for="remision">Guía Remisión</label>
		</div>
		<div class="input-field col s12 m6 l4">
			<input id="obra" maxlength="200" type="text" disabled>
			<label class="active"  for="obra">Obra</label>
		</div>
		<div class="input-field col s12 m6 l4">
			<input id="orden_compra" maxlength="200" type="text" disabled>
			<label class="active"  for="orden_compra" >Orden de Compra</label>
		</div>
		
		<div class="input-field col s8">
			<textarea id="descripcion" maxlength="200" class="materialize-textarea" disabled></textarea>
			<label for="descripcion">Descripcion</label>
        </div>
				
		<div class="input-field col s4">
			<textarea id="observaciones" maxlength="200" class="materialize-textarea" disabled></textarea>
			<label for="observaciones">Observaciones</label>
        </div>
	</div>
	
	<div class="input-field col s12">
        <div class="btn-small" style="display: none" id="btnBuscar" onclick="guardar()" >Guardar</div>
    </div>
</div> 




<script>
	document.addEventListener('DOMContentLoaded', function() {
		M.updateTextFields();
		mostrarHoraActual();
	
	    $("#selectcliente_").hide();
	    $("#i-autocomplete-input").hide();
	    $("#autocomplete-input").hide();
	    $("#tipodocumento").hide();
		$("#tipo_unidad").hide();
		$("#divvehicular").hide();
		
		var options = {
		defaultTime: 'now'
		}
		
		var elems = document.querySelectorAll('.timepicker');
		var instances = M.Timepicker.init(elems, options);
		
		
		$("#fecha").dblclick(function() {
			$("#fecha").hide();
			$("#fechala").hide();
						
			//Variables
			let vdatetime="";
			var vhora=$("#hora").val();

			
			$("#vfecha" ).val(1)
			
			//cambios hora
			vhora = vhora.substr(0,5);
			vdatetime = $("#fecha_" ).val() +"T" + vhora;
						
			$("#fechahora").val(vdatetime);
			//$("#fechahora").val("2018-06-12T19:30");
			
			$("#fechahora").show();
			$("#labelfechahora").show();
						
			let fechahora = document.getElementById("fechahora").value;
			
		});
		
		
		$("#tipo_ingreso").change(function() {
			var t_ingreso=parseInt($("#tipo_ingreso" ).val());
			
			if(t_ingreso==2)
			{					
			   $("#tipo_unidad").prop("disabled", false);
			   $("#tipo_unidad").formSelect(); // update material select			   
			   $("#placa").attr("disabled",false);
			   $("#placa2").attr("disabled",false);
			   $("#bruto").attr("disabled",false);	
			   $("#tara").attr("disabled",false);	
			   $("#neto").attr("disabled",false);		
			   $("#divvehicular").show();		
			}
			else{
			   $("#divvehicular").hide();
			   $("#tipo_unidad").prop("disabled", true);
			   $("#tipo_unidad").formSelect();
			   $("#placa").attr("disabled",true);
			   $("#placa2").attr("disabled",true);			   
			   $("#bruto").attr("disabled",true);	
			   $("#tara").attr("disabled",true);	
			   $("#neto").attr("disabled",true);
			}

		});
	
	});
	
	$(document).ready(function(){
    
	
	//ListadoCLienteVisitante
	ListadoCLienteVisitante();
	//ListadoClienteVisitada
	ListadoClienteVisitada();
 	//Motivo
	Motivo();
	
	  
	  //keyup
	  $("#placa").keyup(function() {
		//$("#placa").length;
		//console.log($("#placa").val().length);
		
		if($("#placa").val().length==3)
		{
			$("#placa").val();
			$("#placa").val($("#placa").val()+"-");
		}
	 });
	  
	  
	  //keyup
	  $("#placa2").keyup(function() {
		
		if($("#placa2").val().length==3)
		{
			$("#placa2").val();
			$("#placa2").val($("#placa2").val()+"-");
		}
	 });
	  
	  
	  
	  
	
	  
	  
		
  });
		
	/*
	function idCliente(val){
		
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
			document.getElementById("cliente_").value = data[0].CLIENT_N_ID;

			if(document.getElementById("idupdate").value==1){
				
				let idpersona = parseInt(document.getElementById("persona_id").value);
				let idcliente = parseInt(document.getElementById("cliente_").value);
				
				
				//UPDATE
				UpdateEmpresaCliente(idpersona,idcliente)			
				
				//FIN UPDATE
				console.log("actualizar empresa");
			}


			}else{
			
			console.log("no hay data");
				
			}
                          
	  });		
	}
	*/
	
	function idCliente2(val){
		//console.log(val+"1");
		
		let url = '<?= base_url() ?>api/execsp';
		let sp = "CLIENTE_ID";
		let empresa = <?= $empresa->EMPRES_N_ID ?>; 
	
		let txtval = val;
				
		let data = {sp, txtval,empresa};
	
		
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
			document.getElementById("cliente").value = data[0].CLIENT_N_ID;
			
			buscarContactoCliente();

			}else{
			
			console.log("no hay data");
				
			}
                          
	  });		
	}
	
	

	function buscar()
    {
		
		let documento = document.getElementById("ndocumento").value;
		
		if(documento == "")
		{
			M.toast({html: 'Campo Nro de Documento vacio, verificar...', classes: 'rounded'});
			return false;
			
		}

		M.toast({html: 'Buscando resultado...', classes: 'rounded'});

		let url = '<?= base_url() ?>api/execsp';
		let sp = "VISITANTE_NUEVO_LIS";
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let tipo_doc = parseInt(document.getElementById("tdocumento").value);

		data = {sp, empresa, tipo_doc, documento};
		
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
				M.toast({html: 'Obteniendo datos de la Persona...', classes: 'rounded'});

				let bloqueado = `<span class="green-text text-darken-4">SIN BLOQUEO</span>`;
				if(data[0].CANTIDAD_BLOQUEOS > 0){
					bloqueado = `<span class="red-text text-darken-4">BLOQUEADO</span>`;
				}

				let foto = `<?= base_url()?>assets/images/sin-imagen.jpg`;
				if(data[0].PERSON_C_FOTO != '')
				{
					foto = `<?= base_url()?>uploads/${data[0].PERSON_C_FOTO}`;
				}

				let sctr = `<span class="green-text text-darken-4">SCRT VIGENTE</span>`;
				if(data[0].SCTR_SITUACION == 0){
					sctr = `<span class="red-text text-darken-4">SCRT VENCIDO</span>`;
				}

				let ingreso = ``;
				//console.log(data[0].INGRESO_VIGENTE);
				if(data[0].INGRESO_VIGENTE > 0){
					ingreso = `<span class="red-text text-darken-4">PERSONA YA INGRESÓ</span>`;
				}

				if(data[0].CANTIDAD_BLOQUEOS == 0 && data[0].SCTR_SITUACION == 1 && data[0].INGRESO_VIGENTE == 0)
				{
					document.getElementById('btnBuscar').style.display = 'block';
				}else{
					document.getElementById('btnBuscar').style.display = 'none';
				}

				document.getElementById('cliente_visita_id').value = data[0].CLIENT_N_ID;					
				document.getElementById('tipodocumento').value = data[0].TIPDOC_C_ABREVIATURA;					
				document.getElementById('persona_id').value = data[0].PERSON_N_ID;	
				document.getElementById('nombres').value = data[0].PERSON_C_NOMBRE;
				document.getElementById('apellidos').value = data[0].PERSON_C_APELLIDOS;
				
				let sctr_ini = data[0].PERSON_C_FECHA_SCTR_INI;
				//console.log(sctr_ini);
				var vfini = sctr_ini.split("/").reverse().join("-");
				//var salida = formato(sctr_ini);
				//console.log(vfini);
				document.getElementById('scrt_ini').value = vfini;
				let vfechaini = document.getElementById('scrt_ini').value;
				
				
				let sctr_fin = data[0].PERSON_C_FECHA_SCTR_FIN;
				var vffin = sctr_fin.split("/").reverse().join("-");
				document.getElementById('scrt_fin').value = vffin;
				let vfechafin = document.getElementById('scrt_fin').value;
				
				//let sctr_fin = document.getElementById('scrt_fin').value;
				document.getElementById('foto').src = foto;
				document.getElementById('bloqueado').innerHTML = bloqueado;
				document.getElementById('sctr').innerHTML = sctr;
				document.getElementById('ingreso').innerHTML = ingreso;
				document.getElementById('empresa').value = data[0].CLIENT_C_RAZON_SOCIAL;
				document.getElementById('autocomplete-input').value = data[0].CLIENT_C_RAZON_SOCIAL;
				
				
				let date = new Date();
				//let fecha = new Date();	
				
				//fecha = date.getDate() + "/" + (date.getMonth() +1) + "/" + date.getFullYear()
				
				let day = date.getDate();
				
				if(day < 10){
					day = `0${day}`;
				}
				else{
					day = `${day}`;
				}
				
				//console.log(day);
				
				let month = date.getMonth()+1 ;
				
				if(month < 10){
				month=`0${month}`;
				}else{
				month=`${month}`;
				}
				
				
				let year = date.getFullYear();
							
				//console.log("day:"+day);
				//console.log("month:"+month);
				//console.log("year:"+year);
				
				fecha = day +"/"+month+"/"+year;
				
				
				console.log(fecha);
				console.log(vfechafin);	
				
							
				let vfecha = Date.parse(fecha);
				vfecha = new Date(vfecha);
								
				if (compare_dates(fecha, vfechafin)){  
				 $("#scrt_ini").attr('ondblclick','Habilitarsctr()');
				 $("#scrt_fin").attr('ondblclick','Habilitarsctr()');
				 $("#scrt_ini").attr("disabled",false);	
				 $("#scrt_fin").attr("disabled",false);
				 $("#scrt_ini").css('color', 'red');
				 $("#scrt_fin").css('color', 'red');
				}else{ 
				
				} 
				
			   
			   //$("#tdocumento").hide();
			   //$('#tdocumento').css('display', 'none');
			   //$("#tdocumento").formSelect();
			   
			   $("#selectdocumento_").hide();
			   $("#tipodocumento").show();
			   //idtipodocumento
			   $("#idtipodocumento").removeAttr("style");
     		   $("#tipo_ingreso").prop("disabled", false);
			   $("#tipo_ingreso").formSelect();
			   //$("#motivo").prop("disabled", false);
			   //$("#motivo").formSelect();
			   //$("#motivo").prop("disabled", true);
			   //$("#cliente").prop("disabled", false);
			   //$("#cliente").formSelect();
			   $("#motivo").attr("disabled",false);
			   $("#contacto").prop("disabled", false);
			   $("#contacto").formSelect();
			   $("#remision").prop("disabled", false);
			   $("#obra").prop("disabled", false);
			   $("#orden_compra").prop("disabled", false);
			   $("#descripcion").prop("disabled", false);
			   $("#observaciones").prop("disabled", false);	   
				//
				
				
				
				M.updateTextFields();
			}else{
				//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
				var r = confirm("Desea registrar un nuevo visitante");
				
				if(r == true){
					Nuevo();
				}
			}
			$('.preloader-background').css({'display': 'none'});                            
		});	
	}
	
	function buscarContactoCliente()
    {
		console.log("1");
		
		M.toast({html: 'Buscando resultado...', classes: 'rounded'});

		let url = '<?= base_url() ?>api/execsp';
		let sp = "CONTACTO_LIS";
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		
		let cliente = parseInt(document.getElementById("cliente").value);
		let contacto = 0;
		let razon_social = '%';
		let ndocumento = '%';
		let nombres = '%';
		let apellidos = '%';

		data = {sp, empresa, cliente, contacto, razon_social, ndocumento, nombres, apellidos};
		
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
					console.log(data)	
					M.toast({html: 'Datos encontrados', classes: 'rounded'});
					$('#contacto').html('<option value="" disabled selected>Elije una opción</option>')
					for (let index = 0; index < data.length; index++) {
						const element = data[index];
						$('#contacto').append(`<option value="${element.CLICON_N_ID}">${element.CLICON_C_NOMBRE} ${element.CLICON_C_APELLIDOS}</option>`);
					}
					$('select').formSelect();		
				}else{
					M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
				}

				$('.preloader-background').css({'display': 'none'});                            
			});	
	}	

	function guardar()
    {
		
		let url = '<?= base_url() ?>api/execsp';
		let sp = "MOVIMIENTO_PERSONA_INS";
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let cliente_visitante = parseInt(document.getElementById("cliente_visita_id").value);
		let persona_id = parseInt(document.getElementById("persona_id").value);
		let tipo_ingreso = parseInt(document.getElementById("tipo_ingreso").value);
		let motivo = parseInt(document.getElementById("idmotivo").value);
		let cliente = parseInt(document.getElementById("cliente").value);
		let contacto = parseInt(document.getElementById("contacto").value);
		let remision = document.getElementById("remision").value;
		let obra = document.getElementById("obra").value;
		let orden_compra = document.getElementById("orden_compra").value;
		let descripcion = document.getElementById("descripcion").value;
		let temperatura = "";
		let observaciones = document.getElementById("observaciones").value;
		let usuario = <?= $this->data['session']->USUARI_N_ID ?>;
		
		
		if(document.getElementById("idupdate").value==1){
		cliente_visitante = parseInt(document.getElementById("cliente_").value);
		}
		
		
		let tipo_unidad = parseInt(document.getElementById("tipo_unidad").value);
		
		if(tipo_unidad==""){
			tipo_unidad = $("#idtipo_unidad").val();
			
			//console.log("ingreso a tipo unidad vacio");
		}		
		
		//console.log(tipo_unidad);
		//return false;
		
		let placa = document.getElementById("placa").value;
		let placa2 = document.getElementById("placa2").value;
		let bruto = document.getElementById("bruto").value;
		let tara = document.getElementById("tara").value;
		let neto = document.getElementById("neto").value;
		let vfecha = document.getElementById("vfecha").value;
		let vhora="";
		let vdatetime =" ";
		
		if(vfecha==1){
			//cambios hora
			//vhora = vhora.substr(0,5);
			let fechahora = document.getElementById("fechahora").value;
				fechahora = fechahora + ":00"; 
			//fin hora
			
			vdatetime = fechahora;
			//vdatetime = $("#fecha_" ).val() +" " +  vhora;
		}
		
		
		//let data = {sp, empresa, cliente_visitante, persona_id, tipo_ingreso, motivo, cliente, contacto, remision, obra, orden_compra, observaciones, usuario,tipo_unidad,placa,placa2,bruto,tara,neto,descripcion,vfecha,vdatetime,temperatura};
		
		let data = {sp, empresa, cliente_visitante, persona_id, tipo_ingreso, motivo, cliente, contacto, remision, obra, orden_compra, observaciones, usuario,tipo_unidad,placa,placa2,bruto,tara,neto,descripcion,vfecha,vdatetime,temperatura};
		
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
				console.log(data);
				M.toast({html: 'Visita registrada correctamente', classes: 'rounded'});
				setTimeout(() => {
					window.location.href= "<?= base_url() ?>ingreso";                
				}, 1000);
				
				/*
				setTimeout(() => {
					window.location.href= "<?= base_url() ?>ingreso?id=" + data[0].ID;                
				}, 1000);
				*/
			}else{
				M.toast({html: 'No se pudo grabar', classes: 'rounded'});
			}

			$('.preloader-background').css({'display': 'none'});                            
		});	
	}	
	
	function mostrarHoraActual()
	{
		// console.log(horaActual());
		document.getElementById("fecha").value = horaActual();
		//document.getElementById('numero_documento').value = horaActual();
		setTimeout(() => {
			mostrarHoraActual();
		}, 1000); 
	}
	
	function Nuevo(){
			
		$("#btnbusca").text("Agregar"); 
		$("#btnbusca").attr("id_action","1");
		$('#btnbusca').attr('onclick', 'GrabarVisitante()');
		$("#tdocumento_").val($("#tdocumento").val());
		$("#ndocumento_").val($("#ndocumento").val());
		$("#nombres").removeAttr("readonly");
		$("#apellidos").removeAttr("readonly");
		$("#scrt_ini").removeAttr("disabled");
		$("#scrt_fin").removeAttr("disabled");
		$("#scrt_fin").removeAttr("readonly");
		$("#scrt_ini").removeAttr("readonly");
		//$("#scrt_fin").removeAttr("readonly");
		$("#divfoto").show();
		$("#empresa").hide();
		//$("#selectcliente_" ).show();
		$("#i-autocomplete-input" ).show();
		$("#autocomplete-input" ).show();
		$("#tipodocumento" ).hide();
		$("#labeltipodocumento" ).hide();
		$("#selectdocumento_" ).show();
		//console.log("agregar la data");		
		
}
	
	
	async function GrabarVisitante()
    {
		
		//console.log("grabo");
        if(archivo.value != ''){
			await uploadFile('archivo')
			validar();
        }else{
            validar();
        } 
    }
	
	
	function validar()
    {
		console.log("Validar");
		
		let cliente = document.getElementById("cliente_").value;
		let tdocumento = document.getElementById("tdocumento").value;            
		let	ndocumento = document.getElementById("ndocumento").value;

		console.log(cliente);
		console.log(tdocumento);
		console.log(ndocumento);
		//return false;
		
        if( 
            document.getElementById('cliente_').value.trim() != '' &&
            document.getElementById('tdocumento').value.trim()  != '' &&
            document.getElementById('ndocumento').value.trim() != '' &&
            document.getElementById('nombres').value.trim() != '' &&
            document.getElementById('apellidos').value.trim() != ''
        )
        {
			//return false;
			
            if( 
                document.getElementById('tdocumento').value.trim() == '2' &&
                document.getElementById('ndocumento').value.trim().length != 8
            )   
            {
                M.toast({html: 'Formato del DNI es inválido', classes: 'rounded'});    
            }
            else
            {
					
                var url =  '<?= base_url() ?>api/personavalidar';
                var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
                            tdocumento: document.getElementById("tdocumento").value,            
                            ndocumento: document.getElementById("ndocumento").value
                        };
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
                    if(data.length>0){
                        M.toast({html: 'Documento Duplicado', classes: 'rounded'});
                    }
                    else{
                       //document.getElementById('form').submit();
					   
					   
					   //nuevo
						 let cliente = document.getElementById("cliente_").value;
						 //let tdocumento = document.getElementById("tdocumento_").value;            
						 let ndocumento = document.getElementById("ndocumento_").value;
						 console.log(tdocumento);
						 console.log(ndocumento);
						 
						 
						 let nombres = document.getElementById("nombres").value;
						 let apellidos = document.getElementById("apellidos").value;
						 let foto = document.getElementById("name_file").value;
						 let scrt_ini = document.getElementById("scrt_ini").value;
						 
						 let sctr_ini = scrt_ini.split("-").reverse().join("/");
						 
						 let scrt_fin = document.getElementById("scrt_fin").value;
						 
						 let sctr_fin = scrt_fin.split("-").reverse().join("/");
						 
					   					   
							var url =  '<?= base_url() ?>api/crear';
							var data = {
							cliente_ : cliente,
							tdocumento_ : tdocumento,
							ndocumento_ : ndocumento,
							nombres : nombres,
							apellidos : apellidos,
							foto : foto,
							scrt_ini : sctr_ini,
							scrt_fin : sctr_fin	
							};

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
						

						if(data.length>0){
							
								//console.log(data[0].PERSON_C_ID);
								//console.log(data[0].CLIENTE_C_ID);
													
							document.getElementById('cliente_visita_id').value =data[0].CLIENTE_C_ID;					
							document.getElementById('persona_id').value = data[0].PERSON_C_ID;	
							
							//Agregar
							M.toast({html: 'Se ingreso Visitante, Por favor continuar con el registro', classes: 'rounded'});
							
							// Deshabilitar lo ingresado
							$("#nombres").attr("readonly",true);
							$("#apellidos").attr("readonly",true);
							$("#scrt_ini").attr("readonly",true);
							$("#scrt_fin").attr("readonly",true);
							$("#scrt_ini").attr("disabled",true);
							$("#scrt_fin").attr("disabled",true);
							$("#btnbusca").attr("disabled",true);
							$("#divfoto").hide();
							
							if(foto!=""){
							foto = '<?= base_url()?>uploads/'+foto;
							document.getElementById('foto').src = foto;
							}
					
							//$("#cliente_").prop("disabled", true);
							//$("#cliente_").formSelect(); // update material select 
							///$("#archivo").prop("disabled", true);
							///$("#archivo").attr("disabled",true);
							///$("#archivo").formSelect(); // update material select 
							$("#archivo").prop("disabled", true);
							
							$("#autocomplete-input").prop("disabled", true);
							
							
							 //Despues de GrabarVisitante
							$("#btnBuscar").show();
							$("#btnBuscar").css("display", "block");
							$("#tipo_ingreso").prop("disabled", false);
							$("#tipo_ingreso").formSelect();
							//$("#motivo").prop("disabled", false);
							//$("#motivo").formSelect();
							//$("#cliente").prop("disabled", false);
							//$("#cliente").formSelect();
							$("#contacto").prop("disabled", false);
							$("#contacto").formSelect();
							$("#remision").prop("disabled", false);
							$("#obra").prop("disabled", false);
							$("#orden_compra").prop("disabled", false);
							$("#descripcion").prop("disabled", false);
							$("#observaciones").prop("disabled", false);	   
							//Fin Despues de GrabarVisistante
							
							
							
							//Fin Agregar
							
							
							    
							}
							else{
							M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
							}   

							});
					   					
					   //fin nuevo
					   				  
					   
                    }
                });
            
			
			}
        }
        else
        {
            M.toast({html: 'Debe llenar todos los campos', classes: 'rounded'});
        }
    }
	
	function Habilitarsctr()
	{
		
		$("#scrt_ini").removeAttr("readonly");
		$("#scrt_fin").removeAttr("readonly");
		$("#scrt_ini").removeAttr("ondblclick");
		$("#scrt_fin").removeAttr("ondblclick");
		//$("#scrt_fin").attr('ondblclick','Habilitarsctr()');
		$("#scrt_fin").attr('onkeypress','GrabarSCTR(this)');			
		
		//$("#scrt_fin").removeAttr("ondblclick");
		//onkeypress='HoraEditSalida(this)'
		//$("#idtipodocumento").removeAttr("style");
		//console.log("habilitar sctr");
		let persona_id = parseInt(document.getElementById("persona_id").value);
		//console.log(persona_id);
		
		
	}
	
  function compare_dates(fecha, fecha2)  
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
		
	var yMonth=fecha2.substring(7,5);  //str.substring(7,5); substring(5, 0)
    var yDay=fecha2.substring(10,8);  //substring(10,8) substring(0,4
    var yYear=fecha2.substring(0,4);  
		
		
		//console.log(yMonth);
		//console.log(yDay);
		//console.log(yYear);
	
    if (xYear> yYear)  
    {  
        return(true)  
    }  
    else  
    {  
      if (xYear == yYear)  
      {   
		
		//console.log("mes validacion:"+xMonth);
	  
        if (xMonth > yMonth)  
        {  
			//console.log("mes mayor");
            return(true); 
        }  
        else  
        {   
          if (xMonth == yMonth)  
          {  
            if (xDay >= yDay)  {
			  //console.log("ingresa aqui");
              return(true);  
			}
			//else if (xDay = yDay) {		
			  //console.log("ingresa aqui2");
             // return(true); 
			//}
			else  
              return(false);  
          }  
          else  
            return(false);  
        }  
      }  
      else  
        return(false);  
    }  
}

	
    function GrabarSCTR(e){
	
	if (event.key === "Enter") {	
	//console.log("presiono enter");
	//let persona_id = parseInt(document.getElementById("persona_id").value);
	//let sctr_ini = document.getElementById("scrt_ini").value;
	//let sctr_fin = document.getElementById("scrt_fin").value;
	
	//console.log(sctr_ini);
	//console.log(sctr_fin);
	
	let url = '<?= base_url() ?>api/execsp';
	let sp = "PERSONA_SCTR_UDP";
	
	let persona_id = parseInt(document.getElementById("persona_id").value);
	let sctr_ini = document.getElementById("scrt_ini").value;
	    sctr_ini = sctr_ini.split("-").reverse().join("/");
	
	let sctr_fin = document.getElementById("scrt_fin").value;
	 sctr_fin = sctr_fin.split("-").reverse().join("/");	
		
	
	//let txtval = val;
		
		
		let data = {sp, persona_id,sctr_ini,sctr_fin};
	
		
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
			
			console.log("realizo la actulizacion");
			$('#scrt_ini').prop('readonly', true);
			$('#scrt_fin').prop('readonly', true);
			$("#scrt_ini").css('color', 'black');
			$("#scrt_fin").css('color', 'black');
			
			sctr =`<span class="green-text text-darken-4">SCRT VIGENTE</span>`;
			document.getElementById('sctr').innerHTML = sctr;
			
			document.getElementById('btnBuscar').style.display = 'block';
			
			//let sctr = `<span class="green-text text-darken-4">SCRT VIGENTE2</span>`;
			//document.getElementById('sctr').innerHTML = sctr;
			//if(data[0].SCTR_SITUACION == 0){
			//	sctr = `<span class="red-text text-darken-4">SCRT VENCIDO</span>`;
			//}
			
			
	});
	
	}
	}
	
	
	function PlacaUnidad(e){
		if (event.key === "Enter") {
		
			let url = '<?= base_url() ?>api/execsp';
			let sp = "PLACA_UNIDAD_DATA";
			let placa = $("#placa").val();
			
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
			//console.log(data[0].TIPUNI_C_DESCRIPCION);
			
			$("#divtipo_unidad").hide();
			
			$("#divtipo_unidad2").show();
			//console.log(data[0].TIPUNI_N_ID);
			$("#idtipo_unidad").val(data[0].TIPUNI_N_ID);
			$("#txttipo_unidad").val(data[0].TIPUNI_C_DESCRIPCION);
			
			$("#tipo_unidad").prop("disabled", true);
			//$("#tipo_unidad").hide();
			//$("#tipo_unidad").css("display", "none");
			//$("#tipo_unidad").formSelect(); // update material select	
			//$("#tipo_unidad").destroy();
			 }
			 
			 else{
				 
				 console.log("no hay data");
			 }
			
			
			
			});
		
		}
	}
	
	function EditarEmpresa(){
		console.log("habilitar la empresa");
		document.getElementById('idupdate').value="1";
		//console.log("codigo idupdate:"+ $("#idupdate").val());
				
				
		//AGREGADO 16/12/2020
			$("#empresa").hide();
			$("#autocomplete-input").show();
		//FIN AGREGADO 16/12/2020
				
	}
	
	function UpdateEmpresaCliente(idpersona,idcliente){
		console.log(idpersona);
		console.log(idcliente);
		
		//UPDATE
		let url = '<?= base_url() ?>api/execsp';
		let sp = "CLIENTE_PERSONA_UDP";
		let data = {sp, idcliente,idpersona};
		
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
			 //console.log("hizo el proceso");
			 M.toast({html: 'Se actualizo empresa del visitante', classes: 'rounded'});
			 
			 
			 /*
			 if(data.length > 0 ){
			
				console.log("hizo el proceso 2");
			 }
			 
			 else{
				 
				 console.log("no hay data");
			 }
			*/
			
			
			});
		//FIN UPDATE
		
		
	}


function Motivo(){
	 	let url = '<?= base_url() ?>api/execsp';
	let sp = "MOTIVO_VISITA_LIS";
	let idempresa = <?= $empresa->EMPRES_N_ID ?>;
	let data = {sp, idempresa};
	
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
			var motivoList = {};
			for (var i = 0; i < clientArray.length; i++) {
			motivoList[clientArray[i].MOTVIS_C_DESCRIPCION] = null;
			}
			$('input.autocomplete3').autocomplete({
			data: motivoList,
			onAutocomplete: function(val) {

  			console.log(val);
  			//console.log(val);
  			//console.log(val);
			//let val2="motivo_visita";
			let val2="motivo_visita";
			//let val3="MOTIVO_VISITA_ID";
			//let val4="idmotivo";
			IdRetorno(val,val2);
			//idCliente(val,val2);
     
			},
		
			});

			}else{
							
			}                          
	  }); 
	
}


function ListadoCLienteVisitante(){
	
	let url = '<?= base_url() ?>api/execsp';
	let sp = "CLIENTE_ESCLIENTE_LIS";
	let idempresa = <?= $empresa->EMPRES_N_ID ?>;
	let idcliente = 0;
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
			
			let val2="cliente";
			IdRetorno(val,val2);
			//idCliente(val);
     
			},
		
			});

			}else{
			
			console.log("no hay data");
							
			}                          
	  });
}


function ListadoClienteVisitada(){
	
	
	let url = '<?= base_url() ?>api/execsp';
	let sp = "CLIENTE_ESCLIENTE_LIS";
	let idempresa = <?= $empresa->EMPRES_N_ID ?>;
	let idcliente = 1;
	 
	let data2 = {sp, idempresa, idcliente};
	
	fetch(url, {

			method: "POST",
			body: JSON.stringify(data2),
			headers: {
				'Content-Type': 'application/json'
			}
		})
		.then(function(response){
			return response.json();
		})
		.then(function(data2){
			if(data2.length > 0 ){
			
			var clientArray = data2;
			var clientList = {};
			for (var i = 0; i < clientArray.length; i++) {
			clientList[clientArray[i].CLIENT_C_RAZON_SOCIAL] = null;
			}
			
			$('input.autocomplete2').autocomplete({
			data: clientList,
			onAutocomplete: function(val) {
			// Callback function when value is autcompleted.
			
			idCliente2(val);
      
			},
			});
			
			}else{
			//console.log("no hay data");
			}                           
	  });
	
}


function IdRetorno(val,tablanombre){
		
		console.log(val);
		console.log(tablanombre);

		
		let url = '<?= base_url() ?>api/execsp';
		let txtval = val;
		let sp = 'ID_RETORNO';
		
		let data = {sp, txtval,tablanombre};
	
		
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

			console.log(data[0].ID);
			let id = data[0].ID;

			//UPDATE
			//UpdateEmpresaCliente(idpersona,idcliente)			
			//console.log("actualizar empresa");	
			//FIN UPDATE
			
			console.log(tablanombre);
			
			if(tablanombre=="cliente")
			{
			
			//console.log("mensaje de cliente");
			
			document.getElementById("cliente_").value = data[0].ID;

			if(document.getElementById("idupdate").value==1){
				
				console.log("ingreso update");
				let idpersona = parseInt(document.getElementById("persona_id").value);
				let idcliente = parseInt(document.getElementById("cliente_").value);
				
				
				//UPDATE
				UpdateEmpresaCliente(idpersona,idcliente)			
				
				//FIN UPDATE
				console.log("actualizar empresa");
			}

			}
			else if (tablanombre=="motivo_visita"){
			$("#idmotivo" ).val(id);
			}
			
			//document.getElementById("cliente_").value = data[0].CLIENT_N_ID;

			


			}else{
			
			console.log("no hay data");
				
			}
                          
	  });		
}


</script>