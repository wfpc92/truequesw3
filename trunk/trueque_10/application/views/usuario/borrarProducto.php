<div id ="miga">
    <?php echo anchor('productos/index', 'Inicio'); ?>
    > <strong><?php echo anchor('miCuenta', 'Mi Cuenta');?></strong>
    > <strong>Eliminar Producto</strong>
</div>
<br/>
<h1><i>Confirma que desea borrar el siguiente producto: </i></h1><br/>
<div style="padding-left: 5%;">
    <h2><?php echo $producto->p_nombre; ?></h2><br/>
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
                    <td>
                        <p>
                            <b>Descripci&oacute;n: </b><?php echo $producto->descripcion; ?><br/><br/>
                            <b>Categor&iacute;a: </b><?php echo $producto->categoria; ?><br/><br/>
                            <b>Fecha Publicaci&oacute;n: </b><?php echo $producto->fechaingreso; ?><br/><br/>
                        </p>
                    </td>
                <?php else: ?>
                <p>No Existe producto</p>
            <?php endif; ?>
            <tr>
                <?php echo form_open('miCuenta/borrarProductoBd'); ?>
                <?php echo form_hidden('producto_id', $producto->producto_id, 'size ="40" id =""'); ?>
                <td></td>
                <td><input type="submit" value="Eliminar" /><button id = "cancelar" onclick="location.href='<?php echo base_url(); ?>/miCuenta'; return false;"  > Cancelar</button></td>
                <?php echo form_close(); ?>
            </tr>
        </table>
    </div>
</div>