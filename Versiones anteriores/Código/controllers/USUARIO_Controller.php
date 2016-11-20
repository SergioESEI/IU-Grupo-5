
<?php

if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	
	require_once('../models/USUARIO_Model.php'); 
	
	//Recoge los datos del formulario de la vista en un objeto 'usuario'.
	function datosForm(){
		
		$usuario = $_POST['usuario'];
		if(isset($_POST['password'])){
			$password = $_POST['password'];
		}else{
			$password = null;
		}
		if(isset($_POST['grupo'])){
			$grupo = $_POST['grupo'];
		}else{
			$grupo = null;
		}
		if(isset($_POST['nombre'])){
			$nombre = $_POST['nombre'];
		}else{
			$nombre = null;
		}
		if(isset($_POST['apellidos'])){
			$apellidos = $_POST['apellidos'];
		}else{
			$apellidos = null;
		}
		if(isset($_POST['dni'])){
			$dni = $_POST['dni'];
		}else{
			$dni = null;
		}
		if(isset($_POST['telefono'])){
			$telefono = $_POST['telefono'];
		}else{
			$telefono = null;
		}
		if(isset($_POST['email'])){
			$email = $_POST['email'];
		}else{
			$email = null;
		}
		
		$usuario = new usuario($dni,$password,$grupo,$usuario,$nombre,$apellidos,$email,$telefono);
		return $usuario;
	}
	
	//Recoge del formulario los datos nuevos para modificar un usuario.
	function datosFormModificar(){
		
		$dni2 = $_POST['dniN'];
		$password2 = $_POST['passwordN'];
		$grupo2 = $_POST['grupoN'];
		$usuario2 = $_POST['usuarioN'];
		$nombre2 = $_POST['nombreN'];
		$apellidos2 = $_POST['apellidosN'];
		$email2 = $_POST['emailN'];
		$telefono2 = $_POST['telefonoN'];
		
		$usuario2 = new usuario($dni2,$password2,$grupo2,$usuario2,$nombre2,$apellidos2,$email2,$telefono2);
		return $usuario2;
	}
	
	//Primero invoca a la vista correspondiente según la opción elegida en el menú.
	//Después invoca un método del modelo en función del parámetro pasado en la vista por get.
	//Finalmente muestra un mensaje de error o confirmación tras acceder a la BD y redirige a la vista.
	if(isset($_GET['id'])){
		$action = $_GET['id'];
		switch($action){
			
			case 'altaUsuario':
				if(!isset($_POST['usuario'])){
					header("location: ../views/USUARIO_AÑADIR_Vista.php");
				}else{
					$usuario = datosForm();
					$mensaje = $usuario->crear(); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/USUARIO_AÑADIR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'bajaUsuario':
				if(!isset($_POST['usuario'])){
					header("location: ../views/USUARIO_BORRAR_Vista.php");
				}else{
					$usuario = datosForm();
					$mensaje = $usuario->borrar(); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/USUARIO_BORRAR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'modificarUsuario':
				if(!isset($_POST['usuario'])){
					header("location: ../views/USUARIO_EDITAR_Vista.php");
				}else{
					$usuario = datosForm();
					$usuario2 = datosFormModificar();
					$mensaje = $usuario->modificar($usuario2); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/USUARIO_EDITAR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'consultarUsuario':
				header("location: ../views/USUARIO_LISTAR_Vista.php");
				break;
		}
	}
}else echo "Permiso denegado.";

?>