<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Controlador_Editar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>	
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo editar controlador']; ?></title>

		<script> 
		//Confirmar la edición.
		function pregunta(){
				if (confirm('<?php echo $strings['confirmar modificacion']; ?>')){
				   document.formulario.submit();
			} else return false;
		}
		</script>
			
		  <body>
			  <div class="row-fluid">
				<?php include_once('menu.php'); ?>
				<div class="col-sm-10 text-left">
					<div class="section-fluid">
					  <div class="container-fluid">
						
						<!-- Formulario para seleccionar el controlador a editar -->
						<?php if(!isset($_POST['controlador'])){ ?>
						<form class="form-horizontal" role="form" method="POST" action="../controllers/CONTROLADOR_Controller.php?id=modificarControlador">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar controlador']; ?></h2></div>
									<div class="col-md-12"><hr></div>
								
								<!-- Campo para seleccionar el controlador a modificar -->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
									</div><div class="col-sm-4">
									<select name="controlador" required>
										<?php listarControlador(); ?>
									</select>
								</div></div>
							</div>
							
							<!-- Submit del controlador a modificar -->
							<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">						
							</div></div>
						</form>
						
						<!-- Formulario para seleccionar la acción a editar, además del nuevo controlador y acción -->
						<?php 
						}else{ ?>
							<form class="form-horizontal" role="form" onsubmit="return pregunta()" name="formulario" method="POST" action="../controllers/CONTROLADOR_Controller.php?id=modificarControlador">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar controlador']; ?></h2></div>
									<div class="col-md-12"><hr></div>	
									
								<!-- Muestra el controlador seleccionado y lo añade a un input oculto -->	
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
									</div><div class="col-sm-4">
									<?php echo $_POST['controlador']; ?>
								</div></div>
								<input type="hidden" class="form-control" name="controlador" value="<?php echo $_POST['controlador']; ?>">
								
								<!-- Lista las acciones del controlador a modificar -->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['accion']; ?>:</label>
									</div><div class="col-sm-4">
									<select name="accion" required>
										<?php listarAccion($_POST['controlador']); ?>
									</select>
								</div></div>
			
								<div class="form-group"><div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
								</div></div>
							</div>
							
							<!-- Campo para añadir el nuevo controlador -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
								</div><div class="col-sm-4">
								<input type="text" class="form-control" id="controladorN" name="controladorN" value="<?php echo $_POST['controlador']; ?>" pattern="[A-ZÑña-zÁÉÍÓÚáéíóú ]{4,30}" title="<?php echo $strings['error controlador']; ?>" required>
							</div></div>
							
							<!-- Campo para añadir la nueva acción -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['accion']; ?>:</label>
								</div><div class="col-sm-4">
								<input type="text" class="form-control" id="accionN" name="accionN" pattern="[A-ZÑña-zÁÉÍÓÚáéíóú]{3,30}" title="<?php echo $strings['error accion']; ?>" required>
							</div></div>
							
							<!-- Submit que envía el controlador y acción a modificar y el controlador y acción nuevos -->
							<div class="form-group">
									<div class="col-sm-4"></div>
									<div class="col-sm-4">
									<input class='btn btn-primary' type='submit' value='<?php echo $strings['modificar']; ?>' >
								</div></div>
							</form>
						<?php } ?>			
						</div>
					</div>
				</div>
			  </div>
		</body>
<?php 	}
}
}else
	echo "Permiso denegado.";
?>