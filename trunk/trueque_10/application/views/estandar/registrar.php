<?php if(isset($errores)) print_r($errores); ?>
<?php 
	$atributos = array(
		'id' => 'formRegistroUsuario'
	); 
	echo form_open('usuarios/registrar', $atributos);
?>
<h1> Registro</h1>
<table id="registrar">
	<tr>
		<td><br/>* Nombre: </td>
		<td> <?php 
			$data_form = array(
                          'name'        => 'nombre',
                          'id'          => 'nombre',
                          'size'        => '40',
                          'value' => set_value('nombre')
                        );
			echo form_input($data_form);?>
		</td>
	</tr>
	<tr>
		<td><br/><label for="apellido">* Apellido: </label></td>
		<td><?php 
			$data_form = array(
                          'name'        => 'apellido',
                          'id'          => 'apellido',
                          'size'        => '40',
                          'value' => set_value('apellido')
                        );
			echo form_input($data_form);?>
		</td>
	</tr>
	<tr>
		<td><br/><label for="email">* E-mail: </label></td>
		<td><?php
			$data_form = array(
                          'name'        => 'email',
                          'id'          => 'email',
                          'size'        => '40',
                          'value' => set_value('email')
                        ); 
			echo form_input($data_form);?>
		</td>
	</tr>
	<tr>
		<td><br/><label for="email">* Confirmar E-mail: </label></td>
		<td><?php
			$data_form = array(
                          'name'        => 'confirmaremail',
                          'id'          => 'confirmaremail',
                          'size'        => '40'
                        ); 
			echo form_input($data_form);?>
		</td>
	</tr>
	<tr>
		<td><br/><label for="contrasena">* Contraseña: </label></td>
		<td><?php 
			$data_form = array(
                          'name'        => 'contrasena',
                          'id'          => 'contrasena',
                          'size'        => '40'
                        );
			echo form_password($data_form);?></td>
	</tr>
	<tr>
		<td><br/><label for="confirmacontrasena">* Confirmar Contraseña: </label></td>
		<td><?php
			$data_form = array(
                          'name'        => 'confirmarcontrasena',
                          'id'          => 'confirmarcontrasena',
                          'size'        => '40'
                        ); 
			echo form_password($data_form);?></td>
	</tr>	
</table>
	 <tr>
        <td><br/><input id = "registrarse" type="submit" value="Registrarme" /></td>
        <button id = "cancelar" onclick="location.href='<?php echo base_url(); ?>'; return false;"> Cancelar</button>
    </tr>
<?php echo form_close();?>