<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php');
	require_once('../controllers/GRUPO_Controller.php');	
?>
<title><?php echo $strings['titulo borrar grupo']; ?></title>
	
	<script> 	
	//Confirman el borrado.
	function pregunta(){
		if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
		   $("form").attr("action","../controllers/GRUPO_Controller.php?id=bajaGrupo");
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
				
				<!-- Formulario para seleccionar el grupo a borrar -->
					<form class="form-horizontal" role="form" name="formulario" method="POST" action="">
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar grupo']; ?></h2></div>
							<div class="col-md-12"><hr></div>
						
						<!-- Lista los controladores registrados -->						
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
							</div><div class="col-sm-4">
							<select name="grupo">
								<?php listarGrupos(); ?>
							</select>
						</div></div>
					</div>
					
					<!-- Submit para borrar el grupo, coon confirmación -->
					<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-4">
							<input class="btn btn-primary" value="<?php echo $strings['borrar']; ?>" type="button" onclick="pregunta()">						
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
