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
		
		if(empty($_POST['idproveedor']))
		{
			header("location: lista_proveedor.php");
			mysqli_close($conection);
		}

		$idproveedor = $_POST['idproveedor'];
		
		$query_delete = mysqli_query($conection,"UPDATE proveedor SET estatus = 0 WHERE codproveedor =$idproveedor");

		////***CIERRA LA CONEXION A LA BD***///
		mysqli_close($conection);

		if($query_delete)
		{
			header("location: lista_proveedor.php");
		}else{
			echo "Error al eliminar Proveedor";
		}

	}

	/****** Validacion del ID cuando hacemos clic en el boton eliminar *//////

	if(empty($_REQUEST['id']))
	{
		
		header("location: lista_proveedor.php");

		////***CIERRA LA CONEXION A LA BD***///
		mysqli_close($conection);
	}else{

		$idproveedor = $_REQUEST['id'];

		$query = mysqli_query($conection, "SELECT * FROM proveedor WHERE codproveedor = $idproveedor and estatus = 1");

		////***CIERRA LA CONEXION A LA BD***///
		mysqli_close($conection);

		$result = mysqli_num_rows($query);

		if($result > 0){

			while ($data = mysqli_fetch_array($query)) {
				
				$idproveedor	= $data['codproveedor'];
				$proveedor 		= $data['proveedor'];
				}
			}else{

				header("location: lista_proveedor.php");
		}
	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Proveedor</title>

</head>
<body>
	
	<?php include "includes/header.php"; ?>

	<section id="container">
		
		<div class="data_delete">
			<h2> Seguro de eliminar el Proveedor? </h2>
			<p>Nombre del Proveedor:	<span> <?php echo $proveedor; ?></span></p>
			<p>Codigo de Proveedor:		<span> <?php echo $idproveedor; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idproveedor" value="<?php echo $idproveedor; ?>">
				<a href="lista_proveedor.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Eliminar" class="btn_ok">		
			</form>

		</div>



	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>