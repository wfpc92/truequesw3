
<div id="contactenos" style="padding-left: 10%;">
			<h2><?php echo $titulo;?></h2>
                        <br/>
			<form action="">
			Nombre: <input type="text" name="firstname"></input><br/><br/>
			Apellido: <input type="text" name="lastname"></input><br/><br/>
			Correo Electronico: <input type="text" name="email"></input><br/><br/>
			<input type="radio" name="sex" value="male"></input>Hombre<br/><br/>
			<input type="radio" name="sex" value="female"></input>Mujer<br/><br/>
			Pais: <select name="Paises">
			<option value="Colombia" selected="selected">Colombia</option>
			<option value="Ecuador">Ecuador</option>
			<option value="Venezuela">Venezuela</option>
			<option value="Peru">Peru</option>
			<option value="Otro">Otro</option>
			</select>
			<br/>
			Ciudad: <input type="text" name="city"></input><br/><br/>
			<textarea rows="10" cols="30"> Escribe Aqui...
			</textarea>
			<br/>
			<input type="submit" value="Enviar"></input>
			<input type="reset" value="Borrar"></input>
			</form>
	 </div>