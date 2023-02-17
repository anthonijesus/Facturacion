	<?php 

		session_start();
		
		if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2){

			header ("location: ./");
		}
		include "../conexion.php";

		if(!empty($_POST)){

			$alert='';

			if(empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']) || empty($_POST['direccion']))
			{
				$alert = '<p classe="msg_error"> Complete todos los campos</p>';
				
			}else{

				$proveedor 		= $_POST['proveedor'];
				$contacto 		= $_POST['contacto'];
				$telefono 		= $_POST['telefono'];
				$direccion 		= $_POST['direccion'];
				$usuario_id 	= $_SESSION['idUser'];

		

					$query_insert = mysqli_query($conection, "INSERT INTO proveedor(proveedor,contacto,telefono,direccion,usuario_id) VALUES('$proveedor','$contacto','$telefono','$direccion','$usuario_id')");

					if($query_insert){
							$alert = '<p classe="msg_save"> Proveedor registrado correctamente</p>';
						}else{
							$alert = '<p classe="msg_errot"> Error al registrar proveedor</p>';
					}
				}
				////***CIERRA LA CONEXION A LA BD*////
				mysqli_close($conection);
			}
				

	 ?>



	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<?php include "includes/scripts.php"; ?>
		<title>Registro de Cliente</title>

	</head>
	<body>
		
		<?php include "includes/header.php"; ?>

		<section id="container">

			<div class="form_register">
				
				<h1><i class="fa-solid fa-truck-field"></i> Registro de Proveedor</h1>
				<hr>
				<div class="alert">
					<?php echo isset($alert) ? $alert : ''; ?>
			</div>

		<form action="" method="post">
			 <label for="proveedor">Proveedor</label>
	         <input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor">
			 <label for="contacto">Nombre</label>
	         <input type="text" name="contacto" id="contacto" placeholder="Nombre Completo">
	         <label for="telefono">Telefono</label>
	         <input type="number" name="telefono" id="telefono" placeholder="Telefono">
	         <label for="direccion">Direccion</label>
	         <input type="text" name="direccion" id="direccion" placeholder="Direccion">
	         
	         <input type="submit" value="Registrar Proveedor" class="btn_save">

	    </form>

			</div>
		</section>

		<?php include "includes/footer.php"; ?>
	</body>
	</html>



