<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
       
        <a href="<?= base_url() ?>ubicaciones"  class="breadcrumb">Ubicaciones</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>ubicacion/crear"  id="form" method="post">
        <div class="row">
        
        <div class="input-field col s12 m6 l6">
                <select id="sede" name="sede">
                    <option value="" disabled selected>Seleccionar Sede</option>
                    
                    <?php if($sedes): ?>
                    <?php foreach($sedes as $sede): ?> 
                    <tr>
                    <option value="<?= $sede->SEDE_N_ID ?>"><?= $sede->SEDE_C_DESCRIPCION ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$sedes</label>
                </select>
        </div>

            <div class="input-field col s12 m6 l6">
            <select id="talmacen" name="talmacen">
                    <option value="" disabled selected>Seleccionar Tipo de Almacén</option>
                    
                    <?php if($talmacenes): ?>
                    <?php foreach($talmacenes as $talmacen): ?> 
                    <tr>
                    <option value="<?= $talmacen->TIPALM_N_ID ?>"><?= $talmacen->TIPALM_C_DESCRIPCION ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    <label>$Tipo de Almacen</label>
                </select>
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="descripcion" maxlength="100" type="text" name="descripcion" class="validate">
                <label class="active" for="descripcion">Descripción</label> 
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="metro" type="number" step="0.01" min="1" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="metro" class="validate">
                <label class="active" for="metro">Area (m2)</label> 
            </div>
            <div class="input-field col s12">
                <div class="btn-small" id="btn_guardar">Guardar
            </div>
        </div>
    </form>
</div>
        
   
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("cargo pantalla")
        var btn_guardar = document.getElementById("btn_guardar"); 
        btn_guardar.addEventListener("click", validar, false); 
    });

    function validar()
    {
        console.log("Validar");
        if( 
            document.getElementById('sede').value.trim() != '' &&
            document.getElementById('talmacen').value.trim()  != '' &&
            document.getElementById('descripcion').value.trim() != '' &&
            document.getElementById('metro').value.trim() != ''
        )
        {
            var url =  '<?= base_url() ?>ubicacion/crear';
            var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
                sede: document.getElementById("sede").value,            
                talmacen: document.getElementById("talmacen").value,
                descripcion: document.getElementById("descripcion").value,
                metro: document.getElementById("metro").value,
            usuario: <?= $session->USUARI_N_ID ?>
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
                M.toast({html: 'Datos Guardados correctamente', classes: 'rounded'});
                setTimeout(() => {
                    window.location.href='<?= base_url() ?>ubicaciones';
                }, 2000);
             });
        }
        else
        {
            M.toast({html: 'Debe llenar todos los campos', classes: 'rounded'});
        }
    }
</script>