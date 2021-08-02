<style>
canvas {
  //border: 1px dotted red;
}


//#divmyChart2 {
  //position: relative;
  //margin: auto;
  //height: 100vh;
 // width: 60vw;
//}

.carousel .carousel-item{
    width:100%;
}
.divborde{
border: 1px solid #ccc!important;
}
#tablesedetotald{
border: 1px solid #ccc!important;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="" class="breadcrumb">Reportes</a>
            <a href="" class="breadcrumb">Importar</a>
        </div>
    </div>
</nav>

<div class="row">

<ul id="tabs-swipe-demo" class="tabs left">
  <li class="tab col s2"><a class="active" href="#swipe-1">Dolares</a></li>
  <li class="tab col s2"><a href="#swipe-2">Soles</a></li>
</ul>
<div id="swipe-1" class="col s12" style="height:1000px">

 <div class="row">

	  
		<div id="sumadolarestotal" class="col s12 m4 divborde"  style="height:374px;margin:5px"> 
		<p>Suma total</p>
		
		<h1 id="sumadolarestotalp"></h1>
		</div>


		<!--
		<div class="col s12 m3 divborde" style="margin:5px">
		<p>Suma total por Sede</p>

		<table id="tablesedetotald" class="highlight">
		<thead><tr><td>Sede</td><td>Total</td></tr><thead>
		<tbody></tbody>
		</table>
		
		</div>
		-->
	
		<!--
		<div class="col s12 m5 divborde" style="height:374px;margin:5px">
			
		<p>Suma total por clientes</p>
		
			<div id="divmyChart2" class="container">
			<canvas id="myChart2" ></canvas>
			</div>

		</div>
		-->
		
		<!--
		<div class="col s12 m11 divborde" style="margin-left:5px;"> 
		<p>Suma total por Mes</p>
		
		<div id="divmyChart" class="container">
		<canvas id="myChart" ></canvas>
		</div>
		
		</div>	  
			-->
</div>

</div>
<div id="swipe-2" class="col s12 ">

 <div class="row">

		<div id="sumasolestotal" class="col s3 divborde"  style="height:374px;margin:5px"> 
		<p>Suma total</p>
		
		<h1 id="sumasolestotalp"></h1>
		</div>
		
		
		<div class="col s3 divborde" style="margin:5px">
		<p>Suma total por Sede</p>

		<table id="tablesedetotals" class="highlight">
		<thead><tr><td>Sede</td><td>Total</td></tr><thead>
		<tbody></tbody>
		</table>
		
		</div>
		
		<div class="col s5 divborde" style="height:374px;margin:5px">
			
			<p>Suma total por clientes</p>
		
			<div id="divmyChart3" class="container">
			<canvas id="myChart3" ></canvas>
			</div>

		</div>
		
		<div class="col s11 divborde" style="margin-left:5px;"> 
		
		<p>Suma total por Mes</p>
		
		<div id="divmyChart4" class="container">
		<canvas id="myChart4" ></canvas>
		</div>
		
		</div>	  
		
		
		

</div>

</div>

</div>

<!--
<div class="section container center" style="padding-top: 0px">
    <div class="row" style="margin-bottom: 0px">
        <form method="post" id="import_form" enctype="multipart/form-data" > 
            <div class="input-field col s12 m6 l4 file-field">
					<div class="btn btn-small">
					<span>Adjunto</span>
					<input id="archivo" type="file" name="file" id="file"  accept=".xls, .xlsx" required>
					</div>
					<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
					</div>
			</div>			
            <div class="input-field col s4">
				<input type="submit" name="import" value="Importar" class="btn btn-small"  />
            </div>
        </form>
    </div> 



	<div id="divmyChart" class="container">
		<canvas id="myChart" ></canvas>
	</div>

	<br><br><br>
	
	<div id="divmyChart2" class="container">
		<canvas id="myChart2" ></canvas>
	</div>
	

</div> 
-->



<script>
$(document).ready(function(){
//console.log("prueba");


$('ul.tabs').tabs({
  swipeable: true,
  responsiveThreshold: Infinity
});
		
	
	DataCarga();
	DataCarga2();
	DataCarga3();
	DataCarga4();
    DataCarga5();
	DataCarga6();
	DataCarga7();
	DataCarga8();
	
	
	$('#import_form').on('submit', function(event){
	event.preventDefault();
	//console.log("ingresa");
	
	$.ajax({
	url:"<?php echo base_url(); ?>importaralquileres/import",
	method:"POST",
	data:new FormData(this),
	contentType:false,
	cache:false,
	processData:false,
	success:function(data){
	console.log(data);
	//DataCarga();
	DataCarga2();	
	}
	})
	});
	
	


});


function DataCarga(){

let url = '<?= base_url() ?>api/execsp';
let sp = 'MES_DOLARESTOTAL_REPORTE';

data = {sp};

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
	var vmes = [];
    var vtotal = [];
	
	if(data.length > 0)
	{
		for (var i = 0; i < data.length; i++) {	
			vmes.push(data[i].mestexto);
			vtotal.push(data[i].total);
			//vtotal.push(new Intl.NumberFormat('es-MX').format(data[i].total));  
			
		}
		
		//remove
		//$("canvas").remove();
		$("#myChart").remove();
		$("#divmyChart").append("<canvas id='myChart'></canvas>");
		//fin remove 
		
		console.log(vmes);
		console.log(vtotal);
		
		DataCanvas(vmes,vtotal);
		
		
	}
	else{
	//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
	}
	//$('.preloader-background').css({'display': 'none'});                            
});

}


function DataCarga2(){

let url = '<?= base_url() ?>api/execsp';
let sp = 'CLIENTE_DOLARESTOTAL_REPORTE';

data = {sp};

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
.then(function(data) {
	var vcliente = [];
    var vtotal = [];
	
	if(data.length > 0)
	{
		for (var i = 0; i < 13; i++) {	 //for (var i = 0; i < data.length; i++) {	
			vcliente.push(data[i].cliente);
			vtotal.push(data[i].total);
			
		}
		
		//remove
		$("#myChart2").remove();
		$("#divmyChart2").append("<canvas id='myChart2' style='position: relative; height:100vh; width:80vw' ></canvas>");
		//fin remove 
		
		console.log(vcliente);
		console.log(vtotal);
		
		DataCanvas2(vcliente,vtotal);
		
		
	}
	else{
	}                        
});

}



function DataCarga3()
{

let url = '<?= base_url() ?>api/execsp';
let sp = 'SUMADOLARES_TOTAL';
data = {sp};

fetch(url, {
	method: 'POST', 
	body: JSON.stringify(data), 
	headers:{
	'Content-Type': 'application/json'
	}
})
.then(function(response) {
	return response.json();
})
.then(function(data) {	
	
	
	if(data.length > 0)
	{
		
		console.log(data[0]);
		
		var total= data[0].suma_total;
		
		//$("#sumadolarestotalp").text(total);
		
		$('#sumadolarestotalp').html(new Intl.NumberFormat('es-MX').format(total));
		//total);
	}
	else
	{
	
	}
});

}


function DataCarga4()
{

let url = '<?= base_url() ?>api/execsp';
let sp = 'SEDEDOLARES_TOTAL';
data = {sp};

fetch(url, {
	method: 'POST', 
	body: JSON.stringify(data), 
	headers:{
	'Content-Type': 'application/json'
	}
})
.then(function(response) {
	return response.json();
})
.then(function(data) {	
	
	
	if(data.length > 0)
	{
		
		for (var i = 0; i < data.length; i++) {	
			//console.log(data[i].sede);
			var monto = data[i].suma_total.toString().replace(/(\d)(?:(?=\d+(?=[^\d.]))(?=(?:[0-9]{3})+\b)|(?=\d+(?=\.))(?=(?:[0-9]{3})+(?=\.)))/g, "$1,");
			//console.log(data[i].suma_total);
			
			markup = "<tr><td>"+data[i].sede +"</td><td>"+monto+"</td></tr>"; 
			//markup = "<tr><td>"+data[i].sede +"</td><td>"+new Intl.NumberFormat('es-MX').format(data[i].suma_total)+"</td></tr>"; 
			
			tableBody = $("#tablesedetotald tbody"); 
			tableBody.append(markup); 
			
		}
		//var total= data[0].suma_total;
		
		//$("#sumadolarestotalp").text(total);
		//$('#sumadolarestotalp').html(new Intl.NumberFormat('es-MX').format(total));
		//total);
	}
	else
	{
	
	}
});

}

function DataCarga5()
{

let url = '<?= base_url() ?>api/execsp';
let sp = 'SUMASOLES_TOTAL';
data = {sp};

fetch(url, {
	method: 'POST', 
	body: JSON.stringify(data), 
	headers:{
	'Content-Type': 'application/json'
	}
})
.then(function(response) {
	return response.json();
})
.then(function(data) {	
	
	
	if(data.length > 0)
	{
		//console.log("ingreso");
		console.log(data[0]);
		
		var total= data[0].suma_total;
		
		//$("#sumadolarestotalp").text(total);
		
		$('#sumasolestotalp').html(new Intl.NumberFormat('es-MX').format(total));
		//total);
	}
	else
	{
	
	}
});

}

function DataCarga6()
{

let url = '<?= base_url() ?>api/execsp';
let sp = 'SEDESOLES_TOTAL';
data = {sp};

fetch(url, {
	method: 'POST', 
	body: JSON.stringify(data), 
	headers:{
	'Content-Type': 'application/json'
	}
})
.then(function(response) {
	return response.json();
})
.then(function(data) {	
	
	
	if(data.length > 0)
	{
		
		for (var i = 0; i < data.length; i++) {	
			//console.log(data[i].sede);
			//console.log(data[i].suma_total);
			
			markup = "<tr><td>"+data[i].sede +"</td><td>"+new Intl.NumberFormat('es-MX').format(data[i].suma_total)+"</td></tr>"; 
			
			tableBody = $("#tablesedetotals tbody"); 
			tableBody.append(markup); 
			
		}
		//var total= data[0].suma_total;
		
		//$("#sumadolarestotalp").text(total);
		//$('#sumadolarestotalp').html(new Intl.NumberFormat('es-MX').format(total));
		//total);
	}
	else
	{
	
	}
});

}


function DataCarga7(){

let url = '<?= base_url() ?>api/execsp';
let sp = 'CLIENTE_SOLESTOTAL_REPORTE';

data = {sp};

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
.then(function(data) {
	var vcliente = [];
    var vtotal = [];
	
	if(data.length > 0)
	{
		
		//console.log(data);
		
		
		for (var i = 0; i < data.length; i++) {	
			vcliente.push(data[i].cliente);
			vtotal.push(data[i].total);
			
		}
		
		$("#myChart3").remove();
		$("#divmyChart3").append("<canvas id='myChart3' style='position: relative; height:100vh; width:80vw' ></canvas>");
		 
		
		console.log(vcliente);
		console.log(vtotal);
		
		DataCanvas3(vcliente,vtotal);
		
	}
	else{
	}                        
});

}



function DataCarga8(){

let url = '<?= base_url() ?>api/execsp';
let sp = 'MES_SOLESTOTAL_REPORTE';

data = {sp};

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
	var vmes = [];
    var vtotal = [];
	
	if(data.length > 0)
	{
		for (var i = 0; i < data.length; i++) {	
			vmes.push(data[i].mestexto);
			vtotal.push(data[i].total);
			//vtotal.push(new Intl.NumberFormat('es-MX').format(data[i].total));  
			
		}
		
		//remove
		//$("canvas").remove();	
		$("#myChart4").remove();
		$("#divmyChart4").append("<canvas id='myChart4'></canvas>");
		//fin remove 
		
		console.log(vmes);
		console.log(vtotal);
		
		DataCanvas4(vmes,vtotal);
		
		
	}
	else{
	//M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
	}
	//$('.preloader-background').css({'display': 'none'});                            
});

}

///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////

function DataCanvas(vmes,vtotal){
		
var ctx= document.getElementById("myChart").getContext("2d");

var myChart = new Chart(ctx,{
	 type:"bar",
	 data:{
		 labels:vmes,
		 datasets:[
		{
			 label:'TOTAL',
			 data:vtotal,
			 backgroundColor:'rgba(160, 221, 240)',
			 
		}]},
	 options:{
		 responsive: true,
		 	tooltips: {
			callbacks: {
					label: function(tooltipItem, data) {
						var value = data.datasets[0].data[tooltipItem.index];
						value = value.toString().replace(/(\d)(?:(?=\d+(?=[^\d.]))(?=(?:[0-9]{3})+\b)|(?=\d+(?=\.))(?=(?:[0-9]{3})+(?=\.)))/g, "$1,");
						//value = value.toString();
						//value = value.split(/(?=(?:...)*$)/);
						//value = value.join(',');
						return value;
					}
			  } // end callbacks:
			}, //end tooltips
		 scales:{
			 xAxes:[{
				 gridLines:{
					 display:false,
				 },
			 }],			 
			 yAxes:[{
				 ticks:{
					 beginAtZero:true,
				callback: function(value, index, values) {
                return Intl.NumberFormat().format((value/1000)) + 'K';
				//return '€' + Intl.NumberFormat().format((value/1000)) + 'K';
				}
				 }
			 }]
		 }
	 }
	 
 });		
}



function DataCanvas2(vcliente,vtotal){
	
var ctx = document.getElementById("myChart2");

var graphColors = [];
var graphOutlines = [];
var hoverColor = [];


var internalDataLength = vcliente.length;


var i = 0;
while (i <= internalDataLength) {
    var randomR = Math.floor((Math.random() * 130) + 100);
    var randomG = Math.floor((Math.random() * 130) + 100);
    var randomB = Math.floor((Math.random() * 130) + 100);
  
    var graphBackground = "rgb(" 
            + randomR + ", " 
            + randomG + ", " 
            + randomB + ")";
    graphColors.push(graphBackground);
    
    var graphOutline = "rgb(" 
            + (randomR - 80) + ", " 
            + (randomG - 80) + ", " 
            + (randomB - 80) + ")";
    graphOutlines.push(graphOutline);
    
    var hoverColors = "rgb(" 
            + (randomR + 25) + ", " 
            + (randomG + 25) + ", " 
            + (randomB + 25) + ")";
    hoverColor.push(hoverColors);
    
  i++;
};


var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: vcliente,
    datasets: [{
      label: '',
      data: vtotal,
      backgroundColor: graphColors,
       hoverBackgroundColor: hoverColor,
      // borderColor: graphOutlines,
      borderWidth: 0
    }]
  },
  options: {
   	//cutoutPercentage: 40,
    responsive: true,
	legend: {
		position: 'right',
		labels: {
                fontColor: 'black',
				fontSize: 09
            }
	},
  },
  
});
}


//DataCanvas3
function DataCanvas3(vcliente,vtotal){
	
var ctx = document.getElementById("myChart3");

var graphColors = [];
var graphOutlines = [];
var hoverColor = [];


var internalDataLength = vcliente.length;


var i = 0;
while (i <= internalDataLength) {
    var randomR = Math.floor((Math.random() * 130) + 100);
    var randomG = Math.floor((Math.random() * 130) + 100);
    var randomB = Math.floor((Math.random() * 130) + 100);
  
    var graphBackground = "rgb(" 
            + randomR + ", " 
            + randomG + ", " 
            + randomB + ")";
    graphColors.push(graphBackground);
    
    var graphOutline = "rgb(" 
            + (randomR - 80) + ", " 
            + (randomG - 80) + ", " 
            + (randomB - 80) + ")";
    graphOutlines.push(graphOutline);
    
    var hoverColors = "rgb(" 
            + (randomR + 25) + ", " 
            + (randomG + 25) + ", " 
            + (randomB + 25) + ")";
    hoverColor.push(hoverColors);
    
  i++;
};


var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: vcliente,
    datasets: [{
      label: '',
      data: vtotal,
      backgroundColor: graphColors,
       hoverBackgroundColor: hoverColor,
      // borderColor: graphOutlines,
      borderWidth: 0
    }]
  },
  options: {
   	//cutoutPercentage: 40,
    responsive: true,
	legend: {
		position: 'right',
		labels: {
                fontColor: 'black',
				fontSize: 09
            }
	},
  },
  
});
}

function DataCanvas4(vmes,vtotal){
		
var ctx= document.getElementById("myChart4").getContext("2d");

var myChart = new Chart(ctx,{
	 type:"bar",
	 data:{
		 labels:vmes,
		 datasets:[
		{
			 label:'TOTAL',
			 data:vtotal,
			 backgroundColor:'rgba(160, 221, 240)',
			 
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

function milesNumeros(numero) {
    return numero.toString().replace(/(\d)(?:(?=\d+(?=[^\d.]))(?=(?:[0-9]{3})+\b)|(?=\d+(?=\.))(?=(?:[0-9]{3})+(?=\.)))/g, "$1,");
};

</script>
