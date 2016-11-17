<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php'); 
	require_once('../controllers/CONTROLADOR_Controller.php');
?>
<title><?php echo $strings['titulo añadir controlador']; ?></title>

  <body>
	<!-- Include del menú-->
    <div class="container-fluid text-center">
      <div class="row content">
        <?php include_once('menu.php'); ?>
        <div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
							
							<!-- Formulario para añadir funcionalidad-->
							<form class="form-horizontal" role="form" action="../controllers/CONTROLADOR_Controller.php?id=altaControlador" method="POST">
								<div class="form-group">
										<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nuevo controlador']; ?></h2></div>
										<div class="col-md-12"><hr></div>

										<!-- Campo controlador-->
										<div class="form-group">
											<div class="col-sm-4">
											  <label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
											</div>
											<div class="col-sm-4">
											  <input type="text" class="form-control" name="controlador" pattern="[A-ZÑña-zÁÉÍÓÚáéíóú ]{4,30}" title="palabra demasiado corta o formato incorrecto" required>
											</div>
										</div>
										<!-- Muestra los controladores registrados en la BD para que el usuario tenga una referencia -->
										<div class="form-group">
											<div class="col-sm-4">
											 <label for="nombre" class="control-label"><?php echo $strings['controladores registrados']; ?>:</label><br>
											 <select>
												<?php listarControlador(); ?>
											</select>
											</div>
										 </div>
										<!-- Campo accion -->
										<div class="form-group">
											  <div class="col-sm-4">
												  <label for="apellidos" class="control-label"><?php echo $strings['accion']; ?>:</label>
											  </div>
											  <div class="col-sm-4">
												  <input type="text" class="form-control" name="accion" pattern="[A-ZÑña-zÁÉÍÓÚáéíóú]{3,30}" title="palabra demasiado corta o formato incorrecto" required>
											  </div>
										</div>
										
										<!-- Submit que envía en controlador y acción a añadir -->
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
	</div>
</body>
<?php 
}else{
	echo "Permiso denegado.";
} ?>
</html>
