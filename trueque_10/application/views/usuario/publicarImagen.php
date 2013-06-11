<div id ="miga">
    <?php echo anchor('productos/index','Inicio'); ?>
     > 
    <?php echo anchor('miCuenta','Mi Cuenta'); ?>
     >
     <?php echo "<strong> seleccionar Imagen </strong>";?>
</div> 
<br/>
<div>
    
    <h1>Selecciona la imagen de tu producto</h1><br/>
    <div style="padding-left: 5%;">
    <?php
    if (isset($error)) {
        echo "<p style=\"color:red;\">Debes seleccionar una imagen para tu producto</p>";
    }
    ?>
    <?php echo form_open_multipart('miCuenta/guardarImagen'); ?>
    <?php echo form_hidden('producto[nombre]', $producto['nombre'], 'size ="40" id =""'); ?>
    <?php echo form_hidden('producto[descripcion]', $producto['descripcion'], 'size ="40" id =""'); ?>
    <?php echo form_hidden('producto[fechaingreso]', $producto['fechaingreso'], 'size ="40" id =""'); ?>
    <?php echo form_hidden('producto[usuario_id]', $producto['usuario_id'], 'size ="40" id =""'); ?>
    <?php echo form_hidden('producto[categoria_id]', $producto['categoria_id'], 'size ="40" id =""'); ?>
    <table><tr><td>
    <input type="file" name="userfile" size="20" />
    </td></tr>
        <tr><td>
    <input type="submit" value="Publicar Producto" />
    <button align="center" id = "cancelar" onclick="location.href='<?php echo base_url(); ?>/miCuenta'; return false;"> Cancelar</button>
    <?php echo form_close(); ?>
            </td></tr>
    </table>
    </div>
</div>