<?php
//Comprueba si el cliente inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){

//Include de la función de conexión a la base de datos.
include_once('conectarBD.php');

class clienteExterno{

  var $id;
  var $nombre;
  var $dni;
  var $tlf;
  var $email;
  var $direccion;
  var $mysql;

  //Constructor.
	function __construct($id,$nombre=null,$dni=null, $tlf=null, $email=null, $direccion=null){

    $this->id = $id;
    $this->nombre = $nombre;
    $this->dni = $dni;
    $this->tlf = $tlf;
    $this->email = $email;
    $this->direccion = $direccion;

	}

  //Getters.
	function getId(){
		return $this->id;
	}
  function getNombre(){
		return $this->nombre;
	}
  function getDni(){
		return $this->dni;
	}
  function getTlf(){
		return $this->tlf;
	}
  function getEmail(){
		return $this->email;
	}
  function getDireccion(){
		return $this->direccion;
	}

  /*Añade un cliente a la BD. Controla que no exista ya el cliente. Si se había realizado un borrado lógico recupera el cliente.*/
	function crear(){

		$this->mysqli = conectarBD();

		$sql = "SELECT * FROM Cliente_Externo WHERE Id_Cliente='".$this->id."';";
		$resultado = $this->mysqli->query($sql);
		if ($resultado->num_rows == 0){
			$sql = "SELECT * FROM Cliente_Externo WHERE Id_Cliente='".$this->id."';";
			$resultado = $this->mysqli->query($sql);
			if ($resultado->num_rows == 0){
				  $sql = "INSERT INTO Cliente_Externo (Id_Cliente, Nombre, DNI, Tlf, Email, Direccion) VALUES ('".$this->id."','".$this->nombre."','".$this->dni."','".$this->tlf."','".$this->email."','".$this->direccion."');";
					$this->mysqli->query($sql);
					return "añadido exito";
		  }else{
				$sql = "SELECT * FROM Cliente_Externo WHERE Id_Cliente='".$this->id."' AND Borrado='1';";
				$resultado = $this->mysqli->query($sql);
				if ($resultado->num_rows == 1){
						$sql = "UPDATE Cliente_Externo SET Borrado='0',Id_Cliente='".$this->id."',Nombre='".$this->nombre."',DNI='".$this->dni."',Tlf='".$this->tlf."',Email='".$this->email."',Direccion='".$this->direccion."' WHERE Cliente_Externo='".$this->clienteExterno."';";
						$this->mysqli->query($sql);
					  return "añadido exito";
			  }else return "ya existe";
			}
		}else return "IdC asignado";
	}

  //Realiza el borrado lógico de un cliente.
	function borrar(){

		$this->mysqli = conectarBD();

		$sql = "UPDATE Cliente_Externo SET Borrado='1' WHERE Id_Cliente='".$this->id."';";
		if($this->mysqli->query($sql) === TRUE) {
			return "borrado exito";
		}else
			return "error borrado";
	}

  //Modifica un Cliente
  function modificar($clienteNuevo){
      $this->mysqli = conectarBD();

      $sql = "SELECT * FROM Cliente_Externo WHERE Id_Cliente='".$clienteNuevo->getId()."',Nombre='".$clienteNuevo->getNombre()."',DNI='".$clienteNuevo->getDni()."',Tlf='".$clienteNuevo->getTlf()."',Email='".$clienteNuevo->getEmail()."',Direccion='".$clienteNuevo->getDireccion()."';";
      $resultado = $this->mysqli->query($sql);
      if ($resultado->num_rows == 0){
        $sql= "UPDATE Cliente_Externo SET Id_Cliente='".$this->id."',Nombre='".$this->nombre."',DNI='".$this->dni."',Tlf='".$this->tlf."',Email='".$this->email."',Direccion='".$this->direccion."' WHERE Id_Cliente='".$this->id."';";
        if($this->mysqli->query($sql) === TRUE) {
          return "modificacion exito";
        }else{
          return "error modificacion";
        }
      }else
        return "ya existe";
      }
  }

  //Lista en un select todos los clientes para borrar. Controla que no se muestre el cliente logeado o admin para no borrarlo.
  function listarClientesBorrar(){

  		$db = conectarBD();

  		$sql = "SELECT Id_Cliente FROM Cliente_Externo WHERE Borrado='0' ORDER BY Id_Cliente;";
  		$resultado = $db->query($sql);
  		$db->close();
  		if ($resultado->num_rows > 0){
  			while($row = $resultado->fetch_array()) {
  				if(strcmp($row['Id_Cliente'],$_SESSION['client']) != 0 && strcmp($row['Nombre_Grupo'],"Admin") != 0)
  					echo "<option value='".$row['Id_Cliente']."'>".$row['Id_Cliente']."</option><tr>";
  			}
  		}
  		$db->close();
  }

  //Lista todos los clientes en una tabla.
  function verClientes(){

  	$db = conectarBD();

  	$sql = "SELECT * FROM Cliente_Externo WHERE Borrado='0' ORDER BY Id_Cliente;";
  	$resultado = $db->query($sql);
  	$db->close();
  	if ($resultado->num_rows > 0){
  		while($row = $resultado->fetch_array()) {
  			echo "<tr> <td>".$row['Id_Cliente']."</td> <td>".$row['Nombre']."</td> <td>".$row['DNI']."</td> </tr>".$row['Tlf']."</td> <td>".$row['Email']."</td> <td>".$row['Direccion']."</td> <td>";
  		}
  	}
  }
  //Recupera los datos de un cliente en un array.
  function mostrarCliente($client){

  	$db = conectarBD();

  	$sql = "SELECT * FROM Cliente_Externo WHERE Id_Cliente='".$client."' AND Borrado='0';";
  	$resultado = $db->query($sql);
  	if ($resultado->num_rows == 1){
  		$row = $resultado->fetch_assoc();
  		return $row;
  	}
  }
  //Muestra los datos de un cliente concreto pasado por parámetro en formato tabla
  function consultarCliente($client){

  	$db = conectarBD();

  	$sql = "SELECT * FROM Cliente_Externo WHERE Id_Cliente='".$client."' AND Borrado='0';";
  	$resultado = $db->query($sql);
  	if ($resultado->num_rows > 0){
  		$row = $resultado->fetch_array();
  		echo "<tr> <td>".$row['Id_Cliente']."</td> <td>".$row['Nombre']."</td> <td>".$row['DNI']."</td> <td>".$row['Tlf']."</td> <td>".$row['Email']."</td> <td>".$row['Direccion']."</td> <td>";
  	}
  }

  }else echo "Permiso denegado.";


?>
