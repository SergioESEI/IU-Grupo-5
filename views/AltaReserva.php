<?php
session_start();
require_once('conexion.php');

if(isset($_POST['Enviar'])){
			
			$sql0="SELECT Nombre
					FROM masaje
					WHERE Id_Masaje='".$_POST['NombreMasaje']."'";
					
			$res0 = mysqli_query($conexion,$sql0) or die(mysqli_error()."<br>".$sql0."<hr>");
			$registro0 = mysqli_fetch_assoc($res0);
					
			$Id_Masaje=$_POST['NombreMasaje'];
			$DNI_Alumno=$_SESSION['DNI'];
			$DNI_Trabajador=$_POST['NombreTrabajador'];
			$Tipo=$registro0['Nombre'];
			$Hora_Inicio=$_POST['Hora_Inicio'];
			$Hora_Fin=$_POST['Hora_Fin'];
			$Fecha=$_POST['Fecha'];
			
			$sql="INSERT INTO reserva_masaje(Id_Masaje,DNI_Alumno,DNI_Trabajador,Tipo,Hora_Inicio,Hora_Fin,Fecha,Borrado)
				  VALUES('$Id_Masaje','$DNI_Alumno','$DNI_Trabajador','$Tipo','$Hora_Inicio','$Hora_Fin','$Fecha','0')";
			
			$res = mysqli_query($conexion,$sql) or die(mysqli_error()."<br>".$sql."<hr>");
			echo "<p>";
				echo "<h2><center>RESERVA REALIZADA</h2>";
				echo "<br>";
				echo 'Click para volver atrás <a href="DNI.php">Volver</a>.';
			echo "</p>";
		}
?>