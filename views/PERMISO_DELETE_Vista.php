<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Permiso_Borrar{

	function __construct(){
		$this->render();
	}

	function render(){
		require_once('../header.php'); 
?>
		<!-- Título de la página -->
		<title><?php echo $strings['titulo borrar permiso']; ?></title>
		
		<script> 
		//Devuelve el controlador para seleccionar una de sus acciones.
		function submit(){
			$("form").attr("action", "../controllers/PERMISO_Controller.php?id=bajaPermiso");
			$('form').submit();
		}
		
		//Confirman el borrado.
		function pregunta(){
			if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
			   $("form").attr("action","../controllers/PERMISO_Controller.php?id=bajaPermiso&borrar=1");
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

		  <div class="row-fluid">
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
						<?php if(!isset($_POST['grupo'])){ ?>
						
						<!-- Formulario para borrar permiso, entra si no se seleccionó grupo -->
						<form class="form-horizontal" role="form" name="formulario" action="../controllers/PERMISO_Controller.php?id=bajaPermiso" method="POST">
							<div class="form-group">
									<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar permiso']; ?></h2></div>
									<div class="col-md-12"><hr></div>

									<!-- Campo grupo-->
									<div class="form-group">
										<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
										</div><div class="col-sm-4">
										<select name="grupo" required>
											<?php listarGruposPermisos(); ?>
										</select>
									</div></div>
									
									<!-- Submit que envía grupo -->
									 <div class="form-group">
										  <div class="col-sm-4"></div>
										  <input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">						

									 </div>
							</div>
						</form>
								
						<!-- Formulario para seleccionar el controlador en base al grupo elegido -->	
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
										<select name="controlador" required>
											<?php listarControladorGrupo($_POST['grupo']); ?>
										</select>
									</div></div>
									
									<!-- Submit que envía grupo y controlador para seleccionar la acción o borra todas las acciones de ese controlador al grupo -->
									 <div class="form-group">
										  <div class="col-sm-4"></div>
										  <input class="btn btn-primary" value="<?php echo $strings['borrar todos permisos']; ?>" type="button" id="boton" onclick="pregunta()">
										  <input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="button" onclick="submit()">						

									 </div>
							</div>
						</form>
								
						<!-- Formulario para seleccionar la acción a borrar del controlador elegido -->
						<?php }else{ ?>
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
									<select name="accion" required>
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
		</body>
<?php 
		}
	}
}else
	echo "Permiso denegado.";
?>
