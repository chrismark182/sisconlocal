<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
       
        <a href="<?= base_url() ?>ordenes"  class="breadcrumb">Orden Servicio</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>

<div class="section container center">
    <form action="<?= base_url() ?>ordenservicio/crear" method="post">
        <div class="row">
        
            <div class="input-field col s12 m6 l8">
                <select id="cliente" name="cliente">
                    <option value="" disabled selected>Seleccionar Cliente</option>
                    <?php if($clientes): ?>
                        <?php foreach($clientes as $cliente): ?> 
                            <option value="<?= $cliente->CLIENT_N_ID ?>"><?= $cliente->CLIENT_C_RAZON_SOCIAL ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Clientes</label>
            </div>
            <div class="input-field col s12 m6 l4">
                <select id="sede" name="sede">
                    <option value="" disabled selected>Seleccionar Sede</option>
                    <?php if($sedes): ?>
                        <?php foreach($sedes as $sede): ?> 
                            <option value="<?= $sede->SEDE_N_ID ?>"><?= $sede->SEDE_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Sedes</label>
            </div>

            <div class="input-field col s12 m6 l5">
                <select id="servicio" name="servicio">
                    <option value="" disabled selected>Seleccionar Servicio</option>
                    <?php if($servicios): ?>
                        <?php foreach($servicios as $servicio): ?> 
                            <option value="<?= $servicio->SERVIC_N_ID ?>"><?= $servicio->SERVIC_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Servicios</label>
            </div>
            <div class="input-field col s12 m6 l3">
                <input id="solicitante" maxlength="100" type="text" name="solicitante" class="validate">
                <label class="active" for="solicitante">Solicitante</label> 
            </div>
            <div class="input-field col s12 m6 l2">
                <input id="numerofisico" maxlength="10" type="text" name="numerofisico" class="validate">
                <label class="active" for="numerofisico">Núm. O.S. Físico</label> 
            </div>
            <div class="input-field col s12 m6 l2">
                <input id="codproyecto" maxlength="20" type="text" name="codproyecto" class="validate">
                <label class="active" for="codproyecto">Código Proyecto</label> 
            </div>


            <div class="input-field col s12 m6 l2">
                <input id="tarifa" maxlength="100" type="text" name="tarifa" readonly="false" class="validate">
                <label class="active" for="tarifa">Tarifa</label> 
            </div>
            <div class="input-field col s12 m6 l3">
                <input id="horas" type="number" min="1" maxlength="2" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="horas" class="validate">
                <label class="active" for="horas">Horas</label> 
            </div>
            <div class="input-field col s12 m6 l3">
                <select id="moneda" name="moneda" enabled="false">
                    <option value="" disabled selected>Seleccionar Moneda</option>
                    <?php if($monedas): ?>
                        <?php foreach($monedas as $moneda): ?> 
                            <option value="<?= $moneda->MONEDA_N_ID ?>"><?= $moneda->MONEDA_C_DESCRIPCION ?></option>
                        <?php endforeach; ?> 
                    <?php endif; ?>
                </select>
                <label>Monedas</label>
            </div>
            <div class="input-field col s12 m6 l4">
                <input id="preciounitario" type="number" readonly="false" step="0.01" min="1" maxlength="6" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="preciounitario" class="validate">
                <label class="active" for="preciounitario">Precio x Hora</label> 
            </div>

            <div class="input-field col s12">
                <div class="btn-small" id="btn_guardar" >Guardar
                </div>
            </div>
        </div>
    </form>
</div>
        
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('sede').addEventListener('change', obtenerTarifa)
        document.getElementById('cliente').addEventListener('change', obtenerTarifa)
        document.getElementById('servicio').addEventListener('change', obtenerTarifa)
        var btn_guardar = document.getElementById("btn_guardar"); 
        btn_guardar.addEventListener("click", crear, false); 
    });

    function crear()
    {
		
		
		//return false;
		//btn_guardar.prop('disabled', true);
		
		
        if(  
            document.getElementById("sede").value != '' &&
            document.getElementById("servicio").value != '' &&
            document.getElementById("horas").value != '' &&
            document.getElementById("solicitante").value != '' &&
            document.getElementById("tarifa").value != '')
        {
			
			$("#btn_guardar").attr('disabled','disabled');
			
            $('.preloader-background').css({'display': 'block'});
            var url =  '<?= base_url() ?>ordenservicio/crear';
            var data = {
                        empresa: <?= $empresa->EMPRES_N_ID ?>, 
                        sede: document.getElementById("sede").value,
                        cliente: document.getElementById("cliente").value,
                        servicio: document.getElementById("servicio").value,
                        numerofisico: document.getElementById("numerofisico").value,
                        solicitante: document.getElementById("solicitante").value,
                        codproyecto: document.getElementById("codproyecto").value,
                        horas: document.getElementById("horas").value,
                        tarifa: document.getElementById("tarifa").value,
                        moneda: document.getElementById("moneda").value,
                        preciounitario: document.getElementById("preciounitario").value,
                        usuario: <?= $this->data['session']->USUARI_N_ID ?>
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
                console.log('terminó de ejecutar');
                M.toast({html: 'Orden Servicio generada correctamente', classes: 'rounded'});
                window.location.href = "<?= base_url() ?>ordenes?os=" + data[0].ORDSER_N_ID;
            }).catch(function(error) {
                console.log('Hubo un problema con la petición Fetch:' + error.message);
            });

            $('.preloader-background').css({'display': 'none'});    
        }
        else{
            M.toast({html: 'No puede guardar vacio', classes: 'rounded'});   
        }
    }

    function obtenerTarifa()
    {
        var empresa = <?= $empresa->EMPRES_N_ID ?>,
                sede =  $('#sede').val(), 
                cliente = $('#cliente').val(), 
                servicio = $('#servicio').val();

        if( sede != null &&
                cliente != null &&
                servicio != null){

            M.toast({html: 'Buscando tarifa por favor espere ...'});    
            var url = '<?= base_url() ?>api/tarifa/' + empresa + '/' + sede + '/' + cliente + '/' + servicio;
            
            fetch(url)
            .then(function(response) {
                return response.json();
            })
            .then(function(data) 
            {
                console.log(data.length)
                if(data.length>0){
                    M.toast({html: 'Tarifa encontrada'});
                    $('#tarifa').val(data[0].TARIFA_N_ID)
                    $('#moneda').val(data[0].MONEDA_N_ID)
                    $('#preciounitario').val(data[0].TARIFA_N_PRECIO_UNIT)
                    M.updateTextFields();
                    $('select').formSelect();
                    console.log(data);
                }
                else
                {
                    M.toast({html: 'Tarifa NO encontrada'});
                    $('#tarifa').val("")
                    $('#moneda').val("")
                    $('#preciounitario').val("")
                    M.updateTextFields();
                    $('select').formSelect();
                    console.log(data);
                }
            });
        };
    }
</script>
