<div id ="miga">
    <?php echo anchor('productos/index','Inicio'); ?>
     > 
    <?php echo anchor('miCuenta','Mi Cuenta'); ?>
     >
     <?php echo "<strong>" . $title . "</strong>";?>
</div>
<br/>
<h1><?php echo $title; ?></h1><br/>
<h3 class =" paginacion"><?php echo $paginacion; ?></h3>
<table id="main" border="0" cellspacing="0">
        <?php
        if ($permutas != FALSE and $permutas->num_rows > 0):
            foreach ($permutas->result() as $permuta):
                ?>
                <tr>
                            <td align="center">
                                <?php
                                $image_properties = array(
                                    'src' => $permuta->sol_imagen,
                                    'alt' => $permuta->sol_nombre,
                                    'class' => 'resize_permuta',
                                );
                                echo anchor('productos/verProducto/' . $permuta->sol_producto_id, img($image_properties));
                                ?>
                                <br/>
                                 <h4><?php echo anchor('productos/verProducto/' . $permuta->sol_producto_id, $permuta->sol_nombre); ?></h4>
                          
                            </td>
                            <td align="center">
                                <h3>Lo quieres cambiar por: </h3>

                            </td>
                            <td align="center"> 
                                <?php
                                $image_properties = array(
                                    'src' => $permuta->rec_imagen,
                                    'alt' => $permuta->rec_nombre,
                                    'class' => 'resize_permuta',
                                );
                                echo anchor('productos/verProducto/' . $permuta->rec_producto_id, img($image_properties));
                                ?>
                                <br/>
                                <h4><?php echo anchor('productos/verProducto/' . $permuta->rec_producto_id, $permuta->rec_nombre); ?></h4>       
                               <h4>Propietario: <?php echo anchor('productos/verUsuario/' . $permuta->rec_usu_id, $permuta->rec_usu_nombre . ' ' . $permuta->rec_usu_apellido); ?></h4>
                            
                            </td>
                            
                            

                        </tr>
                <tr class="espacio">
            <td  colspan="3">
            <hr class="separador" />
            </td>
        </tr>
            <?php endforeach; ?>
        <?php else: ?>
        <tr><td>
            <h2>No has Enviado Propuestas de Trueque</h2>
            </td></tr>
        <?php endif; ?>
 </table>
<div style="clear: both;">&nbsp;</div>
<h3 class =" paginacion"><?php echo $paginacion; ?></h3>
