<?php $atributos = array(
		'id' => 'formCambiarContrasena'
	);
        echo form_open('miCuenta/nuevaContrasena', $atributos);?>
<h1> Cambiar Contrase&ntilde;a</h1>
</br>
<table id="registrar">
<tr>
		<td><br/><label for="contrasena">* Nueva Contraseña: </label></td>
		<td><?php 
			$data_form = array(
                          'name'        => 'contrasena',
                          'id'          => 'contrasena',
                          'size'        => '40'
                        );
                        echo form_error('contrasena','<b><p style="color:red;">','</p></b>');
			echo form_password($data_form);?></td>
	</tr>
	<tr>
		<td><br/><label for="confirmacontrasena">* Confirmar Nueva Contraseña: </label></td>
		<td><?php
			$data_form = array(
                          'name'        => 'confirmarcontrasena',
                          'id'          => 'confirmarcontrasena',
                          'size'        => '40'
                        ); 
                        echo form_error('confirmarcontrasena','<b><p style="color:red;">','</p></b>');
			echo form_password($data_form);?></td>
	</tr>
</table>
<table id ="btnRegistro">
        <tr>
            <td><input  type="submit" value="Cambiar Contrasena" /></td>
            <td><button id ="btnCancelarRegistro" onclick="location.href='<?php echo base_url(); ?>'; return false;"> Cancelar</button></td>
         </tr>
</table>
<?php echo form_close();?>
