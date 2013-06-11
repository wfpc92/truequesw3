<ul>
				
			<li>
				<h2>Informacion</h2>
				<p>Aqui encontraras informacion sobre tu cuenta, productos y trueques, ademas que podras administrar esta informacion segun tus necesidades.</p>
			</li>
			<li>
                            <h2>Mi Cuenta</h2>
				<ul>
                                        <li <?php if (isset($sideSelect) && $sideSelect==0){echo "class=\"seleccionar\"";}?>><?php echo anchor('miCuenta','Productos Publicados')?></li>
					<li <?php if (isset($sideSelect) && $sideSelect==1){echo "class=\"seleccionar\"";}?>><?php echo anchor('miCuenta/productosNoPublicados','Productos sin Publicar')?></li>
                                        <li <?php if (isset($sideSelect) && $sideSelect==2){echo "class=\"seleccionar\"";}?>><?php echo anchor('miCuenta/publicarProducto','Publicar Producto')?></li>
					<li <?php if (isset($sideSelect) && $sideSelect==3){echo "class=\"seleccionar\"";}?>><?php echo anchor('permutas/index','Propuestas Recibidas')?></li>
					<li <?php if (isset($sideSelect) && $sideSelect==4){echo "class=\"seleccionar\"";}?>><?php echo anchor('permutas/permutasEnviadas','Propuestas Enviadas')?></li>
                                        <li <?php if (isset($sideSelect) && $sideSelect==5){echo "class=\"seleccionar\"";}?>><?php echo anchor('miCuenta/editarInformacion','Editar Informacion')?></li>
                                        <li <?php if (isset($sideSelect) && $sideSelect==6){echo "class=\"seleccionar\"";}?>><?php echo anchor('miCuenta/donacion','Realizar Donacion')?></li>
				</ul>
			</li>
		</ul>