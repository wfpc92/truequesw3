        <div id="main" >
            <br/><br/>
            <ul>
                <?php
                if($productos!=FALSE and $productos->num_rows > 0):
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
                                </a></h3>
                            <p>
                                <?php echo $producto->descripcion; ?><br/>
                                <?php echo $producto->categoria; ?><br/>
                                Fecha Publicaci&oacute;n: <?php echo $producto->fechaingreso; ?><br/></p>
                                <br/>
                        </li>
                        <hr/>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No has publicado ningun producto</p>
                <?php endif; ?>
            </ul>
        </div>
        <div style="clear: both;">&nbsp;</div>