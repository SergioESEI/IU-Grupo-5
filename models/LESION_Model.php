<?php
//Comprueba si el usuario inició sesión y si es admin o secretaría antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

class Lesion{
	
	var $dni;
	var $id;
	var $tipo;
	var $descripcion;
	var $curada;
	
	var $mysqli;
	
	//Constructor.
	function __construct($id=null,$dni=null,$tipo=null,$descripcion=null, $curada=null){
		
		$this->dni = $dni;
		$this->id = $id;
		$this->tipo = $tipo;
		$this->descripcion = $descripcion;
		$this->curada = $curada;
		
		
	}


	//Getters.
	function getDni(){
		return $this->dni;
	}
	function getId(){
		return $this->id;
	}
	function getTipo(){
		return $this->tipo;
	}
	function getDescripcion(){
		return $this->descripcion;
	}
	function getCurada(){
		return $this->curada;
	}
	


//Crea una conexión con la BD.
	function conectarBD(){
		
		$this->mysqli = new mysqli("localhost", "root", "iu", "MOOVETT");
		if (mysqli_connect_errno()){
			echo "Fallo al conectar MySQL: " . $this->mysqli->connect_error();
		}
	}



	function crear(){
		
		$this->conectarBD();
		
		$sql = "SELECT * FROM Lesion WHERE DNI='".$this->dni."';";
		$resultado = $this->mysqli->query($sql);
		if ($resultado->num_rows == 0){
					$sql = "INSERT INTO Lesion (DNI,Id_Lesion,Tipo,Curada,Descripcion) VALUES ('".$this->dni."','".$this->id."','".$this->tipo."','".$this->curada."','".$this->descripcion."');";
					
					$this->mysqli->query($sql);		
					return "añadido exito";
		}else{
			$sql = "SELECT * FROM Lesion WHERE DNI='".$this->dni."' AND BORRADO='1' ;";
			$resultado = $this->mysqli->query($sql);
			if ($resultado->num_rows == 1){
				$sql="UPDATE Lesion SET Borrado='0'  WHERE Dni='".$this->dni."' AND Borrado='1';";
				return "añadido exito";
			}else{
				return 'ya existe';
			}
					
		}
	}

	function borrar(){

		$this->conectarBD();
		
		$sql = "UPDATE Lesion SET Borrado='1' WHERE Id_Lesion='".$this->id."';";
		echo $sql;
		if($this->mysqli->query($sql) === TRUE) {
			return "borrado exito";
		}else{
			return "error borrado";
		}
	}
	

	//Modifica los datos de un usuario. Controla que no exista ya el nuevo usuario o el dni ya esté asignado.
	//Si tenía borrado lógico lo sobreescribe y borra el viejo.
	function modificar($LesionNueva){
			$this->conectarBD();

			$sql = "SELECT * FROM Lesion WHERE DNI='" . $LesionNueva->getDni() . "' AND DNI<>'" . $this->getDni() ."';";
			$resultado = $this->mysqli->query($sql);
			if ($resultado->num_rows == 1){
				return "dni asignado";
			}else{

				$sql= "UPDATE Trabajador SET DNI='" . $TrabajadorNuevo->getDni() . "',Apellidos='" . $TrabajadorNuevo->getApellidos() . "',Nombre='" . $TrabajadorNuevo->getNombre() . "',Fecha_Nacimiento='" . $TrabajadorNuevo->getFechaNac() . "',Email='".  $TrabajadorNuevo->getEmail() . "',Direccion='" .  $TrabajadorNuevo->getDireccion() . "',Tipo_Empleado='" . $TrabajadorNuevo->getTipoEmp() . "',Url_Foto='". $TrabajadorNuevo->getUrl_Foto() . "',Telefono='" . $TrabajadorNuevo->getTelefono() . "'Observaciones='" . $TrabajadorNuevo->getObservaciones() . "',Numero_Cuenta='" . $TrabajadorNuevo->getNumeroCuenta() . "',Horas_Extra='" . $TrabajadorNuevo->getHorasExtra() . "',Externo='" . $TrabajadorNuevo->getExterno() . "'  WHERE Dni='".$this->dni."';";
					echo $sql;

					$resultado2 = $this->mysqli->query($sql);
				
			}

			if($resultado2){
				return "modificacion exito";
			}else{
				return "error modificacion";
			}
		}

}
			






function verLesiones($dni){
	
		$db = new mysqli("localhost", "root", "iu", "MOOVETT");
		
		$sql = "SELECT * FROM Lesion WHERE DNI='" . $dni . "' AND Borrado='0';";
		$resultado = $db->query($sql);
		$db->close();
		if ($resultado->num_rows > 0){
			while($row = $resultado->fetch_array()) {
					echo "<tr><td>".$row['Id_Lesion']."</td> <td>".$row['Tipo'] . "</td> <td> <a href='../controllers/LESION_Controller.php?id=mostrarLesion&id2=" . $row['DNI'] . "&idles=" . $row['Id_Lesion'] . "'  class='btn btn-primary' >Ver detalle</a></td></tr>";
			}
		}
	}

function verAlumnos(){
	
	
		$db = new mysqli("localhost", "root", "iu", "MOOVETT");
		
		$sql = "SELECT * FROM Alumno WHERE Borrado='0' ORDER BY Dni;";
		$resultado = $db->query($sql);
		$db->close();
		if ($resultado->num_rows > 0){
			while($row = $resultado->fetch_array()) {

					echo "<tr><td>".$row['DNI']."</td> <td>".$row['Nombre'] . "</td> <td>".$row['Apellidos'] ."</td> <td> <a href='../controllers/LESION_Controller.php?id=altaLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Añadir Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=bajaLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Borrar Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=modificarLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Modificar Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=mostrarLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Ver lesiones</a></td></tr>";
			}
		}
	
}

function verAlumnosBorrados(){
	
	
		$db = new mysqli("localhost", "root", "iu", "MOOVETT");
		
		$sql = "SELECT * FROM Alumno WHERE Borrado='1' ORDER BY Dni;";
		$resultado = $db->query($sql);
		$db->close();
		if ($resultado->num_rows > 0){
			while($row = $resultado->fetch_array()) {
					echo "<tr><td>".$row['DNI']."</td> <td>".$row['Nombre'] . "</td> <td>".$row['Apellidos'] ."</td> <td> <a href='../controllers/LESION_Controller.php?id=altaLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Añadir Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=bajaLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Borrar Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=modificarLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Modificar Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=mostrarLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Ver lesiones</a></td></tr>";
			}
		}
	
}
function verTrabajadores(){
	
	
		$db = new mysqli("localhost", "root", "iu", "MOOVETT");
		
		$sql = "SELECT * FROM Trabajador WHERE Borrado='0' AND Tipo_Empleado = 'monitor' ORDER BY Dni;";
		$resultado = $db->query($sql);
		$db->close();
		if ($resultado->num_rows > 0){
			while($row = $resultado->fetch_array()) {
					echo "<tr><td>".$row['DNI']."</td> <td>".$row['Nombre'] . "</td> <td>".$row['Apellidos'] ."</td> <td> <a href='../controllers/LESION_Controller.php?id=altaLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Añadir Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=bajaLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Borrar Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=modificarLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Modificar Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=mostrarLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Ver lesiones</a></td></tr>";
			}
		}
	
}

function verTrabajadoresBorrados(){
	
	
		$db = new mysqli("localhost", "root", "iu", "MOOVETT");
		
		$sql = "SELECT * FROM Trabajador WHERE Borrado='1' AND Tipo_Empleado = 'monitor' ORDER BY Dni;";
		$resultado = $db->query($sql);
		$db->close();
		if ($resultado->num_rows > 0){
			while($row = $resultado->fetch_array()) {
					echo "<tr><td>".$row['DNI']."</td> <td>".$row['Nombre'] . "</td> <td>".$row['Apellidos'] ."</td> <td> <a href='../controllers/LESION_Controller.php?id=altaLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Añadir Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=bajaLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Borrar Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=modificarLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Modificar Lesión</a></td><td> <a href='../controllers/LESION_Controller.php?id=mostrarLesion&id2=" . $row['DNI']. "'  class='btn btn-primary' >Ver lesiones</a></td></tr>";
			}
		}
	
}

function verLesionesBorradas($dni){
	
		$db = new mysqli("localhost", "root", "iu", "MOOVETT");
		
		$sql = "SELECT * FROM Lesion WHERE DNI='" . $dni . "' AND Borrado='1';";
		$resultado = $db->query($sql);
		$db->close();
		if ($resultado->num_rows > 0){
			while($row = $resultado->fetch_array()) {
					echo "<tr><td>".$row['Id_Lesion']."</td> <td>".$row['Tipo'] . "</td> <td> <a href='../controllers/LESION_Controller.php?id=mostrarLesion&id2=" . $row['DNI'] . "&idles=" . $row['Id_Lesion'] . "'  class='btn btn-primary' >Ver detalle</a></td></tr>";
			}
		}
	}


function mostrarLesion($idLesion){

		$db = new mysqli("localhost", "root", "iu", "MOOVETT");
		$sql = "SELECT * FROM Lesion WHERE Id_Lesion='" . $idLesion . "';";
		$resultado = $db->query($sql);
		if($resultado === FALSE) {
			return "error en la consulta a la base de datos";
		}


	if ($resultado->num_rows !=0){
		$row = $resultado->fetch_assoc();	
		return $row;
	}

}

function verLesionesBorrar($dni){
	$db = new mysqli("localhost", "root", "iu", "MOOVETT");

	$sql = "SELECT * FROM Lesion WHERE Borrado='0' AND DNI='" . $dni . "' ORDER BY Id_Lesion;";
	$resultado = $db->query($sql);
	$db->close();
	if ($resultado->num_rows > 0){
		while($row = $resultado->fetch_array()) {
			echo "<tr> <td>".$row['DNI']."</td> <td>".$row['Id_Lesion']."</td> <td>".$row['Tipo'] . "</td> <td> <a href='../controllers/LESION_Controller.php?id=bajaLesion&id2=" . $row['DNI'] . "&idles=" . $row['Id_Lesion'] . "'  class='btn btn-primary' >Borrar Lesión</a></td></tr>";
		
		}
	}
}


} else {
	echo "Permiso denegado.";
}
?>
