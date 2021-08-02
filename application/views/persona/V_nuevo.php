<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        
        <a href="<?= base_url() ?>personas" class="breadcrumb">Persona Visitante</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>

<div class="section container center">
    <form action="<?= base_url() ?>personas/crear" method="post" id="form">
        <div class="row">
            <div class="input-field col s12 m6 l4">
                <select id="cliente" name="cliente" >
                    <option value="" disabled selected>Seleccionar Empresa</option>
                        
                    <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                            <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Empresas</label>
            </div>

            <div class="input-field col s12 m6 l4">
                <select id="tdocumento" name="tdocumento">
                    <option value="" disabled selected>Seleccionar Tipo de Documento</option>
                    
                    <?php if($tdocumentos): ?>
                        <?php foreach($tdocumentos as $tdocumento): ?> 
                            <option value="<?= $tdocumento->TIPDOC_N_ID ?>"><?= $tdocumento->TIPDOC_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Tipo de Documento</label>
            </div>

            <div class="input-field col s12 m6 l4">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Número de Documento</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="nombres" maxlength="100" type="text" name="nombres" class="validate">
                <label class="active" for="nombres">Nombres</label> 
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="apellidos" maxlength="100" type="text" name="apellidos" class="validate">
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
                <input id="scrt_ini" type="text" value="" name="scrt_ini" class="datepicker">
                <label class="active" for="scrt_ini">SCTR Inicio</label> 
            </div>
            
            <div class="input-field col s12 m6 l4">
                <input id="scrt_fin" type="text" value="" name="scrt_fin" class="datepicker">
                <label class="active" for="scrt_fin">SCTR Vencimiento</label> 
            </div>
            <div class="input-field col s12">
                <div class="btn-small" id="btn_guardar">Guardar</div>
            </div>
        </div>
    </form>
</div>
    
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log("cargo pantalla")
        var btn_guardar = document.getElementById("btn_guardar"); 
        btn_guardar.addEventListener("click", validarUpload, false); 
    });

    async function validarUpload()
    {
        if(archivo.value != ''){
			await uploadFile('archivo')
			validar();
        }else{
            validar();
        }
    }
    
    function validar()
    {
		console.log("Validar");
		
		let cliente = document.getElementById("cliente").value;
		let tdocumento = document.getElementById("tdocumento").value;            
		let	ndocumento = document.getElementById("ndocumento").value;

		console.log(cliente);
		console.log(tdocumento);
		console.log(ndocumento);

        if( 
            document.getElementById('cliente').value.trim() != '' &&
            document.getElementById('tdocumento').value.trim()  != '' &&
            document.getElementById('ndocumento').value.trim() != '' &&
            document.getElementById('nombres').value.trim() != '' &&
            document.getElementById('apellidos').value.trim() != ''
        )
        {
            if( 
                document.getElementById('tdocumento').value.trim() == '2' &&
                document.getElementById('ndocumento').value.trim().length != 8
            )   
            {
                M.toast({html: 'Formato del DNI es inválido', classes: 'rounded'});    
            }
            else
            {
                var url =  '<?= base_url() ?>api/personavalidar';
                var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
                            tdocumento: document.getElementById("tdocumento").value,            
                            ndocumento: document.getElementById("ndocumento").value
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
                    if(data.length>0){
                        M.toast({html: 'Documento Duplicado', classes: 'rounded'});
                    }
                    else{
                        document.getElementById('form').submit();
                    }
                });
            }
        }
        else
        {
            M.toast({html: 'Debe llenar todos los campos', classes: 'rounded'});
        }
    }
</script>
