<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Persona Visitante</a>
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
        <form action="<?= base_url() ?>contacto" method="post">
            <div class="input-field col s12 m6 l9">
                <input id="razon_social" maxlength="200" type="text" name="razon_social"  class="validate">
                <label class="active" for="razon_social">Empresa</label> 
            </div>
            <div class="input-field col s12 m6 l3">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Número de Documento</label> 
            </div>

            <div class="input-field col s12 m6 l4">
                <input id="nombres" maxlength="100" type="text" name="nombres" class="validate">
                <label class="active" for="nombres">Nombres</label> 
            </div>
            <div class="input-field col s12 m6 l5">
                <input id="apellidos" maxlength="100" type="text" name="apellidos" class="validate">
                <label class="active" for="apellidos">Apellidos</label> 
            </div>
            <div class="input-field col s3">
                <div class="btn-small" id="btnBuscar">Buscar</div>
            </div>
        </form>
    </div>    
</div> 

<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="left-align">EMPRESA</th>
                <th class="left-align">TIPO DOC.</th>
                <th class="left-align">DOCUMENTO</th>
                <th class="left-align">NOMBRES</th>
                <th class="left-align">APELLIDOS</th>
                <th class="center-align">VENCE SCTR</th>
                <th class="center-align">BLOQUEO</th>
                <th class="center-align">FOTO</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody id="resultados">            
        </tbody>
    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:absolute;" 
    href="<?= base_url()?>personas/nuevo"><i class="material-icons">add</i></a>

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

<div id="modalFoto" class="modal">
    <div class="modal-content">
        <img src="" id="foto" style="width:100%">
    </div>
	<!--
    <div class="modal-footer">
    </div>
	-->
</div>

<div id="modalBloqueos" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="left">Bloquear persona</h4>
        <div class="section row">
            <input type="hidden" id="persona_id" >
            <div class="input-field col s12">
                <textarea id="motivo" class="materialize-textarea"></textarea>
                <label for="motivo">Motivo de Bloqueo</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" waves-effect waves-green btn-flat" onclick="bloquear()">Aceptar</a>
    </div>
</div>

<div id="modalInfoDesbloqueado" class="modal modal-fixed-footer">
    <div class="modal-content" >
		<h4>Datos del bloqueo</h4>
		<div class="divider"></div>
		<p>Motivo bloqueo: <span id="des_bloqueo_motivo"></span></p>
		<p>Usuario bloqueo: <span id="des_bloqueo_usuario"></span></p>
		<p>Fecha bloqueo: <span id="des_bloqueo_fecha"></span></p>
		<br>
		<h4>Datos del desbloqueo</h4>
		<div class="divider"></div>
		<p>Motivo desbloqueo: <span id="desbloqueo_motivo"></span></p>
		<p>Usuario desbloqueo: <span id="desbloqueo_usuario"></span></p>
		<p>Fecha desbloqueo: <span id="desbloqueo_fecha"></span></p>
    </div>
	<div class="modal-footer">
      	<a href="#!" class="modal-close waves-effect waves-green btn-flat">Aceptar</a>
    </div>
</div> 


<div id="modalDesBloqueos" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4 class="left">Desbloquear persona</h4>
        <div class="section row">
            <input type="hidden" id="persona_id" >
			<input type="hidden" id="bloqueo_item" >
            <div class="input-field col s12">
                <textarea id="motivodes" class="materialize-textarea"></textarea>
                <label for="motivo">Motivo del desbloqueo</label>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <a href="#!" class=" waves-effect waves-green btn-flat" onclick="desbloquear()">Aceptar</a>
    </div>
</div>


<div id="modalInfoBloqueos" class="modal modal-fixed-footer">
    <div class="modal-content" >
		<h4>Datos del bloqueo</h4>
		<div class="divider"></div>
		<p>Motivo bloqueo: <span id="bloqueo_motivo"></span></p>
		<p>Usuario bloqueo: <span id="bloqueo_usuario"></span></p>
		<p>Fecha bloqueo: <span id="bloqueo_fecha"></span></p>
		<div class="btn" onclick="modalDesbloquear()">DESBLOQUEAR</div>
    </div>
	<div class="modal-footer">
      	<a href="#!" class="modal-close waves-effect waves-green btn-flat">Aceptar</a>
    </div>
</div> 

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnBuscar = document.getElementById("btnBuscar"); 
        btnBuscar.addEventListener("click", buscar, false);
        
        ndocumento = getParameterByName('n')
        if(ndocumento != '')
        {
            $('#ndocumento').val(ndocumento)
            M.updateTextFields(); //este metodo sale de materialize
            buscar()
        }
    });

    function buscar()
    {
        console.log('Estoy buscando..  ')
        M.toast({html: 'Buscando resultado...', classes: 'rounded'});
        $('.preloader-background').css({'display': 'block'});
		let url = '<?= base_url() ?>api/execsp';

		let sp = 'PERSONA_LIS';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;

        let cliente = '%'; 
        if($('#razon_social').val() != ''){cliente = $('#razon_social').val() + '%';}

        let ndocumento = '%'; 
        if($('#ndocumento').val() != '')
        {
            ndocumento = $('#ndocumento').val() + '%';
        }

        let nombres = '%'; 
        if($('#nombres').val() != '')
        {
            nombres = $('#nombres').val() + '%';
        }

        let apellidos = '%'; 
        if($('#apellidos').val() != '')
        {
            apellidos = $('#apellidos').val() + '%';
        }

        var data = {sp, empresa, cliente, ndocumento, nombres, apellidos};
        
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
                M.toast({html: 'Cargando Personas Visitante', classes: 'rounded'});
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];

                    if(element.PERSON_C_FOTO == "")
                    {
                        $foto = `<i class="material-icons tooltipped" style="color: #999999" data-position="bottom" data-tooltip="No tienen foto">photo_camera</i>`
                    }else
                    {
                        $foto = `<i class="material-icons tooltipped" data-position="bottom" data-tooltip="Tienen foto" onclick="Ver(this)" attr_name="${element.PERSON_C_FOTO}" >photo_camera</i>`
                    }

                    if(element.PERSON_N_BLOQUEOS > 0)
                    {
                        //$bloqueo = `<i class="material-icons tooltipped" style="color: #999999;cursor: pointer" data-position="bottom" data-tooltip="Bloqueado">lock</i>`
                        $bloqueo = `<i class="material-icons tooltipped" style="cursor: pointer;" data-position="bottom" data-tooltip="Bloqueado" onclick="muestraInfoBloqueo(${element.PERSON_N_ID},${element.PERBLO_N_ITEM})">lock</i>`
                    }else
                    {
                       //$bloqueo = `<i class="material-icons">block</i>`
                        $bloqueo = `<i class="material-icons" style="cursor: pointer;" onclick="modalBloquear(${element.PERSON_N_ID})">lock_open</i>`
                    }

                    $('#resultados').append(`   <tr>
													<td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
													<td class="left-align">${element.TIPDOC_C_ABREVIATURA}</td>
                                                    <td class="left-align">${element.PERSON_C_DOCUMENTO}</td>
                                                    <td class="left-align">${element.PERSON_C_NOMBRE}</td>
                                                    <td class="left-align">${element.PERSON_C_APELLIDOS}</td>
                                                    <td class="center-align">${element.PERSON_C_FECHA_SCTR_FIN}</td>
                                                    <td class="center-align">
                                                        ${$bloqueo}
                                                    </td>
                                                    <td class="center-align">
                                                        ${$foto}
                                                    </td>
                                                    <td class="center-align">
                                                        <a  href="<?= base_url() ?>personas/${data[index].EMPRES_N_ID}/${data[index].PERSON_N_ID}/editar">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                    </td>
                                                    <td class="center-align">
                                                        <i class="material-icons " style="cursor: pointer" onclick="confirmarEliminar(${data[index].PERSON_N_ID})">delete</i>                        
                                                    </td>
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

    function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

    function confirmarEliminar($persona)
    {
        console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'personas/'+$persona+'/eliminar')
    }
	
	async function Ver(e)
	{
	 //console.log("ingreso ver");
	 let foto = $(e).attr('attr_name');
	 //console.log(foto);
	 foto = '<?= base_url()?>uploads/'+foto;
	 document.getElementById('foto').src = foto;
	 
	 await $('#modalFoto').modal('open');	
	}

	 function modalBloquear($id)
    {
        document.getElementById('persona_id').value = $id;
        $('#modalBloqueos').modal('open');
    }
	
	function bloquear()
    {

		let url = '<?= base_url() ?>api/execsp';
		let sp = 'PERSONA_BLOQUEO_INS';				
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let motivo = document.getElementById('motivo').value;
		let persona = parseInt(document.getElementById('persona_id').value);
		let usuario = <?= $session->USUARI_N_ID ?>;
		data = {sp, empresa, persona, motivo, usuario};

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
			M.toast({html: 'Persona bloqueada correctamente!', classes: 'rounded'});
            $('.preloader-background').css({'display': 'none'});                            
			//setTimeout(() => {window.location.href= "<?= base_url() ?>persona?n=" + data[0].PERSON_C_DOCUMENTO; }, 1000);
			setTimeout(() => {window.location.href= "<?= base_url() ?>personas"; }, 1000);
		}).catch(error => console.log(error));
    }
	
	
	function muestraInfoBloqueo(id, item)
	{	 	
		document.getElementById('persona_id').value = id;
		document.getElementById('bloqueo_item').value = item;

		let url = '<?= base_url() ?>api/execsp';
		let sp = 'PERSONA_BLOQUEO_ITEM_LIS';				
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		data = {sp, empresa, id, item};

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
			let element = data[0];
			document.getElementById('bloqueo_motivo').innerHTML = element.PERBLO_C_MOTIVO_BLOQUEO;
			document.getElementById('bloqueo_usuario').innerHTML = element.USUARI_C_USERNAME;
			document.getElementById('bloqueo_fecha').innerHTML = element.PERBLO_D_FECHA_REG;
			$('#modalInfoBloqueos').modal('open');
			$('.preloader-background').css({'display': 'none'});                            
		});
	}
	
	
	
	function muestraInfoDesbloqueo(id, item)
	{		
		document.getElementById('persona_id').value = id;
		document.getElementById('bloqueo_item').value = item;

		let url = '<?= base_url() ?>api/execsp';
		let sp = 'PERSONA_BLOQUEO_ITEM_LIS';				
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		data = {sp, empresa, id, item};

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
			let element = data[0];
			document.getElementById('des_bloqueo_motivo').innerHTML = element.PERBLO_C_MOTIVO_BLOQUEO;
			document.getElementById('des_bloqueo_usuario').innerHTML = element.USUARI_C_USERNAME;
			document.getElementById('des_bloqueo_fecha').innerHTML = element.PERBLO_D_FECHA_REG;

			document.getElementById('desbloqueo_motivo').innerHTML = element.PERBLO_C_MOTIVO_DESBLOQUEO;
			document.getElementById('desbloqueo_usuario').innerHTML = element.USUARIO_DESBLOQUEA;
			document.getElementById('desbloqueo_fecha').innerHTML = element.PERBLO_D_FECHA_UPD;

			$('#modalInfoDesbloqueado').modal('open');
			$('.preloader-background').css({'display': 'none'});                            
		});
	}
	
	function modalDesbloquear()
    {
		$('.modal').modal('close');
        $('#modalDesBloqueos').modal('open');
    }
	
	function desbloquear()
    {
		let url = '<?= base_url() ?>api/execsp';
		let sp = 'PERSONA_BLOQUEO_UPD';				
		let empresa = <?= $empresa->EMPRES_N_ID ?>;
		let persona = parseInt(document.getElementById('persona_id').value);
		let item = parseInt(document.getElementById('bloqueo_item').value);
		let motivo = document.getElementById('motivodes').value;
		let usuario = <?= $session->USUARI_N_ID ?>;
		data = {sp, empresa, persona, item, motivo, usuario};

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
			M.toast({html: 'Persona desbloqueada correctamente!', classes: 'rounded'});
            $('.preloader-background').css({'display': 'none'});                            
			setTimeout(() => {
			    window.location.href= "<?= base_url() ?>personas?n=" + data[0].PERSON_C_DOCUMENTO;                
            }, 1000);
		}).catch(error => console.log(error));
    }
	
	
	
</script>
