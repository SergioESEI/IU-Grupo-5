<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Accion_Crear{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>		
		<!-- Título de la página -->
		<title><?php echo $strings['titulo añadir controlador']; ?></title>

		  <body>
			<!-- Include del menú-->
			  <div class="row-fluid">
				<?php include_once('menu.php'); ?>
				<div class="col-sm-10 text-left">
					<div class="section-fluid">
					  <div class="container-fluid">
								
						<!-- Formulario para seleccionar el controlador al que se añade la acción y la acción a crear -->
						<form class="form-horizontal" role="form" method="POST" action="../controllers/CONTROLADOR_Controller.php?id=altaAccion">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nuevo controlador']; ?></h2></div>
									<div class="col-md-12"><hr></div>
								
								<!-- Campo para seleccionar el controlador -->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
									</div><div class="col-sm-4">
									<select name="controlador" required>
										<?php listarControlador(); ?>
									</select>
								</div></div>
								</div>

								<!-- Campo acción -->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['accion']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="accion" pattern="[A-ZÑña-zÁÉÍÓÚáéíóú]{4,30}" title="<?php echo $strings['error controlador']; ?>" required>
									</div>
								</div>
								
								<!-- Submit que envía en controlador a añadir -->
								 <div class="form-group">
									  <div class="col-sm-4"></div>
									  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['crear']; ?>" type="submit">
									  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
								 </div>
							</div>
						</form>
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
