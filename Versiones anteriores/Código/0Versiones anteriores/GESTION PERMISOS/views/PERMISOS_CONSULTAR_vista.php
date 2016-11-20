
<html>
<head> 
    <title> <?php echo $strings['consultarPermisos']; ?></title>
</head>
<?php
	session_start();
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

	include_once('../header.php'); 
	include_once('../models/PERMISOS_modelo.php');
?>
<title><?php echo $strings['mostrarPermisos']; ?></title>
  <body>
	<div class="container-fluid text-center">
      <div class="row content">
        <?php include_once('menu_permisos.php'); ?>
        <div class="col-sm-10 text-left">
			<div class="section-fluid">
			  <div class="container-fluid">
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['escoger grupo y controlador']; ?></h2></div>
						<div class="col-md-12"><hr></div>
							<?php mostrarSelectsConsultar();;?>
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
