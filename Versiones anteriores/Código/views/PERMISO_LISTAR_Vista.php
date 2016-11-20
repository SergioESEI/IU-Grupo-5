<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php');
	require_once('../controllers/PERMISO_Controller.php');
?>
<title><?php echo $strings['titulo listar permiso']; ?></title>

	<body>
	<div class="container-fluid text-center">
      <div class="row content">
        <?php include_once('menu.php'); ?>
        <div class="col-sm-10 text-left">
			<div class="section-fluid">
			  <div class="container-fluid">
				
				<!-- Lista acciones poor controlador (funcionalidades) -->
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['ver permiso']; ?></h2></div>
						<div class="col-md-12"><hr></div>
							<table class="table table-striped">
								<thead><tr> 
									<th><?php echo $strings['grupo']; ?></th>
									<th><?php echo $strings['controlador']; ?></th>
									<th><?php echo $strings['accion']; ?></th></tr> 
								</thead><tbody>
									<?php listarPermisos(); ?>
								</tbody>
							</table>
					</div>
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