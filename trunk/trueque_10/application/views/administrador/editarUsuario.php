<div id ="miga">
    <?php echo anchor('productos/index', 'Inicio'); ?>
    > <?php echo anchor('administrar/index', 'Administrar'); ?>
    ><strong>Editar Usuario</strong>
</div>
<h1>Editar Un Usuario</h1>
<div style="padding-left: 5%;">
<table cellpadding="5" cellspacing="0" border="0">
    <tr>
        <?php echo form_open('administrar/guardarUsuario') ?>
        <td><?php echo form_hidden('usuario[usuario_id]', $usuario->usuario_id, 'size ="40" id ="usuario_id"'); ?></td>
    </tr>
    <tr>
        <td><br/><label for="nombre"> Nombre: </label></td>
        <td><?php echo form_input('usuario[nombre]', $usuario->nombre, 'size="40" id="nombre"'); ?></td>
    </tr>
    <tr>
        <td><br/><label for="apellido"> Apellido: </label></td>
        <td><?php echo form_input('usuario[apellido]', $usuario->apellido, 'size="40" id="apellido"'); ?></td>
    </tr>
    <tr>
        <td><br/><label for="email"> Email: </label></td>
        <td><?php echo form_input('usuario[email]', $usuario->email, 'size="40" id="email"'); ?></td>
    </tr>
    <tr>
        <td> <?php echo form_label("Ciudad"); ?></td>
        <td> <?php echo form_dropdown('ciudad', $ciudades, $usuario->id_ciudad); ?></td>
    </tr>
    <tr>
        <td style="padding-top: 5%; padding-left: 30%"><br/><input type="submit" value="Guardar Usuario" /></td>
        <td style="padding-top: 9%; padding-left: 30%;"><button id = "cancelar" onclick="location.href='<?php echo base_url(); ?>administrar'; return false;"> Cancelar</button></td>
        <?php echo form_close(); ?>
    </tr>
</table>
</div>