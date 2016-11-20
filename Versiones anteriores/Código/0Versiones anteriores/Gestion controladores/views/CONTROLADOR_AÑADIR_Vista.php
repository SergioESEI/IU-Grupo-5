<html>
<head> 
    <title> Añadir Controlador</title>
</head>
<?php
	session_start();
	if(strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	include_once('../header.php'); 
?>

  <html><body>
    <div class="container-fluid text-center">
      <div class="row content">
        <?php include_once('menu.php'); ?>
        <div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
							<form class="form-horizontal" role="form" action="../controllers/CONTROLADOR_Controller.php?id=altaControlador" method="POST">
								<div class="form-group">
										<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nuevo controlador']; ?></h2></div>
										<div class="col-md-12"><hr></div>

										<!-- Campo nombre-->
										<div class="form-group">
											<div class="col-sm-4">
											  <label for="nombre" class="control-label"><?php echo $strings['controlador']; ?></label>
											</div>
											<div class="col-sm-4">
											  <input type="text" class="form-control" name="controlador" pattern="[A-Za-z ]{4,40}"  title="minimo 4 letras" required>
											</div>
										</div>
										<!-- Campo apellido -->
										<div class="form-group">
											  <div class="col-sm-4">
												  <label for="apellidos" class="control-label"><?php echo $strings['accion']; ?></label>
											  </div>
											  <div class="col-sm-4">
												  <input type="text" class="form-control" name="accion" pattern="[A-Za-z ]{4,40}"  title="minimo 4 letras" required>
											  </div>
										</div>

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
