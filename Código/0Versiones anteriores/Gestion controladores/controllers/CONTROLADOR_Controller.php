
<?php

session_start();
if(strcmp($_SESSION['grupo'],"Admin") == 0 ){
	
	include_once('../models/CONTROLADOR_Model.php'); 
	$action = $_GET['id'];
	
	function datosForm(){
		$accion = $_POST['accion'];
		$controlador = $_POST['controlador'];
		
		$cont = new Controlador($controlador, $accion);
		return $cont;
	}
	switch($action){
		
		case 'altaControlador':
			if(!isset($_POST['accion'])){
				header("location: ../views/CONTROLADOR_AÑADIR_Vista.php");
			}else{
				$cont = datosForm();
				$mensaje = $cont->crear();
				echo $mensaje;
			}
			break;
			
		case 'bajaControlador':
			echo "Del";
			break;
			
		case 'modificarControlador':
			break;
			
		case 'consultarControlador':
			break;
	}
	
}else echo "Permiso denegado.";

?>