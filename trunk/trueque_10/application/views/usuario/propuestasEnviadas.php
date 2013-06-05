<h2>Lista de Permutas Enviadas</h2><br/>
<p><a href="#" class="more"><</a><a href="#" class="more">></a></p>


<div id="main" >
    <br/><br/>
    <ul>
        <?php
        if ($permutas != FALSE and $permutas->num_rows > 0):
            foreach ($permutas->result() as $permuta):
                ?>
                <li ><center>
                    <table >
                        <tr>
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
                                <h5>Lo quieres cambiar por: </h5>

                            </td>
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
                            
                            

                        </tr>

                        <tr>
                            <td align="center">
                                <?php echo anchor('productos/verProducto/' . $permuta->sol_producto_id, $permuta->sol_nombre); ?>
                            </td>
                            <td>

                            </td>
                            <td align="center">
                                <?php echo anchor('productos/verProducto/' . $permuta->rec_producto_id, $permuta->rec_nombre); ?>                       

                            </td>

                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td align="center">
                                <?php echo anchor('productos/verUsuario/' . $permuta->rec_usu_id, $permuta->rec_usu_nombre . ' ' . $permuta->rec_usu_apellido); ?>
                            </td>
                        </tr>    
                    </table></center>
                    <br/>

                </li>
                <hr class="separador"/>
            <?php endforeach; ?>

        <?php else: ?>
            <p>Ningun Producto En La Base de datos</p>
        <?php endif; ?>
    </ul>
</div>



<p><a href="#" class="more"><</a><a href="#" class="more">></a></p>
<div style="clear: both;">&nbsp;</div>