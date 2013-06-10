<h2><?php echo $producto->p_nombre; ?></h2><br/>

<div id="item" >
    <div style="float: left; width: 50%; height: 100%">
        <?php
        if (count($producto) > 0):
            $image_properties = array(
                'src' => $producto->imagen,
                'alt' => $producto->p_nombre,
                'class' => 'resize',
            );
            echo img($image_properties);
            ?>
        </div>
        <div style="float: right; width: 50%; height: 100%">
            <p>
                <b>Descripci&oacute;n: </b><?php echo $producto->descripcion; ?><br/><br/>
                <b>Categor&iacute;a: </b><?php echo $producto->categoria; ?><br/><br/>
                <b>Fecha Publicaci&oacute;n: </b><?php echo $producto->fechaingreso; ?><br/><br/>
                <b>Propietario: </b><?php echo anchor('productos/verUsuario/' . $producto->u_id, $producto->u_nombre . ' ' . $producto->u_apellido); ?>
            </p>
            <?php echo form_open('miCuenta/truequear')?>
                <?php echo form_hidden('productoSolicita', $producto->producto_id, 'size ="40" id =""'); ?>
                    <input type="submit" value="Truequear" />
            <?php echo form_close();?>
        </div>
    <?php else: ?>
        <p>No Existe producto</p>
    <?php endif; ?>
</div>
<div style="clear: both;">&nbsp;</div>