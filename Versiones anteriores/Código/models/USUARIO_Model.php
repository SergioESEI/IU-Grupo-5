<?php
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

class usuario{
	
	var $dni;
	var $password;
	var $grupo;
	var $nombre;
	var $apellidos;
	var $usuario;
	var $telefono;
	var $email;
	var $mysqli;
	
	//Constructor.
	function __construct($dni=null,$password=null,$grupo=null,$usuario,$nombre=null,$apellidos=null,$email=null,$telefono=null){
		
		$this->dni = $dni;
		$this->password = md5($password);
		$this->usuario = $usuario;
		$this->nombre = $nombre;
		$this->apellidos = $apellidos;
		$this->email = $email;
		$this->telefono = $telefono;
		$this->grupo = $grupo;
	}
	
	function getDni(){
		return $this->dni;
	}
	function getPassword(){
		return $this->password;
	}
	function getGrupo(){
		return $this->grupo;
	}
	function getUsuario(){
		return $this->usuario;
	}
	function getNombre(){
		return $this->nombre;
	}
	function getApellidos(){
		return $this->apellidos;
	}
	function getEmail(){
		return $this->email;
	}
	function getTelefono(){
		return $this->telefono;
	}
	
	//Crea una conexión con la BD.
	function conectarBD(){
		
		$this->mysqli = new mysqli("localhost", "root", "iu", "MOOVETT");
		if (mysqli_connect_errno()){
			echo "Fallo al conectar MySQL: " . $this->mysqli->connect_error();
		}
	}
	
	//Añade un usuario a la BD. Controla que no exista ya el usuario.
	function crear(){
		
		$this->conectarBD();
		
		$sql = "SELECT * FROM Usuario WHERE Usuario='".$this->usuario."';";
		$resultado = $this->mysqli->query($sql);
		if ($resultado->num_rows == 0){
			$sql = "INSERT INTO Usuario (DNI,Nombre_Grupo,Password,Usuario,Nombre,Apellidos,Email,Telefono) VALUES ('".$this->dni."','".$this->grupo."','".$this->password."','".$this->usuario."','".$this->nombre."','".$this->apellidos."','".$this->email."','".$this->telefono."');";
			$this->mysqli->query($sql);		
			return "Usuario añadido correctamente";
		}else{
			return "El usuario ya existe.";
		}
	}
	
	//Realiza el borrado lógico de un usuario.
	function borrar(){

		$this->conectarBD();
		
		$sql = "UPDATE Usuario SET Borrado='1' WHERE Usuario='".$this->usuario."';";
		if($this->mysqli->query($sql) === TRUE) {
			return "Usuario borrado con éxito.";
		}else
			return "Error al borrar usuario.";
	}
	
	//Modifica los datos de un usuario. Controla que no exista ya el nuevo usuario.
	function modificar($usuarioNuevo){

		$this->conectarBD();
		
		$sql = "SELECT * FROM Usuario WHERE DNI='".$usuarioNuevo->getDni()."' AND Password='".$usuarioNuevo->getPassword()."' AND Nombre_Grupo='".$usuarioNuevo->getGrupo()."';";
		$resultado = $this->mysqli->query($sql);
		if ($resultado->num_rows == 0){
			$sql= "UPDATE Usuario SET DNI='".$usuarioNuevo->getDni()."',Password='".$usuarioNuevo->getPassword()."',Nombre_Grupo='".$usuarioNuevo->getGrupo()."' WHERE DNI='".$this->dni."';";
			if($this->mysqli->query($sql) === TRUE) {
				return "Usuario modificado con éxito.";
			}else{
				return "Error al modificar usuario.";
			}
		}else 
			return "El usuario a insertar ya existe.";
	}

}

//Lista en un select todos los usuarios. Controla que no se muestre el usuario logeado para no borrarlo.
function listarUsuariosBorrar(){
	
		$db = new mysqli("localhost", "root", "iu", "MOOVETT");
		
		$sql = "SELECT Usuario FROM Usuario WHERE Borrado='0' ORDER BY Usuario;";
		$resultado = $db->query($sql);
		$db->close();
		if ($resultado->num_rows > 0){
			while($row = $resultado->fetch_array()) {
				if(strcmp($row['Usuario'],$_SESSION['user']) != 0)
					echo "<option value='".$row['Usuario']."'>".$row['Usuario']."</option><tr>";
			}
		}
		$db->close();
}

//Lista en un select todos los usuarios. 
function listarUsuariosModificar(){
	
		$db = new mysqli("localhost", "root", "iu", "MOOVETT");
		
		$sql = "SELECT Usuario FROM Usuario WHERE Borrado='0' ORDER BY Usuario;";
		$resultado = $db->query($sql);
		$db->close();
		if ($resultado->num_rows > 0){
			while($row = $resultado->fetch_array()) {
				echo "<option value='".$row['Usuario']."'>".$row['Usuario']."</option><tr>";
			}
		}
		$db->close();
}

//Lista todos los usuarios en una tabla
function verUsuarios(){
	
	$db = new mysqli("localhost", "root", "iu", "MOOVETT");
		
	$sql = "SELECT * FROM Usuario WHERE Borrado='0' ORDER BY DNI;";
	$resultado = $db->query($sql);
	$db->close();
	if ($resultado->num_rows > 0){
		while($row = $resultado->fetch_array()) {
			echo "<tr> <td>".$row['Usuario']."</td> <td>".$row['Nombre']."</td> <td>".$row['Apellidos']."</td> <td>".$row['DNI']."</td> <td>".$row['Email']."</td> <td>".$row['Telefono']."</td> <td>".$row['Nombre_Grupo']."</td> </tr>";
		}
	}
}

function consultarUsuario($user){
		
	$db = new mysqli("localhost", "root", "iu", "MOOVETT");
	
	$sql = "SELECT * FROM Usuario WHERE Usuario='".$user."';";
	$resultado = $db->query($sql);
	$row = $resultado->fetch_array();
	echo $row['Usuario']."<br><br>".$row['Nombre'].", ".$row['Apellidos']."<br>".$row['DNI']."<br>".$row['Email']."<br>".$row['Telefono']."<br>".$row['Nombre_Grupo'];
}	

//Lista todos los grupos registrados en un select. Oculta el grupo admin si ya hay un admin.
function listarGrupos(){
	
	$db = new mysqli("localhost", "root", "iu", "MOOVETT");
	
	$sql = "SELECT * FROM Grupo ORDER BY Nombre_Grupo;";
	$resultado = $db->query($sql);
	if ($resultado->num_rows > 0){
		while($row = $resultado->fetch_array()) {	
			if(!strcmp($row['Nombre_Grupo'],'Admin')== 0)
				echo "<option value='".$row['Nombre_Grupo']."'>".$row['Nombre_Grupo']."</option>";
		}
	}
}

}else echo "Permiso denegado.";

?>