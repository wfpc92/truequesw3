    
    <h1> Publicar Producto</h1>
    </br>
    <div id="imagenProducto">
	<img id ="imagenProducto" src="" width="200" height="200">
	<div id="filename"></div>
	<?php 
            $data = array(
            	'name' => 'imagen',
              	'id' => 'imagen',
              	'size' => '2',
              	'type' => 'file',
              	'onchange'=> 'readURL(this);',
              	'accept' => 'image/gif, image/jpeg, image/png'
            );
            //echo form_input($data);
	?>
    </div>
    <div id ="botonImagen"><?php echo form_input($data); ?></div>
    <table id="formulario-publicar">
        <span><?php echo validation_errors(); ?></span>
        <tr>
		<?php echo form_open('miCuenta/publicarProducto')?>
		<td><label for="nombreProducto">* Nombre: </label></td>
		<td><?php echo form_input('productos[nombre]','','size ="40" id ="nombreProducto"');?></td>
	</tr>
	<tr>
		<td><br/><label for="descripcion"> * Descripcion: </label></td>
		<td><?php echo form_textarea('productos[descripcion]','','size="40" id="descripcion"');?></td>
	</tr>
        <tr>
            <td><br/><?php echo form_label(" * Categoria " ); ?></td>
            <td><?php echo form_dropdown('categorias', $categoria); ?></td>  
	</tr>
	<tr>
		<td><br/><input id ="botonPublicar" type="submit" value="Publicar" /></td>
		<?php echo form_close();?>
        </tr>

    </table>