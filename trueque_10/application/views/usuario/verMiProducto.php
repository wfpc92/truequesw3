<div id ="miga">
    <?php echo anchor('productos/index','Inicio'); ?>
     > 
    <?php echo anchor('miCuenta','Mi Cuenta'); ?>
     >
     <?php echo "<strong>ver Producto</strong>"; ?>
</div>   
<br/>
<h1><?php echo $producto->p_nombre; ?></h1><br/>
<div style="padding-left: 5%;">   
<div id="item" >
    <table>
        <tr>
            <td valign="top">
                 <?php
                if (count($producto) > 0):
                    $image_properties = array(
                        'src' => $producto->imagen,
                        'alt' => $producto->p_nombre,
                        'class' => 'resize',
                    );
                    echo img($image_properties);
                    ?>               
            </td>
            <td style="padding-left: 10px;">
                <p>
                <b>Descripci&oacute;n: </b><?php echo $producto->descripcion; ?><br/><br/>
                <b>Categor&iacute;a: </b><?php echo $producto->categoria; ?><br/><br/>
                <b>Fecha Publicaci&oacute;n: </b><?php echo $producto->fechaingreso; ?><br/><br/>               
            </p>    
            </td>
        </tr>
        <tr ><td></td><td colspan="2">
        <table><tr>
                            <td>
                                <?php echo form_open('miCuenta/editarProducto') ?>
                                <?php echo form_hidden('producto_id', $producto->producto_id, 'size ="40"'); ?>
                                <input type="submit" value="Editar" />
                                <?php echo form_close(); ?>
                            </td>
                            <td>
                                <?php echo form_open('miCuenta/borrarProducto') ?>
                                <?php echo form_hidden('producto_id', $producto->producto_id, 'size ="40"'); ?>
                                <input type="submit" value="Eliminar" />
                                <?php echo form_close(); ?>
                            </td>
                            <td>
                                <?php echo form_open('miCuenta/darDeBaja') ?>
                                <?php echo form_hidden('producto_id', $producto->producto_id, 'size ="40"'); ?>
                                <input type="submit" value="Dejar de Publicar" />
                                <?php echo form_close(); ?>
                            </td>
                        </tr>
        </table></td>
    </tr>
    </table>
    <?php else: ?>
        <p>No Existe producto</p>
    <?php endif; ?>
</div>
</div>