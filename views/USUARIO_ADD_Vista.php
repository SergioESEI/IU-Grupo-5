<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Usuario_Crear{

	function __construct(){
		$this->render();
	}

	function render(){
		require_once('../header.php'); 
?>
		<!-- Título de la página -->
		<title><?php echo $strings['titulo añadir usuario']; ?></title>

		<body>
		<!-- Include del menú-->
		  <div class="row-fluid">
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
							
						<!-- Formulario para añadir usuario -->
						<form class="form-horizontal" role="form" action="../controllers/USUARIO_Controller.php?id=altaUsuario" method="POST">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nuevo usuario']; ?></h2></div>
								<div class="col-md-12"><hr></div>
								
								<!-- Campo usuario-->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['usuario']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="usuario" pattern="[0-9A-Za-z]{4,16}" title="<?php echo $strings['error usuario']; ?>" required>
									</div>
								</div>
								
								<!-- Campo password-->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['password']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="password" class="form-control" name="password" pattern="[A-Za-z0-9]{4,16}" title="<?php echo $strings['error password']; ?>" required>
									</div>
								</div>
								
								<!-- Campo grupo-->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
									</div><div class="col-sm-4">
									<select name="grupo" required>
										<?php listarGrupos(); ?>
									</select>
								</div></div>
								
								<!-- Campo DNI, opcional-->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['dni opcional']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="dni" pattern="[0-9]{8}[A-Z]{1}" title="<?php echo $strings['error dni']; ?>">
									</div>
								</div>
								
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
		</body>
<?php 
		}
	}
}else
	echo "Permiso denegado.";
?>
