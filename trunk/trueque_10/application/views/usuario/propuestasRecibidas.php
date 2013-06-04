<h2>Lista de Permutas</h2><br/>
<p><a href="#" class="more"><</a><a href="#" class="more">></a></p>


<div id="main" >
    <br/><br/>
    <ul>
        <?php
        if ($permutas != FALSE and $permutas->num_rows > 0):
            foreach ($permutas->result() as $permuta):
                ?>
                <li >
                    <table>
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
                            <td>
                                <h5>Te lo cambian por: </h5>

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

                        </tr>

                        <tr>
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
                        <tr>
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
                    </table>
                    <br/>

                </li>
                <hr/>
            <?php endforeach; ?>

        <?php else: ?>
            <p>Ningun Producto En La Base de datos</p>
        <?php endif; ?>
    </ul>
</div>



<p><a href="#" class="more"><</a><a href="#" class="more">></a></p>
<div style="clear: both;">&nbsp;</div>