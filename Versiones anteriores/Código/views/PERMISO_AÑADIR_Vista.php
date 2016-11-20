<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php'); 
	require_once('../controllers/PERMISO_Controller.php');

?>
<title><?php echo $strings['titulo añadir permiso']; ?></title>

<script> 
	//Devuelve el controlador para seleccionar una de sus acciones.
	function submit(){
		$("form").attr("action", "PERMISO_AÑADIR_Vista.php");
		$('form').submit();
	}
	
	//Confirman el añadido.
	function pregunta(){
		if (confirm('<?php echo $strings['añadir permisos']; ?>')){
		   $("form").attr("action","../controllers/PERMISO_Controller.php?id=altaPermiso");
		   document.formulario1.submit();
		}
	}
</script>

  <body>
	<!-- Include del menú-->
    <div class="container-fluid text-center">
      <div class="row content">
        <?php include_once('menu.php'); ?>
        <div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
						<!-- Formulario para añadir funcionalidad-->
						<?php if(!isset($_POST['controlador'])){ ?>
						<form class="form-horizontal" role="form" name="formulario1" action="" method="POST">
							<div class="form-group">
									<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nuevo permiso']; ?></h2></div>
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
									
									<!-- Campo controlador -->
									<div class="form-group">
										<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
										</div><div class="col-sm-4">
										<select name="controlador">
											<?php listarControlador(); ?>
										</select>
									</div></div>
									
									<!-- Submit que envía grupo y controlador para seleccionar la acción o añade todas las acciones de ese controlador al grupo -->
									 <div class="form-group">
										  <div class="col-sm-4"></div>
										  <input class="btn btn-primary" value="<?php echo $strings['añadir todo']; ?>" type="button" id="boton" onclick="pregunta()">
										  <input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="button" onclick="submit()">						

									 </div>
							</div>
						</form>
						
						<!-- Formulario para seleccionar la acción a insertar en el grupo del controlador elegido -->
					<?php 
					}else{ ?>
						<form class="form-horizontal" role="form" method="POST" action="../controllers/PERMISO_Controller.php?id=altaPermiso">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nuevo permiso']; ?></h2></div>
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
							<!-- Lista las acciones del controlador seleccionado -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['accion']; ?>:</label>
								</div><div class="col-sm-4">
								<select name="accion">
									<?php listarAccion($_POST['controlador']); ?>
								</select>
							</div></div>
						</div>
						
						<!-- Submit que envía controlador y acción a insertar en los permisos del grupo -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class='btn btn-primary' value='<?php echo $strings['crear']; ?>' type='submit'>
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
