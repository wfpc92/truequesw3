<?php if(isset($errorSesion)){echo $errorSesion;}?>
<form action="<?php echo base_url(); ?>usuarios/login/" method="post">
							<table >
							<tr><td align="right">E-mail: </td><td><input class="text" name="email" id='email' size="32" maxlength="64"/></td></tr>
							<tr><td align="right">Contraseña: </td><td><input type='password' class="text" name="contrasena" id='contrasena' size="32" maxlength="64" /></td></tr>
							<tr><td align="right"></td>
							<td><input class="button" value="Ingresar" type="submit" />
							<a href="<?php echo base_url(); ?>usuarios/registrar">Registrate</a><br/></td></tr>
							<tr><td align="right"></td>
							<td><a href="<?php echo base_url();?>usuarios/email/">¿Olvido Su Contraseña?</a></td></tr>
							</table>
</form>