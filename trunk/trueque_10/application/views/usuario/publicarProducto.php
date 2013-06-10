    
<div id ="miga">
    <?php echo anchor('productos/index','Inicio'); ?>
     > 
    <?php echo anchor('miCuenta','Mi Cuenta'); ?>
     >
     <?php echo "<strong>" . $title . "</strong>";?>
</div>    
<br/>
<h1> Publicar Producto</h1>
    <table id="formulario-publicar">
        <tr>
            <?php echo form_error('nombre');?>
		<?php echo form_open('miCuenta/guardarProducto');?>
		<td><label for="nombreProducto">* Nombre: </label></td>
		<td><?php echo form_input('nombre',set_value('nombre'),'size ="40" id ="nombreProducto"');?></td>
	</tr>
	<tr>
            <?php echo form_error('descripcion');?>
		<td><br/><label for="descripcion"> * Descripcion: </label></td>
		<td><?php echo form_textarea('descripcion',set_value('descripcion'),'size="40" id="descripcion"');?></td>
	</tr>
        <tr>
            <?php echo form_error('categoria');?>
            <td><br/><?php echo form_label(" * Categoria " ); ?></td>
            <td><?php echo form_dropdown('categoria', $categoria); ?></td>  
	</tr>
	<tr>
		<td><br/><input id ="botonImagen" type="submit" value="Siguiente" /></td>
                <td><br/><button align="center" id = "cancelar" onclick="location.href='<?php echo base_url(); ?>/miCuenta'; return false;"> Cancelar</button></td>
                <?php echo form_close();?>
        </tr>

    </table>