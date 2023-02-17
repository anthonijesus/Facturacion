	<?php 

		/***CON ESTE CODIGO VALIDAMOS QUE EL USUARIO LOGEADO NO TENGA ACCESO A LAS FUNCIONES DE ADMINISTRADOR*/
		session_start();
		if($_SESSION['rol'] != 1){

			header ("location: ./");
		}
		///**********///
		
		include "../conexion.php";

		if(!empty($_POST)){

			$alert='';

			if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['rol']))
			{
				$alert = '<p classe="msg_error"> Complete todos los campos</p>';
				
			}else{


				$nombre = $_POST['nombre'];
				$email 	= $_POST['correo'];
				$user 	= $_POST['usuario'];
				$clave 	= md5($_POST['clave']);
				$rol 	= $_POST['rol'];
				
							
				$query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' ");

				////***CIERRA LA CONEXION A LA BD*////
				mysqli_close($conection);

				$result = mysqli_fetch_array($query);

				if($result > 0){

					$alert = '<p classe="msg_error"> Correo o Usuario ya existen</p>';

				}else{
						$query_insert = mysqli_query($conection, "INSERT INTO usuario(nombre,correo,usuario,clave,rol) VALUES('$nombre','$email','$user','$clave','$rol')");

						if($query_insert){

							$alert = '<p classe="msg_save"> Usuario registrado correctamente</p>';

						}else{

							$alert = '<p classe="msg_errot"> Error al crear usuario</p>';
						}
				}
			}

		}

	 ?>



	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<?php include "includes/scripts.php"; ?>
		<title>Registro de Usuarios</title>

	</head>
	<body>
		
		<?php include "includes/header.php"; ?>

		<section id="container">

			<div class="form_register">
				
				<h1><i class="fa-sharp fa-solid fa-id-card"></i> Registro de Usuarios</h1>
				<hr>
				<div class="alert">
					<?php echo isset($alert) ? $alert : ''; ?>
			</div>

		<form action="" method="post">
			 <label for="nombre">Nombre</label>
	         <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
	         <label for="correo">Correo Electronico</label>
	         <input type="email" name="correo" id="correo" placeholder="Correo Electronico">
	         <label for="usuario">Usuario</label>
	         <input type="text" name="usuario" id="usuario" placeholder="Usuario">
	         <label for="clave">Clave</label>
	         <input type="password" name="clave" id="clave" placeholder="clave de acceso">
	         <label for="rol">Tipo Usuario</label>
	         
	         <?php 

	         	$query_rol = mysqli_query($conection, "SELECT * FROM rol");

				////***CIERRA LA CONEXION A LA BD*////
				mysqli_close($conection);	         	

	         	$result_rol = mysqli_num_rows($query_rol);

	         	        			

	          ?>
	         <select name="rol" id="rol">

	         		<?php 

	         			if($result_rol > 0)
	         			{
	         				while ($rol = mysqli_fetch_array($query_rol)){
	         		?>
	         		
	         		<option value="<?php echo $rol["idrol"];?>"><?php echo $rol["rol"]; ?></option>

	         		<?php			
	         				}
	         			}
	         		 ?>
	         </select>

	         <button type="submit" class="btn_save"><i class="fa-solid fa-floppy-disk"></i> Registrar </button>
	    </form>

			</div>
		</section>

		<?php include "includes/footer.php"; ?>
	</body>
	</html>



