<?php 
	
	/***CON ESTE CODIGO VALIDAMOS QUE EL USUARIO LOGEADO NO TENGA ACCESO A LAS FUNCIONES DE ADMINISTRADOR*/
		session_start();
		if($_SESSION['rol'] != 1){

			header ("location: ./");
		}
		///**********///

	include "../conexion.php";


	/******* Accion del boton aceptar del formulario de eliminar *//////

	if(!empty($_POST))
	{
		
		if(empty($_POST['idcliente']))
		{
			header("location: lista_clientes.php");
			mysqli_close($conection);
		}

		$idcliente = $_POST['idcliente'];
		
		$query_delete = mysqli_query($conection,"UPDATE cliente SET estatus = 0 WHERE idcliente =$idcliente");

		////***CIERRA LA CONEXION A LA BD***///
		mysqli_close($conection);

		if($query_delete)
		{
			header("location: lista_clientes.php");
		}else{
			echo "Error al eliminar cliente";
		}

	}

	/****** Validacion del ID cuando hacemos clic en el boton eliminar *//////

	if(empty($_REQUEST['id']))
	{
		
		header("location: lista_clientes.php");

		////***CIERRA LA CONEXION A LA BD***///
		mysqli_close($conection);
	}else{

		$idcliente = $_REQUEST['id'];

		$query = mysqli_query($conection, "SELECT * FROM cliente WHERE idcliente = $idcliente and estatus = 1 ");

		////***CIERRA LA CONEXION A LA BD***///
		mysqli_close($conection);

		$result = mysqli_num_rows($query);

		if($result > 0){

			while ($data = mysqli_fetch_array($query)) {
				
				$rut 		= $data['rut'];
				$nombre 	= $data['nombre'];
				}
			}else{

				header("location: lista_clientes.php");
		}
	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Cliente</title>

</head>
<body>
	
	<?php include "includes/header.php"; ?>

	<section id="container">
		
		<div class="data_delete">
			<h2> Seguro de eliminar el Cliente? </h2>
			<p>Nombre del Cliente:		<span> <?php echo $nombre; ?></span></p>
			<p>Rut: 					<span> <?php echo $rut; ?></span></p>

			<form method="post" action="">
				
				<input type="hidden" name="idcliente" value="<?php echo $idcliente; ?>">
				<a href="lista_clientes.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Eliminar" class="btn_ok">
				

			</form>

		</div>



	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>