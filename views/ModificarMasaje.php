<?php
session_start();
require_once('conexion.php');

//ESTE ARCHIVO PERMITIRA REALIZAR CAMBIOS EN UN MASAJE
	
	$sql = "SELECT DISTINCT Nombre,Id_Masaje
					FROM masaje
					WHERE Borrado=0";
			
			$res = mysqli_query($conexion,$sql) or die(mysqli_error()."<br>".$sql."<hr>");
			
?>	
		Tipo de masaje:
		<br>
		<form method=POST action='ModificarMasaje.php'>
		<select name=NombreMasaje>
		<?php
			while($registro=mysqli_fetch_assoc($res)){
		
				echo '<option value="'.$registro["Id_Masaje"].'">"'.$registro["Nombre"].'"</option>';
				
			}
		?>
		</select>
		<br>
		<br>
		
		<input  type = "submit" name = "OK" value="Enviar"/>
		</form>
		
<?php
	
	$conexion = mysqli_connect($servidor, $usuario_bbdd, $clave_bbdd,$base_datos);
	
		if(isset($_POST['OK'])){
			
			echo "<form action='NM1.php' method=POST >";
			echo "Nuevo nombre del masaje:<input type='text' name='Nombre' required>";
			echo "<input type='hidden' name = clave1 value = ".$_POST['NombreMasaje'].">";
			echo "<input  type = 'submit' name = 'OK1' value='Enviar'/>";
			echo "</form>";

		
}
?>