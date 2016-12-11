<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 || strcmp($_SESSION['grupo'],"Secretario") == 0) ){ 

//Crea la clase e instancia la función render en el constructor. 
class Alumno_Editar{
	
	//Si se le pasa, crea un array con los datos del alumno.
	function __construct($datos=null){
		$this->render($datos);
	}

	function render($datos){
		require_once('../header.php'); 
?>
		<!-- Título de la página -->	
		<title><?php echo $strings['titulo editar alumno']; ?></title>

		<body>
		  <div class="row-fluid">
			<!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
					<div class="container-fluid">
					
					<!-- Formulario para seleccionar el alumno a editar -->
					<?php if(!isset($_POST['alumno'])){ ?>
					<form class="form-horizontal" role="form" method="POST" action="">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar alumno']; ?></h2></div>
								<div class="col-md-12"><hr></div>
							
							<!-- Lista los alumnos registrados -->						
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['alumno']; ?>:</label>
								</div><div class="col-sm-4">
									<?php listarAlumnosModificar(); ?>
							</div></div>
						</div>
						
						<!-- Submit para visualizar alumno a modificar -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">						
							</div></div>
					</form>
						
					<!-- Formulario para mostrar el alumno y confirmar la edición -->
					<?php }else{ ?>
					<form class="form-horizontal" role="form" name="formulario" method="POST" action="../controllers/ALUMNO_Controller.php?id=modificarAlumno" onsubmit="return pregunta()">
						<div class="form-group">
							<div class="col-md-20"> <h2 class="text-info "><?php echo $strings['editar alumno']; ?></h2></div>
								<div class="col-md-12"><hr></div>
							
							<!-- Muestra los datos del alumno a editar -->
							<table class="table table-striped">
								<thead><tr> 
                                                                    <th><?php echo $strings['dni']; ?></th>
                                                                    <th><?php echo $strings['apellidos']; ?></th>
                                                                    <th><?php echo $strings['nombre']; ?></th>
                                                                    <th><?php echo $strings['direccion']; ?></th>
                                                                    <th><?php echo $strings['email']; ?></th>
                                                                    <th><?php echo $strings['nacimiento']; ?></th>
                                                                    <th><?php echo $strings['profesion']; ?></th> 
                                                                    <th><?php echo $strings['observaciones']; ?></th>
								</thead><tbody>
									<?php consultarAlumno($_POST['alumno']); ?>
								</tbody>
							</table>
							
							<!-- Input oculto con el alumno a modificar -->
							<input type="hidden" name="alumno" value="<?php echo $_POST['alumno']; ?>">
							<input type="hidden" name="alumnoN" value="<?php echo $_POST['alumno']; ?>">
                                                        
                                                        <input type="hidden" name="dni" value="<?php echo $datos['DNI']; ?>">
                                                        <input type="hidden" name="apellidos" value="<?php echo $datos['Apellidos']; ?>">
                                                        <input type="hidden" name="nombre" value="<?php echo $datos['Nombre']; ?>">
                                                        <input type="hidden" name="direccion" value="<?php echo $datos['Direccion']; ?>">
                                                        <input type="hidden" name="email" value="<?php echo $datos['Email']; ?>">
                                                        <input type="hidden" name="nacimiento" value="<?php echo $datos['Fecha_Nacimiento']; ?>">
                                                        <input type="hidden" name="profesion" value="<?php echo $datos['Profesion']; ?>">
                                                        <input type="hidden" name="observaciones" value="<?php echo $datos['Observaciones']; ?>">
                                                        
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?> <?php echo $strings['campos modificar']; ?>:</label>
								</div>
							</div>
						</div>

                                                        <!-- Campo nombre -->
                                                        <div class="form-group">
                                                                <div class="col-sm-4">
                                                                  <label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                  <input type="text" class="form-control" name="nombreN" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{3,50}" title="<?php echo $strings['error nombreA']; ?>" >
                                                                </div>
                                                        </div>

                                                        <!-- Campo apellidos -->
                                                        <div class="form-group">
                                                                <div class="col-sm-4">
                                                                  <label for="nombre" class="control-label"><?php echo $strings['apellidos']; ?>:</label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                  <input type="text" class="form-control" name="apellidosN" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{3,70}" title="<?php echo $strings['error apellidosA']; ?>" >
                                                                </div>
                                                        </div>

                                                        <!-- Campo direccion -->
                                                        <div class="form-group">
                                                                <div class="col-sm-4">
                                                                  <label for="nombre" class="control-label"><?php echo $strings['direccion']; ?>:</label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                  <input type="text" class="form-control" name="direccionN" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ\. ]{3,100}" title="<?php echo $strings['error direccionA']; ?>" >
                                                                </div>
                                                        </div>

                                                        <!-- Campo email -->
                                                        <div class="form-group">
                                                                <div class="col-sm-4">
                                                                  <label for="nombre" class="control-label"><?php echo $strings['email']; ?>:</label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                  <input type="email" class="form-control" name="emailN" title="<?php echo $strings['error emailA']; ?>" >
                                                                </div>
                                                        </div>

                                                        <!-- Campo fecha de nacimiento -->
                                                        <div class="form-group">
                                                                <div class="col-sm-4">
                                                                  <label for="nombre" class="control-label"><?php echo $strings['nacimiento']; ?>:</label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                  <input type="date" class="form-control" name="nacimientoN" title="<?php echo $strings['error nacimientoA']; ?>" >
                                                                </div>
                                                        </div>

                                                        <!-- Campo profesion -->
                                                        <div class="form-group">
                                                                <div class="col-sm-4">
                                                                  <label for="nombre" class="control-label"><?php echo $strings['profesion']; ?>:</label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                  <input type="text" class="form-control" name="profesionN" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{3,50}" title="<?php echo $strings['error profesionA']; ?>" >
                                                                </div>
                                                        </div>

                                                        <!-- Campo observaciones -->
                                                        <div class="form-group">
                                                                <div class="col-sm-4">
                                                                  <label for="nombre" class="control-label"><?php echo $strings['observaciones']; ?>:</label>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                  <input type="text" class="form-control" name="observacionesN" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ\. ]{3,500}" title="<?php echo $strings['error observacionesA']; ?>" >
                                                                </div>
                                                        </div>
						
						<!-- Submit para editar el alumno, con confirmación -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['modificar']; ?>" type="submit">						
							</div></div>
					</form>
					<?php } ?>
					</div>
				</div>
			</div>
		  </div>
		</body>
<?php 
		}
	}
}else
	echo "Permiso denegado.";
?>