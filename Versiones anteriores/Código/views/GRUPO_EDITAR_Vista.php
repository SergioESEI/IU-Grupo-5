<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php');
	require_once('../controllers/GRUPO_Controller.php');
?>
<title><?php echo $strings['titulo editar grupo']; ?></title>

<script> 
//Confirman la edición.
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
				
				<!-- Formulario para editar grupo -->
					<form class="form-horizontal" role="form" method="POST" name="formulario" action="../controllers/GRUPO_Controller.php?id=modificarGrupo" onsubmit="return pregunta()">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar grupo']; ?></h2></div>
								<div class="col-md-12"><hr></div>
							
							<!-- Campo para seleccionar el grupo a modificar -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
								</div><div class="col-sm-4">
								<select name="grupo">
									<?php listarGrupos(); ?>
								</select>
							</div></div>
							<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
							</div>
						</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
							</div><div class="col-sm-4">
							  <input type="text" class="form-control" name="grupoN" pattern="[A-ZÑña-zÁÉÍÓÚáéíóú]{4,30}" title="palabra demasiado corta o formato incorrecto" required>
						</div></div>
						
						<!-- Submit para editar grupo, con confirmación -->
						<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-4">
							<input class="btn btn-primary" value="<?php echo $strings['modificar']; ?>" type="submit">						
						</div></div>
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