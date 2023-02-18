		

		<nav>
			<ul>
				<li><a href="index.php"><i class="fa-sharp fa-solid fa-house"></i> Inicio</a></li>
				<?php 
					if($_SESSION['rol'] == 1){
				?>
				<li class="principal">
					<a href="#"><i class="fa-solid fa-user-tie"></i> Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php"><i class="fa-solid fa-user-plus"></i> Nuevo Usuario</a></li>
						<li><a href="lista_usuario.php"><i class="fa-solid fa-users"></i> Lista de Usuarios</a></li>
					</ul>
				</li>
				<?php } ?>
				
				<li class="principal">
					<a href="#"><i class="fa-solid fa-users"></i> Clientes</a>
					<ul>
						<li><a href="registro_cliente.php"><i class="fa-solid fa-user-plus"></i> Nuevo Cliente</a></li>
						<li><a href="lista_clientes.php"><i class="fa-solid fa-users"></i> Lista de Clientes</a></li>
					</ul>
				</li>
						<?php 
							if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
						?>
				<li class="principal">
					<a href="#"><i class="fa-solid fa-truck-field"></i> Proveedores</a>
					<ul>
						<li><a href="registro_proveedo.php"><i class="fa-solid fa-truck-field"></i> Nuevo Proveedor</a></li>
						<li><a href="lista_proveedor.php"><i class="fa-solid fa-truck-field"></i> Lista de Proveedores</a></li>
			
					</ul>
				</li>
						<?php } ?>
						
				<li class="principal">
					<a href="#">Productos</a>
					<ul>
						<li><a href="registro_producto.php">Nuevo Producto</a></li>
						<li><a href="lista_producto.php">Lista de Producto</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#">Facturas</a>
					<ul>
						<li><a href="#">Nuevo Factura</a></li>
						<li><a href="#">Facturas</a></li>
					</ul>
				</li>
			</ul>
		</nav>