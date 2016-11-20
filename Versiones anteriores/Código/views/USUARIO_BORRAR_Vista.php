<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php');
	require_once('../controllers/USUARIO_Controller.php');	
?>
<title><?php echo $strings['titulo borrar usuario']; ?></title>
	
	<script> 	
	//Confirman el borrado.
	function pregunta(){
		if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
		   $("form").attr("action","../controllers/USUARIO_Controller.php?id=bajaUsuario");
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
				<?php if(!isset($_POST['user'])){ ?>
				<form class="form-horizontal" role="form" method="POST" action="USUARIO_BORRAR_Vista.php">
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar usuario']; ?></h2></div>
							<div class="col-md-12"><hr></div>
						
						<!-- Lista los usuarios registrados -->						
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['usuario']; ?>:</label>
							</div><div class="col-sm-4">
							<select name="user">
								<?php listarUsuariosBorrar(); ?>
							</select>
						</div></div>
					</div>
					
					<!-- Submit para visualizar usuario a borrar -->
					<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-4">
							<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">						
						</div></div>
				</form>
					
				<!-- Formulario para mostrar el usuario y confirmar el borrado -->
				<?php }else{ ?>
				<form class="form-horizontal" role="form" name="formulario" method="POST" action="">
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar usuario']; ?></h2></div>
							<div class="col-md-12"><hr></div>
						
						<!-- Muestra los datos del usuario -->						
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['usuario']; ?>:</label>
							</div><div class="col-sm-4">
								<?php consultarUsuario($_POST['user']); ?>
						</div></div>
						<input type="hidden" name="usuario" value="<?php echo $_POST['user']; ?>">
					</div>
					
					<!-- Submit para borrar el usuario, con confirmación -->
					<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-4">
							<input class="btn btn-primary" value="<?php echo $strings['borrar']; ?>" type="button" onclick="pregunta()">						
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
