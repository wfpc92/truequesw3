<div id="estiloSesion"><?php
	echo "<h3>Hola     ".$usuarioActual['nombre']." </h3>";
	echo anchor('usuarios/logout','cerrar sesion');
        ?>
    <div style="clear: both;"></div>
</div>