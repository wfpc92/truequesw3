<div id="main" >
    <br/><br/>
    <ul>
        <?php
        if ($productos != FALSE and $productos->num_rows > 0):
            foreach ($productos->result() as $producto):
                ?>
                <li>
                    <ul style="display: inline-block;">
                        <li style="width: 50%; float: left;">
                            <?php
                            $image_properties = array(
                                'src' => $producto->imagen,
                                'alt' => $producto->p_nombre,
                                'class' => 'resize',
                            );
                            echo img($image_properties);
                            ?>
                        </li>
                        <li style="width: 30%; float: left; padding-right: 20%;">
                            <br/>
                            <h3><?php echo anchor('productos/verProducto/' . $producto->producto_id, $producto->p_nombre); ?>
                            </h3>
                            <br/>
                            <b>Categoria: </b><?php echo $producto->categoria; ?><br/>
                            <b>Fecha Publicaci&oacute;n: </b><?php echo $producto->fechaingreso; ?><br/>
                        </li>
                <li style="width: 20%; float: right; padding-right: 5%;">
                <?php echo form_open('miCuenta/enviarTrueque')?>
                <?php echo form_hidden('productoSolicita', $productoSolicita, 'size ="40" id =""'); ?>
                <?php echo form_hidden('productoEnvia', $producto->producto_id, 'size ="40" id =""'); ?>
                <li style="width: 20%; float: right; padding-right:5%; ">
                    <input type="submit" value="Seleccionar" />
                </li>
                <?php echo form_close();?>
                </li>
            </ul>
        </li>
        <li>
            <hr class="separador"/>
        </li>
    <?php endforeach; ?>

<?php else: ?>
    <p>Ningun Producto En La Base de datos</p>
<?php endif; ?>
</ul>
</div>
<p class =" paginacion"><?php echo $paginacion; ?></ p>