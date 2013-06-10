<ul>
                   <!----- <li><?php echo anchor('productos', 'Inicio') ?></li>
                    <li><a href="#">Como Funciona</a></li>
                    <li><a href="#">Cantactenos</a></li>---->
                    
                    
                <li <?php if(isset($activo) && $activo == 1) echo "class='activo'"; ?>><a href="<?php echo base_url(); ?>productos">Inicio</a></li>
                <li <?php if(isset($activo) && $activo == 3) echo "class='activo'"; ?>><a href="<?php echo base_url(); ?>">Como Funciona</a></li>
		<li <?php if(isset($activo) && $activo == 4) echo "class='activo'"; ?>><a href="<?php echo base_url(); ?>contactenos">Contactenos</a></li>
		
</ul>