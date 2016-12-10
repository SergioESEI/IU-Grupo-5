<?php
session_start();
require_once('conexion.php');

//ESTE ARCHIVO PERMITIRÁ VER LOS DATOS DE UN MASAJE
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/estilos.css">
</head>

<?php

$sql = "SELECT DISTINCT Nombre,Id_Masaje
					FROM masaje
					WHERE Borrado=0";
			
			$res = mysqli_query($conexion,$sql) or die(mysqli_error()."<br>".$sql."<hr>");
			
?>	
		Nombre del masaje:
		<br>
		<form method=POST action='ConsultarMasaje.php'>
		<select name=NombreMasaje>
		<?php
			while($registro=mysqli_fetch_assoc($res)){
		
				echo '<option value="'.$registro["Id_Masaje"].'">"'.$registro["Nombre"].'"</option>';
			}
		?>
		</select>
		
		<br>
		<input  type = "submit" name = "Validar" value="OK"/>
		</form>
		<?php

if(isset($_POST['Validar'])){

			$sql = "SELECT *
				FROM masaje
				WHERE Id_Masaje ='".$_POST['NombreMasaje']."'AND Borrado =0";
				
				
	$res = mysqli_query($conexion,$sql) or die(mysqli_error()."<br>".$sql."<hr>");
		
		echo "<h2><center>DATOS DEL MASAJE</h2>";
				echo "<hr>";
				echo "<br>";
				
		
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
			echo "<br>";
				
	}
	

?>
</html>