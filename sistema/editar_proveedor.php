	<?php 
		
		session_start();
		
		if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2) {

			header ("location: ./");
		}

		include "../conexion.php";

		if(!empty($_POST)){

			$alert='';

			if(empty($_POST['proveedor']) || empty($_POST['contacto'])|| empty($_POST['telefono']) || empty($_POST['direccion']))
			{
				$alert = '<p classe="msg_error"> Complete todos los campos</p>';
				
			}else{

				$idproveedor 		= $_POST['id'];
				$proveedor 			= $_POST['proveedor'];
				$contacto 			= $_POST['contacto'];
				$telefono 			= $_POST['telefono'];
				$direccion 			= $_POST['direccion'];
			
						
				$sql_update = mysqli_query($conection,"UPDATE proveedor
													   SET proveedor = '$proveedor', contacto = '$contacto', telefono = '$telefono', direccion = '$direccion' 
													    WHERE codproveedor = $idproveedor");
						
						if($sql_update){

							$alert = '<p classe="msg_save"> Proveedor actualizado correctamente</p>';

						}else{

							$alert = '<p classe="msg_errot"> Error al actualizar Proveedor</p>';
						}
					}
			}

		//Cargar datos en formulario de edición//

		if(empty($_REQUEST['id'])){
			header('location: lista_proveedor.php');
			
			////***CIERRA LA CONEXION A LA BD*////
			mysqli_close($conection);
		}

		$idproveedor = $_REQUEST['id'];

		$sql = mysqli_query($conection,"SELECT * FROM proveedor WHERE codproveedor = $idproveedor and estatus = 1");

				////***CIERRA LA CONEXION A LA BD*////
				mysqli_close($conection);

		$result_sql = mysqli_num_rows($sql);

		if($result_sql == 0){

			header('location: lista_proveedor.php');
		}else{

			while($data = mysqli_fetch_array($sql)) {
				
				$idproveedor 	= $data['codproveedor'];
				$proveedor 		= $data['proveedor'];
				$contacto 		= $data['contacto'];
				$telefono 		= $data['telefono'];
				$direccion 		= $data['direccion'];
			}
		}

	 ?>


	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<?php include "includes/scripts.php"; ?>
		<title>Editar Proveedor</title>

	</head>
	<body>
		
		<?php include "includes/header.php"; ?>

		<section id="container">

			<div class="form_register">
				
				<h1>Editar Proveedor</h1>
				<hr>
				<div class="alert">
					<?php echo isset($alert) ? $alert : ''; ?>
			</div>

		<form action="" method="post">
			 <input type="hidden" name="id" value="<?php echo $idproveedor; ?>">
			 <label for="proveedor">Proveedor</label>
	         <input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor" value="<?php echo $proveedor; ?>">
			 <label for="contacto">Nombre</label>
	         <input type="text" name="contacto" id="contacto" placeholder="Nombre Completo" value="<?php echo $contacto; ?>">
	         <label for="telefono">Telefono</label>
	         <input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">
	         <label for="direccion">Direccion</label>
	         <input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $direccion; ?>">
	         
	         <input type="submit" value="Editar Proveedor" class="btn_save">

	    </form>

			</div>
		</section>

		<?php include "includes/footer.php"; ?>
	</body>
	</html>



