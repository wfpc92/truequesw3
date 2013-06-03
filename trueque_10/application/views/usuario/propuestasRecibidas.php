<h2>Lista de Permutas</h2><br/>
        <p><a href="#" class="more"><</a><a href="#" class="more">></a></p>


        <div id="main" >
            <br/><br/>
            <ul>
                <?php
                if ($permutas!= FALSE and $permutas->num_rows> 0): 
                    foreach ($permutas->result() as $permuta):
                        ?>
                        <li >
                            
                            <br/>
                            <h3><?php echo anchor('productos/verProducto/'.$permuta->producto_recibe, $permuta->producto_recibe); ?>
                            </h3>
                            <h3><?php echo anchor('productos/verProducto/'.$permuta->producto_solicita, $permuta->producto_solicita); ?>
                            </h3>
                            <h3><?php echo anchor('productos/verProducto/'.$permuta->fechapermuta, $permuta->fechapermuta); ?>
                            </h3>
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