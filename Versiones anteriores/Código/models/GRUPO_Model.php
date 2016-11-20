<?php
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

class grupo{
	
	var $grupo;
	var $mysqli;
	
	//Constructor. 
	function __construct($grupo){
		
		$this->grupo = $grupo;
	}
	
	function getGrupo(){
		return $this->grupo;
	}
	
	//Crea una conexión con la BD.
	function conectarBD(){
		
		$this->mysqli = new mysqli("localhost", "root", "iu", "MOOVETT");
		if (mysqli_connect_errno()){
			echo "Fallo al conectar MySQL: " . $this->mysqli->connect_error();
		}
	}
	
	//Añade un grupo a la BD en base al grupo recibidos del controller. Controla que no exista ya.
	function crear(){
		
		$this->conectarBD();
		
		$sql = "SELECT * FROM Grupo WHERE Nombre_Grupo='".$this->grupo."';";
		$resultado = $this->mysqli->query($sql);
		if ($resultado->num_rows == 0){
			$sql = "INSERT INTO Grupo (Nombre_Grupo) VALUES ('".$this->grupo."');";
			$this->mysqli->query($sql);		
			return "Grupo añadido correctamente.";
		}else{
			return "El grupo ya existe.";
		}
	}
	
	//Borra el grupo seleccionado en el controller.
	function borrar(){

		$this->conectarBD();
		
		$sql = "DELETE FROM Grupo WHERE Nombre_Grupo='".$this->grupo."';";
		if($this->mysqli->query($sql) === TRUE) {
			return "Grupo borrado con éxito.";
		}else
			return "Error al borrar grupo.";
	}
	
	//Modifica el grupo recibido del controller. Controla que no exista el nuevo grupo.
	function modificar($grupoNuevo){

		$this->conectarBD();
		
		$sql = "SELECT * FROM Grupo WHERE Nombre_Grupo='".$grupoNuevo->getGrupo()."';";
		$resultado = $this->mysqli->query($sql);
		if ($resultado->num_rows == 0){
			$sql= "UPDATE Grupo SET Nombre_Grupo='".$grupoNuevo->getGrupo()."' WHERE Nombre_Grupo='".$this->grupo."';";
			if($this->mysqli->query($sql) === TRUE) {
				return "Grupo modificado con éxito.";
			}else{
				return "Error al modificar grupo.";
			}
		}else 
			return "El grupo a insertar ya existe.";
	}	
}

//Lista todos los grupos registrados en un select. Oculta el grupo admin.
function listarGrupos(){
	
	$db = new mysqli("localhost", "root", "iu", "MOOVETT");
	
	$sql = "SELECT * FROM Grupo ORDER BY Nombre_Grupo;";
	$resultado = $db->query($sql);
	if ($resultado->num_rows > 0){
		while($row = $resultado->fetch_array()) {
			if(strcmp($row['Nombre_Grupo'],'Admin')!= 0 )
				echo "<option value='".$row['Nombre_Grupo']."'>".$row['Nombre_Grupo']."</option>";
		}
	}
}

//Lista todos los grupos registrados.
function verGrupos(){
	
	$db = new mysqli("localhost", "root", "iu", "MOOVETT");
	
	$sql = "SELECT * FROM Grupo ORDER BY Nombre_Grupo;";
	$resultado = $db->query($sql);
	if ($resultado->num_rows > 0){
		while($row = $resultado->fetch_array()) {
			echo "<tr><td>".$row['Nombre_Grupo']."</td> </tr>";
		}
	}
}

}else echo "Permiso denegado.";

?>