<div id ="miga">
    <?php echo anchor('productos/index', 'Inicio'); ?>
    > 
    <?php echo anchor('miCuenta', 'Mi Cuenta'); ?>
    >
    <?php echo "<strong> seleccionar Imagen </strong>"; ?>
</div> 
<br/>
<div>
    <h1>Selecciona la imagen de tu producto:</h1>
    <div style="padding-left: 5%">
        <table><tr>
                <?php
                if (isset($error)) {
                    echo "<td>" . $error . "</td>";
                }
                ?>
                <td><h4>Imagen Actual: </h4></td>
            </tr>
            <tr>
                <td>
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
                </td>
            </tr>
            <?php echo form_open_multipart('miCuenta/guardarImagen'); ?>
            <?php echo form_hidden('producto[imagen]', $producto['imagen'], 'size ="40" id =""'); ?>
            <?php echo form_hidden('producto[nombre]', $producto['nombre'], 'size ="40" id =""'); ?>
            <?php echo form_hidden('producto[descripcion]', $producto['descripcion'], 'size ="40" id =""'); ?>
            <?php echo form_hidden('producto[fechaingreso]', $producto['fechaingreso'], 'size ="40" id =""'); ?>
            <?php echo form_hidden('producto[usuario_id]', $producto['usuario_id'], 'size ="40" id =""'); ?>
            <?php echo form_hidden('producto[categoria_id]', $producto['categoria_id'], 'size ="40" id =""'); ?>
            <?php echo form_hidden('producto_id', $producto['producto_id'], 'size ="40" id =""'); ?>
            <tr><td><input type="file" name="userfile" size="20" /></td></tr>
            <tr><td><input type="submit" value="Guardar Imagen" /></td></tr>
            <?php echo form_close() ?>
        </table>
    </div>
</div>