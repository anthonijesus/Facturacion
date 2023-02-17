	<?php 

		session_start();
		
		include "../conexion.php";

		if(!empty($_POST)){

			$alert='';

			if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion']))
			{
				$alert = '<p classe="msg_error"> Complete todos los campos</p>';
				
			}else{

				$rut 		= $_POST['rut'];
				$nombre 	= $_POST['nombre'];
				$telefono 	= $_POST['telefono'];
				$direccion 	= $_POST['direccion'];
				$usuario_id = $_SESSION['idUser'];


				$result = 0;

				if(is_numeric($rut) || $rut == 0)
				{
					$query = mysqli_query($conection, "SELECT * FROM cliente WHERE rut = '$rut' ");

					$result = mysqli_fetch_array($query);

				}

				if($result > 0)
				{
					$alert = '<p classe="msg_error"> RUT ya existente</p>';
				}else{

					$query_insert = mysqli_query($conection, "INSERT INTO cliente(rut,nombre,telefono,direccion,usuario_id) VALUES('$rut','$nombre','$telefono','$direccion','$usuario_id')");

					if($query_insert){
							$alert = '<p classe="msg_save"> cliente registrado correctamente</p>';
						}else{
							$alert = '<p classe="msg_errot"> Error al registrar cliente</p>';
					}
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
				
				<h1><i class="fa-solid fa-user-plus"></i> Registro de Cliente</h1>
				<hr>
				<div class="alert">
					<?php echo isset($alert) ? $alert : ''; ?>
			</div>

		<form action="" method="post">
			 <label for="rut">RUT</label>
	         <input type="number" name="rut" id="rut" placeholder="Nro. RUT">
			 <label for="nombre">Nombre</label>
	         <input type="text" name="nombre" id="nombre" placeholder="Nombre">
	         <label for="telefono">Telefono</label>
	         <input type="number" name="telefono" id="telefono" placeholder="Telefono">
	         <label for="direccion">Direccion</label>
	         <input type="text" name="direccion" id="direccion" placeholder="Direccion">
	         
	         <input type="submit" value="Registrar Cliente" class="btn_save">

	    </form>

			</div>
		</section>

		<?php include "includes/footer.php"; ?>
	</body>
	</html>



