<div id ="miga">
    <?php echo anchor('productos/index', 'Inicio'); ?>
    > <strong>Mi Cuenta</strong>
</div>
<br/>
<h1><?php echo $title ?></h1>
<h3 class =" paginacion"><?php echo $paginacion; ?></h3>
<table id="main" border="0" cellspacing="0">
    <br/>
    <br/>
    <tr>
        <?php
        if ($productos != FALSE and $productos->num_rows > 0):
            foreach ($productos->result() as $producto):
                ?>
                <td>
                    <?php
                    $image_properties = array(
                        'src' => $producto->imagen,
                        'alt' => $producto->p_nombre,
                        'class' => 'resize',
                    );
                    echo img($image_properties);
                    ?>
                </td>
                <td class="descripcion">
                    <br/>
                    <h3><?php echo anchor('miCuenta/verMiProducto/' . $producto->producto_id, $producto->p_nombre); ?>
                    </h3>
                    <br/>
                    <b>Categoria: </b><?php echo $producto->categoria; ?><br/>
                    <b>Fecha Publicaci&oacute;n: </b><?php echo $producto->fechaingreso; ?><br/>
                </td><td>
                    <table><tr>
                            <td class="boton">
                                <?php echo form_open('miCuenta/editarProducto') ?>
                                <?php echo form_hidden('producto_id', $producto->producto_id, 'size ="40"'); ?>
                                <input type="submit" value="Editar" />
                                <?php echo form_close(); ?>
                            
                                <?php echo form_open('miCuenta/borrarProducto') ?>
                                <?php echo form_hidden('producto_id', $producto->producto_id, 'size ="40"'); ?>
                                <input type="submit" value="Eliminar" />
                                <?php echo form_close(); ?>
                            
                                <?php echo form_open('miCuenta/darDeBaja') ?>
                                <?php echo form_hidden('producto_id', $producto->producto_id, 'size ="40"'); ?>
                                <input type="submit" value="Dejar de Publicar" />
                                <?php echo form_close(); ?>
                            </td>
                        </tr>
                    </table></td>
            </tr>
            <tr class="espacio">
                <td  colspan="3">
                    <hr class="separador" />
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        <h2>Aun no Tienes Productos Publicados.</h2><br/>
        <h3>Has <?php echo anchor('miCuenta/publicarProducto', 'Click Aqui'); ?> para agregar un Producto a tus Publicaciones</h3>
    <?php endif; ?>
</table>
<h3 class =" paginacion"><?php echo $paginacion; ?></h3>