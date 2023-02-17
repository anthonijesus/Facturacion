	<?php 
		
		session_start();
		
		include "../conexion.php";

		if(!empty($_POST)){

			$alert='';

			if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['direccion']))
			{
				$alert = '<p classe="msg_error"> Complete todos los campos</p>';
				
			}else{

				$idcliente 		= $_POST['id'];
				$rut 			= $_POST['rut'];
				$nombre 		= $_POST['nombre'];
				$telefono 		= $_POST['telefono'];
				$direccion 		= $_POST['direccion'];
			

					 /* Validamos que el rut no exista */

				$result = 0;

				if(is_numeric($rut) and $rut == 0){

					$query = mysqli_query($conection, "SELECT * FROM cliente 
														WHERE (rut = '$rut' AND idcliente != $idcliente) ");
								
				$result = mysqli_fetch_array($query);


				}

				if($result > 0){

					$alert = '<p classe="msg_error"> Rut ya existente</p>';

				}else{

						if($rut == '')
						{
							$rut = 0;
						}

						
							$sql_update = mysqli_query($conection,"UPDATE cliente
																   SET rut = '$rut', nombre = '$nombre', telefono = '$telefono', direccion = '$direccion' 
																   WHERE idcliente = $idcliente");
						
						if($sql_update){

							$alert = '<p classe="msg_save"> Cliente actualizado correctamente</p>';

						}else{

							$alert = '<p classe="msg_errot"> Error al actualizar Cliente</p>';
						}
					}
				}
			}

		//Cargar datos en formulario de edición//

		if(empty($_REQUEST['id'])){
			header('location: lista_clientes.php');
			
			////***CIERRA LA CONEXION A LA BD*////
			mysqli_close($conection);
		}

		$idcliente = $_REQUEST['id'];

		$sql = mysqli_query($conection,"SELECT * FROM cliente WHERE idcliente = $idcliente and estatus = 1");

				////***CIERRA LA CONEXION A LA BD*////
				mysqli_close($conection);

		$result_sql = mysqli_num_rows($sql);

		if($result_sql == 0){

			header('location: lista_clientes.php');
		}else{

			while($data = mysqli_fetch_array($sql)) {
				
				$idcliente 	= $data['idcliente'];
				$rut 		= $data['rut'];
				$nombre 	= $data['nombre'];
				$telefono 	= $data['telefono'];
				$direccion 	= $data['direccion'];
			}
		}

	 ?>


	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<?php include "includes/scripts.php"; ?>
		<title>Editar Cliente</title>

	</head>
	<body>
		
		<?php include "includes/header.php"; ?>

		<section id="container">

			<div class="form_register">
				
				<h1>Editar Cliente</h1>
				<hr>
				<div class="alert">
					<?php echo isset($alert) ? $alert : ''; ?>
			</div>

		<form action="" method="post">
			 <input type="hidden" name="id" value="<?php echo $idcliente; ?>">
			 <label for="rut">RUT</label>
	         <input type="number" name="rut" id="rut" placeholder="Nro. RUT" value="<?php echo $rut; ?>">
			 <label for="nombre">Nombre</label>
	         <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
	         <label for="telefono">Telefono</label>
	         <input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">
	         <label for="direccion">Direccion</label>
	         <input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $direccion; ?>">
	         
	         <input type="submit" value="Actualizar Cliente" class="btn_save">

	    </form>

			</div>
		</section>

		<?php include "includes/footer.php"; ?>
	</body>
	</html>



