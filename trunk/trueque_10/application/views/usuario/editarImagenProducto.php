<html>
    <head>
        <title>Formulario de Subida</title>
    </head>
    <body>
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
        <h4>Imagen Actual: </h4>
        <div>
        <?php
                            $image_properties = array(
                                'src' => $producto['imagen'],
                                'alt' => $producto['nombre'],
                                'class' => 'resize',
                                'width' => '300',
                                'height' => '200'
                            );
                            echo img($image_properties);
        ?>
        </div>
        <div>
        <?php echo form_open_multipart('miCuenta/guardarImagen'); ?>
        <?php echo form_hidden('producto[nombre]', $producto['nombre'], 'size ="40" id =""'); ?>
<?php echo form_hidden('producto[descripcion]', $producto['descripcion'], 'size ="40" id =""'); ?>
<?php echo form_hidden('producto[fechaingreso]', $producto['fechaingreso'], 'size ="40" id =""'); ?>
<?php echo form_hidden('producto[usuario_id]', $producto['usuario_id'], 'size ="40" id =""'); ?>
<?php echo form_hidden('producto[categoria_id]', $producto['categoria_id'], 'size ="40" id =""'); ?>
<?php echo form_hidden('producto_id', $producto['producto_id'], 'size ="40" id =""'); ?>
        <input type="file" name="userfile" size="20" />
        <br /><br />
        <input type="submit" value="Guardar Imagen" />
        </div>
            </form>
</body>
</html>