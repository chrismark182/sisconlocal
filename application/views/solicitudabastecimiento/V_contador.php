<style>
.modal { width: 75% !important ; height: 75% !important ; }
i.icon-white {
    color: #FFFFFF;
}
</style>

<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="#!" class="breadcrumb">Solicitudes</a>
      </div>
    </div>
</nav>


<br>

<!--
<a class="waves-effect waves-light btn btn-small">Obras</a>
<a class="waves-effect waves-light btn btn-small">Abastecimiento</a>
-->
<div class="section container">

 <ul class="collapsible" style="width:100%">
    <li class="active">
      <div class="collapsible-header"><i class="material-icons left">chevron_right</i>En Proceso</div>
      <div class="collapsible-body">
	  
	  <table class="highlight" id="tableenproceso">
        <thead>
            <tr>          
				<!--<th>#</th>-->
				<th>Fecha</th>
				<th>Solicitante</th>
                <th>Tipo Solicitud</th>
				<th>Descripcion</th>
                <th>Cotizacion</th>
                <th>Precio</th>
                <th>Completo</th>
                <th>Editar</th>
				<th></th>
            </tr>
        </thead>
        
        <tbody>
                <?php foreach($results2 as $row2): ?> 
                    <tr>
                        <!--<td><?=$row2->SOLABAS_NUMERO?></td>-->
						<td><?=$row2->SOLABAS_DATE?></td>
						<td><?=$row2->USUARI_C_USERNAME?></td>
						<td><?php if($row2->SOLABAS_TIPO==1){ echo "Obras"; } else { echo  "Abastecimiento"; }
						//$row2->SOLABAS_TIPOphp ?></td>
                        <td><?=$row2->DESCRIPCION?></td>
						<?php 
						
						if($row2->SOLABAS_OPC1==1){
							$ruta="./uploads/".$row2->FILE1;
						}
						elseif($row2->SOLABAS_OPC1==2){
							$ruta="./uploads/".$row2->FILE2;
						}
						elseif($row2->SOLABAS_OPC1==3){
							$ruta="./uploads/".$row2->FILE3;
						}
						
						
						if(empty($row2->SOLABAS_PORCEN)){
							$vporcen = 0;
						}
						else
						{ 
							$vporcen = $row2->SOLABAS_PORCEN;
						}
						
						?>
						
                        <td>
						<a id="afile" href="<?= $ruta ?>" target="_blank" class="btn btn-small"><i class="material-icons icon-white">file_download</i></a>	
						<!--<a id="afile" href="<?= $ruta ?>" target="_blank"><img src="<?= $ruta ?>" id="arfile" width="42" height="42" /></a>	-->
						
						</td>
                        <td id="tdprecio_<?=$row2->SOLABAS_N_ID?>">
						<?php
						if(!empty($row2->SOLABAS_PRECIO))
						{
						
						echo $row2->SOLABAS_PRECIO;
						}
						else
						{
						?>
						<input type="hidden"  class="idsoliabas" id="idsoliabas" name="idsoliabas" value="<?=$row2->SOLABAS_N_ID?>" />
						<!--<input class="precio" type="text" id="precio_<?=$row2->SOLABAS_N_ID?>" name="precio" autocomplete="off" style="width:100px;" />--> <input class="precio" type="number" step="any" id="precio_<?=$row2->SOLABAS_N_ID?>" name="precio" autocomplete="off" style="width:100px;" />
						<button type="button" class='btn-floating btn-small' style="right:0px!important;bottom:0px!important;" id="btnpreciog_<?=$row2->SOLABAS_N_ID?>" name="btnpreciog" attr_idsoli_ver="<?=$row2->SOLABAS_N_ID?>" ><i class='material-icons'>check</i></button>
						<?php
						}
						?></td>
                        <td id="vporcen_<?=$row2->SOLABAS_N_ID?>" > <?= $vporcen." %" ?></td>
                        <td>
						<?php
						if(!empty($row2->SOLABAS_PRECIO))
						{
						?>			
						<?php if(!($session->USUARI_C_USERNAME=='MDiaz' or $session->USUARI_C_USERNAME=='ACuglievan')): ?>
						<button class="btn btn-floating btn-small modal-trigger" style="right:0px!important;bottom:0px!important;" href="#modal2" name="btnedit" id="btnedit_<?=$row2->SOLABAS_N_ID?>" attr_solabas_id="<?=$row2->SOLABAS_N_ID?>" <?php if($row2->SOLABAS_PORCEN==100) {  echo "disabled"; } ?>    ><i class="material-icons" >edit</i></button>
						<?php  endif; ?>	
						
						<?php
						}
						else
						{
						?>
						<?php if(!($session->USUARI_C_USERNAME=='MDiaz' or $session->USUARI_C_USERNAME=='ACuglievan')): ?>
						<button class="btn btn-floating btn-small modal-trigger" style="right:0px!important;bottom:0px!important;" href="#modal2" name="btnedit" id="btnedit_<?=$row2->SOLABAS_N_ID?>" attr_solabas_id="<?=$row2->SOLABAS_N_ID?>" disabled  ><i class="material-icons" disabled >edit</i></button>
						<?php endif; ?>	
						<?php } ?>	

						</td>
						<td>
						<?php if($session->USUARI_C_USERNAME=='ACuglievan'): ?>
						<button class="waves-effect waves-light btn btn-small" onclick="AprobarSolicitud(<?=$row2->SOLABAS_N_ID?>);" <?php if($row2->SOLABAS_OPC2==1) {  echo "disabled"; } ?> >APROBADO</button>
						<?php endif; ?>	
						</td>
                    </tr>
                <?php endforeach; ?>  
        </tbody>
    </table>
	<input type="hidden"  class="psoliabas" id="psoliabas" name="psoliabas" value="" />
    </li>
 <?php //endif; ?>	
 
    <li>
      <div class="collapsible-header"><i class="material-icons left">chevron_right</i>Culminados</div>
      <div class="collapsible-body">   
	  <table class="highlight" id="tableculminado">
        <thead>
            <tr>          
				<!--<th>#</th>-->
				<th>Fecha</th>
                <th>Solicitante</th>
                <th>Tipo Solicitud</th>
				<th>Descripcion</th>
                <th>Precio</th>
				<th>Historico de Pago</th>
				<th>Reporte Final</th>
            </tr>
        </thead>
		
		 <tbody>
            <?php if($results3): ?>
                <?php foreach($results3 as $row3): ?> 
                    <tr >
                        <!--<td><?=$row3->SOLABAS_NUMERO?></td>-->
						<td><?=$row3->SOLABAS_DATE?></td>
						<td><?=$row3->USUARI_C_USERNAME?></td>
						<td><?php if($row3->SOLABAS_TIPO==1){ echo "Obras"; } else { echo  "Abastecimiento"; }
						//$row3->SOLABAS_TIPO?></td>
                        <td><?=$row3->DESCRIPCION?></td>
                        <td><?=$row3->SOLABAS_PRECIO?></td>
						<td><button class="btn btn-floating btn-small modal-trigger" style="right:0px!important;bottom:0px!important;" href="#modal3" name="btndetcul" id="btndetcul" attr_solabas_id="<?=$row3->SOLABAS_N_ID?>" attr_cul_num="<?=$row3->SOLABAS_NUMERO?>" attr_cul_desc="<?=$row3->DESCRIPCION?>" ><i class="material-icons">description</i></button></td>
						<td>
						<!--
						<button class="waves-effect waves-light btn btn-small" onclick="verSolicitados(this)" name="btnver" id="btnver" attr_soliabas_id="<?=$row->SOLABAS_N_ID?>" >Ver</button>
						-->
						<button class="btn btn-floating btn-small" style="right:0px!important;bottom:0px!important;" name="btnreporfinal" id="btnreporfinal" onclick="verReporteFinal(this)" attr_cul_id="<?=$row3->SOLABAS_N_ID?>" attr_cul_num="<?=$row3->SOLABAS_NUMERO?>" attr_cul_desc="<?=$row3->DESCRIPCION?>" attr_reportfinal_estado="<?=$row3->SOLABAS_REPORFINAL?>" ><i class="material-icons" >edit</i></button></td>
                    </tr>
                <?php endforeach; ?>  
            <?php endif; ?>
        </tbody>
		</table>
		</div>
    </li>
	
  </ul>

<!--Modal 2-->
<div id="modal2" class="modal">
    <div class="modal-content">
	
	<table class="highlight" id="tableaceptados">
        <thead>
            <tr>          
				<th>#</th>
				<th>Fecha</th>
                <th>Obra/Abastecimiento</th>               
			   <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            <tr>
			<td name="cnum"></td>
			<td name="cfecha"></td>
			<td name="cobab"></td>
			<td name="preci" id="preci"></td>                       
            </tr>
        </tbody>
    </table>
	<br>
	<br>
<h4>Historial</h4>
<input type="hidden" id="id_solabas" name="id_solabas" />

<div class="section container center">
<button class="btn btn-primary" type="button" id="btnaddprecio" ><i class="material-icons" >add</i></button>		
	
		<form action="<?= base_url() ?>solicitudabastecimiento/autorizar"  method="post" enctype="multipart/form-data" >
		<div class="form-group">
            <div class="col-md-12">
            
            <br>
            <br>
            <table id="tabledetprecio" class="table table-striped table-bordered nowrap" > <!--style="width:100%"-->
			<thead>
            <tr>
            <th style='width: 80px;'>Descripcion</th>
            <th>Pago</th>
			<th>Adjunto</th>
			<th>Opcion</th>
            </tr>
            </thead>
			</table>
		<input type="hidden" id="name_file" name="name_file" value="">
						
           </div>
         </div>
		<div>
		</div>
</div>
</form>		
		
</div>

</div>
 
 <!--Fin Modal 2-->
 
 <!--Modal 3-->
<div id="modal3" class="modal">
	<div class="modal-content">
		<h4 id="titulohistorico" style="text-align: center">Historico </h4>
	

 	<table class="highlight" id="tablehistorico">
        <thead>
            <tr>          
				<th>Fecha</th>
				<th>Descripcion</th>
                <th>Pago</th>
				<th>Adjunto</th> 
            </tr>
        </thead>
		<!--
        <tbody>
            <tr>
			<td name="">#</td>
			<td name="">#</td>
			<td name="">#</td>                    
            </tr>
			<tr>
			<td name="">#</td>
			<td name="">#</td>
			<td name="">#</td>                    
            </tr>
			<tr>
			<td name="">#</td>
			<td name="">#</td>
			<td name="">#</td>                    
            </tr>
        </tbody>
		-->
    </table>
	 
	</div> 
</div>
 <!--Fin Modal 3-->
 
 
 
  <!--Modal 4-->
<div id="modal4" class="modal">
	<div class="modal-content">
			<h4 id="tituloreportefinal" style="text-align: center">Reporte Final </h4>
	
		<button class="btn btn-primary <?php if($session->USUARI_C_USERNAME=='MDiaz' or $session->USUARI_C_USERNAME=='ACuglievan') { echo 'disabled';  } ?>" type="button" id="btnaddreporte"><i class="material-icons" >add</i></button>	
			
	 	<table class="highlight" id="tablereporfinal">
		<thead>
            <tr>          
				<th>Descripcion</th>
				<th>Adjunto</th>
				<th>Opcion</th>				
            </tr>
        </thead>
		 </table>
		 
		 <br>
		 <br>
		 <br>
		 
		 <div>
		 
		 <input type="hidden" name="idreporsoliabas" id="idreporsoliabas" value="" />
		 <button class="btn btn-primary <?php if($session->USUARI_C_USERNAME=='MDiaz' or $session->USUARI_C_USERNAME=='ACuglievan') { echo 'disabled';  } ?>" type="button" id="btnfinalizado" name="btnfinalizado" >Finalizar</button>
		 
		<!--
		<label>
        <input type="checkbox" id="chkfinalizado" name="chkfinalizado" value="1" />
        <span>Finalizado</span>
		</label>
		-->
		  
		  </div>
		<!--
		<tbody>
            <tr>
			<td><input size="16" type="text" id="descripreport" name="descripreport" value="" ></td>
			<td>
			<div class ="file-field input-field"><div class = "btn btn-small" style="background-color: #CDCDCD"><i class="material-icons">attach_file</i><input type = "file" name="file" id="file"/></div><div class = "file-path-wrapper"><input class = "file-path validate" type ="text" placeholder = "Upload file" /></div></div></td>
			<td><button type="button" class="btn-floating" style="right:0px!important;bottom:0px!important;" id="" onclick="" name="" data-id=""><i class='material-icons small'>check</i></button></td>
            </tr>
		</tbody>	
		-->	
		
		<!--
		<tr>
			<td name="">#</td>
			<td name="">#</td>
			<td name="">#</td>                    
            </tr>
			<tr>
			<td name="">#</td>
			<td name="">#</td>
			<td name="">#</td>                    
            </tr>
        </tbody>
		-->
   
	 
	</div> 
</div>
 <!--Fin Modal 4-->
 
 
 
 

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:fixed;" 
    href="<?= base_url()?>solicitudabastecimiento/nuevo"><i class="material-icons">add</i></a>
