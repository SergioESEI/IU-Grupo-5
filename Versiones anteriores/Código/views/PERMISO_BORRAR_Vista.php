<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php');
	require_once('../controllers/PERMISO_Controller.php');
?>
<title><?php echo $strings['titulo borrar permiso']; ?></title>
	
	<script> 
	//Devuelve el controlador para seleccionar una de sus acciones.
	function submit(){
		$("form").attr("action", "PERMISO_BORRAR_Vista.php");
		$('form').submit();
	}
	
	//Confirman el borrado.
	function pregunta(){
		if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
		   $("form").attr("action","../controllers/PERMISO_Controller.php?id=bajaPermiso");
		   document.formulario1.submit();
		}
	}
	function pregunta2(){
		if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
		   $("form").attr("action","../controllers/PERMISO_Controller.php?id=bajaPermiso");
		   document.formulario2.submit();
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
					<!-- Formulario para borrar funcionalidad-->
							<form class="form-horizontal" role="form" name="formulario" action="PERMISO_BORRAR_Vista.php" method="POST">
								<div class="form-group">
										<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar permiso']; ?></h2></div>
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
										
										<!-- Submit que envía grupo y controlador para seleccionar la acción o borra todas las acciones de ese controlador al grupo -->
										 <div class="form-group">
											  <div class="col-sm-4"></div>
											  <input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">						

										 </div>
								</div>
							</form>
						<?php } else if(!isset($_POST['controlador'])){ ?>
							<form class="form-horizontal" role="form" name="formulario1" action="" method="POST">
								<div class="form-group">
										<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar permiso']; ?></h2></div>
										<div class="col-md-12"><hr></div>

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
										
										<!-- Submit que envía grupo y controlador para seleccionar la acción o borra todas las acciones de ese controlador al grupo -->
										 <div class="form-group">
											  <div class="col-sm-4"></div>
											  <input class="btn btn-primary" value="<?php echo $strings['borrar todos permisos']; ?>" type="button" id="boton" onclick="pregunta()" dir="../controllers/PERMISO_Controller.php?id=bajaPermiso">
											  <input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="button" onclick="submit()" dir="PERMISO_BORRAR_Vista.php">						

										 </div>
								</div>
							</form>
							
							<!-- Formulario para seleccionar la acción a borrar del controlador elegido -->
						<?php 
						}else{ ?>
							<form class="form-horizontal" role="form" name="formulario2" method="POST" action="../controllers/PERMISO_Controller.php?id=bajaPermiso">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar permiso']; ?></h2></div>
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
										<?php listarAccionGrupo($_POST['grupo'],$_POST['controlador']); ?>
									</select>
								</div></div>
							</div>
							
							<!-- Submit que envía controlador y acción a borrar en los permisos del grupo -->
							<div class="form-group">
									<div class="col-sm-4"></div>
									<div class="col-sm-4">
									<input class='btn btn-primary' value='<?php echo $strings['borrar']; ?>' type="button" onclick="pregunta2()">
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
