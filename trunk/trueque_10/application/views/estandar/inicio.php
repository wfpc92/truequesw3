<div id ="miga"> 
    <?php 
        if($title != 'Productos Destacados'){
            echo anchor('productos/index','Inicio');
            echo " > ";
            echo "<strong>".$title."</strong><br/></br>";
        }
    ?>
</div>
</br>
<h1><?php echo $title; ?></h1><br/>

<div id="main" >
    <br/><br/>
    <ul style="width: 100%;">
        <?php
        if ($productos != FALSE and $productos->num_rows > 0):
            foreach ($productos->result() as $producto):
                ?>
                <li>
                    <ul style="display: inline-block;">
                        <li style="width: 50%; float: left;">
                            <?php
                            $image_properties = array(
                                'id'=> 'imagenProducto',
                                'src' => $producto->imagen,
                                'alt' => $producto->p_nombre,
                                'class' => 'resize',
                            );
                            echo img($image_properties);
                            ?>
                        </li>
                        <li style=" width: 40%;float: left; margin-left: 10%">
                            <br/>
                            <h3><?php echo anchor('productos/verProducto/' . $producto->producto_id, $producto->p_nombre); ?>
                            </h3>
                            <br/>
                            <b>Categoria: </b><?php echo $producto->categoria; ?><br/>
                            <b>Fecha Publicaci&oacute;n: </b><?php echo $producto->fechaingreso; ?><br/>
                            <b>Propietario: </b>
                        <u><?php echo anchor('productos/verUsuario/' . $producto->u_id, $producto->u_nombre . ' ' . $producto->u_apellido); ?></u>
                </li>
                <?php echo form_open('miCuenta/truequear')?>
                <?php echo form_hidden('productoSolicita', $producto->producto_id, 'size ="40" id =""'); ?>
                <li style="width: 5%; float: right;">
                    <input type="submit" value="Truequear" />
                </li>
                <?php echo form_close();?>
            </ul>
        </li>
        <li>
            <hr class="separador"/>
        </li>
    <?php endforeach; ?>

<?php else: ?>
    <p>Ningun Producto En La Base de datos</p>
<?php endif; ?>
</ul>
</div>
<!---PAGINACION-->
<p class =" paginacion"><?php echo $paginacion; ?></ p>
    <!---FIN_PAGINACION-->

<div style="clear: both;">&nbsp;</div>