<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="<?= base_url() ?>personas" class="breadcrumb">Persona Visitante</a>
            <a href="#!" class="breadcrumb">Editar</a>
        </div>
    </div>
</nav>

<div class="section container center">
    <form action="<?= base_url() ?>personas/<?= $personas->EMPRES_N_ID ?>/<?= $personas->PERSON_N_ID ?>/actualizar" id="form" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <select id="cliente" name="cliente" disabled>
                    <option value="" disabled>Empresa</option>
                        
                    <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): 
                            $selected='';
                            if($cliente->CLIENT_N_ID == $personas->CLIENT_N_ID): 
                                $selected='selected';
                            endif;    
                            ?> 
                            <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Empresas</label>
            </div>
            <div class="input-field col s12 m6 l4">
                <select id="tdocumento" name="tdocumento" disabled>
                    <option value="" disabled>Tipo de Documento </option>
                    
                    <?php if($tdocumentos): ?>
                        <?php foreach($tdocumentos as $tdocumento): 
                            $selected='';
                            if($tdocumento->TIPDOC_N_ID == $personas->TIPDOC_N_ID): 
                                $selected='selected';
                            endif;
                            ?> 

                            <option value="<?= $tdocumento->TIPDOC_N_ID ?>" <?= $selected ?>><?= $tdocumento->TIPDOC_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Tipo de Documento</label>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="ndocumento" maxlength="15" type="text" readonly="true" name="ndocumento" value ="<?= $personas->PERSON_C_DOCUMENTO ?>" class="validate">
                <label class="active" for="ndocumento">Número de Documento</label> 
            </div>

            <div class="input-field col s12 m6 l4">
                <input id="nombres" maxlength="100" type="text" name="nombres" value ="<?= $personas->PERSON_C_NOMBRE ?>" class="validate">
                <label class="active" for="nombres">Nombres</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="apellidos" maxlength="100" type="text" name="apellidos" value ="<?= $personas->PERSON_C_APELLIDOS ?>" class="validate">
                <label class="active" for="apellidos">Apellidos</label> 
            </div>
            <input type="hidden" id="name_file" name="foto">
            <div class="file-field input-field col s12 m6 l4">
                <div class="btn">
                    <span>Foto</span>
                    <input id="archivo" type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>

            <div class="input-field col s12 m6 l4">
                <input id="scrt_ini" type="text" name="scrt_ini" class="datepicker" value ="<?= $personas->PERSON_C_FECHA_SCTR_INI ?>">
                <label class="active" for="scrt_ini">SCTR Inicio</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="scrt_fin" type="text" name="scrt_fin" class="datepicker" value ="<?= $personas->PERSON_C_FECHA_SCTR_FIN ?>">
                <label class="active" for="scrt_fin">SCTR Vencimiento</label> 
            </div>
            
            <div class="input-field col s12">
                <input class="btn-small" type="button" id="btn_guardar" value="Guardar">
            </div>
        </div>
    <!--</form>-->
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
        console.log("cargo pantalla");
        var btn_guardar = document.getElementById("btn_guardar"); 
        btn_guardar.addEventListener("click", validarUpload, false); 
    });
	
    async function validarUpload()
    {
        if(archivo.value != ''){
			await uploadFile('archivo');
			document.getElementById('form').submit();
        }else{
            document.getElementById('form').submit();
        }
    }
</script>
        
