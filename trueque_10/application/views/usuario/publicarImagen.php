<html>
    <head>
        <title>Formulario de Subida</title>
    </head>
    <body>
        <h1>Selecciona la imagen de tu producto</h1><br/>
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

        <input type="file" name="userfile" size="20" />
        <br /><br />
        <input type="submit" value="Publicar Producto" />
        <button align="center" id = "cancelar" onclick="location.href='<?php echo base_url(); ?>/miCuenta'; return false;"> Cancelar</button>
        <?php echo form_close(); ?>
    </body>
</html>