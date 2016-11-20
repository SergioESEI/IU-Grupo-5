<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php');
	require_once('../controllers/PERMISO_Controller.php');	
?>
<title><?php echo $strings['titulo editar permiso']; ?></title>

<script> 
	function pregunta(){
		if (confirm('<?php echo $strings['confirmar modificacion']; ?>')){
		   $("form").attr("action","../controllers/PERMISO_Controller.php?id=modificarPermiso");
		   document.formulario.submit();
		}
	}
</script> 

  <body>
    <div class="container-fluid text-center">
      <div class="row content">
        <?php include_once('menu.php'); ?>
        <div class="col-sm-10 text-left">
			<div class="section-fluid">
			  <div class="container-fluid">
				<?php if(!isset($_POST['grupo'])){ ?>
						<!-- Formulario para editar funcionalidad-->
						<form class="form-horizontal" role="form" action="PERMISO_EDITAR_Vista.php" method="POST">
							<div class="form-group">
									<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar permiso']; ?></h2></div>
									<div class="col-md-12"><hr></div>

									<!-- Campo grupo-->
									<div class="form-group">
										<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
										</div><div class="col-sm-4">
										<select name="grupo">
											<?php listarGrupos(); ?>
										</select>
									</div></div>
									
									<!-- Submit que envía grupo a esta vista -->
									 <div class="form-group">
										  <div class="col-sm-4"></div>
										  <input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">						

									 </div>
							</div>
						</form>
							
						<?php } else if(!isset($_POST['controlador'])){ ?>
						<form class="form-horizontal" role="form" action="PERMISO_EDITAR_Vista.php" method="POST">
							<div class="form-group">
									<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar permiso']; ?></h2></div>
									<div class="col-md-12"><hr></div>
									
									<!-- Muestra el grupo seleccionado -->
									<div class="form-group">
										<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
										</div><div class="col-sm-4">
										<?php echo $_POST['grupo']; ?>
									</div></div>
									<input type="hidden" class="form-control" name="grupo" value="<?php echo $_POST['grupo']; ?>">
									
									<!-- Campo controlador -->
									<div class="form-group">
										<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
										</div><div class="col-sm-4">
										<select name="controlador">
											<?php listarControladorGrupo($_POST['grupo']); ?>
										</select>
									</div></div>
									
									<!-- Submit que envía grupo y controlador para seleccionar la acción -->
									 <div class="form-group">
										  <div class="col-sm-4"></div>
										  <input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit" >						
									 </div>
							</div>
						</form>						
							
						<!-- Formulario para la acción a modificar y seleccionar el nuevo controlador -->
						<?php }else if(!isset($_POST['accion'])){ ?>
						<form class="form-horizontal" role="form" method="POST" action="PERMISO_EDITAR_Vista.php">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar permiso']; ?></h2></div>
									<div class="col-md-12"><hr></div>	
								<!-- Muestra el grupo que seleccionó el usuario -->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
									</div><div class="col-sm-4">
									<?php echo $_POST['grupo']; ?>
								</div></div>
								<input type="hidden" class="form-control" name="grupo" value="<?php echo $_POST['grupo']; ?>">
								<!-- Muestra el controlador que seleccionó el usuario -->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
									</div><div class="col-sm-4">
									<?php echo $_POST['controlador']; ?>
								</div></div>
							  <input type="hidden" class="form-control" name="controlador" value="<?php echo $_POST['controlador']; ?>">
								<!-- Lista las acciones del controlador y grupo seleccionados para elegir una -->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['accion']; ?>:</label>
									</div><div class="col-sm-4">
										<select name="accion">
											<?php listarAccionGrupo($_POST['grupo'],$_POST['controlador']); ?>
										</select>
								</div></div>
							  <div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
									</div>
								</div>
							</div>
							<!-- Recoge los datos del nuevo controlador -->
							<input type="hidden" class="form-control" name="grupoN" value="<?php echo $_POST['grupo']; ?>">
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
								</div><div class="col-sm-4">
									<select name="controladorN">
										<?php listarControlador(); ?>
									</select>
							</div></div>
							
							<!-- Submit que envía controlador y acción a editar en los permisos del grupo -->
							<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class='btn btn-primary' value='<?php echo $strings['siguiente']; ?>' type="submit">
							</div></div>
						</form>
						
						<!-- Formulario para enviar los datos -->						
						<?php }else{ ?>
						<form class="form-horizontal" role="form" name="formulario" method="POST" action="">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar permiso']; ?></h2></div>
									<div class="col-md-12"><hr></div>	
								<!-- Muestra el grupo que seleccionó el usuario -->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
									</div><div class="col-sm-4">
									<?php echo $_POST['grupo']; ?>
								</div></div>
								<input type="hidden" class="form-control" name="grupo" value="<?php echo $_POST['grupo']; ?>">
								<!-- Muestra el controlador que seleccionó el usuario -->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
									</div><div class="col-sm-4">
									<?php echo $_POST['controlador']; ?>
								</div></div>
							  <input type="hidden" class="form-control" name="controlador" value="<?php echo $_POST['controlador']; ?>">
								<!-- Muestra los datos de la acción seleccionada -->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['accion']; ?>:</label>
									</div><div class="col-sm-4">
									<?php echo $_POST['accion']; ?>
								</div></div>
								<input type="hidden" class="form-control" name="accion" value="<?php echo $_POST['accion']; ?>">
							  <div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
									</div>
								</div>
							</div>
							<!-- Muestra los datos del nuevo controlador seleccionada -->
							<input type="hidden" class="form-control" name="grupoN" value="<?php echo $_POST['grupoN']; ?>">
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
								</div><div class="col-sm-4">
								<?php echo $_POST['controladorN']; ?>
							</div></div>
							<input type="hidden" class="form-control" name="controladorN" value="<?php echo $_POST['controladorN']; ?>">
							<!-- Recoge los datos de la nueva acción -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['accion']; ?>:</label>
								</div><div class="col-sm-4">
									<select name="accionN">
										<?php listarAccion($_POST['controladorN']); ?>
									</select>
							</div></div>
							
							<!-- Submit que envía controlador y acción a editar en los permisos del grupo -->
							<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class='btn btn-primary' value='<?php echo $strings['modificar']; ?>' type="button" onclick="pregunta()">
							</div></div>
						</form>
						<?php } ?>
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