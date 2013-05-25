<?php
if (count($usuarios) > 0): 
    foreach ($usuarios->result() as $usuario):
        ?>
       <?php echo $usuario->usuario_id; ?>
       <?php echo $usuario->nombre; ?>
       <?php echo $usuario->apellido; ?>
       <?php echo $usuario->email; ?>
       <?php echo $usuario->nivel; ?>
        </br>
    <?php endforeach; ?>
<?php else: ?>
<?php endif; ?>