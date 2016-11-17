
<?php

if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	
	require_once('../models/GRUPO_Model.php'); 
	
	//Recoge los datos del formulario de la vista en un objeto 'Grupo'.
	function datosForm(){

		$grupo = $_POST['grupo'];
		
		$grup = new grupo($grupo);
		return $grup;
	}
	
	//Recoge del formulario los datos nuevos para modificar un grupo.
	function datosFormModificar(){
		
		$grupo = $_POST['grupoN'];
		
		$grupo2 = new grupo($grupo);
		return $grupo2;
	}
	
	//Primero invoca a la vista correspondiente según la opción elegida en el menú.
	//Después invoca un método del modelo en función del parámetro pasado en la vista por get.
	//Finalmente muestra un mensaje de error o confirmación tras acceder a la BD y redirige a la vista.
	if(isset($_GET['id'])){
		$action = $_GET['id'];
		switch($action){
			
			case 'altaGrupo':
				if(!isset($_POST['grupo'])){
					header("location: ../views/GRUPO_AÑADIR_Vista.php");
				}else{
					$grupo = datosForm();
					$mensaje = $grupo->crear(); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/GRUPO_AÑADIR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'bajaGrupo':
				if(!isset($_POST['grupo'])){
					header("location: ../views/GRUPO_BORRAR_Vista.php");
				}else{
					$grupo = datosForm();
					$mensaje = $grupo->borrar(); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/GRUPO_BORRAR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'modificarGrupo':
				if(!isset($_POST['grupo'])){
					header("location: ../views/GRUPO_EDITAR_Vista.php");
				}else{
					$grupo = datosForm();
					$grupo2 = datosFormModificar();
					$mensaje = $grupo->modificar($grupo2); ?>
					<script>
						window.alert('<?php echo $mensaje; ?>');
						location.href='../views/GRUPO_EDITAR_Vista.php';
					</script> <?php
				}
				break;
				
			case 'consultarGrupo':
				header("location: ../views/GRUPO_LISTAR_Vista.php");
				break;
		}
	}
}else echo "Permiso denegado.";

?>