<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
			<a href="<?= base_url() ?>solicitudabastecimiento" class="breadcrumb">Solicitudes</a>
			<a href="#!" class="breadcrumb">Nuevo</a>
        </div>
		<!--
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2"><?php echo count($tarifas);?></span>
                    </b>
                </div>
            </div>
        </ul>
		-->
    </div>
</nav>

<?php 
				 $dfecha=date("Y-m");
					
					
				if($results): 
				foreach($results as $row):
				
				$vdato=$row->SOLABAS_NUMERO;

					$vdato1=substr($vdato, 0, -4);
					$vnum=substr($vdato, 8);
										
							if($dfecha==$vdato1){
								$vnum=intval($vnum);
								$vnum=$vnum+1;
								
								$pr_id = sprintf("%03d", $vnum);								
								 $vnumero = $vdato1."-".$pr_id;
							}
							else
							{
								$vnumero = $dfecha."-001";
							}		
											
							
                  endforeach;
				  
				  else:
					  $vnumero = $dfecha."-001";
				  
                  endif;
				
				

?>



<div class="section container center">
    <form action="<?= base_url() ?>solicitudabastecimiento/crear" method="post"  enctype="multipart/form-data">
        <div class="row">
		
		<input type="hidden" id="num" name="num" value="<?php echo $vnumero; ?>" />
				
            <div class="input-field col s12 m6 l4">
				<!--
				<input id="fecha" type="text" name="fecha" class="validate">
				-->
				<div class="input-group date form_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
				<input class="validate" size="16" type="text" id="fecha" name="fecha"  readonly>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>				
				<label class="active" for="fecha" >Fecha:</label>
            </div>
			
            <div class="input-field col s12 m6 l4">
				<div class="input-group date form_date col-md-12" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
				<input size="16" type="text" id="numero" name="numero" value="" readonly>
				<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
				</div>				
				<label class="active" for="numero" >Numero:</label>				
            </div>
					
        </div>		
		
		 <!---<p class="h4 mb-4 text-center  border-dark">SOLICITUD DE ABASTECIMIENTO</p>-->
		 
		 
		<div class="form-group">
			<p class="text-center bgcolor">EMPRESA</p>
		</div>
			
		<div class="row">
		
		<div class="input-field col s12 m6 l3">
			<label>
			<input class="with-gap" name="empresa" type="radio" id="empresa1" value="1" />
			<span>Bigote</span>
			</label>
		</div>
		
        <div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="empresa" type="radio" id="empresa2" value="2" />
				<span>Lopud</span>
			</label>
		</div>
		
		
		<!--
		<div class="input-field col s12 m6 l3">
			<label>
			<input class="with-gap" name="empresa" type="radio" id="empresa3" value="3" />
			<span>AQP</span>
			</label>
		</div>
		
        <div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="empresa" type="radio" id="empresa4" value="4" />
				<span>Choice</span>
			</label>
		</div>
		-->
		
		
		<input type="hidden" name="empresaid" id="empresaid" />
		</div>
		
		<br>
		
	<div id="divsedes" name="" class="" >
	
	
		<div class="form-group">
			<p class="text-center bgcolor">SEDES</p>
		</div>
		
		
		
	<div class="row">
		
	<?php foreach ($sedes as $row): ?>
		<div class="input-field col s12 m6 l3">
			<label>
			<input class="with-gap" name="sede" type="radio" id="sede<?= $row->SEDE_N_ID ?>" value="<?= $row->SEDE_N_ID ?>" />
			<span><?= $row->SEDE_C_DESCRIPCION ?></span>
			</label>
		</div>
	<?php endforeach; ?>

	<!--
        <div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="sede2" type="radio" id="sede2" value="2" />
				<span>data2</span>
			</label>
		</div>
		
		

		<div class="input-field col s12 m6 l3">
			<label>
			<input class="with-gap" name="sede3" type="radio" id="sede3" value="3" />
			<span>data3</span>
			</label>
		</div>
	-->

		<input type="hidden" name="sedeid" id="sedeid" />
    </div>
	
	</div>
	
		<br>
		
		
		<div class="form-group">
			<p class="text-center bgcolor">TIPO </p>
		</div>
		
		
		<div class="row">
		
		 <div class="input-field col s12 m6 l3">
			<label>
			<input class="with-gap" name="tipo" type="radio" id="tipo1" value="1" />
			<span>Obras</span>
			</label>
		</div>
		
        <div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="tipo" type="radio" id="tipo2" value="2" />
				<span>Abastecimiento</span>
			</label>
		</div>
		<input type="hidden" name="tipoid" id="tipoid" />
		</div>
	
		<br>	
	
		
		<div id="divdepartamento" name="" class="" >
		
		
		<div class="form-group">
			<p class="text-center bgcolor">DEPARTAMENTO</p>
		</div>
		
		
		<div class="row">
		<div class="input-field col s12 m6 l3">
		
		<label>
				<input class="with-gap" name="departamento" type="radio" id="gg" />
				<span>G.G.</span>
		</label>

	<!--
			<input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">G.G.</label>
			-->
		</div>
		
        <div class="input-field col s12 m6 l3">
			<!--
			<input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">Administracion</label>
			-->
			<label>
				<input class="with-gap" name="departamento" type="radio" id="administracion" />
				<span>Administracion</span>
		    </label>
        </div>
	
		
		
		<div class="input-field col s12 m6 l3">
		<!--
			<input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">Sistemas</label>
			-->
			
			<label>
				<input class="with-gap" name="departamento" type="radio" id="sistemas" />
				<span>Sistemas</span>
		    </label>
        </div>
		
		<div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="departamento" type="radio" id="monitoreo" />
				<span>Monitoreo</span>
		    </label>
		
		<!--
			<input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">Monitoreo</label>
        -->
		</div>
		
		<div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="departamento" type="radio" id="operarios" />
				<span>Operarios</span>
		    </label>
		<!--
			 <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">Operarios</label>
        -->
		</div>
		
		<div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="departamento" type="radio" id="galmacen" />
				<span>G. Almacen</span>
		    </label>
			<!--
			<input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">G. Almacen</label>
			-->
		</div>
		
		<div class="input-field col s12 m6 l3">
			<label>
				<input class="with-gap" name="departamento" type="radio" id="operaciones" />
				<span>Operaciones</span>
		    </label>
		<!--
			<input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">Operaciones</label>
        -->
		</div>
		
		<div class="input-field col s12 m6 l3">
			<!--
			<input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">Seguridad</label>
			-->
			<label>
				<input class="with-gap" name="departamento" type="radio" id="seguridad" />
				<span>Seguridad</span>
		    </label>
		</div>
		
		<div class="input-field col s12 m6 l3">
			<!--
		    <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">RRHH</label>
			-->
			<label>
				<input class="with-gap" name="departamento" type="radio" id="rrhh" />
				<span>RRHH</span>
		    </label>
        </div>
		
		<div class="input-field col s12 m6 l3">
			<!--
		    <input class="form-check-input" type="checkbox" id="gridCheck">
            <label class="form-check-label" for="gridCheck">RRHH</label>
			-->
			<label>
				<input class="with-gap" name="departamento" type="radio" id="legal" />
				<span>Legal</span>
		    </label>
        </div>
		
		<div class="input-field col s12 m6 l3">
		 <label>
				<input class="with-gap" name="departamento" type="radio" id="otros" />
				<span>Otros</span>
				<input type="text" class="" id="otrosin" name="otrosin">
				<!--<input type ="file" name="userfile2" />-->
		 </label>
        </div>
		</div>	
		
		
	
		<input type="hidden" name="datogg" id="datogg" value="" />
		<input type="hidden" name="datoadmi" id="datoadmi" value="" />
		<input type="hidden" name="datosis" id="datosis" value="" />
		<input type="hidden" name="datomon" id="datomon" value="" />
		<input type="hidden" name="datooper" id="datooper" value="" />
		<input type="hidden" name="datogal" id="datogal" value="" />
		<input type="hidden" name="datoopera" id="datoopera" value="" />
		<input type="hidden" name="datosegu" id="datosegu" value=""/>
		<input type="hidden" name="datorrhh" id="datorrhh" value=""/>
		<input type="hidden" name="datolegal" id="datolegal" value=""/>
		<input type="hidden" name="datootr" id="datootr" value="" />
		
		</div>
		
		
		<br>
		<br>
		<br>		
		
		<div class="form-group"> 
			<p class="text-center bgcolor">DETALLE</p>
		</div>
		
		<div class="form-group">
            <div class="col-md-12">

<!--     
<button class="btn btn-primary" type="button" id="btnnuevo" > <span class="glyphicon glyphicon-plus"></span> Agregar</button>
-->       
		   <br>
            <br>
            <table id="tabledetalle" class="table table-striped table-bordered nowrap" > <!--style="width:100%"-->
            <thead>
			<tr>
            <!--<th style="width: 40px;">Cantidad</th>-->
			<!--
            <th>Un.</th>
            <th>Stock Almacen </th>
            <th>Area/Responsable</th>
            <th>VºBº</th>
			-->
            <th style="width: 700px;">Descripcion</th>
            <!--<th>Proveedor sugerido</th>-->
            <!--<th>Precio</th>-->
            <th style="width: 500px;">Cotizaciones</th>
			<!--<th></th>-->
            </tr>
            </thead>
			
			<tbody>
			<tr>
			<td><input type='text' class='col6' id='descrip_1' name='descrip_1'></td>
			<td><div class='file-field input-field'><div class='btn btn-small' style='background-color: #CDCDCD'><i class='material-icons'>attach_file</i><input type='file' name='userfile1_1' /></div><div class= 'file-path-wrapper'><input class='file-path validate' type='text' placeholder='Upload file' /></div></div><div class= 'file-field input-field'><div class='btn btn-small' style='background-color: #CDCDCD'><i class='material-icons'>attach_file</i><input type='file' name='userfile2_1' /></div><div class='file-path-wrapper'><input class='file-path validate' type='text' placeholder='Upload file'/></div></div><div class='file-field input-field'><div class='btn btn-small' style='background-color: #CDCDCD'><i class='material-icons'>attach_file</i><input type='file' name='userfile3_1' /></div><div class= 'file-path-wrapper'><input class='file-path validate' type='text' placeholder='Upload file' /></div></div></td>
			<td style='width:150px;' ><button type='button' onclick='productDelete(this);' class='btn-floating red' id='btndelete_1' data-id='1'><i class='material-icons'>close</i></button></td>
			</tr>
			</tbody>
			
			
            </table>
			
           </div>
         </div>
		 <!--
         <div class="input-field col s6 m6 l3">
         </div>
         <div class="input-field col s3">
         </div>
		-->
		
		<br>
		<br>
		<br>
		<!--
		<div>
			<div id="total">Total: ___ </div>
		</div>
		-->
		<!--
		 <div class="input-field col s6 center-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total:
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2"></span>
                    </b>
                </div>
            </div>
			-->
		
	
		<br>
		<br>
		<br>
		<div>
		<input type="hidden" id="vararray" name="vararray" />
		
		<button id="btnprocesar" class="btn" type="submit">Procesar</button>
		</div>
			<!--
            <div class="input-field col l12">
                <input class="btn-small" type="submit" value="Buscar">
            </div>
			-->
	
    </form>
</div>

