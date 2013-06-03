<h2>Productos Destacados</h2><br/>
      
        <div id="main" >
            <br/><br/>
            <ul>
                <?php
                if ($productos!= FALSE and $productos->num_rows> 0): 
                    foreach ($productos->result() as $producto):
                        ?>
                        <li >
                            <?php
                            $image_properties = array(
                                'src' => $producto->imagen,
                                'alt' => $producto->p_nombre,
                                'class' => 'resize',
                            );
                            echo img($image_properties);
                            ?>
                            <br/>
                            <h3><?php echo anchor('productos/verProducto/'.$producto->producto_id, $producto->p_nombre); ?>
                            </h3>
                            <button><?php echo anchor('miCuenta/truequear/'.$producto->producto_id,'truequear')?></button>
                            <p>
                                <?php echo $producto->descripcion; ?><br/>
                                <?php echo $producto->categoria; ?><br/>
                                Fecha Publicaci&oacute;n: <?php echo $producto->fechaingreso; ?><br/>
                                <b>Propietario: </b><u><?php echo anchor('productos/verUsuario/' . $producto->u_id, $producto->u_nombre . ' ' . $producto->u_apellido); ?></u>
                        </p>
                        </li>
                        <hr/>
                    <?php endforeach; ?>

                <?php else: ?>
                    <p>Ningun Producto En La Base de datos</p>
                <?php endif; ?>
            </ul>
        </div>
         <!---PAGINACION-->
       <p class =" paginacion"><?php echo $this->pagination->create_links(); ?></ p>
        <!---FIN_PAGINACION-->
       
        <div style="clear: both;">&nbsp;</div>