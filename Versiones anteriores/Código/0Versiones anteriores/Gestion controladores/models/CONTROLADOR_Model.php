<?php

if(strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

class Controlador{
	
	var $accion;
	var $controlador;
	var $mysqli;
	
	function __construct($controlador,$accion){
		
		$this->accion = $accion;
		$this->controlador = $controlador;
	}
	
	function conectarBD(){
		
		$this->mysqli = new mysqli("localhost", "root", "iu", "MOOVETT");
		if (mysqli_connect_errno()){
			echo "Fallo al conectar MySQL: " . $this->mysqli->connect_error();
		}
	}
	
	function crear(){
		
		$this->conectarBD();
		
		$sql = "SELECT * FROM Controlador WHERE controlador='".$this->controlador."' AND accion='".$this->accion."';";
		$resultado = $this->mysqli->query($sql);
		if ($resultado->num_rows == 0){
			$sql = "INSERT INTO Controlador (controlador,accion) VALUES ('".$this->controlador."','".$this->accion."');";
			$this->mysqli->query($sql);
			
			$mensaje = "Controlador añadido correctamente.";
		}else{
			$mensaje = "El controlador (".$this->controlador.", ".$this->accion.") ya existe.";
		}
		$this->mysqli->close();
		return $mensaje;
	}
	
	function listar($user){
		
		$this->conectarBD();
		
		$sql = "SELECT * FROM USUARIOS WHERE usergit='".$user."'";
		$resultado = $this->mysqli->query($sql);
		$this->mysqli->close();
		
		if ($resultado->num_rows == 1){
			return $resultado->fetch_assoc();
		}else{
			return "El usuario ".$user." no existe.";
		}
	}
	
	function borrar($user){

		$this->conectarBD();
		
		$sql = "DELETE FROM USUARIOS WHERE usergit='".$user."'";
		if($this->mysqli->query($sql) === TRUE) {
			return "Usuario ".$user." borrado con éxito.";
		}else{
			return "Error al borrar usuario.";
		}
		$this->mysqli->close();
	}
	
	function modificar(){

		$this->conectarBD();
		
		$sql = "UPDATE USUARIOS SET ";
		if($this->password != null) $sql .= "password='{$this->password}', ";
		if($this->email != null) $sql .= "emailuser='{$this->email}', ";
		if($this->fecha != null) $sql .= "fechnacuser='{$this->fecha}', ";
		if($this->nombre != null) $sql .= "nombreuser='{$this->nombre}', ";
		if($this->apellidos != null) $sql .= "apellidosuser='{$this->apellidos}', ";
		if($this->titulo != null) $sql .= "titulacionuser='{$this->titulo}', ";
		if($this->curso != null) $sql .= "cursoacademicouser='{$this->curso}', ";
		if($this->grupo != null) $sql .= "grupopracticas='{$this->grupo}' ";
		$sql .= " WHERE usergit='{$this->user}';";
		if($this->mysqli->query($sql) === TRUE) {
			return "Usuario ".$this->user." modificado con éxito.";
		}else{
			return "Error al modificar el usuario.";
		}
		$this->mysqli->close();
	}
	
}

}else echo "Permiso denegado.";

?>