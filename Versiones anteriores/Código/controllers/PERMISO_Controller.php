
<?php

if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	
	require_once('../models/PERMISO_Model.php'); 
	
	//Recoge los datos del formulario de la vista en un objeto 'Permiso'.
	function datosForm(){
		
		if(isset($_POST['accion'])){
			$accion = $_POST['accion'];
		}else{
			$accion = null;
		}
		$controlador = $_POST['controlador'];
		$grupo = $_POST['grupo'];
		
		$permiso = new permiso($grupo,$controlador,$accion);
		return $permiso;
	}
	
	//Recoge del formulario los datos nuevos para modificar un permiso.
	function datosFormModificar(){
		
		$grupo2 = $_POST['grupoN'];
		$accion2 = $_POST['accionN'];
		$controlador2 = $_POST['controladorN'];
		
		$permiso2 = new permiso($grupo2,$controlador2, $accion2);
		return $permiso2;
	}
	
	//Primero invoca a la vista correspondiente según la opción elegida en el menú.
	//Después invoca un método del modelo en función del parámetro pasado en la vista por get.
	//Finalmente muestra un mensaje de error o confirmación tras acceder a la BD y redirige a la vista.
	if(isset($_GET['id'])){
		$action = $_GET['id'];
		switch($action){
			
			case 'altaPermiso':
				if(!isset($_POST['grupo'])){
					header("location: ../views/PERMISO_AÑADIR_Vista.php");
				}else{
					$permiso = datosForm();
					$mensaje = $permiso->crear(); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/PERMISO_AÑADIR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'bajaPermiso':
				if(!isset($_POST['grupo'])){
					header("location: ../views/PERMISO_BORRAR_Vista.php");
				}else{
					$permiso = datosForm();
					$mensaje = $permiso->borrar(); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/PERMISO_BORRAR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'modificarPermiso':
				if(!isset($_POST['grupo'])){
					header("location: ../views/PERMISO_EDITAR_Vista.php");
				}else{
					$permiso = datosForm();
					$permiso2 = datosFormModificar();
					$mensaje = $permiso->modificar($permiso2); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/PERMISO_EDITAR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'consultarPermiso':
				header("location: ../views/PERMISO_LISTAR_Vista.php");
				break;
		}
	}
}else echo "Permiso denegado.";

?>