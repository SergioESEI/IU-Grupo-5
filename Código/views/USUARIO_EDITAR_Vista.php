<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php');
	require_once('../controllers/USUARIO_Controller.php');
?>
<title><?php echo $strings['titulo editar usuario']; ?></title>

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
				
				<?php if(!isset($_POST['user'])){ ?>
				<form class="form-horizontal" role="form" method="POST" action="USUARIO_EDITAR_Vista.php">
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar usuario']; ?></h2></div>
							<div class="col-md-12"><hr></div>
						
						<!-- Lista los usuarios registrados -->						
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['usuario']; ?>:</label>
							</div><div class="col-sm-4">
							<select name="user">
								<?php listarUsuariosModificar(); ?>
							</select>
						</div></div>
					</div>
					
					<!-- Submit para visualizar usuario a modificar -->
					<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-4">
							<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">						
						</div></div>
				</form>
					
				<!-- Formulario para mostrar el usuario y confirmar la edición -->
				<?php }else{ ?>
				<form class="form-horizontal" role="form" name="formulario" method="POST" action="../controllers/USUARIO_Controller.php?id=modificarUsuario" onsubmit="return pregunta()">
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar usuario']; ?></h2></div>
							<div class="col-md-12"><hr></div>
						
						<!-- Muestra los datos del usuario -->						
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['usuario']; ?>:</label>
							</div><div class="col-sm-4">
								<?php consultarUsuario($_POST['user']); ?>
						</div></div>
						
						<!-- Input ocuulto con el user del usuario a modificar -->
						<input type="hidden" name="usuario" value="<?php echo $_POST['user']; ?>">
						
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
							</div>
						</div>
					</div>
					
					<!-- Campo nombre-->
					<div class="form-group">
						<div class="col-sm-4">
						  <label for="nombre" class="control-label">Nombre:</label>
						</div>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="nombre" pattern="[A-Za-z ]{2,30}" title="abc" required>
						</div>
					</div>
					<!-- Campo apellidos -->
					<div class="form-group">
						<div class="col-sm-4">
						  <label for="nombre" class="control-label">Apellidos:</label>
						</div>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="apellidos" pattern="[A-Za-z ]{2,50}" title="abc abc" required>
						</div>
					</div>
					<!-- Campo DNI-->
					<div class="form-group">
						<div class="col-sm-4">
						  <label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
						</div>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="dni" pattern="[0-9]{8}[A-Z]{1}" title="11111111A" required>
						</div>
					</div>
					<!-- Campo email-->
					<div class="form-group">
						<div class="col-sm-4">
						  <label for="nombre" class="control-label">Email:</label>
						</div>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="email" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="user@moovett.com" required>
						</div>
					</div>
					<!-- Campo telefono-->
					<div class="form-group">
						<div class="col-sm-4">
						  <label for="nombre" class="control-label">Telefono:</label>
						</div>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="telefono" pattern="[0-9]{9}" title="9 números" required>
						</div>
					</div>
					<!-- Campo password-->
					<div class="form-group">
						<div class="col-sm-4">
						  <label for="nombre" class="control-label"><?php echo $strings['password']; ?>:</label>
						</div>
						<div class="col-sm-4">
						  <input type="password" class="form-control" name="password" pattern="[A-Za-z0-9]{4,16}" title="mínimo 4 caracteres alfanuméricos" required>
						</div>
					</div>
					<!-- Campo grupo-->
					<div class="form-group">
						<div class="col-sm-4">
						<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
						</div><div class="col-sm-4">
						<select name="grupo">
							<?php listarGrupos(); ?>
						</select>
					</div></div>
					
					<!-- Submit para editar el usuario, con confirmación -->
					<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-4">
							<input class="btn btn-primary" value="<?php echo $strings['modificar']; ?>" type="submit">						
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