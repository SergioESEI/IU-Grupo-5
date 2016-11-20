<html>
	<head>	
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
		<style>		
			html {
			  background-image: url('images/background.jpg');
			}
		</style>
	</head>	

    <body>	  
	<!-- Formulario que recoge los datos de login -->
	<div class="container">
		<div class="row vertical-offset-100">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">MOOVETT</h3>
					</div>
					<div class="panel-body">
						<form accept-charset="UTF-8" role="form" method="POST" action="login.php">
						<fieldset>
							<div class="form-group">Usuario
							<input type="text" name="dni" class="form-control" pattern="([0-9]{8})" title="Formato de DNI inválido" required autofocus>
							</div>
							<div class="form-group">Password
							<input type="password" name="password" class="form-control"  pattern=".{6,}" maxlength="16"  required><br>
							</div>
							<input class="btn btn-lg btn-success btn-block" type="submit" value="ENTRAR">
						</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	</body>	
</html>	

<?php


//Carga en una variable de sesión los permisos del usuario.
function cargarPermisos($user){
	
	$db = new mysqli('localhost','root','iu','MOOVETT');
	
	$sql = "SELECT controlador,accion FROM Permisos P, Trabajador T WHERE T.dni='".$user."' AND P.grupo=T.grupo;";
	$result=$db->query($sql);
	if ($result->num_rows > 0){
		return $result->fetch_array();
	}else{
		return null;
	}
}

//Busca al usuario en la BD y vuelve al index si existe.
if(isset($_POST['dni'])){
	
	$db = new mysqli('localhost','root','iu','MOOVETT');
	
	$dni=$_POST['dni'];
	$password=$_POST['password'];
	$password=md5($password); // Encriptamos el password
	$sql="SELECT grupo FROM Trabajador WHERE dni='$dni' and password='$password'";
	$result=$db->query($sql);	
	
	//Se crean variables de sesión para el usuario, grupo al que pertenece y permisos.
	if($result->num_rows == 1){
		session_start();
		$_SESSION['user'] = $dni;
		$array = $result->fetch_array();
		$_SESSION['grupo'] = $array[0];
		if(cargarPermisos($dni) != null){
			$_SESSION['permisos'] = cargarPermisos($dni);
		}
		header("location: index.php");
	}else{
		echo "El usuario no existe.";
	}
}
?>
