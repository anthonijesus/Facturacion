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

			if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['rol']))
			{
				$alert = '<p classe="msg_error"> Complete todos los campos</p>';
				
			}else{

				$idUsuario 	= $_POST['id'];
				$nombre 	= $_POST['nombre'];
				$email 		= $_POST['correo'];
				$user 		= $_POST['usuario'];
				$clave 		= md5($_POST['clave']);
				$rol 		= $_POST['rol'];
				

					 /* Validamos que el usuario no exista */
				$query_user = mysqli_query($conection, "SELECT * FROM usuario 
														WHERE (usuario = '$user' AND idusuario != $idUsuario) ");


				$result_user = mysqli_fetch_array($query_user);

					/* Validamos que el correo no exista */
				$query_correo = mysqli_query($conection, "SELECT * FROM usuario 
															WHERE (correo = '$email' AND idusuario != $idUsuario) ");

				$result_correo = mysqli_fetch_array($query_correo);

				if($result_user > 0){

					$alert = '<p classe="msg_error"> Usuario ya existente</p>';

				}else if ($result_correo > 0){
						$alert = '<p classe="msg_error"> Correo ya existente</p>';
				}else{
						if(empty($_POST['clave']))
						{
							$sql_update = mysqli_query($conection,"UPDATE usuario
																   SET nombre = '$nombre', correo = '$email', usuario = '$user', rol = '$rol' 
																	   WHERE idusuario = $idUsuario");
						}else{
								$sql_update = mysqli_query($conection,"UPDATE usuario
																	   SET nombre  = '$nombre', correo  = '$email', usuario ='$user', clave = '$clave', rol = '$rol' 
																	   WHERE idusuario = $idUsuario");

						}

						if($sql_update){

							$alert = '<p classe="msg_save"> Usuario actualizado correctamente</p>';

						}else{

							$alert = '<p classe="msg_errot"> Error al actualizar usuario</p>';
						}
					}
				}
			}

		//Cargar datos en formulario de edición//

		if(empty($_REQUEST['id'])){
			header('location: lista_usuario.php');
			
			////***CIERRA LA CONEXION A LA BD*////
			mysqli_close($conection);
		}

		$iduser = $_REQUEST['id'];

		$sql = mysqli_query($conection,"SELECT u.idusuario,u.nombre,u.correo,u.usuario, (u.rol) AS idrol,
						    (r.rol) AS rol 
							FROM usuario u
							INNER JOIN rol r
							ON u.rol = r.idrol
							WHERE idusuario= $iduser and estatus = 1");

				////***CIERRA LA CONEXION A LA BD*////
				mysqli_close($conection);

		$result_sql = mysqli_num_rows($sql);

		if($result_sql == 0){

			header('location: lista_usuario.php');
		}else{

			$option = '';
			while($data = mysqli_fetch_array($sql)) {
				
				$iduser 	= $data['idusuario'];
				$nombre 	= $data['nombre'];
				$correo 	= $data['correo'];
				$usuario 	= $data['usuario'];
				$idrol	 	= $data['idrol'];
				$rol 		= $data['rol'];

				/////Coloca tipo de ROL en el Formulario///////

				if($idrol == 1){
					$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
				}else if($idrol == 2){
					$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
				}else if($idrol == 3){
					$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
				}

			}
		}

	 ?>


	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<?php include "includes/scripts.php"; ?>
		<title>Editar Usuario</title>

	</head>
	<body>
		
		<?php include "includes/header.php"; ?>

		<section id="container">

			<div class="form_register">
				
				<h1>Editar Usuario</h1>
				<hr>
				<div class="alert">
					<?php echo isset($alert) ? $alert : ''; ?>
			</div>

		<form action="" method="post">
			 <input type="hidden" name="id" value="<?php echo $iduser; ?>">
			 <label for="nombre">Nombre</label>
	         <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" value="<?php echo $nombre; ?>">
	         <label for="correo">Correo Electronico</label>
	         <input type="email" name="correo" id="correo" placeholder="Correo Electronico" value="<?php echo $correo; ?>">
	         <label for="usuario">Usuario</label>
	         <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>">
	         <label for="clave">Clave</label>
	         <input type="password" name="clave" id="clave" placeholder="clave de acceso">
	         <label for="rol">Tipo Usuario</label>
	         
	         <?php 
	         	include "../conexion.php";
	         	$query_rol = mysqli_query($conection, "SELECT * FROM rol");

	         	////***CIERRA LA CONEXION A LA BD*////
				mysqli_close($conection);

	         	$result_rol = mysqli_num_rows($query_rol);

	         	        			

	          ?>
	         <select name="rol" id="rol" class="notItemOne">
	         		<?php 
	         			echo $option;
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

	         <input type="submit" value="editar usuario" class="btn_save">
	    </form>

			</div>
		</section>

		<?php include "includes/footer.php"; ?>
	</body>
	</html>



