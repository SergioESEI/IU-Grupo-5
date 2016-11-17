<?php

include('../controllers/PERMISOS_controller.php');

class Permisos{

  var $mysqli;


function ConectarBD()//Escribimos la funcion para conectarnos a la Base de Datos
{
    $this->mysqli = new mysqli("localhost", "admin", "admin", "IU2016");
	
	if ($this->mysqli->connect_errno) {
		echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
	}
}

function listarGrupoUsuarios(){//Con esta funcion ejecutamos la sentencia SQL para sacar todos los grupos de usuarios. A continuación convertimos el resultado en un array
    $toQuery = "select GRUPO from GRUPO";
    $result = $this->doQuery($toQuery);
    return $this->returnArray($result);
}

function listarControladores(){//Con esta funcion ejecutamos la sentencia SQL para sacar todos los controladores. A continuación convertimos el resultado en un array
    $toQuery = "select CONTROLADOR from CONTROLADOR";
    $result = $this->doQuery($toQuery);
    return $this->returnArray($result);
}

  function listarAccionesControlador($valorSelect2){//Con esta funcion ejecutamos la sentencia SQL para sacar todos las acciones del controlador que le pasamos como parámetro. A continuación convertimos el resultado en un array
    $toQuery = 'select ACCION from CONTROLADOR where CONTROLADOR == "' . $valorSelect2 . '"';
    $result = $this->doQuery($toQuery);
    return $this->returnArray($result);
}

  function listarPermisosGrupoControlador($grupo, $controlador){//Con esta funcion sacamos las acciones a las que tiene permiso un usuario
    $toQuery = 'select ACCION where GRUPO == ' . $grupo .' and CONTROLADOR ==' . $controlador . ';';
    $result = $this->doQuery($toQuery);
    return $this->returnArray($result);
  }

  function devolverArray($result){//Convertimos el resultado de una query a un array asociativo
    $arrayToReturn = array();
    while($r = $result->fetch_assoc()){
      array_push($arrayToReturn,$r);
    }
    return $arrayToReturn;
  }

function desconectarBD()//Cerramos la conexion con la base de datos
{
  mysql_close();
}

  function mostrarSelectsConsultar(){//En esta funcion generamos los selects que nos muestran los grupos de usuarios y los controladores.

  conectarBD();
  $arrayGrupos = listarGrupoUsuarios();//Guardammos los grupos en un array
  $arrayControladores = listarControladores();//Guardamos los controladores en un array
  desconectarBD();

  echo '<form action="../controllers/PERMISO_controller.php?id=consultarPermisos" method="post"> <br> <select name="selectgrupos"> <br>';//Mostramos el primer select.
                
                foreach($arrayGrupos as $clave => $grupos){

                  echo '<option value="'. $grupos . '">' . $grupos . '</option> <br>';
                  
                }

  echo '</select> <br> <select name="selectcontroladores"> <br>';
                
                foreach($arrayControladores as $clave => $controladores){

                  echo '<option value="'. $controladores . '">' . $controladores . '</option> <br>';
                  
                }

  echo '</select> <br> <input type = 'submit' name = 'accion' value = 'Seleccionar' > <br> </form>';

}

function mostrarSelectsModificar(){//En esta funcion generamos los selects que nos muestran los grupos de usuarios y los controladores.

  conectarBD();
  $arrayGrupos = listarGrupoUsuarios();//Guardammos los grupos en un array
  $arrayControladores = listarControladores();//Guardamos los controladores en un array
  desconectarBD();

  echo '<form action="../controllers/PERMISO_controller.php?id=modificarPermisos" method="post"> <br> <select name="selectgrupos"> <br>';//Mostramos el primer select.
                
                foreach($arrayGrupos as $clave => $grupos){

                  echo '<option value="'. $grupos . '">' . $grupos . '</option> <br>';
                  
                }

  echo '</select> <br> <select name="selectcontroladores"> <br>';
                
                foreach($arrayControladores as $clave => $controladores){

                  echo '<option value="'. $controladores . '">' . $controladores . '</option> <br>';
                  
                }

  echo '</select> <br> <input type = 'submit' name = 'accion' value = 'Seleccionar' > <br> </form>';

}

      /*$valorSelect1=$_POST['selectgrupos'];//Recogemos el valor del select de grupos
      $valorSelect2=$_POST['selectcontroladores'];//Recogemos el valor del select de controladores*/

function mostrarCheckboxesModificar(){//Esta funcion nos muestra los checkboxes en el caso de querer modificar permisos.
  conectar();
  $arrayPermisos = listarPermisosGrupoControlador($valorSelect1, $valorSelect2);
  $arrayAcciones = listarAccionesControlador($valorSelect2);
  desconectarBD();
//Creamos un nuevo formulario para mostrar las acciones en forma de checkboxes.

  echo '<form action="../procesarCheckboxes.php" method="post"> <br>';
  
 
        foreach ($arrayAcciones as $clave => $accion) {

          if(in_assoc($accion, $arrayPermisos)){

              echo '<input type="checkbox" checked name="acciones[]" value="' . $accion . '">' . $accion . '<br>';//Si el permiso esta concedido, se le muestra el checkbox marcado.
          }else{
              echo '<input type="checkbox" name="acciones[]" value="' . $accion . '">' . $accion . '<br>';//Si el permiso no esta concedido, mostramos el checkbox vacio
          }
  }
  echo '<input type = 'submit' name = 'aceptar' value = 'Aceptar' > <br> </form>';
}


 function mostrarCheckboxesConsultar(){//Esta funcion nos muestra los checkboxes en el caso de querer consultar permisos.
  conectar();
  $arrayPermisos = listarPermisosGrupoControlador($valorSelect1, $valorSelect2);
  $arrayAcciones = listarAccionesControlador($valorSelect2);
  desconectarBD();
//Creamos un nuevo formulario para mostrar las acciones en forma de checkboxes.

  echo '<form <br>';
  
 
        foreach ($arrayAcciones as $clave => $accion) {

          if(in_assoc($accion, $arrayPermisos)){

              echo '<input type="checkbox" checked disabled name="acciones[]" value="' . $accion . '">' . $accion . '<br>';//Si el permiso esta concedido, se le muestra el checkbox marcado. El checkbox esta deshabilitado, ya que solo vamos a consultar.
          }else{
        
              echo '<input type="checkbox" disabled name="acciones[]" value="' . $accion . '">' . $accion . '<br>';//Si el permiso no esta concedido, mostramos el checkbox vacio
          }
  }
  echo 'form>';
  
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function modificarPermisos($arraySeleccionados,$arrayNoSeleccionados,$valorSelect1,$valorSelect2){//SIN ACABAR. FALTA LA SENTENCIA SQL

        
//Para comprobar si un checkbox fue modificado, compruebo cuales de los seleccionados no estaban en el array de permisos.
        foreach ($arraySeleccionados as $clave => $valor) {
          if(!in_assoc($valor, $arrayPermisos)){
            //ENTONCES AQUI SE LE ASIGNARON PERMISOS, POR LO QUE AÑADIMOS A LA BD LA ACCION, CONTROLADOR Y GRUPO

          }
        }

        foreach ($arrayNoSeleccionados as $clave => $valor) {
          if(in_assoc($valor, $arrayPermisos)){
            //ENTONCES AQUI ELIMINAMOS PERMISOS, POR LO QUE BORRAMOS DE LA BD LA ACCION, CONTROLADOR Y GRUPO.
          }
        }
}



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function in_assoc($needle,$array){//Esta funcion comprueba si un valor se encuentra en un array asociativo.

    $key = array_keys($array);
    $value = array_values($array);
    if (in_array($needle,$key)){
      return true;
    }
    elseif (in_array($needle,$value)){
      return true;
    }
    else {
      return false;
    }
}
}
?>