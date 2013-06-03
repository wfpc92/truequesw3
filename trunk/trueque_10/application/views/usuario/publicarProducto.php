    
    <h1> Publicar Producto</h1>
    <table id="formulario-publicar">
        <span><?php echo validation_errors(); ?></span>
        <tr>
		<?php echo form_open('miCuenta/guardarProducto')?>
		<td><label for="nombreProducto">* Nombre: </label></td>
		<td><?php echo form_input('nombre',set_value('nombre'),'size ="40" id ="nombreProducto"');?></td>
	</tr>
	<tr>
		<td><br/><label for="descripcion"> * Descripcion: </label></td>
		<td><?php echo form_textarea('descripcion',set_value('descripcion'),'size="40" id="descripcion"');?></td>
	</tr>
        <tr>
            <td><br/><?php echo form_label(" * Categoria " ); ?></td>
            <td><?php echo form_dropdown('categoria', $categoria); ?></td>  
	</tr>
	<tr>
		<td><br/><input id ="botonPublicar" type="submit" value="Publicar" /></td>
		<?php echo form_close();?>
        </tr>

    </table>