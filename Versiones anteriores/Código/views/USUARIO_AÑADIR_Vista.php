<html>
<?php
	session_start();
	//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
	if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 
	require_once('../header.php'); 
	require_once('../controllers/USUARIO_Controller.php');
?>
<title><?php echo $strings['titulo añadir usuario']; ?></title>

  <body>
	<!-- Include del menú-->
    <div class="container-fluid text-center">
      <div class="row content">
        <?php include_once('menu.php'); ?>
        <div class="col-sm-10 text-left">
			<div class="section-fluid">
			  <div class="container-fluid">
						
					<!-- Formulario para añadir usuario -->
					<form class="form-horizontal" role="form" action="../controllers/USUARIO_Controller.php?id=altaUsuario" method="POST">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nuevo usuario']; ?></h2></div>
							<div class="col-md-12"><hr></div>
							
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
							<!-- Campo usuario-->
							<div class="form-group">
								<div class="col-sm-4">
								  <label for="nombre" class="control-label">Usuario:</label>
								</div>
								<div class="col-sm-4">
								  <input type="text" class="form-control" name="usuario" pattern="[0-9A-Za-z]{4,30}" title="minimo 4 caracteres alfanuméricos" required>
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
							
							<!-- Submit que envía los datos para crear el usuario -->
							 <div class="form-group">
								  <div class="col-sm-4"></div>
								  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['crear']; ?>" type="submit">
								  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
							 </div>
						</div>
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
