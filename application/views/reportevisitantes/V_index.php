 <?php
  // Sets the top option to be the current year. (IE. the option that is chosen by default).
  $currently_selected = date('Y'); 
  // Year to start available options at
  $earliest_year = 2019; 
  // Set your latest year you want in the range, in this case we use PHP to just set it to the current year.
  $latest_year = date('Y'); 
 
 ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<style>
/*
#divgrafico {
  width:95% !important;
  height:70% !important;
}
canvas{
  width:95% !important;
  height:70% !important;

}
*/
</style>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      	<div class="col s12">
        	<a href="" class="breadcrumb">Reportes</a>
        	<a href="" class="breadcrumb">Visitantes</a>
        	<!--<a href="#!" class="breadcrumb">Nuevo</a>-->
      	</div>
    </div>
</nav>
<div class="section container center" style="padding-top: 0px">
    <div class="row" style="margin-bottom: 0px">
        <!--<form action="<?= base_url() ?>clientes" method="post">-->
		
			<div class="input-field col s12 m6 l6">
				<!--<input id="empresa_visitante" maxlength="50" type="text" name="empresa_visitante"  class="autocomplete validate" autocomplete="off" >-->
				<input type="text" id="empresa_visitante" class="autocomplete" autocomplete="off"  >
				<input type="hidden" id="idempresa_visitante" name="cliente">
				<!--<input id="idempresa_visitante" name="idempresa_visitante" type="text">-->
                <label class="active" for="empresa_visitante">Empresa</label> 
            </div>
			
			<div class="input-field col s12 m6 l4">
			<!--<input type='date' id='fechahorai' name='fechahorai' value="" >-->
                <!--<input id="desde" type="text" value="" class="datepicker">-->
				<!--<input type="text" class="">  -->             
		<select id="fecha" name="fecha" required>
					<?php foreach ( range( $latest_year, $earliest_year ) as $i ) {	?>
						<?php print '<option value="'.$i.'"'.($i === $currently_selected ? ' selected="selected"' : '').'>'.$i.'</option>'; ?>			
					<?php  } ?>
		</select>
		<label class="" for="fecha">Año</label> 
       </div>
			

            <div class="input-field col s12 m6 l1">
                <div class="btn-small" id="btnBuscar" onclick="buscar()" >Buscar</div>
				<!--<a href="<?php echo base_url(); ?>movimientopersona/reporte"  class="btn-small" onclick="MovimientoPersona()"   target="_blank">Descargar excel</a>-->
            </div>
        <!--</form>-->
    </div>    
</div>

<!---
 <div class="row">
      <div class="col s1">1</div>
      <div class="col s1">2</div>
      <div class="col s1">3</div>
      <div class="col s1">4</div>
      <div class="col s1">5</div>
      <div class="col s1">6</div>
      <div class="col s1">7</div>
      <div class="col s1">8</div>
      <div class="col s1">9</div>
      <div class="col s1">10</div>
      <div class="col s1">11</div>
      <div class="col s1">12</div>
</div>
--->


<div>

</div>

<div id="divmyChart" class="container">
<canvas id="myChart" ></canvas>
        <!-- Page Content goes here -->
		<!--contenido-->
</div>


<div id="divgrafico">

</div>

<!--<canvas id="myChart" ></canvas>-->



<script>

$(document).ready(function() {
	
	//console.log(document.getElementById("fecha").value);

	//console.log(idcliente);
	//let idvisitante =  document.getElementById('idempresa_visitante').value;
	//if(idvisitante==""){
	//console.log("ingresa a buscar de carga de inicio");
	DataCarga();
	//}
	
	
	
	//BLOQUE BUSQUEDA
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
			// Callback function when value is autcompleted.
			
			idCliente(val);
      
			//Here you then can do whatever you want, val tells you what got clicked so you can push to another page etc...
			},
		
			});
			//console.log(data);
			}else{
			
			console.log("no hay data");				
			}             
	  });
	  //FIN BLOQUE BUSQUEDA
	  
	  
	  //
	  
	  
});	


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
	

//document.addEventListener('DOMContentLoaded', function() {
function buscar(){

$("canvas").remove();


$("#divmyChart").append("<canvas id='myChart'></canvas>");
//var canvas = document.getElementById("myChart");
//var contexto = canvas.getContext("2d");

//contexto.clearRect(0, 0, canvas.width, canvas.height);

DataCarga();


}

//console.log(tpdata);

function DataCarga(){

let url = '<?= base_url() ?>api/execsp';
let sp = 'MOVIMIENTO_PERSONA_REPORTE';
let empresa = <?= $empresa->EMPRES_N_ID ?>;
let empresa_visitante = document.getElementById('empresa_visitante').value + '%';
let fecha = document.getElementById("fecha").value;



if(fecha==""){
fecha = new Date();
fecha = fecha.getFullYear();
}

//fecha = "2020";
//let idempresa_visitante = '%';
let idempresa_visitante = '';
if(document.getElementById('empresa_visitante').value != ''){
	idempresa_visitante = document.getElementById('idempresa_visitante').value;
}	

//console.log(idempresa_visitante); 

//let tipo_ingreso=1;

data = {sp, empresa,idempresa_visitante,fecha};

fetch(url, {
	method: 'POST', // or 'PUT'
	body: JSON.stringify(data), // data can be `string` or {object}!
	headers:{
	'Content-Type': 'application/json'
	}
})
.then(function(response) {
	//console.log(response);
	return response.json();
})
.then(function(data) {
	//console.log("ingreso");
	//console.log(data);
	var tip = [];
    var tiv = [];
	
	if(data.length > 0)
	{
		for (var i = 0; i < data.length; i++) {	
			tip.push(data[i].tipoingresopeatonal);
			tiv.push(data[i].tipoingresovehicular);
			
		}
		
		console.log(tip);
		console.log(tiv);
		DataCanvas(tip,tiv);
		
		
	}
	else{
	//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
	}
	//$('.preloader-background').css({'display': 'none'});                            
});

}


function DataCanvas(tip,tiv){
		
var ctx= document.getElementById("myChart").getContext("2d");

var myChart = new Chart(ctx,{
	 type:"bar",
	 data:{
		 labels:['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		 datasets:[
		{
			 label:'PEATONAL',
			 data:tip,
			 backgroundColor:'rgba(255, 153, 0)',
			 
		},
		{
			 label:'VEHICULAR',
			 data:tiv,
			 backgroundColor:'rgba(84, 156, 33)',
	 }]},
	 options:{
		 responsive: true,
		 scales:{
			 xAxes:[{
				 gridLines:{
					 display:false,
				 },
			 }],			 
			 yAxes:[{
				 ticks:{
					 beginAtZero:true
				 }
			 }]
		 }
	 }
	 
 });		
}
</script>
