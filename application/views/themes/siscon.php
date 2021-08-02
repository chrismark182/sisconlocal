<!DOCTYPE>
<html>
<head>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/siscon.css?<?= time() ?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SISCON</title>
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
	<script src="<?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
	<script src="<?= base_url() ?>assets/js/materialize.js"></script>
	<script>var base_url = '<?php echo base_url() ?>';</script>
	<script src="<?= base_url() ?>assets/js/main.js?v=<?= time() ?>"></script>


	<!--AGREGADO-->
	<!--<script src="<?= base_url() ?>assets/js/funciones.js"></script>-->
	<script src="<?= base_url() ?>assets/js/moment.js"></script>
	<!---->
	
	
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			$('select').formSelect();
			$('.sidenav').sidenav();
			$('.modal').modal();
			var options = {
				format: 'dd/mm/yyyy',
				autoClose: true, 
				setDefaultDate: true
			}
			var elems = document.querySelectorAll('.datepicker');
			var instances = M.Datepicker.init(elems, options);
			$('.dropdown-trigger').dropdown();
			$('.tooltipped').tooltip();
			
			var message = '<?= $this->session->flashdata('message'); ?>';
			if(message != '')
			{
				M.toast({html: message, classes: 'rounded'});
			}
			status()
		
		//console.log("pruebas " + document.getElementsByClassName("select-dropdown").length)
		
		
		
		
		
		});
		async function status()
		{
			/*
			var url = '<?= base_url() ?>sistema/log';
			var urlRevisar = '<?= base_url() ?>sistema/revisar';
			var data = {};
			await fetch(url, {
                method: 'POST', // or 'PUT'
                body: JSON.stringify(data), // data can be `string` or {object}!
                headers:{
                    'Content-Type': 'application/json'
                    }
                })
            .then(function(response) {
            	return response.text();
            })
            .then(function(data) 
            {
                console.log(data)
				document.getElementById('version').innerHTML = data;
				document.getElementById('system').innerHTML = 'Buscando actualización...';
            });

			await fetch(urlRevisar, {
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
				document.getElementById('system').innerHTML = data.message;
				if(data.action == 1)
				{
					sync();
				}
            });
			*/
		}
		async function sync()
		{
			document.getElementById('system').innerHTML = 'Actualizando sistema...';
			var url = '<?= base_url() ?>sistema/sync';
			var data = {};
			await fetch(url, {
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
				document.getElementById('system').innerHTML = data.message;	
				status();
            });
		}
	</script>
	<style>
		.preloader-background
        {
            display: none;
            background-color: rgba(255,255,255,0.5);
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 9;
        }
        .preloader-wrapper.active
        {
            position: absolute;
            left: 0;
            right: 0;
            margin: auto;
			top: 0;
			bottom: 0;
        }
		td i
		{
			color: #039be5;
		}
		
		
		ul#nav-mobile:first-child input.select-dropdown
		{
			width: 210px !important;
			font-size: 14px !important;
			color:white;
		}
		
		/*
		input.select-dropdown
		{
		width: 210px !important;
		font-size: 14px !important;
		color:white;
		}
		*/
		
	</style>
</head>
<body>
           
	 <!-- Preloader  -->
	 <div class="preloader-background">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
	<!--<nav class="blue-grey darken-1" style="padding: 0 1em;">-->
	<nav class="blue-grey darken-1" style="padding: 0 1em;">
    	<!--<div class="nav-wrapper">-->
    	<div class="nav-wrapper row">
		<?php if($this->session->userdata('logged_in')): ?>
		<?php endif; ?>
				
			<!--<a href="<?= base_url() ?>" class="brand-logo">SISCON </a>-->

			<!--Agregado-->
			
			<!-- Dropdown Structure -->
			<ul id="dropUsuario" class="dropdown-content">
				<li><a href="<?= base_url() ?>usuario/cambio_pass">Cambiar Contraseña</a></li>
				<li><a href="<?= base_url() ?>logout">Cerrar Sesión</a></li>
			</ul>
		
			


			<?php if(!empty($accesos['padres'])):  ?>
				<?php foreach ($accesos['padres'] as $menu_padre): ?>
					<ul id="<?= $menu_padre->MENU_ID; ?>" class="dropdown-content">
						<?php foreach($accesos['hijos'] as $hijo):?>
							<?php if($hijo->MENU_PADRE_ID == $menu_padre->MENU_ID): ?>
								<li>
									<a href="<?= base_url() ?><?= $hijo->MENU_RUTA; ?>">
										<?= $hijo->MENU_DESCRIPCION; ?>
									</a>
								</li> 
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php endforeach; ?>
			<?php endif; ?>


			<ul id="nav-mobile" class="right hide-on-med-and-down">
			<?php if($this->session->userdata('logged_in')):
	
			$vcategoria=$this->session->userdata('categoria');
	
			//if($categoria->CATEGO_N_ID;)$session->USUARI_N_ID
			//f($vcategoria==1 or $vcategoria==3 ){
			if($vcategoria==1 or $vcategoria==7 or $vcategoria==15 or $vcategoria==16  ){
			?>
			<li>
			<select id="selectsector" name="selectsector" class="selectsector" >
			<?php
			$empresa=$this->session->userdata('empresa_id');
			
			foreach ($listadosector as $listado): 
			
			if($listado->EMPRES_N_ID == $empresa){
				$selected="selected";
			}else
			{
				$selected="";
			}
			
			?>
			<option value="<?= $listado->EMPRES_N_ID ?>"  <?= $selected ?> ><?= $listado->EMPRES_C_RAZON_SOCIAL ?></option>
			<?php endforeach; ?>
			 </select>
			<!--<label>Sector</label>-->
			</li>	
			<?php } ?>
			<?php if(!empty($accesos['padres'])): ?>
						<?php foreach($accesos['padres'] as $acceso): ?>
							<?php if($acceso->MENU_RUTA == '#'): ?>
								<li><a class="dropdown-trigger" href="#!" data-target="<?= $acceso->MENU_ID ?>"><?= $acceso->MENU_DESCRIPCION ?><i class="material-icons right">arrow_drop_down</i></a></li>
							<?php else: ?>
								<li>
									<a href="<?= base_url() . $acceso->MENU_RUTA ?>"><?= $acceso->MENU_DESCRIPCION ?></a>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<li><a href="#" class="dropdown-trigger" data-target="dropUsuario"><?= $session->USUARI_C_USERNAME ?>
						<i class="material-icons right">arrow_drop_down</i></a></li>
				<?php else: ?>
				
				<?php endif;?>
				
			</ul>
    	</div>
  	</nav>

	<div class="container">
		<?php if ($this->session->flashdata('error')): ?>
			<div class="card-panel red lighten-2 white-text"><?= $this->session->flashdata('error'); ?></div>
		<?php endif ?>
	</div>
	<?php echo $output;?>
	<div class="blue-grey darken-1 status-bar">
		<div id="system">Sistema actualizado</div>
		<div id="version">v1</div>
	</div>
	
</body>
</html>
