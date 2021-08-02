<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
        <div class="col s4" style="display: inline-block">
            <a href="#!" class="breadcrumb">Persona Visitante</a>
        </div>
        <ul id="nav-mobile" class="right">
            <div class="input-field col s6 left-align" style="margin: 0px; font-size: 12px;">
                <div>
                    <b>
                        Total Registros: 
                        &nbsp;&nbsp;&nbsp;
                        <span id="total" class="btn blue-grey darken-2">0</span>
                    </b>
                </div>
            </div>
        </ul>
    </div>
</nav>

<!-- Buscador -->
<div class="section container center" style="padding-top: 0px">
    <div class="row" style="margin-bottom: 0px">
        <form action="<?= base_url() ?>contacto" method="post">
            <div class="input-field col s12 m6 l9">
                <input id="razon_social" maxlength="200" type="text" name="razon_social"  class="validate">
                <label class="active" for="razon_social">Empresa</label> 
            </div>
            <div class="input-field col s12 m6 l3">
                <input id="ndocumento" maxlength="15" type="text" name="ndocumento" class="validate">
                <label class="active" for="ndocumento">Número de Documento</label> 
            </div>

            <div class="input-field col s12 m6 l4">
                <input id="nombres" maxlength="100" type="text" name="nombres" class="validate">
                <label class="active" for="nombres">Nombres</label> 
            </div>
            <div class="input-field col s12 m6 l5">
                <input id="apellidos" maxlength="100" type="text" name="apellidos" class="validate">
                <label class="active" for="apellidos">Apellidos</label> 
            </div>
            <div class="input-field col s3">
                <div class="btn-small" id="btnBuscar">Buscar</div>
            </div>
        </form>
    </div>    
</div> 

<div class="container">
    <table class="striped" style="font-size: 12px;">
        <thead class="blue-grey darken-1" style="color: white">
            <tr>          
                <th class="left-align">EMPRESA</th>
                <th class="left-align">TIPO DOC.</th>
                <th class="left-align">DOCUMENTO</th>
                <th class="left-align">NOMBRES</th>
                <th class="left-align">APELLIDOS</th>
                <th class="center-align">VENCE SCTR</th>
                <th class="center-align">BLOQUEO</th>
                <th class="center-align">FOTO</th>
                <th class="center-align">EDITAR</th>
                <th class="center-align">ELIMINAR</th>
            </tr>
        </thead>
        <tbody id="resultados">            
        </tbody>
    </table>
</div>

<a  class="btn-floating btn-large waves-effect waves-light red" style="bottom:16px; right:16px; position:absolute;" 
    href="<?= base_url()?>personas/nuevo"><i class="material-icons">add</i></a>

<div id="modalEliminar" class="modal">
    <div class="modal-content">
        <h4>Eliminar</h4>
        <p>¿Está seguro que desea elimniar el registro?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCELAR</a>
        <a id="btnConfirmar" href="#!" class="modal-close waves-effect waves-green btn">ACEPTAR</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var btnBuscar = document.getElementById("btnBuscar"); 
        btnBuscar.addEventListener("click", buscar, false);
        
        ndocumento = getParameterByName('n')
        if(ndocumento != '')
        {
            $('#ndocumento').val(ndocumento)
            M.updateTextFields(); //este metodo sale de materialize
            buscar()
        }
    });

    function buscar()
    {
        console.log('Estoy buscando..  ')
        M.toast({html: 'Buscando resultado...', classes: 'rounded'});
        $('.preloader-background').css({'display': 'block'});
		let url = '<?= base_url() ?>api/execsp';

		let sp = 'PERSONA_LIS';
        let empresa = <?= $empresa->EMPRES_N_ID ?>;

        let cliente = '%'; 
        if($('#razon_social').val() != ''){cliente = $('#razon_social').val() + '%';}

        let ndocumento = '%'; 
        if($('#ndocumento').val() != '')
        {
            ndocumento = $('#ndocumento').val() + '%';
        }

        let nombres = '%'; 
        if($('#nombres').val() != '')
        {
            nombres = $('#nombres').val() + '%';
        }

        let apellidos = '%'; 
        if($('#apellidos').val() != '')
        {
            apellidos = $('#apellidos').val() + '%';
        }

        var data = {sp, empresa, cliente, ndocumento, nombres, apellidos};
        
        $('#resultados').html('');
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
            $('#total').html(data.length);
            if(data.length > 0)
            {
                M.toast({html: 'Cargando Personas Visitante', classes: 'rounded'});
                for (let index = 0; index < data.length; index++) {
                    const element = data[index];

                    if(element.PERSON_C_FOTO == "")
                    {
                        $foto = `<i class="material-icons tooltipped" style="color: #999999" data-position="bottom" data-tooltip="No tienen foto">photo_camera</i>`
                    }else
                    {
                        $foto = `<i class="material-icons tooltipped" data-position="bottom" data-tooltip="Tienen foto">photo_camera</i>`
                    }

                    if(element.PERSON_N_BLOQUEOS > 0)
                    {
                        $bloqueo = `<i class="material-icons tooltipped" style="color: #999999" data-position="bottom" data-tooltip="Bloqueado">block</i>`
                    }else
                    {
                        $bloqueo = `<i class="material-icons tooltipped"></i>`
                    }

                    $('#resultados').append(`   <tr>
													<td class="left-align">${element.CLIENT_C_RAZON_SOCIAL}</td>
													<td class="left-align">${element.TIPDOC_C_ABREVIATURA}</td>
                                                    <td class="left-align">${element.PERSON_C_DOCUMENTO}</td>
                                                    <td class="left-align">${element.PERSON_C_NOMBRE}</td>
                                                    <td class="left-align">${element.PERSON_C_APELLIDOS}</td>
                                                    <td class="center-align">${element.PERSON_C_FECHA_SCTR_FIN}</td>
                                                    <td class="center-align">
                                                        ${$bloqueo}
                                                    </td>
                                                    <td class="center-align">
                                                        ${$foto}
                                                    </td>
                                                    <td class="center-align">
                                                        <a  href="<?= base_url() ?>personas/${data[index].EMPRES_N_ID}/${data[index].PERSON_N_ID}/editar">
                                                            <i class="material-icons">edit</i>
                                                        </a>
                                                    </td>
                                                    <td class="center-align">
                                                        <i class="material-icons " style="cursor: pointer" onclick="confirmarEliminar(${data[index].PERSON_N_ID})">delete</i>                        
                                                    </td>
                                                </tr>
                                        `);
                }
            }
            else{
                M.toast({html: 'No se encontraron resultados', classes: 'rounded'});
            }
            $('.preloader-background').css({'display': 'none'}); 
            $('.tooltipped').tooltip();                           
        });
    }

    function getParameterByName(name) {
		name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
		results = regex.exec(location.search);
		return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	}

    function confirmarEliminar($persona)
    {
        console.log('confirmar eliminar')
        $('#modalEliminar').modal('open');
        $('#btnConfirmar').attr('href', 'personas/'+$persona+'/eliminar')
    }
</script>
