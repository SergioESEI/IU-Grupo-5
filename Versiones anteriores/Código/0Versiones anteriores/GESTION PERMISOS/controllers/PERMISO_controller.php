
<?php

session_start();
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){

include('../models/PERMISOS_modelo.php'); 


function leerSelect1(){
		
		if(isset($_POST['accion'])){
			$accion = $_POST['accion'];
		}else{
			$accion = null;
		}
		$valorSelect1=$_POST['selectgrupos'];//Recogemos el valor del select de grupos
     	
     	return $valorSelect1;
}

function leerSelect2(){
		
		if(isset($_POST['accion'])){
			$accion = $_POST['accion'];
		}else{
			$accion = null;
		}
		
     	$valorSelect2=$_POST['selectcontroladores'];//Recogemos el valor del select de controladores

     	return $valorSelect2;
		
}	

$action = $_GET['id'];

switch($action){

	case 'consultarPermisos':
	if(!isset($_POST['accion'])){
			header("location: ../views/PERMISOS_CONSULTAR_vista.php");
		}else{
			$valorSelect1= leerSelect1();
			$valorSelect2= leerSelect2();
			header("location: ../views/PERMISOS_CONSULTAR_vista_2.php");
		}
		break;
	case 'modificarPermisos':
		if(!isset($_POST['accion'])){
				header("location: ../views/PERMISOS_MODIFICAR_vista.php");
			}else{
			$valorSelect1= leerSelect1();
			$valorSelect2= leerSelect2();
			header("location: ../views/PERMISOS_MODIFICAR_vista_2.php");
			}
		break;
}
}else echo "Permiso denegado.";

?>