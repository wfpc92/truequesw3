
<div id ="miga">
    <?php echo anchor('productos/index', 'Inicio'); ?>
    > <?php echo anchor('administrar/index', 'Administrar'); ?>
    ><strong>Borrar Usuario</strong>
</div>
<div style="padding-left: 5%;">
<h3>Confirma que va a eliminar a: <br/></h3>
<h4><?php echo $usuario->nombre . " " . $usuario->apellido; ?></h4>
<?php echo form_open('administrar/borrarUsuario') ?>
<?php echo form_hidden('id', $usuario->usuario_id, 'size ="40" id ="usuario_id"'); ?>
<table>
    <tr>
        <td><input type="submit" value="Eliminar" /></td>
        <td><button id = "cancelar" onclick="location.href='<?php echo base_url(); ?>administrar'; return false;"  > Cancelar</button></td>
    </tr>
</table>
<?php echo form_close(); ?>		
</div>