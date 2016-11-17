<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php');
	require_once('../controllers/CONTROLADOR_Controller.php');	
?>
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
    <div class="container-fluid text-center">
      <div class="row content">
        <?php include_once('menu.php'); ?>
        <div class="col-sm-10 text-left">
			<div class="section-fluid">
			  <div class="container-fluid">
				
				<!-- Formulario para seleccionar el controlador a editar y mostrar sus acciones -->
				<?php if(!isset($_POST['controlador'])){ ?>
					<form class="form-horizontal" role="form" method="POST" action="CONTROLADOR_EDITAR_Vista.php">
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar controlador']; ?></h2></div>
							<div class="col-md-12"><hr></div>
						
						<!-- Campo para seleccionar el controlador a modificar -->
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
							</div><div class="col-sm-4">
							<select name="controlador">
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
							
						<!-- Muuestra el controlador seleccionado y lo añade a un input oculto -->	
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
							<select name="accion">
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
						<input type="text" class="form-control" id="controladorN" name="controladorN" value="<?php echo $_POST['controlador']; ?>" pattern="[A-ZÑña-zÁÉÍÓÚáéíóú ]{4,30}" title="palabra demasiado corta" required>
					</div></div>
					
					<!-- Campo para añadir la nueva acción -->
					<div class="form-group">
						<div class="col-sm-4">
						<label for="nombre" class="control-label"><?php echo $strings['accion']; ?>:</label>
						</div><div class="col-sm-4">
						<input type="text" class="form-control" id="accionN" name="accionN" pattern="[A-ZÑña-zÁÉÍÓÚáéíóú]{3,30}" title="palabra demasiado corta" required>
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
	</div>
</body>
<?php 
}else{
	echo "Permiso denegado.";
} ?>
</html>