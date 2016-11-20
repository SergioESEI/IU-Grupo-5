<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php');
	require_once('../controllers/CONTROLADOR_Controller.php');	
?>
	<title><?php echo $strings['titulo borrar controlador']; ?></title>
	
	<script> 
	//Devuelve el controlador para seleccionar una de sus acciones.
	function submit(){
		$("form").attr("action", "CONTROLADOR_BORRAR_Vista.php");
		$('form').submit();
	}
	
	//Confirman el borrado.
	function pregunta(){
		if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
		   $("form").attr("action","../controllers/CONTROLADOR_Controller.php?id=bajaControlador");
		   document.formulario1.submit();
		}
	}
	function pregunta2(){
		if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
			$("form").attr("action","../controllers/CONTROLADOR_Controller.php?id=bajaControlador");
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
				
				<!-- Formulario para seleccionar el controlador a borrar o mostrar sus acciones para borrar una -->
				<?php if(!isset($_POST['controlador'])){ ?>
					<form class="form-horizontal" role="form" name="formulario1" method="POST" action="">
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar controlador']; ?></h2></div>
							<div class="col-md-12"><hr></div>
						
						<!-- Lista los controladores registrados -->						
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
							</div><div class="col-sm-4">
							<select name="controlador">
								<?php listarControlador(); ?>
							</select>
						</div></div>
					</div>
					
					<!-- Dos submits: borrar controlador o acceder a acciones del controlador seleccionado -->
					<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-4">
							<input class="btn btn-primary" value="<?php echo $strings['borrar']; ?>" type="button" id="boton" onclick="pregunta()" dir="../controllers/CONTROLADOR_Controller.php?id=bajaControlador">
							<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="button" onclick="submit()" dir="CONTROLADOR_BORRAR_Vista.php">						
						</div></div>
					</form>
				
				
				<!-- Formulario para seleccionar la acción a borrar del controlador elegido -->
				<?php 
				}else{ ?>
					<form class="form-horizontal" role="form" name="formulario2" method="POST" action="">
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar controlador']; ?></h2></div>
							<div class="col-md-12"><hr></div>	
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
					
					<!-- Submit que envía controlador y acción a borrar -->
					<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-4">
							<input class='btn btn-primary' value='<?php echo $strings['borrar']; ?>' type='button' onclick='pregunta2()'>
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
