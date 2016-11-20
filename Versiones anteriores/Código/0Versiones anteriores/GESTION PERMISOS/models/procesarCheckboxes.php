<?php
include('../models/PERMISOS_modelo.php'); 
include('../controllers/PERMISOS_controller.php');

session_start();
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){

	if(isset($_POST['accion'])){
			$accion = $_POST['accion'];
		}else{
			$accion = null;
		}
		$arraySeleccionados=$_POST['acciones'];//Recogemos los valores del checkbox marcados.
      	$arrayNoSeleccionados=array();

	leerCheckboxes();
	modificarPermisos($arraySeleccionados,$arrayNoSeleccionados, $valorSelect1, $valorSelect2);
}
}else echo "Permiso denegado.";

?>