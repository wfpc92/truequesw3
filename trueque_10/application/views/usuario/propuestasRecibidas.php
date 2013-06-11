<div id ="miga">
    <?php echo anchor('productos/index','Inicio'); ?>
     > 
    <?php echo anchor('miCuenta','Mi Cuenta'); ?>
     >
     <?php echo "<strong>" . $title . "</strong>";?>
</div>
<br/>
<h1><?php echo $title ?></h1><br/>
<h3 class =" paginacion"><?php echo $paginacion; ?></h3>
<table id="main" border="0" cellspacing="0">
        <?php
        if ($permutas != FALSE and $permutas->num_rows > 0):
            foreach ($permutas->result() as $permuta):
                ?>
                        <tr>
                            <td>
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
                                <h3>Te lo cambian por: </h3>

                            </td>
                            <td>
                                <?php
                                $image_properties = array(
                                    'src' => $permuta->sol_imagen,
                                    'alt' => $permuta->sol_nombre,
                                    'class' => 'resize_permuta',
                                );
                                echo anchor('productos/verProducto/' . $permuta->sol_producto_id, img($image_properties));
                                ?>

                            </td>
                            <td>
                                <table >

                                    <tr>
                                        <td>
                                            <?php
                                            $image_properties = array(
                                                'src' => 'images/aceptar.jpg',
                                                'alt' => 'ok',
                                                'float' => 'right',
                                                'class' => 'resize_rechazar_aceptar',
                                            );
                                            $peticion = $permuta->rec_producto_id . '.' . $permuta->sol_producto_id . '.' . $permuta->usu_recibe_id . '.' . $permuta->usu_solicita_id;
                                            echo anchor('permutas/permutar/' . $peticion, img($image_properties));
                                            ?>             
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>

                                            <?php
                                            $image_properties = array(
                                                'src' => 'images/rechazar.jpg',
                                                'alt' => 'rechazado',
                                                'class' => 'resize_rechazar_aceptar',
                                            );
                                            echo anchor('permutas/rechazar/' . $peticion,img($image_properties));
                                            ?>
                                        </td>
                                    </tr>
                                </table>




                            </td>

                        </tr >

                        <tr class="espacio">
                            <td align="center">
                                <?php echo anchor('productos/verProducto/' . $permuta->rec_producto_id, $permuta->rec_nombre); ?>                       

                            </td>
                            <td>

                            </td>
                            <td align="center">
                                <?php echo anchor('productos/verProducto/' . $permuta->sol_producto_id, $permuta->sol_nombre); ?>
                            </td>
                            <td>

                            </td>

                        </tr>
                        <tr class="espacio">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td align="center">
                                <?php echo anchor('productos/verUsuario/' . $permuta->sol_usu_id, $permuta->sol_usu_nombre . ' ' . $permuta->sol_usu_apellido); ?>
                            </td>
                            <td>

                            </td>
                        </tr>    
                        <tr><td class="espacio">
                <hr class="separador"/>
                        </td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
                <tr><td>
                <h2>No Tienes Mas Propuestas de Trueque Recibidas</h2>
                    </td></tr>
        <?php endif; ?>
                </table>
<div style="clear: both;">&nbsp;</div>
<h3 class =" paginacion"><?php echo $paginacion; ?></h3>
