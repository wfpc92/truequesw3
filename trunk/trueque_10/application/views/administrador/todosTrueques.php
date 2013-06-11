<div id ="miga">
    <?php echo anchor('productos/index', 'Inicio'); ?>
    > <?php echo anchor('administrar/index', 'Administrar'); ?>
    ><strong>Estadistica Trueques</strong>
</div>
<br/>
<h1>Todos los trueques</h1><br/>
<h2 class ="paginacion"><?php echo $paginacion; ?></h2>
<div style="padding-left: 5%;">
<table id="main" border="0" cellspacing="0">
        <?php
        if ($permutas != FALSE and $permutas->num_rows > 0):
            foreach ($permutas->result() as $permuta):
                ?>
                        <tr>
                            <td align="center">
                                <?php
                                $image_properties = array(
                                    'src' => $permuta->rec_imagen,
                                    'alt' => $permuta->rec_nombre,
                                    'class' => 'resize_permuta',
                                );
                                echo anchor('productos/verProducto/' . $permuta->rec_producto_id, img($image_properties));
                                ?>

                            </td>
                            <td align="center">
                                <h3>se ha Truequeado por </h3>

                            </td>
                            <td align="center">
                                <?php
                                $image_properties = array(
                                    'src' => $permuta->sol_imagen,
                                    'alt' => $permuta->sol_nombre,
                                    'class' => 'resize_permuta',
                                );
                                echo anchor('productos/verProducto/' . $permuta->sol_producto_id, img($image_properties));
                                ?>

                            </td>

                        </tr>

                        <tr class="espacio">
                            <td align="center">
                                <?php echo anchor('productos/verProducto/' . $permuta->rec_producto_id, $permuta->rec_nombre); ?>                       

                            </td>
                            <td>

                            </td>
                            <td align="center">
                                <?php echo anchor('productos/verProducto/' . $permuta->sol_producto_id, $permuta->sol_nombre); ?>
                            </td>

                        </tr>
                        <tr class="espacio"><td>
                <hr class="separador"/></tr><td>
            <?php endforeach; ?>
        <?php else: ?>
                            <tr><td><h2>Ningun Producto En La Base de datos</h2></td></tr>
        <?php endif; ?>
</table>
<h2 class ="paginacion" align ="center"><?php echo $paginacion; ?></h2>
<div style="clear: both;">&nbsp;</div>
</div>