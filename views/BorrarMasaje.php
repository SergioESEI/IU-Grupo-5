<?php
session_start();
require_once('conexion.php');

//ESTE ARCHIVO BORRARÁ UN MASAJE

$sql = "SELECT DISTINCT Nombre,Id_Masaje
					FROM masaje
					WHERE Borrado=0";
			
			$res = mysqli_query($conexion,$sql) or die(mysqli_error()."<br>".$sql."<hr>");
			
?>	
		Tipo de masaje:
		<br>
		<form method=POST action='BorrarMasaje.php'>
		<select name=NombreMasaje>
		<?php
			while($registro=mysqli_fetch_assoc($res)){
		
				echo '<option value="'.$registro["Id_Masaje"].'">"'.$registro["Nombre"].'"</option><br>';
			
			}
		?>
		<br>
		
		<input  type = "submit" name = "OK" value="Enviar"/>
		</select>
		</form>
		<?php
		
		


	if(isset($_POST['OK'])){
		
		$sql0 = "UPDATE masaje
				SET Borrado = 1
				WHERE Id_Masaje ='".$_POST['NombreMasaje']."'";
			
			$res0 = mysqli_query($conexion,$sql0) or die(mysqli_error()."<br>".$sql0."<hr>");
			echo "<p>";
				echo "<h2><center>MASAJE BORRADO</h2>";
				echo "<br>";
			echo "</p>";
	}
		?>	
		
		