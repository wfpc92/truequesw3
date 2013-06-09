<div id ="miga">
    <?php echo anchor('productos/index','Inicio'); ?>
     > <strong>Mi Cuenta</strong>
</div>
</br></br>

<h1><?php echo $title ?></h1>
</br>
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
                    <button><?php echo anchor('miCuenta/editarProducto/'.$producto->producto_id, 'Editar') ?></button>
                </li>
                <li style="width: 20%; float: right; padding-right: 5%;">
                    <button><?php echo anchor('miCuenta/borrarProducto/'.$producto->producto_id, 'Eliminar') ?></button>
                </li>
                <li style="width: 20%; float: right; padding-right: 5%;">
                    <button><?php echo anchor('miCuenta/darDeBaja/'.$producto->producto_id, 'Dejar de Publicar') ?></button>
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