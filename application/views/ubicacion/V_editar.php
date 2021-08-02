<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="<?= base_url() ?>ubicaciones" class="breadcrumb">Ubicaciones</a>
        <a href="#!" class="breadcrumb">Editar</a>
      </div>
    </div>
</nav>
<div class="section container center">
        <select id="sede" name="sede" disabled>
            <option value="" disabled>Sede </option>

                <?php if($sedes): ?>
                <?php foreach($sedes as $sede): 
                $selected='';
                if($sede->SEDE_N_ID == $ubicacion->SEDE_N_ID): 
                    $selected='selected';
                endif;
                ?> 

                <option value="<?= $sede->SEDE_N_ID ?>" <?= $selected ?>><?= $sede->SEDE_C_DESCRIPCION ?></option>
                <?php endforeach; ?> 
                <?php endif; ?>
                <label>sede</label>
        </select>
        
        <select id="talmacen" name="talmacen" disabled>
            <option value="" disabled>Tipo de almacen </option>

                <?php if($talmacenes): ?>
                <?php foreach($talmacenes as $talmacen): 
                $selected='';
                if($talmacen->TIPALM_N_ID == $ubicacion->TIPALM_N_ID): 
                    $selected='selected';
                endif;
                ?> 

                <option value="<?= $talmacen->TIPALM_N_ID ?>" <?= $selected ?>><?= $talmacen->TIPALM_C_DESCRIPCION ?></option>
                <?php endforeach; ?> 
                <?php endif; ?>
                <label>Tipo de almacen</label>
        </select>
        
    <form action="<?= base_url() ?>ubicacion/<?= $ubicacion->EMPRES_N_ID ?>/<?= $ubicacion->SEDE_N_ID ?>/<?= $ubicacion->UBICAC_N_ID ?>/actualizar" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" maxlength="100" type="text" name="descripcion" value="<?= $ubicacion->UBICAC_C_DESCRIPCION ?>" class="validate">
                <label class="active" for="descripcion">Descripción</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="metro" type="number" step="0.01" min="1" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="metro" value ="<?= $ubicacion->UBICAC_N_M2 ?>" class="validate">
                <label class="active" for="metro">Metros Cuadrados</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
