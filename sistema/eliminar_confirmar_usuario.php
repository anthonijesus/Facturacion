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
		/*Evalua que el id usuario enviado por POST no sea el administrador*/
		
		if($_POST['idusuario'] == 1){
		header("location: lista_usuario.php");
		////***CIERRA LA CONEXION A LA BD***///
		mysqli_close($conection);

		exit;
		}

		/*****************************/
		
		$idusuario = $_POST['idusuario'];


		$query_delete = mysqli_query($conection,"UPDATE usuario SET estatus = 0 WHERE idusuario =$idusuario");

		////***CIERRA LA CONEXION A LA BD***///
		mysqli_close($conection);

		if($query_delete)
		{
			header("location: lista_usuario.php");
		}else{
			echo "Error al eliminar usuario";
		}

	}

	/****** Validacion del ID cuando hacemos clic en el boton eliminar *//////

	if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
		
		header("location: lista_usuario.php");

		////***CIERRA LA CONEXION A LA BD***///
		mysqli_close($conection);
	}else{

		$idusuario = $_REQUEST['id'];

		$query = mysqli_query($conection, "SELECT u.nombre,u.usuario,r.rol
											FROM usuario u
											INNER JOIN rol r
											ON u.rol = r.idrol
											WHERE u.idusuario = $idusuario and estatus = 1");

		////***CIERRA LA CONEXION A LA BD***///
		mysqli_close($conection);

		$result = mysqli_num_rows($query);

		if($result > 0){

			while ($data = mysqli_fetch_array($query)) {
				
				$nombre 	= $data['nombre'];
				$usuario 	= $data['usuario'];
				$rol 		= $data['rol'];
				}
			}else{

				header("location: lista_usuario.php");
		}
	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Usuario</title>

</head>
<body>
	
	<?php include "includes/header.php"; ?>

	<section id="container">
		
		<div class="data_delete">
			<h2> Seguro de eliminar el usuario? </h2>
			<p>Nombre: 				<span> <?php echo $nombre; ?></span></p>
			<p>Usuario: 			<span> <?php echo $usuario; ?></span></p>
			<p>Tipo de usuario: 	<span> <?php echo $rol; ?></span></p>

			<form method="post" action="">
				
				<input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
				<input type="submit" value="Aceptar" class="btn_ok">
				<a href="lista_usuario.php" class="btn_cancel">Cancelar</a>

			</form>

		</div>



	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>