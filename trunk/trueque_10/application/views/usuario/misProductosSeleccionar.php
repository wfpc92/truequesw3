<div id ="miga"> 
    <?php 
        if($title != 'Productos Destacados'){
            echo anchor('productos/index','Inicio');
            echo " > ";
            echo "<strong> Truequeando</strong><br/></br>";
        }
    ?>
</div>
<br/>
<h1>¿Con cual de Tus Productos lo queres Truequear?</h1><br/>
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
                <?php echo form_open('miCuenta/enviarTrueque')?>
                <?php echo form_hidden('productoSolicita', $productoSolicita, 'size ="40" id =""'); ?>
                <?php echo form_hidden('productoEnvia', $producto->producto_id, 'size ="40" id =""'); ?>
                <td class="boton">
                    <input type="submit" value="Seleccionar" />
                </td>
                <?php echo form_close();?>
                </tr>
                <tr class="espacio">
            <td  colspan="3">
            <hr class="separador" />
            </td>
        </tr>
    <?php endforeach; ?>

<?php else: 
    $data['mensajeAprobacion']='No tienes Productos Publicados
        <br/> Ve a <a href=\'http://localhost/trueque_10/miCuenta/publicarProducto\'> Publicar Producto </a> para agregar
        uno <br/>a <a href=\'http://localhost/trueque_10/miCuenta\'>Tu lista de Publicaciones</a>';
$this->load->view('estandar/error',$data);
endif; ?>

</table>
<!---PAGINACION-->
<h2 class =" paginacion"><?php echo $paginacion; ?></h2>
    <!---FIN_PAGINACION-->

<div style="clear: both;">&nbsp;</div>