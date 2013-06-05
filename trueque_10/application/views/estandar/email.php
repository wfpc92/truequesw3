<?php if(isset($errores)) print_r($errores); ?>
<?php 
	echo form_open('usuarios/enviarContrasena');
?>
<h1> Recuperacion de contraseña</h1>
<table id="recuperar contrasena">
    <tr>    <td><?php if(isset($errores)){
        echo $errores;
    }
?> </td>
		<td><br/>* E-mail: </td>
		<td> <?php
			$data_form = array(
                          'name'        => 'email',
                          'id'          => 'email',
                          'size'        => '40'
                        );
			echo form_input($data_form);?>
		</td>
	</tr>
</table>
	 <tr>
        <td><br/><input id = "registrarse" type="submit" value="Enviar"/></td>
        <button id = "cancelar" onclick="location.href='<?php echo base_url(); ?>'; return false;"> Cancelar</button>
        <!--<input type= "button" name= "submitCancel"  value="Cancel" onclick="redirect('usuarios');”>-->
        <?php echo form_close();?>
    </tr>
<?php echo form_close();?>


