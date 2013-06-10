<div id ="miga"> 
    <?php 
        if($title != 'Productos Destacados'){
            echo anchor('productos/index','Inicio');
            echo " > ";
            echo "<strong>".$title."</strong><br/></br>";
        }
    ?>
</div>
<br/>
<h1><?php echo $title ?></h1>
<h2 class =" paginacion" align="left"><?php echo $paginacion; ?></h2>
<table id="main" border="0" cellspacing="0">
    <br/><br/>
    <tr>
        <?php
        if ($productos != FALSE and $productos->num_rows > 0):
            foreach ($productos->result() as $producto):
                ?>
                        <td>
                            <?php
                            $image_properties = array(
                                'id'=> 'imagenProducto',
                                'src' => $producto->imagen,
                                'alt' => $producto->p_nombre,
                                'class' => 'resize',
                            );
                            echo img($image_properties);
                            ?>
                        </td>
                        <td class="descripcion">
                            <br/>
                            <h3><?php echo anchor('productos/verProducto/' . $producto->producto_id, $producto->p_nombre); ?>
                            </h3>
                            <br/>
                            <b>Categoria: </b><?php echo $producto->categoria; ?><br/>
                            <b>Fecha Publicaci&oacute;n: </b><?php echo $producto->fechaingreso; ?><br/>
                            <b>Propietario: </b>
                        <u><?php echo anchor('productos/verUsuario/' . $producto->u_id, $producto->u_nombre . ' ' . $producto->u_apellido); ?></u>
                </td>
                <?php echo form_open('miCuenta/truequear')?>
                <?php echo form_hidden('productoSolicita', $producto->producto_id, 'size ="40" id =""'); ?>
                <td class="boton">
                    <input type="submit" value="Truequear" />
                </td>
                <?php echo form_close();?>
                </tr>
                <tr class="espacio">
            <td  colspan="3">
            <hr class="separador" />
            </td>
        </tr>
    <?php endforeach; ?>

<?php else: ?>
    <h3>No se han Encontrado Productos</h3>
<?php endif; ?>

</table>
<!---PAGINACION-->
<h2 class =" paginacion"><?php echo $paginacion; ?></h2>
    <!---FIN_PAGINACION-->

<div style="clear: both;">&nbsp;</div>