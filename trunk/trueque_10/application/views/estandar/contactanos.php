
<div id ="miga">
    <?php echo anchor('productos/index','Inicio'); ?>
     > <strong>Contactenos</strong>
</div>
<br/>
			<h1><?php echo $titulo;?></h1>
                        <div id="contactenos" style="padding-left: 5%;">
                        <br/>
			<form action="">
                            <table>
                                <tr>
                                    <td>Nombre: </td>
                                    <td><input type="text" name="firstname"></input></td>
                                </tr>
                                <tr>
                                    <td>Apellido: </td>
                                    <td><input type="text" name="lastname"></input></td>
                                </tr>
                                <tr>
                                    <td>Correo Electronico: </td>
                                    <td><input type="text" name="email"></input></td>
                                </tr>
                                <tr>
                                    <td>G&eacute;nero:</td>
                                    <td><input type="radio" name="sex" value="male"></input>Hombre &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="female"></input>Mujer</td>
                                </tr>
                                <tr>
                                    <td>Pais: </td>
                                    <td><select name="Paises">
                                        <option value="Colombia" selected="selected">Colombia</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Otro">Otro</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Ciudad:</td>
                                    <td><input type="text" name="city"></input></td>
                                </tr>
                                <tr>
                                    <td valign="top" style="padding-top: 5px;" >Mensaje: </td>
                                    <td><textarea rows="10" cols="30"> Escribe Aqui...
                                        </textarea></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center"><input type="submit" value="Enviar"></input>
			<input type="reset" value="Borrar"></input></td>
                                </tr>
                                
                            </table>
			
			
			</form>
	 </div>