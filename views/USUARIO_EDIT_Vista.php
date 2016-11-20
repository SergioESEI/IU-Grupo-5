<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Usuario_Editar{

	function __construct(){
		$this->render();
	}

	function render(){
		require_once('../header.php'); 
?>
		<!-- Título de la página -->	
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
		  <div class="row-fluid">
			<!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
					<div class="container-fluid">
					
					<!-- Formulario para seleccionar el usuario a editar -->
					<?php if(!isset($_POST['usuario'])){ ?>
					<form class="form-horizontal" role="form" method="POST" action="../controllers/USUARIO_Controller.php?id=modificarUsuario">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar usuario']; ?></h2></div>
								<div class="col-md-12"><hr></div>
							
							<!-- Lista los usuarios registrados -->						
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['usuario']; ?>:</label>
								</div><div class="col-sm-4">
								<select name="usuario" required>
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
							
							<!-- Muestra los datos del usuario a editar -->
							<table class="table table-striped">
								<thead><tr> 
									<th><?php echo $strings['usuario']; ?></th>
									<th><?php echo $strings['grupo']; ?></th>
									<th><?php echo $strings['dni']; ?></th>
								</thead><tbody>
									<?php consultarUsuario($_POST['usuario']); ?>
								</tbody>
							</table>
							
							<!-- Input oculto con el usuario a modificar -->
							<input type="hidden" name="usuario" value="<?php echo $_POST['usuario']; ?>">
							<input type="hidden" name="usuarioN" value="<?php echo $_POST['usuario']; ?>">
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
								</div>
							</div>
						</div>
						
						<!-- Campo password-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['password']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="password" class="form-control" name="passwordN" pattern="[A-Za-z0-9]{4,16}" title="<?php echo $strings['error password']; ?>" required>
							</div>
						</div>
						
						<!-- Campo grupo, si es Admin no permite modificarlo -->
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
							</div><div class="col-sm-4">
							<?php if(strcmp($_SESSION['user'],$_POST['usuario'])!= 0){
								echo "<select name='grupoN' required>";
								listarGrupos(); 
								echo "</select>";
							}else{ 
								echo $_SESSION['grupo'];
								echo "<input type='hidden' name='grupoN' value='".$_SESSION['grupo']."'>";
							} ?>
						</div></div>
						
						<!-- Campo DNI, opcional -->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['dni opcional']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" class="form-control" name="dniN" pattern="[0-9]{8}[A-Z]{1}" title="<?php echo $strings['error dni']; ?>">
							</div>
						</div>
						
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
		</body>
<?php 
		}
	}
}else
	echo "Permiso denegado.";
?>