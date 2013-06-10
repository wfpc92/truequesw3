<ul>
                  <!----  <li><?php echo anchor('productos', 'Inicio') ?></li>
                    <li><?php echo anchor('administrar', 'Administrar') ?></li>
                    <li><a href="#">Como Funciona</a></li>
                    <li><a href="#">Cantactenos</a></li>--->
                <li <?php if(isset($activo) && $activo == 1) echo "class='activo'"; ?>><a href="<?php echo base_url(); ?>productos">Inicio</a></li>
		<li <?php if(isset($activo) && $activo == 2) echo "class='activo'"; ?>><a href="<?php echo base_url(); ?>administrar">Administrar</a></li>
                <li <?php if(isset($activo) && $activo == 3) echo "class='activo'"; ?>><a href="<?php echo base_url(); ?>comoFunciona">Como Funciona</a></li>		
</ul>