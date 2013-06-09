<?php if(isset($errores)) print_r($errores); ?>
<?php 
	echo form_open('usuarios/enviarContrasena');
?>
<div id ="miga">
    <?php echo anchor('productos/index','Inicio'); ?>
     > <strong>Olvido su contraseña?</strong>
</div>
</br></br>


<h1> Recuperacion de contraseña</h1>
<table id="recuperarContrasena">
    <tr>
        <td>
            (*)Dato Obligatorio
        </td>
    </tr>
    <tr> 
        <tr>
            <td><?php if(isset($errores)){
                 echo $errores;
                }
                ?> 
            </td>
        </tr>
	<td>* E-mail: </td>
	<td> 
            <?php
		$data_form = array(
                    'name'        => 'email',
                    'id'          => 'email',
                    'size'        => '40'
                 );
                echo form_input($data_form);?>
	</td>
    </tr>
</table>
<table id = "btnRegistro">
	 <tr>
            <td><input  type="submit" value="Enviar"/></td>
            <td><button id = "cancelar" onclick="location.href='<?php echo base_url(); ?>'; return false;"> Cancelar</button></td>
             <!--<input type= "button" name= "submitCancel"  value="Cancel" onclick="redirect('usuarios');”>-->
        <?php echo form_close();?>
    </tr>
<?php echo form_close();?>
</table>


