<ul id="sidebar">
			<li>
				<h2>Informacion</h2>
				<p>En esta seccion se puede ver informacion acerca de los productos que han sido publicados y pueden ser intercambiados.</p>
			</li>
			<li>
				<h2>Categorias</h2>
				<ul>
					<?php echo anchor('productos','<li>Todas las Categorias</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Antiguedades','<li>Antiguedades</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Camaras','<li>Camaras</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Casas','<li>Casas</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Celulares','<li>Celulares</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Cine','<li>Cine</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Computadores','<li>Computadores</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Deporte','<li>Deporte</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Electrodomesticos','<li>Electrodomesticos</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Joyas','<li>Joyas</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Juguetes','<li>Juguetes</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Libros','<li>Libros</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Musica','<li>Musica</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Vehiculos','<li>Vehiculos</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Videojuegos','<li>Videojuegos</li>')?>
                                        <?php echo anchor('productos/getProductosSide/Otros','<li>Otros</li>')?>
				</ul>
			</li>
		</ul>