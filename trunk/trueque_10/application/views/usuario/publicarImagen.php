<html>
    <head>
        <title>Formulario de Subida</title>
    </head>
    <body>
        <?php
        echo $producto['nombre'];
        echo $producto['descripcion'];
        echo $producto['categoria_id'];
        echo $producto['fechaingreso'];
        echo $producto['usuario_id'];
        echo $producto['categoria_id'];
        if (isset($error)) {
            echo $error;
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
        <input type="submit" value="upload" />
    </form>
</body>
</html>