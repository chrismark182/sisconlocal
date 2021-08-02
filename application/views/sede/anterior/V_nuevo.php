<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url() ?>sedes" class="breadcrumb">Sedes</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>
<div class="section container center">
    <form action="<?= base_url() ?>sede/crear"  id="form" method="post">
        <div class="row">        
            <div class="input-field col s12 m6 l4">
                <input id="descripcion" maxlength="100" type="text" name="descripcion" class="validate">
                <label class="active" for="descripcion">Sede</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="direccion" maxlength="200" type="text" name="direccion" class="validate">
                <label class="active" for="direccion">Dirección</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="abreviatura" maxlength="10" type="text" name="abreviatura" class="validate">
                <label class="active" for="abreviatura">Abreviatura</label> 
            </div>      
            <div class="btn-small" id="btn_guardar" >Guardar
            </div>
        </div>
    </form>
</div>
           
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("pagina")
        var btn_guardar = document.getElementById("btn_guardar"); 
        btn_guardar.addEventListener("click", validar, false); 
    });
    function validar()
    {
        console.log("validando")
        if( 
            document.getElementById('descripcion').value.trim() != '' &&
            document.getElementById('direccion').value.trim()  != '' &&
            document.getElementById('abreviatura').value.trim() != ''
        )
        {
            var url =  '<?= base_url() ?>sede/crear';
            var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
            descripcion: document.getElementById("descripcion").value,            
            direccion: document.getElementById("direccion").value,
            abreviatura: document.getElementById("abreviatura").value,
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
                    window.location.href='<?= base_url() ?>sedes';
                }, 1000);
             });

        }
        else
        {
            M.toast({html: 'Debe llenar todos los campos', classes: 'rounded'});
        }

    }

</script>