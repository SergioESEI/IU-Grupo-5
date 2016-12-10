<?php
require_once('conexion.php');

//ESTE ARCHIVO CREARA UN NUEVO MASAJE
?>


<form method=POST action=''>
			Nombre del masaje:<br>
			<input type='text' name='Nombre' required>
			<br>
			
			<input  type = "submit" name = "OK1" value="Enviar"/>
		</form>
<?php
if (isset($_POST['OK1'])){
	
			
			$Nombre=$_POST['Nombre'];
			
			$sql="INSERT INTO masaje (Nombre,Borrado)
				  VALUES('$Nombre','0')";
				  
			$res = mysqli_query($conexion,$sql) or die(mysqli_error()."<br>".$sql."<hr>");	
			echo "<p>";
				echo "<h2><center>MASAJE CREADO</h2>";
				echo "<br>";
			echo "</p>";
		}
?>