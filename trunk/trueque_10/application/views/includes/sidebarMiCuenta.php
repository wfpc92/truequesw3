<ul>
				<li><a href="#" class="more"> Inicio</a><br/><br/>
			<li>
				<h2>Informacion</h2>
				<p>Aqui encontraras informacion sobre tu cuenta, productos y trueques</p>
			</li>
			<li>
				<h2>Mi Cuenta</h2>
				<ul>
					<li><?php echo anchor('miCuenta','Mis Productos')?></li>
					<li><?php echo anchor('miCuenta/publicarProducto','Publicar Producto')?></li>
					<li><?php echo anchor('permutas/index','Propuestas Recibidas')?></li>
					<li><?php echo anchor('permutas/permutasEnviadas','Propuestas Enviadas')?></li>
                                        <li><?php echo anchor('miCuenta/editarInformacion','Editar Informacion')?></li>
				</ul>
			</li>
		</ul>