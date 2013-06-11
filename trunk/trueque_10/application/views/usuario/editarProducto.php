<div id ="miga">
    <?php echo anchor('productos/index', 'Inicio'); ?>
    > <strong><?php echo anchor('miCuenta', 'Mi Cuenta');?></strong>
    > <strong>Editar Producto</strong>
</div>
<br/>
<h1> Editar Producto</h1>
<div style="padding-left: 5%;">
    <table id="formulario_editar">
        <span><?php echo validation_errors(); ?></span>
        <tr>
		<?php echo form_open('miCuenta/guardarProducto')?>
                <?php echo form_hidden('producto_id', $producto->producto_id, 'size ="40" id =""');?>
		<?php echo form_hidden('imagen', $producto->imagen, 'size ="40" id =""');?>
                <td><label for="nombreProducto">* Nombre: </label></td>
		<td><?php echo form_input('nombre',$producto->p_nombre,'size ="40" id ="nombreProducto"');?></td>
	</tr>
	<tr>
		<td><br/><label for="descripcion"> * Descripcion: </label></td>
		<td><?php echo form_textarea('descripcion',$producto->descripcion,'size="40" id="descripcion"');?></td>
	</tr>
        <tr>
            <td><br/><?php echo form_label(" * Categoria " ); ?></td>
            <td><?php echo form_dropdown('categoria', $categoria,$producto->categoria_id); ?></td>  
	</tr>
	<tr>
                <td><br/><input id ="botonPublicar" type="submit" value="Siguiente" /></td>
		<td><br/><button id = "cancelar" onclick="location.href='<?php echo base_url(); ?>/miCuenta'; return false;"  > Cancelar</button></td>
		
                <?php echo form_close();?>
        </tr>

    </table>
</div>