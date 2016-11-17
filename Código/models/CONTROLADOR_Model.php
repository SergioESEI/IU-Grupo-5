<?php
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

class controlador{
	
	var $accion;
	var $controlador;
	var $mysqli;
	
	//Constructor. La acción puede ser null.
	function __construct($controlador,$accion=null){
		
		$this->accion = $accion;
		$this->controlador = $controlador;
	}
	
	function getControlador(){
		return $this->controlador;
	}
	
	function getAccion(){
		return $this->accion;
	}
	
	//Crea una conexión con la BD.
	function conectarBD(){
		
		$this->mysqli = new mysqli("localhost", "root", "iu", "MOOVETT");
		if (mysqli_connect_errno()){
			echo "Fallo al conectar MySQL: " . $this->mysqli->connect_error();
		}
	}
	
	//Añade un controlador a la BD en base al controlador y acción recibidos del controller. Controla que no exista el controlador.
	function crear(){
		
		$this->conectarBD();
		
		$sql = "SELECT * FROM Controlador WHERE Nombre_Controlador='".$this->controlador."' AND Accion='".$this->accion."';";
		$resultado = $this->mysqli->query($sql);
		if ($resultado->num_rows == 0){
			$sql = "INSERT INTO Controlador (Nombre_Controlador,Accion) VALUES ('".$this->controlador."','".$this->accion."');";
			$this->mysqli->query($sql);		
			return "Controlador añadido correctamente";
		}else{
			return "El controlador ya existe.";
		}
	}
	
	//Borra todas las tuplas de un mismo controlador si no se pasa acción, o bien controlador y acción de una tupla.
	function borrar(){

		$this->conectarBD();
		
		if($this->accion != null){
			$sql = "DELETE FROM Controlador WHERE Nombre_Controlador='".$this->controlador."' AND Accion='".$this->accion."';";
			if($this->mysqli->query($sql) === TRUE) {
				return "controlador borrado con éxito.";
			}else
				return "Error al borrar controlador.";
		}else{
			$sql = "DELETE FROM Controlador WHERE Nombre_Controlador='".$this->controlador."';";
			if($this->mysqli->query($sql) === TRUE) {
				return "controlador borrado con éxito.";
			}else
				return "Error al borrar controlador.";
		}	
	}
	
	//Modifica el controlador-acción recibido del controller. Controla que no exista el nuevo controlador.
	function modificar($controladorNuevo){

		$this->conectarBD();
		
		$sql = "SELECT * FROM Controlador WHERE Nombre_Controlador='".$controladorNuevo->getControlador()."' AND Accion='".$controladorNuevo->getAccion()."';";
		$resultado = $this->mysqli->query($sql);
		if ($resultado->num_rows == 0){
			$sql= "UPDATE Controlador SET Nombre_Controlador='".$controladorNuevo->getControlador()."',Accion='".$controladorNuevo->getAccion()."' WHERE Nombre_Controlador='".$this->controlador."' AND Accion='".$this->accion."';";
			if($this->mysqli->query($sql) === TRUE) {
				return "Controlador modificado con éxito.";
			}else{
				return "Error al modificar controlador.";
			}
		}else 
			return "El controlador a insertar ya existe.";
	}	
}

//Lista en un select todos los controladores registrados.
function listarcontrolador(){
	
		$db = new mysqli("localhost", "root", "iu", "MOOVETT");
		
		$sql = "SELECT DISTINCT Nombre_Controlador FROM Controlador;";
		$resultado = $db->query($sql);
		$db->close();
		if ($resultado->num_rows > 0){
			while($row = $resultado->fetch_array()) {
				echo "<option value='".$row['Nombre_Controlador']."'>".$row['Nombre_Controlador']."</option><tr>";
			}
		}
		$db->close();
}

//Lista en un select todas las acciones del controlador pasado como parámetro.	
function listaraccion($contr){
	
	$db = new mysqli("localhost", "root", "iu", "MOOVETT");
	
	$sql = "SELECT Accion FROM Controlador WHERE Nombre_Controlador='".$contr."';";
	$resultado = $db->query($sql);
	$db->close();
	if ($resultado->num_rows > 0){
		while($row = $resultado->fetch_array()) {
			echo "<option value='".$row['Accion']."'>".$row['Accion']."</option><tr>";
		}
	}
	$db->close();
}

//Lista todos los controladores con sus acciones
function listarFuncionalidades(){
	
	$db = new mysqli("localhost", "root", "iu", "MOOVETT");
	
	$sql = "SELECT * FROM Controlador ORDER BY Nombre_Controlador,Accion;";
	$resultado = $db->query($sql);
	if ($resultado->num_rows > 0){
		while($row = $resultado->fetch_array()) {
			echo "<tr><td>".$row['Nombre_Controlador']."</td> <td>".$row['Accion']."<td></tr>";
		}
	}
}

}else echo "Permiso denegado.";

?>