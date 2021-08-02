<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s12">
            <a href="<?= base_url() ?>clientes" class="breadcrumb">Entidades</a>
            <a href="#!" class="breadcrumb">Nuevo</a>
        </div>
    </div>
</nav>

<div class="section container center">
    <form action="<?= base_url() ?>cliente/crear" method="post" id="form">
        <div class="row">
        
            <div class="input-field col s12 m6 l4">
                <select id="tdocumento" name="tdocumento">
                    <option value="" disabled selected>Seleccionar Tipo de Documento</option>
                    
                    <?php if($tdocumentos): ?>
                    <?php foreach($tdocumentos as $tdocumento): ?> 
                    <tr>
                    <option value="<?= $tdocumento->TIPDOC_N_ID ?>"><?= $tdocumento->TIPDOC_C_DESCRIPCION ?></option>
                    <?php endforeach; ?> 
                    <?php endif; ?>
                    
                </select>
                <label>Tipo de Documento</label>
            </div>
            
            <div class="input-field col s12 m6 l2">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Nro. Documento</label> 
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="razon_social" maxlength="250" type="text" name="razon_social" class="validate">
                <label class="active" for="razon_social">Razón Social</label> 
            </div>
            <div class="input-field col s12 m6 l12">
                <input id="direccion" maxlength="250" type="text" name="direccion" class="validate">
                <label class="active" for="direccion">Dirección</label> 
            </div>
            <div class="input-field col s12 m6 l4 left-align">       
                <p>
                    <label>
                        <input id="escliente" name="escliente" class="validate" type="checkbox"/>
                        <span>Es Cliente</span>
                    </label>
                </p>
                
                <p>
                    <label>
                        <input id="esproveedor" name="esproveedor" type="checkbox"/>
                        <span>Es proveedor</span>
                    </label>
                </p>
                <p>
                    <label>
                        <input id="estransportista" name="estransportista" type="checkbox"/>
                        <span>Es Transportista</span>
                    </label>
                </p>
				
				 <p>
                    <label>
                        <input id="otro" name="otro" type="checkbox"/>
                        <span>Otro</span>
                    </label>
                </p>
             
            </div>
            <div class="input-field col s12 m6 l4">
            <p>
                    <label>
                        <input  id="ordencompra" name="ordencompra" type="checkbox" disabled="disabled"/>
                        <span>Requiere Orden de Compra</span>
                    </label>
                </p>
            </div>
            <div class="input-field col s12">
            <div class="btn-small" id="btn_guardar" >Guardar
            </div>
            
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() { 
        var btn_guardar = document.getElementById("btn_guardar"); 
        btn_guardar.addEventListener("click", validar, false); 
    });

    function validar()
    {
        if( 
            document.getElementById('tdocumento').value.trim() != '' &&
            document.getElementById('ndocumento').value.trim()  != '' &&
            document.getElementById('razon_social').value.trim() != '' &&
            document.getElementById('direccion').value.trim() != '' &&
			(document.getElementById('escliente').checked == true ||
			 document.getElementById('esproveedor').checked == true ||
			 document.getElementById('estransportista').checked == true ||
			 document.getElementById('otro').checked == true
			)
        )
        {
            if( 
                document.getElementById('tdocumento').value.trim() == '4' &&
                document.getElementById('ndocumento').value.trim().length != 11
            )   
            {
                M.toast({html: 'Formato del RUC es inválido', classes: 'rounded'});    
            }
            else
            {
                var url =  '<?= base_url() ?>api/clientevalidar';
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
    
    // Si se hace click sobre el input de tipo checkbox con id checkb
    $('#escliente').click(function() {
        // Si esta seleccionado (si la propiedad checked es igual a true)
        if ($(this).prop('checked')) {
            // Selecciona cada input que tenga la clase .checar
            $('#ordencompra').prop('disabled', false);
        } else {
            // Deselecciona cada input que tenga la clase .checar
            $('#ordencompra').prop('disabled', true);
        }
    });        
</script>
        
