<html>
	<head>	
		<title> Login</title>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/login.css" rel="stylesheet">
	</head>	
	
    <body>	 
	
	<!-- Formulario que recoge los datos de login -->
	<div class="container">
        <div class="card card-container">
			<form class="form-signin" accept-charset="UTF-8" method="POST" action="installBD.php">
				<fieldset>
					<h1 class="form-signin-heading text-muted">Instalar BD</h1>
					
					<!-- Campo que recoge el user del usuario -->
					<div class="form-group">
					<h2><small>Usuario:</h2></small>
					<input type="text" name="usuario" class="form-control" required autofocus>
					</div>
					
					<!-- Campo que recoge el password del usuario -->
					<div class="form-group">
					<h2><small>Password:</h2></small>
					<input type="password" name="password" class="form-control" required><br>
					</div>
					
					<!-- Sumbit que envía user y password -->
					<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">CREAR</button>
				</fieldset>
			</form>
		</div>
    </div>
	</body>	
</html>	

<?php



//Crea la BD.
if(isset($_POST['usuario'])){
	
	$user=$_POST['usuario'];
	$password=$_POST['password'];
	//$password=md5($password); // Encriptamos el password
	shell_exec("mysql -u ".$_POST['usuario']." -p".$_POST['password']." < bd/MOOVETT.sql");

}
?>
