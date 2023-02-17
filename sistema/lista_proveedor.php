	<?php 

		session_start();

		if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2){

			header ("location: ./");
		}

		include "../conexion.php";
		
	 ?>




	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<?php include "includes/scripts.php"; ?>
		<title>Lista de Proveedores</title>

	</head>
	<body>
		
		<?php include "includes/header.php"; ?>

		<section id="container">

				<h1><i class="fa-solid fa-truck-field"></i> Lista de Proveedores</h1>

				<a href="registro_proveedor.php" class="btn_new"><i class="fa-sharp fa-solid fa-user-plus"></i> Registrar Proveedor</a>

				<!--BUSCADOR!-->
				<form action="buscar_proveedor.php" method="get" class="form_search">
					
					<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
					<input type="submit" value="Buscar" class="btn_search">

				</form>

				<table>
					<tr>
						<th>Codigo de Proveedor</th>
						<th>Nombre</th>
						<th>Contacto</th>
						<th>Telefono</th>
						<th>Dirección</th>
						<th>Fecha</th>
						<th>Acciones</th>
					</tr>

					<?php 

					/*PAGINADOR*/

					$sql_register = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM proveedor WHERE estatus = 1");

					$result_register = mysqli_fetch_array($sql_register);

					$total_registro = $result_register['total_registro'];

					$por_pagina = 5;

					if(empty($_GET['pagina']))
					{
						$pagina = 1;
					}else{
						$pagina = $_GET['pagina'];
					}

					$desde = ($pagina -1) * $por_pagina;

					$total_pagina = ceil($total_registro / $por_pagina);

					/*********************/
						$query = mysqli_query($conection,"SELECT * FROM proveedor WHERE estatus =1 ORDER BY codproveedor LIMIT $desde,$por_pagina");

						$result = mysqli_num_rows($query);
						
						////***CIERRA LA CONEXION A LA BD*////
						mysqli_close($conection);

						if($result > 0){

							while ($data = mysqli_fetch_array($query)) {

								$formato = 'Y-m-d H:i:s';
								$fecha = DateTime::createFromFormat($formato,$data["date_add"])
						?>

					<tr>
						<td><?php echo $data["codproveedor"]; ?></td>
						<td><?php echo $data["proveedor"]; ?></td>
						<td><?php echo $data["contacto"]; ?></td>
						<td><?php echo $data["telefono"]; ?></td>
						<td><?php echo $data["direccion"]; ?></td>
						<td><?php echo $fecha->format('d-m-Y'); ?></td>
					
						<td>
							<a class="link_edit" href="editar_proveedor.php?id=<?php echo $data["codproveedor"];?>"><i class="fa-solid fa-file-pen"></i></a>
							
							<?php 
								if($_SESSION['rol'] == 1){
							?>
							<a class="link_delete" href="eliminar_confirmar_proveedor.php?id=<?php echo $data["codproveedor"];?>"><i class="fa-solid fa-trash"></i></a>
							<?php } ?>
						</td>
					</tr>

					<?php
						}
						
					 		}

					 ?>
	
				</table>

				<div class="paginador">
					
					<ul>

						<?php 

						if($pagina!= 1)
						{
						 ?>

						<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
						<li><a href="?pagina=<?php echo $pagina -1; ?>"><<</a></li>
					<?php 
						}
						for($i=1; $i <= $total_pagina; $i++){

							if($i == $pagina)
							{
								echo '<li class="pageSelected">'.$i.'</li>';
							}else{
								echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
							}
						}

						if($pagina != $total_pagina)
						{
					 ?>
											
						<li><a href="?pagina=<?php echo $pagina+1; ?>">>></a></li>
						<li><a href="?pagina=<?php echo $total_pagina; ?>">>|</a></li>
					<?php } ?>

					</ul>

				</div>	

		</section>

		<?php include "includes/footer.php"; ?>
	</body>
	</html>