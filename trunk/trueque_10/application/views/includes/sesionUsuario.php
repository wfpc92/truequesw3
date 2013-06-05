<div id="estiloSesion">
    <div style="float:left">
    <div>
        <?php echo "<h3>Hola     " . $usuarioActual['nombre'] . " </h3>";?>
    </div>
    <div>
        <?php echo anchor('usuarios/logout', 'cerrar sesion');?>
    </div>
    </div>
    <div style="float:right">
<?php $image_properties = array(
    'src' => $usuarioActual['avatar'],
    'alt' => $usuarioActual['nombre'],
    'class' => 'resize',
    'width' => '50',
    'height' => '50',
);
echo img($image_properties);?>
    </div>
    <div style="clear: both;"></div>
</div>