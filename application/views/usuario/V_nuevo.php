<nav class="blue-grey lighten-1" style="padding: 0 1em;">
    <div class="nav-wrapper">
      <div class="col s12">
            <a href="#!" class="breadcrumb">Seguridad</a>
            <a href="<?= base_url() ?>usuarios" class="breadcrumb">Usuarios</a>
            <a href="#!" class="breadcrumb">Nuevo</a>
      </div>
    </div>
</nav>

<div class="section container center">
    <form action="<?= base_url() ?>usuario/crear" method="post">
        <div class="row">
            <div class="input-field col s12 m6 l12">
                <select name="empresa" id="empresa">
                    <option value="0" disabled>Seleccionar Empresa</option>
                    <?php foreach ($empresas as $empresa): ?>
                        <option value="<?= $empresa->EMPRES_N_ID ?>"><?= $empresa->EMPRES_C_RAZON_SOCIAL ?></option>
                    <?php endforeach; ?>

                </select>
                <label>Empresa</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <select name="categoria">
                    <option value="0" disabled>Seleccionar Categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria->CATEGO_N_ID ?>"><?= $categoria->CATEGO_C_DESCRIPCION ?></option>
                    <?php endforeach; ?>

                </select>
                <label>Categoría</label>
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="username" maxlength="20" type="text" name="username" class="validate">
                <label class="active" for="username">Usuario</label> 
            </div>
			
			 <div class="input-field col s12 m6 l6">
                <input id="firstname" maxlength="20" type="text" name="firstname" class="validate">
                <label class="active" for="firstname">Nombre</label> 
            </div>
            <div class="input-field col s12 m6 l6">
                <input id="lastname" maxlength="20" type="text" name="lastname" class="validate">
                <label class="active" for="lastname">Apellido</label> 
            </div>
            <div class="input-field col s12">
                <input class="btn-small" type="submit" value="Guardar">
            </div>
        </div>
    </form>
</div>
        
