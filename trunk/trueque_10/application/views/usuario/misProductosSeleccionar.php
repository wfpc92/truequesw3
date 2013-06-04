<h2>Selecciona Tu Producto</h2><br/>
        <p><a href="#" class="more"><</a><a href="#" class="more">></a></p>


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
                            <h3><?php echo $producto->p_nombre ?>
                                </a></h3>
                            <button><?php echo anchor('productos','Seleccionar')?></button>
                            <p>
                                <?php echo $producto->descripcion; ?><br/>
                                <?php echo $producto->categoria; ?><br/>
                                Fecha Publicaci&oacute;n: <?php echo $producto->fechaingreso; ?><br/>
                                <b>Propietario: </b><u><?php echo anchor('productos/verUsuario/' . $producto->u_id, $producto->u_nombre . ' ' . $producto->u_apellido); ?></u>
                        </p>
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