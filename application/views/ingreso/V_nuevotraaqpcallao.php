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
				
				<input type="hidden" id="ndocumento_" name="ndocumento_" >
				<input type="hidden" id="tdocumento_" name="tdocumento_">
				
				<input type="hidden" id="idupdate" name="idupdate" value="">
					<input type="hidden" id="cliente_visita_id" value="">
					<input type="text" id="cliente" name="cliente" value=" ">
					<!--<input class="ancho" id="empresa" type="text" value=""  ondblclick="EditarEmpresa()" readonly>-->
				<label class="active" for="empresa">Empresa Visitante</label>
			</div>	

			<div class="input-field col s6" >
				<input type="hidden" id="persona_id">
				<input  id="apellidos" type="text" value=" " name="apellidos" readonly >
				<label class="active" for="apellidos">Apellidos</label>
			</div>
			<div class="input-field col s6"  >
				<input class="ancho" id="nombres" type="text" value=" " name="nombres" readonly>
				<label class="active" for="nombres">Nombres</label>
			</div>

			<!--<div class="input-field col s12" >-->
			<label class="input-field col s12">
			<input type="hidden" id="idcheckboxsctr" name="idcheckboxsctr" value="0">
			<input type="checkbox" class="filled-in" id="checkboxsctr" name="checkboxsctr" /> <!--checked="checked"-->
       		<span>Habilitar SCTR</span>
			</label>
			<!--</div>-->
				
			<div class="input-field col s6" >
                <input id="sctr_ini" type="date" value="" name="sctr_ini"  disabled readonly >
				<label class="active" for="sctr_ini">SCTR Inicio</label>
			</div>
			
			<div class="input-field col s6"  >
				<input id="sctr_fin" type="date" value="" name="sctr_fin"  disabled readonly >
                <label class="active" for="sctr_fin">SCTR Vencimiento</label> 
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
			
			<div class="input-field col s6" >
               <select id="area" id="area" disabled  required>
                    <option value="0">Seleccionar Area</option>		
                    <option value="1">Postal</option>
                    <option value="2">Carga</option>
                </select>
				<label for="area">Area</label>
			</div>
			
		</div>	
		
		
			<div class="input-field col s6" >
                <input id="temperatura" type="number" value="" name="temperatura" disabled readonly >
				<label class="active" for="temperatura">Temperatura</label>
			</div>
			
		<div id="divcondicion" >
			
			<div class="input-field col s6" >
               <select id="condicion" name="condicion" disabled  required>
                    <option value="0">Seleccionar Condicion</option>		
                    <option value="1">Apto</option>
                    <option value="2">Vulnerable</option>
                </select>
				<label for="condicion">Condicion</label>
			</div>
		
		</div>
		
			<!--
			<div class="input-field col s12 ">
			
			<input type="text" id="autocomplete-input2" class="autocomplete2" autocomplete="off"   >
			<input type="hidden" id="cliente" name="cliente" >
			<label>Empresa Visitada</label>

			</div>
		-->		
		<!--
			<div class="input-field col s12  ">
				<select id="contacto" disabled required>
					<option value="0">Seleccionar Contácto</option>				
				</select>
				<label>Persona de Contácto</label>
			</div>
			-->
		</div>
		<div class="col s4">
			<img id="foto" style="width:100%"  src="<?= base_url()?>assets/images/sin-imagen.jpg"/>
			<p id="bloqueado" class="center"></p>
			<p id="sctr" class="center"></p>
			<p id="ingreso" class="center"></p>
		</div>
	</div>
	
	<div class="row">
	    <!--
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
		-->		
				
		<div class="input-field col s12">
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
			   $("#area").attr("disabled",false);
			   $("#area").formSelect();
			   $("#divcondicion").hide();
			  //$("#condicion").formSelect();
			  //$("#condicion").hide();
			  //$("#condicion").attr("disabled",false);
			   //$("#bruto").attr("disabled",false);	
			   //$("#tara").attr("disabled",false);	
			  // $("#neto").attr("disabled",false);		
			   $("#divvehicular").show();		
			}
			else{
			   $("#divvehicular").hide();
			   $("#tipo_unidad").prop("disabled", true);
			   $("#tipo_unidad").formSelect();
			   $("#placa").attr("disabled",true);
			   $("#placa2").attr("disabled",true);
			   $("#divcondicion").show();
			   $("#condicion").prop("disabled", false);
			   $("#condicion").formSelect();
			   //$("#bruto").attr("disabled",true);	
			   //$("#tara").attr("disabled",true);	
			  // $("#neto").attr("disabled",true);
			}

		});
	
	});
	
	$(document).ready(function(){
	
	$('#checkboxsctr').click(function() {
    if ($(this).is(':checked')) { //!$(this).is(':checked'))
		
		$("#sctr_ini").removeAttr("disabled");
		$("#sctr_fin").removeAttr("disabled");
		$("#sctr_ini").removeAttr("readonly");
		$("#sctr_fin").removeAttr("readonly");	
		$("#idcheckboxsctr").val("1");	
		//$('#sctr_ini').prop('readonly', true);
		//$('#sctr_fin').prop('readonly', true);
		//sctr_ini
		//sctr_fin
		//return confirm("Are you sure?");
    }else
	{
		$("#sctr_ini").attr("disabled", true);
		$("#sctr_fin").attr("disabled", true);
		$("#sctr_ini").attr("readonly", true);
		$("#sctr_fin").attr("readonly", true);
		$("#idcheckboxsctr").val("0");
		
		
	}

  });
	
	
	
	
    
	let url = '<?= base_url() ?>api/execsp';
	let sp = "CLIENTE_ESCLIENTE_LIS";
	let idempresa = <?= $empresa->EMPRES_N_ID ?>;
	let idcliente = 1;
	let data = {sp, idempresa, idcliente};
	let id = 0;
	let cliente = "";
	
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
			id=data[0].CLIENT_N_ID;
			cliente=data[0].CLIENT_C_RAZON_SOCIAL;
			
			
			$("#cliente_visita_id").val(id);
			$("#cliente").val(cliente);
			$("#cliente").attr("disabled", true);
			//$("#placa").val();
			//console.log(data);			
			//var clientArray = data;
			//var clientList = {};
			
			
			//for (var i = 0; i < clientArray.length; i++) {
			
			
			//clientList[clientArray[i].CLIENT_C_RAZON_SOCIAL] = null;
			
			
			//}
			
			/*
			$('input.autocomplete').autocomplete({
			data: clientList,
			onAutocomplete: function(val) {

			idCliente(val);
     
			},
			});
			*/
			
			}else{
			
			console.log("no hay data");
							
			}                          
	  });
	  
	  
	//empresa visitada
	idcliente = 1;
	 
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
		
	
	function idCliente(val){
		
		let url = '<?= base_url() ?>api/execsp';
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let sp = "CLIENTE_ID";
	
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
			//console.log("mensaje de prueba");
			//return false;
			
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
				
				
				console.log(data[0].CANTIDAD_BLOQUEOS);
				console.log(data[0].SCTR_SITUACION);
				console.log(data[0].INGRESO_VIGENTE);
				
				

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
				$('#nombres').attr('disabled', true);
				document.getElementById('apellidos').value = data[0].PERSON_C_APELLIDOS;
				$('#apellidos').attr('disabled', true);
				document.getElementById('idcheckboxsctr').value = data[0].PERSON_C_HABILITARSCTR;
				idcheckboxsctr = data[0].PERSON_C_HABILITARSCTR;
					
				
				if(idcheckboxsctr==1)
				{
					$('#checkboxsctr').attr('checked', true);
					$('#checkboxsctr').attr('disabled', true);
					//checkboxsctr
					//checkboxsctr
				}
				else
				{
					$('#checkboxsctr').attr('checked', false);
					$('#checkboxsctr').attr('disabled', true);
					//checkboxsctr
				}
				
				
				
				let sctr_ini = data[0].PERSON_C_FECHA_SCTR_INI;
				//console.log(sctr_ini);
				var vfini = sctr_ini.split("/").reverse().join("-");
				//var salida = formato(sctr_ini);
				//console.log(vfini);
				document.getElementById('sctr_ini').value = vfini;
				let vfechaini = document.getElementById('sctr_ini').value;
				
				
				let sctr_fin = data[0].PERSON_C_FECHA_SCTR_FIN;
				var vffin = sctr_fin.split("/").reverse().join("-");
				document.getElementById('sctr_fin').value = vffin;
				let vfechafin = document.getElementById('sctr_fin').value;					

				//$("#sctr_ini").removeAttr("disabled");
				//$("#sctr_fin").removeAttr("disabled");
				//$("#sctr_ini").removeAttr("readonly");
				//$("#sctr_fin").removeAttr("readonly");		
				//$("#sctr_fin").attr('onkeypress','GrabarSCTR(this)');
				
				
				document.getElementById('foto').src = foto;
				document.getElementById('bloqueado').innerHTML = bloqueado;
				document.getElementById('sctr').innerHTML = sctr;
				document.getElementById('ingreso').innerHTML = ingreso;
				//document.getElementById('empresa').value = data[0].CLIENT_C_RAZON_SOCIAL;
				//document.getElementById('autocomplete-input').value = data[0].CLIENT_C_RAZON_SOCIAL;
			   
			   $("#selectdocumento_").hide();
			   $("#tipodocumento").show();
			   $("#idtipodocumento").removeAttr("style");
     		   $("#temperatura").prop("disabled", false);
			   $("#temperatura").prop("readonly", false);
			   $("#tipo_ingreso").prop("disabled", false);
			   $("#tipo_ingreso").formSelect();
			   $("#observaciones").prop("disabled", false);	   
				
				let date = new Date();
				let day = date.getDate();
				
				if(day < 10){
					day = `0${day}`;
				}
				else{
					day = `${day}`;
				}
				
				
				let month = date.getMonth()+1 ;
				
				if(month < 10){
				month=`0${month}`;
				}else{
				month=`${month}`;
				}
				
				
				let year = date.getFullYear()
											
				fecha = day +"/"+month+"/"+year;
				
				console.log(fecha);
				console.log(vfechafin);							
							
				let vfecha = Date.parse(fecha);
				vfecha = new Date(vfecha);
								
				if (compare_dates(fecha, vfechafin)){  
				 //$("#sctr_ini").attr('ondblclick','Habilitarsctr()');
				 //$("#sctr_fin").attr('ondblclick','Habilitarsctr()');
				 //$("#sctr_ini").attr("disabled",false);	
				 //$("#sctr_fin").attr("disabled",false);
				 //$("#sctr_ini").css('color', 'red');
				// $("#sctr_fin").css('color', 'red');
				}else{ 
				
				} 
				
				
				
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
	

	function guardar()
    {
		
		let url = '<?= base_url() ?>api/execsp';
		let sp = "MOVIMIENTO_PERSONA_INS_AQPCALLAO";
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let cliente_visitante = parseInt(document.getElementById("cliente_visita_id").value);
		let persona_id = parseInt(document.getElementById("persona_id").value);
		let tipo_ingreso = parseInt(document.getElementById("tipo_ingreso").value);
		let condicion = parseInt(document.getElementById("condicion").value);
		let area = parseInt(document.getElementById("area").value);
		let motivo = "";
		let cliente=0;
		if(empresa==1){
		  cliente = 636;
		}
		else if(empresa==2){
		  cliente = 4;
		}
		else if(empresa ==3){
		  cliente=2;
		}
		let contacto = "";
		let remision = "";
		let obra = "";
		let orden_compra = "";
		let descripcion = "";
		let temperatura = document.getElementById("temperatura").value;
		let pase = 0;
		let tipoalmacen = 0;
		let tiposervicio = 0;
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
		let bruto = "";
		let tara = "";
		let neto = "";
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
		
		let data = {sp, empresa, cliente_visitante, persona_id, tipo_ingreso, motivo, cliente, contacto, remision, obra, orden_compra, observaciones, usuario,tipo_unidad,placa,placa2,bruto,tara,neto,descripcion,vfecha,vdatetime,temperatura,condicion,area,pase,tipoalmacen,tiposervicio};
		
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
		$("#divfoto").show();
		$("#empresa").hide();
		//$("#selectcliente_" ).show();
		$("#i-autocomplete-input" ).show();
		$("#autocomplete-input" ).show();
		$("#tipodocumento" ).hide();
		$("#labeltipodocumento" ).hide();
		$("#selectdocumento_" ).show();
		//$("#sctr_ini").removeAttr("disabled");
		//$("#sctr_fin").removeAttr("disabled");
		//$("#sctr_ini").removeAttr("readonly");
		//$("#sctr_fin").removeAttr("readonly");		
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
		//console.log("Validar");
		
		let cliente = document.getElementById("cliente").value;
		let tdocumento = document.getElementById("tdocumento").value;            
		let	ndocumento = document.getElementById("ndocumento").value;

		console.log(cliente);
		console.log(tdocumento);
		console.log(ndocumento);
		//return false;
		
        if( 
            document.getElementById('cliente').value.trim() != '' &&
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
						 let cliente = document.getElementById("cliente_visita_id").value;
						 
						 if(tdocumento==""){
						 tdocumento = document.getElementById("tdocumento_").value; 
						 }
						 let ndocumento = document.getElementById("ndocumento_").value;
						 let idcheckboxsctr = document.getElementById("idcheckboxsctr").value;
						 console.log(tdocumento);
						 console.log(ndocumento);
						 
						 
						 let nombres = document.getElementById("nombres").value;
						 let apellidos = document.getElementById("apellidos").value;
						 let foto = document.getElementById("name_file").value;						
						 let scrt_ini = document.getElementById("sctr_ini").value;
						 let sctr_ini = scrt_ini.split("-").reverse().join("/");
						 let scrt_fin = document.getElementById("sctr_fin").value;
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
							scrt_fin : sctr_fin,
							idcheckboxsctr: idcheckboxsctr
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
							$("#sctr_ini").attr("readonly",true);
							$("#sctr_fin").attr("readonly",true);
							$("#sctr_ini").attr("disabled",true);
							$("#sctr_fin").attr("disabled",true);
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
							$("#temperatura").prop("disabled", false);
							$("#temperatura").prop("readonly", false);
							$("#tipo_ingreso").prop("disabled", false);
							$("#tipo_ingreso").formSelect();
							$("#motivo").prop("disabled", false);
							$("#motivo").formSelect();
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
			
			$("#divtipo_unidad").hide();
			
			$("#divtipo_unidad2").show();
			$("#idtipo_unidad").val(data[0].TIPUNI_N_ID);
			$("#txttipo_unidad").val(data[0].TIPUNI_C_DESCRIPCION);
			
			$("#tipo_unidad").prop("disabled", true);
			 }
			 
			 else{
				 
				 console.log("no hay data");
			 }
			
			
			
			});
		
		}
	}
	
	function EditarEmpresa(){
		//console.log("habilitar la empresa");
		document.getElementById('idupdate').value="1";
		console.log("codigo idupdate:"+ $("#idupdate").val());
				
				
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


function Habilitarsctr()
{
		$("#sctr_ini").removeAttr("readonly");
		$("#sctr_fin").removeAttr("readonly");
		$("#sctr_ini").removeAttr("ondblclick");
		$("#sctr_fin").removeAttr("ondblclick");
		//$("#scrt_fin").attr('ondblclick','Habilitarsctr()');
		$("#sctr_fin").attr('onkeypress','GrabarSCTR(this)');			
		
		//$("#scrt_fin").removeAttr("ondblclick");
		//onkeypress='HoraEditSalida(this)'
		//$("#idtipodocumento").removeAttr("style");
		//console.log("habilitar sctr");
		let persona_id = parseInt(document.getElementById("persona_id").value);
		//console.log(persona_id);	
}

function GrabarSCTR(e){
	//console.log("ingreso sctr");
	
	
	if (event.key === "Enter") {	
	//console.log("presiono enter");

	let url = '<?= base_url() ?>api/execsp';
	let sp = "PERSONA_SCTR_UDP";

	let persona_id = parseInt(document.getElementById("persona_id").value);
	let sctr_ini = document.getElementById("sctr_ini").value;
	sctr_ini = sctr_ini.split("-").reverse().join("/");

	let sctr_fin = document.getElementById("sctr_fin").value;
	sctr_fin = sctr_fin.split("-").reverse().join("/");	

	let data = {sp, persona_id,sctr_ini,sctr_fin};

	//console.log("ingreso enter");

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
	$('#sctr_ini').prop('readonly', true);
	$('#sctr_fin').prop('readonly', true);
	//$('#scrt_fin').prop('readonly', true);
	//$('#scrt_fin').prop('readonly', true);
	$("#sctr_ini").css('color', 'black');
	$("#sctr_fin").css('color', 'black');

	sctr =`<span class="green-text text-darken-4">SCRT VIGENTE</span>`;
	document.getElementById('sctr').innerHTML = sctr;

	document.getElementById('btnBuscar').style.display = 'block';

	});

	}
}




</script>