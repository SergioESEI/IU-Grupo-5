<?php
session_start();
require_once('conexion.php');
	
//ESTE ARCHIVO INSERTA LOS CAMBIOS DEL MASAJE EN LA BD

	if(isset($_POST['OK1'])){
	
	$Nombre=$_POST['Nombre'];
	
		$sql="UPDATE masaje
					SET Nombre='$Nombre'
					WHERE Id_Masaje ='". $_POST['clave1']."'";
				  
			$res = mysqli_query($conexion,$sql) or die(mysqli_error()."<br>".$sql."<hr>");
			
			echo "<p>";
				echo "<h2><center>MASAJE MODIFICADO</h2>";
				echo "<br>";
			echo "</p>";
}
?>