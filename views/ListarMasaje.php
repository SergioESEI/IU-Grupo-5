<?php
session_start();
require_once('conexion.php');
	
	//ESTE ARCHIVO MOSTRARÁ LOS DATOS DE TODOS LOS MASAJES DEL SISTEMA

?>
		<h3><center>Estos son todos los masajes del sistema
		<hr>
		<html>
			<head>
				<link rel="stylesheet" type="text/css" href="css/estilos.css">
			</head>
			<?php
			$sql = "SELECT *
				FROM masaje
				WHERE Borrado =0";
				
				
	$res = mysqli_query($conexion,$sql) or die(mysqli_error()."<br>".$sql."<hr>");
		
		echo "<form name = tabla method=POST action=''>";
				echo "<table>";
				echo "<tr>";
							echo "<th>IdMasaje</th>";
							echo "<th>Nombre</th>";
						echo "</tr>";
				
				while($registro1 = mysqli_fetch_assoc($res)){
						
						echo "<tr>";
							echo"<td>";
								echo $registro1['Id_Masaje']."<br>";
							echo "</td>";
							echo"<td>";
								echo $registro1['Nombre']."<br>";
							echo "</td>";							
					echo "</tr>";
				
			}	
				echo "</table>";
			echo "</form>";
			
		
?>