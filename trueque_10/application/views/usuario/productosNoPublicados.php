<div id ="miga">
    <?php echo anchor('productos/index','Inicio'); ?>
     > 
    <?php echo anchor('miCuenta','Mi Cuenta'); ?>
     >
     <?php echo "<strong>" . $title . "</strong>";?>
</div>
<br/><br/>

<h1><?php echo $title ?></h1>
<br/>
<h2 class =" paginacion"><?php echo $paginacion; ?></h2>
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
                        </td><td>
    <table><tr>
                        <td class="boton">
                     <?php echo form_open('miCuenta/editarProducto')?>
                <?php echo form_hidden('producto_id', $producto->producto_id, 'size ="40"'); ?>
                    <input type="submit" value="Editar" />
            <?php echo form_close();?>
                </td>
                <td class="boton">
                    <?php echo form_open('miCuenta/borrarProducto')?>
                <?php echo form_hidden('producto_id', $producto->producto_id, 'size ="40"'); ?>
                    <input type="submit" value="Eliminar" />
            <?php echo form_close();?>
                </td>
        </tr>
                <tr>
                <td>
                    <?php echo form_open('miCuenta/darDeAlta')?>
                <?php echo form_hidden('producto_id', $producto->producto_id, 'size ="40"'); ?>
                    <input type="submit" value="Publicar" />
            <?php echo form_close();?>
                </td>
                </tr>
    </table></td>
    </tr>
        <tr class="espacio">
            <td  colspan="3">
            <hr class="separador" />
            </td>
        </tr>
    <?php endforeach; ?>

<?php else: ?>
    <h2>No Tienes Productos sin Publicar.</h2><br/>
<?php endif; ?>
</table>
<h2 class =" paginacion"><?php echo $paginacion; ?></h2>