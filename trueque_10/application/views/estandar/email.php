<?php if(isset($errores)) print_r($errores); ?>
<?php 
	$atributos = array(
		'id' => 'formRegistroUsuario'
	); 
	echo form_open('usuarios/email', $atributos);
?>
<h1> Recuperacion de contraseña</h1>
<table id="registrar">
	<tr>
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
        <td><br/><input id = "registrarse" type="submit" value="Enviar" onclick="location.href='<?php echo base_url(); ?>'; return false;" /></td>
        <button id = "cancelar" onclick="location.href='<?php echo base_url(); ?>'; return false;"> Cancelar</button>
        <!--<input type= "button" name= "submitCancel"  value="Cancel" onclick="redirect('usuarios');”>-->
        <?php echo form_close();?>


    </tr>
<?php echo form_close();?>


