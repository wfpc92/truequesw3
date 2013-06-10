<ul id="sidebar">
			<li>
				<h2>Informacion</h2>
				<p>Aqui podras configurar la aplicacion</p>
			</li>
			<li>
				<h2>Administrar</h2>
				<ul>
					<li><?php echo anchor('administrar','Usuarios')?></li>
                                        <li><?php echo anchor('administrar/seleccionarAnio','Estadistica Trueques')?></li>
                                        <li><?php echo anchor('administrar/seleccionarAnioP','Estadistica Publicaciones')?></li>
                                        <li><?php echo anchor('administrar/todosTrueques','Trueques Realizados')?></li>
                                        <li><?php echo anchor('administrar/todosTrueques','Mensajes Recibidos')?></li>
                                </ul>
			</li>
		</ul>