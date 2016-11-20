<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php');
	require_once('../controllers/USUARIO_Controller.php');	
?>
<title><?php echo $strings['titulo listar usuario']; ?></title>

	<body>
	<div class="container-fluid text-center">
      <div class="row content">
        <?php include_once('menu.php'); ?>
        <div class="col-sm-10 text-left">
			<div class="section-fluid">
			  <div class="container-fluid">
				
				<!-- Lista los grupos -->
				<div class="form-group">
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['ver usuario']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					<table class="table table-striped">
						<thead><tr> 
							<th>Usuario</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th><?php echo $strings['dni']; ?></th>
							<th>email</th>
							<th>telefono</th>
							<th><?php echo $strings['grupo']; ?></th>
						</thead><tbody>
							<?php verUsuarios(); ?>
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