<h2>Productos Destacados</h2><br/>

<div id="main" >
    <?php
    if ($productos != FALSE and $productos->num_rows > 0):
        foreach ($productos->result() as $producto):
            ?>
            <div style=" padding-top: 2%; padding-bottom: 2%; overflow: hidden;">
                <div style=" float: left;">
                    <?php
                    $image_properties = array(
                        'src' => $producto->imagen,
                        'alt' => $producto->p_nombre,
                        'class' => 'resize',
                        'width' => '300',
                        'height' => '200'
                    );
                    echo img($image_properties);
                    ?>
                </div>
                <div style=" float: right;">
                    <br/>
                    <h3><?php echo anchor('productos/verProducto/' . $producto->producto_id, $producto->p_nombre); ?>
                    </h3>
                    <p>
                        <?php echo $producto->descripcion; ?><br/>
                        <?php echo $producto->categoria; ?><br/>
                        Fecha Publicaci&oacute;n: <?php echo $producto->fechaingreso; ?><br/>
                        <b>Propietario: </b><u><?php echo anchor('productos/verUsuario/' . $producto->u_id, $producto->u_nombre . ' ' . $producto->u_apellido); ?></u>
                    </p>
                </div >
                <div style=" float: right;">
                    <button><?php echo anchor('miCuenta/truequear/' . $producto->producto_id, 'truequear') ?></button>
                </div>
            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <p>Ningun Producto En La Base de datos</p>
    <?php endif; ?>
</div>
<!---PAGINACION-->
<p class =" paginacion"><?php echo $this->pagination->create_links(); ?></ p>
    <!---FIN_PAGINACION-->

<div style="clear: both;">&nbsp;</div>