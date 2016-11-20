
<?php

if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	
	require_once('../models/CONTROLADOR_Model.php'); 
	
	//Recoge los datos del formulario de la vista en un objeto 'Controlador'.
	function datosForm(){
		
		if(isset($_POST['accion'])){
			$accion = $_POST['accion'];
		}else{
			$accion = null;
		}
		$controlador = $_POST['controlador'];
		
		$cont = new Controlador($controlador, $accion);
		return $cont;
	}
	
	//Recoge del formulario los datos nuevos para modificar un controlador.
	function datosFormModificar(){

		$accion2 = $_POST['accionN'];
		$controlador2 = $_POST['controladorN'];
		
		$cont2 = new Controlador($controlador2, $accion2);
		return $cont2;
	}
	
	//Primero invoca a la vista correspondiente según la opción elegida en el menú.
	//Después invoca un método del modelo en función del parámetro pasado en la vista por get.
	//Finalmente muestra un mensaje de error o confirmación tras acceder a la BD y redirige a la vista.
	if(isset($_GET['id'])){
		$action = $_GET['id'];
		switch($action){
			
			case 'altaControlador':
				if(!isset($_POST['accion'])){
					header("location: ../views/CONTROLADOR_AÑADIR_Vista.php");
				}else{
					$cont = datosForm();
					$mensaje = $cont->crear(); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/CONTROLADOR_AÑADIR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'bajaControlador':
				if(!isset($_POST['accion']) && !isset($_POST['controlador'])){
					header("location: ../views/CONTROLADOR_BORRAR_Vista.php");
				}else{
					$cont = datosForm();
					$mensaje = $cont->borrar(); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/CONTROLADOR_BORRAR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'modificarControlador':
				if(!isset($_POST['accion'])){
					header("location: ../views/CONTROLADOR_EDITAR_Vista.php");
				}else{
					$cont = datosForm();
					$cont2 = datosFormModificar();
					$mensaje = $cont->modificar($cont2); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/CONTROLADOR_EDITAR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'consultarControlador':
				header("location: ../views/CONTROLADOR_LISTAR_Vista.php");
				break;
		}
	}
}else echo "Permiso denegado.";

?>