<?php 
    $fecha = new DateTime(); 
    $fechaFinal = new DateTime(); 
	
    $fechaFinal->modify('1 year');
?>

<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
        <a href="<?= base_url() ?>acuerdos" class="breadcrumb">Acuerdos de Alquiler</a>
        <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>

<div class="section container center">
    <form action="<?= base_url() ?>acuerdo/crear" method="post"  enctype="multipart/form-data">
        <div class="row">
            <div class="input-field col s8">
                <select id="cliente" name="cliente" required>
                    <option value="" disabled selected>Seleccionar Cliente</option>
                    <?php foreach ($clientes as $row): ?>
                        <option value="<?= $row->CLIENT_N_ID ?>"><?= $row->CLIENT_C_RAZON_SOCIAL ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Cliente</label>
            </div> 
            <div class="input-field col s4 m4">
                <input id="id" maxlength="15" type="text" name="id" class="left-align validate" value="<?= $nextId ?>" disabled>
                <label class="active" for="id">ID Alquiler</label> 
            </div>
            
            <div class="input-field col s8">
                <select id="sede" name="sede">
                    <option value="" disabled selected>Seleccionar Sede</option>
                    <?php foreach ($sedes as $row): ?>
                        <option value="<?= $row->SEDE_N_ID ?>"><?= $row->SEDE_C_DESCRIPCION ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Sede</label>
            </div> 
            <div class="input-field col s4 m4">
                <input id="fecha" type="text" name="fecha" class="left-align" value="<?= $fecha->format('d/m/Y') ?>" readonly>
                <label class="active" for="fecha">Fecha Registro</label> 
            </div> 

            <div class="input-field col s8">
                <select id="ubicacion" name="ubicacion" onchange="obtenerUbicacion()">
                    <option value="" disabled selected>Seleccionar Ubicación</option>
                </select>
                <label>Ubicación</label>
            </div> 
            <div class="input-field col s4">
                <input id="tipo_almacen" type="text" name="tipo_almacen" class="validate" disabled>
                <label class="active" for="tipo_almacen">Tipo de Almacén</label> 
            </div>

            <div class="input-field col s4 m4">
                <input id="fecha_inicio" maxlength="15" type="text" name="fecha_inicio" class="left-align datepicker validate" value="<?= $fecha->format('d/m/Y') ?>" required>
                <label class="active" for="fecha_inicio">Fecha Inicio</label> 
            </div>    
            <div class="input-field col s4 m4">
                <input id="fecha_termino" maxlength="15" type="text" name="fecha_termino" class="left-align datepicker validate" value="<?= $fechaFinal->format('d/m/Y') ?>" required>
                <label class="active" for="fecha_termino">Fecha Final</label> 
            </div>
            <div class="input-field col s4 m4">
                <select id="moneda" name="moneda" required>
                    <option value="" disabled>Seleccionar Moneda</option>
                    <?php foreach ($monedas as $row): ?>
                        <option value="<?= $row->MONEDA_N_ID ?>"><?= $row->MONEDA_C_DESCRIPCION ?></option>
                    <?php endforeach; ?>
                </select>
                <label>Moneda</label>
            </div>  

            <div class="input-field col s4 m4">
                <input id="area" type="number" step="0.01" min="1" maxlength="6" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="area" class="validate" onchange="calcularTotal()" required>
                <label class="active" for="area">Area M2</label> 
            </div> 
            <div class="input-field col s4 m4">
                <input id="precio" type="number" step="0.01" min="1" maxlength="6" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="precio" class="validate" onchange="calcularTotal()" required>
                <label class="active" for="precio">Precio x M2</label> 
            </div>
            <div class="input-field col s4 m4" required>
                <input id="total" maxlength="9" type="text" name="total" disabled>
                <label class="active" for="total">Sub Total</label> 
            </div>

            <div class="input-field col s4">
                <textarea id="observaciones" name="observaciones" class="materialize-textarea"></textarea>
                <label for="observaciones">Observaciones</label>
            </div>
			
			<div class="input-field col s4">
                <input id="garantia" type="number" name="garantia" class="validate" step='0.01' required>
                <label class="active" for="garantia">Garantia</label>
            </div>
			 <!--<input type="hidden" id="name_file" name="foto">-->
			<!--<div class="input-field col s2">-->
			<div class="input-field col s4 file-field">
				<div class="btn">
                    <span>Adjunto</span>
                    <input id="archivo" type="file" name="archivo">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
			</div>
						
            <div class="input-field col s1 m3 l3">
                <p>
                    <label >
                        <input type="checkbox" name="facturable" />
                        <span>Facturable</span>
                    </label>
                </p>
            </div>

            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
            
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var options = {
            format: 'dd/mm/yyyy',
            autoClose: true, 
            setDefaultDate: true
        }
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, options);

        var sede = document.getElementById("sede"); 
        sede.addEventListener("change", ubicaciones, false); 

        M.textareaAutoResize($('#observaciones'));
        $($('#moneda').children()[2]).attr("selected","selected");
        $('select').formSelect();
    });

    function ubicaciones()
    {
        M.toast({html: 'Cargando ubicaciones disponibles', classes: 'rounded'});
        $('#ubicacion').html(`<option value="" disabled selected>Cargando ubicaciones...</option>`)
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
        var url =  '<?= base_url() ?>api/execsp';
        var data = {
                    sp: 'UBICACION_DISPONIBLE_LIS',
                    empresa: <?= $empresa->EMPRES_N_ID ?>, 
                    sede: parseInt(document.getElementById("sede").value),
                    ubicacion: 0};
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
            $('#ubicacion').html(`<option value="" disabled selected>Seleccionar Ubicación</option>`)
            for (let index = 0; index < data.length; index++) {
                const element = data[index];            
                $('#ubicacion').append(`<option value="${element.UBICAC_N_ID}">${element.UBICAC_C_DESCRIPCION}</option>`)
            }
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
    }

    function obtenerUbicacion()
    {
        console.log('Ubicación')
        M.toast({html: 'Cargando datos de la Ubicación...', classes: 'rounded'});
        var url =  '<?= base_url() ?>api/ubicacion';
        var data = {empresa: <?= $empresa->EMPRES_N_ID ?>, 
                    sede: document.getElementById("sede").value,
                    ubicacion: document.getElementById("ubicacion").value};
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
            document.getElementById('tipo_almacen').value = data[0].TIPALM_C_DESCRIPCION + ' (' +  data[0].UBICAC_N_SALDO + ') m2'
            if(data[0].TIPALM_N_ID == 1)
            {
                console.log('techado')
                document.getElementById("area").readOnly = true;
            }
            else if(data[0].TIPALM_N_ID == 2)
            {
                console.log('patio')
                document.getElementById("area").readOnly = false;
            }
            document.getElementById("area").max = data[0].UBICAC_N_SALDO;
            document.getElementById('area').value = data[0].UBICAC_N_SALDO

            M.updateTextFields();
        });
    }

    function calcularTotal()
    {
        console.log('Total')
        if(  
            document.getElementById("area").value != '' &&
            document.getElementById("precio").value != '')
        {
            var area = document.getElementById("area").value,
                precio = document.getElementById("precio").value,
                total = parseFloat(area) * parseFloat(precio)
            
        }
        else{
            var total = 0
        }
        document.getElementById("total").value = total
        console.log(total)
        M.updateTextFields();
    }
    
    function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}
</script>