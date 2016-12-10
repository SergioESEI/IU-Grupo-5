<?php

//Si no hay una sesión iniciada la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	
	//Requires del modelo, otros controladores y las vistas.
	require_once('../models/LESION_Model.php'); 	

	require_once('../views/LESION_ADD_Vista.php');
	require_once('../views/LESION_ADD_CONFIRMAR_Vista.php');
	require_once('../views/LESION_DELETE_Vista.php');
	require_once('../views/LESION_DELETE_CONFIRMAR_Vista.php');
	require_once('../views/LESION_LISTAR_TRABAJADORES_Vista.php');
	require_once('../views/LESION_LISTAR_ALUMNOS_Vista.php');
	require_once('../views/LESION_LIST_Vista.php'); 
	require_once('../views/LESION_EDIT_Vista.php');
	require_once('../views/TRABAJADOR_EDIT_CONFIRMAR_Vista.php');
	require_once('../views/LESION_BUSCAR_Vista.php');
	require_once('../views/LESION_SHOW_Vista.php');
	
	//Include del idioma elegido, o español por defecto.
	if(isset($_SESSION['lang'])){
		if(strcmp($_SESSION['lang'],'gal')==0)
			include("../locates/Strings_GALEGO.php"); 
		else if(strcmp($_SESSION['lang'],'esp')==0)
			include("../locates/Strings_CASTELLANO.php"); 
	}else{
		include("../locates/Strings_CASTELLANO.php"); 
	}

	//Recoge los datos del formulario de la vista en un objeto 'trabajador'.

	
	function datosFormLesion(){

		if(isset($_POST['idLesion'])){
			$id=$_POST['idLesion'];
		}else{
			$id=null;
		}
		$dni=$_POST['dni'];
		$tipo=$_POST['tipo'];
		$descripcion=$_POST['descripcion'];
		$curada=$_POST['curada'];

		$lesion= new Lesion($id,$dni,$tipo,$descripcion,$curada);
		return $lesion;
	}

	

	//Primero invoca a la vista correspondiente según la opción elegida en el menú y pasada por get.
	//Después invoca un método del modelo con los datos recibidos vía post de la vista.
	//Finalmente muestra un mensaje de error o confirmación tras acceder a la BD y redirige a la vista.
	if(isset($_GET['id'])){
		$action = $_GET['id'];
		switch($action){
			
			case 'altaLesion':
				if(!isset($_GET['id2'])){
					new Lesion_Escoger_DNI();
				}else if(!isset($_GET['ok'])){
					new Lesion_Nueva($_GET['id2']);
				}else if(!isset($_GET['confirm'])){
					$lesion=datosFormLesion();
					var_dump($lesion);
					new Lesion_Nueva_Confirmar($lesion);
				}else{
					$lesion=datosFormLesion();
					$mensaje = $lesion->crear(); 
					?>
					<script>
						window.alert('<?php echo $strings[$mensaje]; ?>');
					</script><?php
					unset($_GET['ok']);
					unset($_GET['confirm']);
					new Lesion_Nueva($_GET['id2']);
				}
							
			break;
			
			case 'bajaLesion':
			if(!isset($_GET['idles'])){
				new Lesion_Borrar($_GET['id2']);
			}else if(!isset($_GET['confirm'])){
				$array = mostrarLesion($_GET['idles']);
				new Lesion_Borrar_Confirmar($array);
			}else{
				$lesion = datosFormLesion();
				$mensaje = $lesion->borrar(); ?>
				<script>
					window.alert('<?php echo $strings[$mensaje]; ?>');
				</script><?php
				unset($_GET['idles']);
				unset($_GET['confirm']);
				new Lesion_Borrar($_GET['id2']);
			}
			break;
			case 'listarTrabajadores':
				new Lesion_Escoger_Trabajador('activos');

			break;

			case 'listarAlumnos':
				new Lesion_Escoger_Alumno('activos');
			break; 


			case 'listarTrabajadoresBorrados':
				new Lesion_Escoger_Trabajador('no activos');

			break;

			case 'listarAlumnosBorrados':
				new Lesion_Escoger_Alumno('no activos');
			break; 

			case 'verLesiones':
				new Lesion_Listar_DNI('activos',$_GET['id2']);
			break; 

				case 'verLesionesBorradas':
				new Lesion_Listar_DNI('no activos',$_GET['id2']);
			break; 



			case 'modificarLesion':
				if(!isset($_GET['id2'])){
					new Lesion_Editar();
				}
				else if(!isset($_POST['dniN'])){
					$array = mostrarLesionDni($_GET['id2']);
					new Lesion_Editar($array);
				}else if(!isset($_GET['confirm'])){
					$array = mostrarLesionDni($_GET['id2']);
					$trabajador2 = datosFormLesionModificar($array);
					new Lesion_Editar_Confirmar($trabajador2);
				}else{
					$array = mostrarTrabajadorDni($_GET['id2']);
					$trabajador = datosFormTrabajador();
					$trabajador2 = datosFormTrabajadorModificar($array);
					$mensaje = $trabajador->modificar($trabajador2); ?>
					<script>
						window.alert('<?php echo $strings[$mensaje]; ?>');
					</script><?php
					unset($_GET['id2']);
					new Trabajador_Editar();
				}
				break;
				
				
				case 'buscarTrabajador':
				if(!isset($_GET['buscar'])){
					new Lesion_Buscar();
				}else{
					$trabajador = datosFormLesion();
					$array = buscarLesion($trabajador);
					new Lesion_Buscar($array);
				}
				break;
				case 'mostrarLesion':

				$idLesion = $_GET['idles'];
				$array = mostrarLesion($idLesion);
				new Lesion_Mostrar($array);
				break;
			}
			
		}
	}else echo "Permiso denegado.";
	?>