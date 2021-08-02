<?php 
    $fechaDesde = new DateTime();
    //$fechaDesde->modify('-1 month');
    $fechaDesde->modify('first day of this month');    
    
	$fechaHasta = new DateTime();
    $fechaHasta->modify('first day of this month');
	$intervalo = new DateInterval('P1M');
	$fechaHasta->add($intervalo);
	
    //$fechaHasta = new DateTime();
	//$fechaHasta = new DateTime();
?>
<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Acuerdos de Alquiler</a>
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
        <form action="<?= base_url() ?>clientes" method="post">
            <!--
			<div class="input-field col s12 m6 l4">
                <input id="acuerdo_id" maxlength="11" type="text" class="validate">
                <label class="active" for="acuerdo_id">ID Acuerdo</label> 
            </div>
			-->
            <div class="input-field col s12 m6 l4">
<!--               
			   <input id="razon_social" maxlength="200" type="text" name="razon_social"  class="validate">
                <label class="active" for="razon_social">Cliente</label> 
-->			
					<input id="razon_social" maxlength="50" type="text" name="razon_social"  class="autocomplete validate" autocomplete="off" >
                <label class="active" for="razon_social">Cliente</label> 		
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="sede" maxlength="100" type="text"  class="validate">
                <label class="active" for="sede">Sede</label> 
            </div>
			
            <div class="input-field col s12 m6 l4">
                <!--
				<input id="desde" type="text" value="<?= $fechaDesde->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="desde">Estado</label> 
				-->
				<select id="estado" required>
						<option value="1">Vigente</option>
						<option value="2">Vencido</option>
				</select>
				<label for="estado">Estado</label>
			</div>
			<!--
            <div class="input-field col s12 m6 l4">
                <input id="hasta" type="text" value="<?= $fechaHasta->format('m/d/Y') ?>" class="datepicker">
                <label class="active" for="hasta">Hasta</label> 
            </div>
			-->
			
            <div class="input-field col s4">
                <div class="btn-small" id="btnBuscar">Buscar</div>
            </div>
        </form>
    </div>    
</div> 

<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="right-align">ID</th>
                <th class="left-align">CLIENTE</th>
                <th class="left-align">SEDE</th>
                <th class="left-align">UBICACIÓN</th>
                <th class="center-align">F. INICIO</th>
                <th class="center-align">F. TERMINO</th>
                <th class="center-align">CERRADO</th>
                <th class="center-align">PERIODOS</th>
                <th class="center-align">IMPRIMIR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody id="resultados">            
        </tbody>

    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" 
    href="<?= base_url()?>acuerdo/nuevo"><i class="material-icons">add</i></a>

<!-- Confirmar Eliminar -->
<div id="modalEliminar" class="modal">
    <div class="modal-content">
      <h4>Eliminar</h4>
      <p>¿Está seguro que desea elimniar el registro?</p>
      <input type="hidden" id="eliminar_tipo">
      <input type="hidden" id="eliminar_registro">
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
      <a id="btnConfirmar" href="#!" class="modal-close waves-effect waves-green btn" onclick="confirmarEliminar()">ACEPTAR</a>
    </div>
</div>



<!-- Confirmar Cerrar -->
<div id="confirmarCerrar" class="modal">
    <div class="modal-content">
    <h4>Cerrar</h4>
    <p>¿Está seguro que desea cerrar el registro?</p>
    </div>
    <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
    <a id="btnConfirmarCerrar" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>

 <!-- Ver periodos -->
<div id="modalPeriodos" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="left">Periodos</h4>
        <input type="hidden" id="acuerdo_id_periodo" >
        <div id="btnAgregarPeriodo" class="btn right" onclick="agregarPeriodo()">Agregar Periodo</div>
        <div class="section">
            <table class="striped" style="font-size: 12px;">
                <thead class="blue-grey darken-1" style="color: white">
                    <tr>
                        <th class="center-align">ID</th>          
                        <th class="center-align">F. INICIO</th>
                        <th class="center-align">F. TERMINO</th>
                        <th class="right-align">AREA</th>
                        <th class="right-align">PRECIO</th>
                        <th class="right-align">SUB TOTAL</th>
                        <th class="center-align">SITUACIÓN</th>
                        <th class="center-align">ELIMINAR</th>
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

 <!-- Agregar periodo -->
 <div id="modalAgregarPeriodo" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 >Nuevo Periodo</h4>
        <div class="section">
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder=" " id="np_fecha_inicio" type="text" class="right-align" readonly>
                    <label for="np_fecha_inicio">Fecha Inicio</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder=" " id="np_fecha_fin" type="text" class="right-align" readonly>
                    <label for="np_fecha_fin">Fecha Final</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder=" " id="nuevo_area" type="text" class="right-align">
                    <label for="nuevo_area">Area M2</label>
                </div>
                <div class="input-field col s6">
                    <input placeholder=" " id="nuevo_precio" type="text" class="validate right-align" onkeydown="recalcular()" onchange="recalcular()">
                    <label for="nuevo_precio">Precio</label>
                </div>
                <div class="input-field col s12">
                    <input placeholder="" id="np_total" type="text" class="right-align" readonly>
                    <label for="total">Total</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class="waves-effect waves-green btn" onclick="guardarNuevoPeriodo()">GUARDAR NUEVO PERIODO</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
		//Clientes 
		CargarCliente();
		buscar();
		
		
		var btnBuscar = document.getElementById("btnBuscar"); 
        btnBuscar.addEventListener("click", buscar, false);
        
        acuerdo_id = getParameterByName('aca')
        if(acuerdo_id != '')
        {
            $('#acuerdo_id').val(acuerdo_id)
            M.updateTextFields(); //este metodo sale de materialize
            buscar()
        }
		
		
		
    });
	
	function CargarCliente(){
	
	let url = '<?= base_url() ?>api/execsp';
	let sp = "CLIENTE_ESCLIENTE_LIS";
	
	let idempresa = 1;
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
			
			//idCliente(val);
      
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
		
	}

    function buscar()
    {
        console.log('Estoy buscando..  ')
        M.toast({html: 'Buscando resultado...', classes: 'rounded'});
        $('.preloader-background').css({'display': 'block'});

        var url = 'acuerdo/buscar';


		//Acuerdo ID
		/*
        var acuerdo_id = 0; 
        if($('#acuerdo_id').val() != '')
        {
            acuerdo_id = $('#acuerdo_id').val();
        }
		*/
		
        var cliente = '%'; 
        if($('#razon_social').val() != '')
        {
            cliente = $('#razon_social').val() + '%';
        }
		
		
        var sede = '%'; 
        if($('#sede').val() != '')
        {
            sede = $('#sede').val() + '%';
        }
		
		var estado='%';
		
		if($('#estado').val() != '')
		{
			 estado = $('#estado').val();
		}
		
		//console.log($('#estado').val());
		
        /*
		$fecha_desde = $('#desde').val();
        $fecha_desde = $fecha_desde.split('/');
        
        $fecha_hasta = $('#hasta').val();
        $fecha_hasta = $fecha_hasta.split('/');
		*/
		
        var data = {
                    empresa: <?= $empresa->EMPRES_N_ID ?>, 
                   // acuerdo: acuerdo_id,
                    cliente: cliente,
                    sede: sede,
					estado: estado,
                    //fecha_desde: $fecha_desde[2] + $fecha_desde[1] + $fecha_desde[0],
                    //fecha_hasta: $fecha_hasta[2] + $fecha_hasta[1] + $fecha_hasta[0]
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
            console.log("Abajo se encontrara la funcion data")
            console.log(data);
            if(data.length > 0)
            {
                M.toast({html: 'Cargando Acuerdos', classes: 'rounded'});
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];
                    
					console.log("Abajo estara la variable element");
					console.log( element);
					
					//consolel.log(element.ALQUIL_C_FECHA_FINAL);
                
                    $cerrado='<i class="material-icons tooltipped" style="color: #999" data-tooltip="No puede cerrar el Acuerdo, tiene periodos pendientes">lock_open</i>';
                    if(element.ALQUIL_C_ESTA_CERRADO==1){
                        $cerrado = '<i class="material-icons tooltipped" data-tooltip="Cerrado">lock</i>'
                    }else if(element.ALQUIL_C_ESTA_CERRADO==0){
                        if(element.CANTIDAD_DETALLES == element.SITUACION_MAYOR_CERO)
                        {
                            $cerrado=`<i class="material-icons" style="cursor: pointer" onclick="confirmarCerrar(${element.EMPRES_N_ID},${element.ALQUIL_N_ID})">lock_open</i>`;
                        }
                    }

                    $eliminar = `<i class="material-icons tooltipped" style="color: #999999" data-tooltip="No puede eliminar, tiene periodos liquidados">delete</i>`
                    if(element.ALQUIL_C_ESTA_CERRADO==1)
                    {
                        $eliminar = `<i class="material-icons tooltipped" style="color: #999999" data-tooltip="No puede eliminar, está cerrado">delete</i>`    
                    }
                    else{
                        if(element.CANTIDAD_DETALLES == element.SITUACION_CERO)
                        {
                            $eliminar = `<i class="material-icons" style="cursor: pointer" onclick="modalEliminar('1','${element.EMPRES_N_ID}-${element.ALQUIL_N_ID}')">delete</i>`
                        }
                    }

                    $ver_periodos = `${element.CANTIDAD_DETALLES} <i class="material-icons" style="vertical-align: middle; cursor: pointer" onclick="verPeriodos(${element.EMPRES_N_ID},${element.ALQUIL_N_ID}, ${element.ALQUIL_C_ESTA_CERRADO})">event_note</i>`

                    $('#resultados').append(`   <tr>
                                                    <td class="center-align">${element.ALQUIL_N_ID}</td>
                                                    <td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
                                                    <td class="left-align">${element.SEDE_C_DESCRIPCION}</td>
                                                    <td class="left-align">${element.UBICAC_C_DESCRIPCION}</td>
                                                    <td class="center-align">${element.ALQUIL_C_FECHA_INICIO}</td>
                                                    <td class="center-align">${element.ALQUIL_C_FECHA_FINAL}</td>
                                                    <td class="center-align">${$cerrado}</td>
                                                    <td class="center-align">
                                                        ${$ver_periodos}                
                                                    </td>
                                                    <td class="center-align">
                                                        <a href="acuerdo/reporte/${element.ALQUIL_N_ID}" target="_blank">
                                                            <i class="material-icons">layers</i>
                                                        </a>
                                                    </td> 
                                                    <td class="center-align">
                                                        ${$eliminar}                
                                                    </td>
                                                    </div>
                                                </tr>
                                        `);
                }
            }
            else{
                M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
            }
            $('.preloader-background').css({'display': 'none'}); 
            $('.tooltipped').tooltip();                           
        });
    }

    function recalcular()
    {
        $('#np_total').val(parseInt($('#nuevo_area').val()) * parseInt($('#nuevo_precio').val()))        
    }

    function modalEliminar($tipo, $registro)
    {
        console.log('confirmar eliminar')
        $('.modal').modal('close');
        $('#eliminar_tipo').val($tipo);
        $('#eliminar_registro').val($registro);
        $('#modalEliminar').modal('open');
    }

    function confirmarEliminar()
    {
        $('.preloader-background').css({'display': 'block'});
        let tipo = $('#eliminar_tipo').val();

        let registro = $('#eliminar_registro').val();
        registro = registro.split('-');

        let url = 'api/execsp';
        let empresa = registro[0];
        let acuerdo = registro[1];
        let sp = '';
        let data = '';
        if(tipo == '1')
        {
            sp = 'ALQUILER_DEL';
            data = {sp, empresa, acuerdo};
        }else if(tipo == '2')
        {
            sp = 'ALQUILER_DETALLE_DEL';
            let periodo = registro[2];    
            let usuario = <?= $session->USUARI_N_ID ?>;        
            data = {sp, empresa, acuerdo, periodo, usuario};
        }

        
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
            $('.preloader-background').css({'display': 'none'});     
            if(tipo == '1')
            {
                buscar();
            }else if(tipo == '2')
            {
                verPeriodos(empresa, acuerdo);        
            }
        });
    }

    function confirmarCerrar($empresa,$acuerdo)
    {
        console.log('confirmar cerrar')
        $('#confirmarCerrar').modal('open');
        $('#btnConfirmarCerrar').attr('href', 'acuerdo/'+$empresa+'/'+$acuerdo+'/cerrar')
    }
    
    function verPeriodos($empresa,$acuerdo, $cerrado = 0)
    {
        console.log('Estoy buscando.. ')

        if($cerrado > 0)
        {
            $('#btnAgregarPeriodo').css({'display': 'none'});
        }else{
            $('#btnAgregarPeriodo').css({'display': 'block'});
        }
        
        $('.preloader-background').css({'display': 'block'});
        $('#acuerdo_id_periodo').val($acuerdo)
        let url = 'api/execsp';
        let sp = 'ALQUILER_DETALLE_LIS';
        let empresa = $empresa;
        let acuerdo = $acuerdo;
        data = {sp, empresa, acuerdo};
        
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

                $situacion = '';
                let $eliminar = `<i class="material-icons" style="color: #999999">delete</i>`
                if(element.ALQDET_C_SITUACION == '0')
                {
                    $eliminar = `<i class="material-icons" style="cursor: pointer;" onclick="modalEliminar('2', '${element.EMPRES_N_ID}-${element.ALQUIL_N_ID}-${element.ALQDET_N_ID}')">delete</i>`
                    $situacion = `<p style="color: #EE9A08;"><b>${element.ALQDET_C_SITUACION_DES}</b><i class="material-icons" style="cursor: pointer"></i></p>`;
                
                }else if(element.ALQDET_C_SITUACION == '1'){
                
                    $situacion = `<p style="color: #1EB635;"><b>${element.ALQDET_C_SITUACION_DES}</b><i class="material-icons" style="cursor: pointer"></i></p>`;
                }
                else{
                    $situacion = `<p style="color: #4690F5;"><b>${element.ALQDET_C_SITUACION_DES}</b><i class="material-icons" style="cursor: pointer"></i></p>`;
                }
                
                $('#periodos').append(`   
                                        <tr>
                                            <td class="center-align">${element.ALQDET_N_ID}</td>
                                            <td class="center-align">${element.ALQDET_C_FECHA_INICIO}</td>
                                            <td class="center-align">${element.ALQDET_C_FECHA_FINAL}</td>
                                            <td class="right-align">${element.ALQDET_N_AREA}</td>
                                            <td class="right-align">${element.ALQDET_N_PRECIO_UNIT}</td>
                                            <td class="right-align">${element.TOTAL}</td>
                                            <td class="center-align">${$situacion}</td>
                                            <td class="center-align">
                                                ${$eliminar} 
                                            </td>
                                        </tr>
                                    `);
            }
            $('#modalPeriodos').modal('open');
            $('.preloader-background').css({'display': 'none'});                            
        });
    }

    function agregarPeriodo()
    {
        console.log('Estoy buscando.. ')
        $('.modal').modal('close');
        $('.preloader-background').css({'display': 'block'});

        let url = 'api/execsp';
        let sp = 'ALQUILER_DETALLE_PROXIMO_LIS';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let acuerdo = $('#acuerdo_id_periodo').val();
        var data = {sp, empresa, acuerdo};
        
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
            console.log(data);
            $('#np_fecha_inicio').val(data[0].FECHA_INICIO)
            $('#np_fecha_fin').val(data[0].FECHA_FINAL)
            $('#nuevo_area').val(data[0].ALQDET_N_AREA)
            $('#nuevo_precio').val(data[0].ALQDET_N_PRECIO_UNIT)
            $('#np_total').val(data[0].ALQDET_N_AREA * data[0].ALQDET_N_PRECIO_UNIT)
            if(data[0].TIPALM_N_ID == 1)
            {
                console.log('techado')
                document.getElementById("nuevo_area").readOnly = true;
            }
            else if(data[0].TIPALM_N_ID == 2)
            {
                console.log('patio')
                document.getElementById("nuevo_area").readOnly = false;
            }
            $('#modalAgregarPeriodo').modal('open');
            $('.preloader-background').css({'display': 'none'});                            
        });
    }

    function guardarNuevoPeriodo()
    {
        console.log('Estoy buscando.. ')
        
        let url = 'api/acuerdos/periodo/guardar';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;
        let acuerdo = $('#acuerdo_id_periodo').val();
        let area = $('#nuevo_area').val();
        let precio =  $('#nuevo_precio').val();
        let usuario =  <?= $session->USUARI_N_ID ?>;

        let data = {empresa, acuerdo, area, precio, usuario};

        if(area != '' && precio != '')
        {
            $('.modal').modal('close');
            $('.preloader-background').css({'display': 'block'});
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
                M.toast({html: 'Periodo creado correctamente', classes: 'rounded'});    
                $('.preloader-background').css({'display': 'none'});                            
                verPeriodos(empresa, acuerdo);            
            });
        }else{
            M.toast({html: 'Debe llenar todos los campos', classes: 'rounded'});
            return false; 
        }
    }
	
	
</script>


