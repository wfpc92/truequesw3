<?php 
	$atributos = array(
		'id' => 'formRegistroUsuario'
	); 
	echo form_open('usuarios/registrar', $atributos);
?>
<div id ="miga">
    <?php echo anchor('productos/index','Inicio'); ?>
     > <strong>Registrate</strong>
</div>
<br/><br/>

<h1> Registro</h1>
</br>

<table id="registrar">
    <tr><td>(*)Datos Obligatorios</td></tr>
	<tr>
		<td><br/>* Nombre: </td>
		<td> <?php 
			$data_form = array(
                          'name'        => 'nombre',
                          'id'          => 'nombre',
                          'size'        => '40',
                          'value' => set_value('nombre')
                        );
                        echo form_error('nombre','<b><p style="color:red;">','</p></b>');
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
                        echo form_error('apellido','<b><p style="color:red;">','</p></b>');
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
                        echo form_error('email','<b><p style="color:red;">','</p></b>');
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
                        echo form_error('confirmaremail','<b><p style="color:red;">','</p></b>');
			echo form_input($data_form);?>
		</td>
	</tr>
	<tr>
            <td><br/><label for="contrasena">* Contraseña: </label><br/>
                <label>(Minimo 6 Caracteres)</label></td>
		<td><?php 
			$data_form = array(
                          'name'        => 'contrasena',
                          'id'          => 'contrasena',
                          'size'        => '40'
                        );
                        echo form_error('contrasena','<b><p style="color:red;">','</p></b>');
			echo form_password($data_form);?></td>
                <td><label>Obligatorio: Mayuscula, Minuscula,Numero y Especial</label></td>
	</tr>
	<tr>
		<td><br/><label for="confirmacontrasena">* Confirmar Contraseña: </label></td>
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
            <td><input  type="submit" value="Registrarme" /></td>
            <td><button id ="btnCancelarRegistro" onclick="location.href='<?php echo base_url(); ?>'; return false;"> Cancelar</button></td>
         </tr>
</table>
	 
<?php echo form_close();?>