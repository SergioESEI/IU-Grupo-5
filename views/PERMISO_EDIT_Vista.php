<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Permiso_Editar{

	function __construct(){
		$this->render();
	}

	function render(){
		require_once('../header.php'); 
?>
		<!-- Título de la`página -->
		<title><?php echo $strings['titulo editar permiso']; ?></title>

		<script> 
		//Confirmar la modificación.
		function pregunta(){
			if (confirm('<?php echo $strings['confirmar modificacion']; ?>')){
			   $("form").attr("action","../controllers/PERMISO_Controller.php?id=modificarPermiso");
			   document.formulario.submit();
			}
		}
		</script> 

		<body>
		<!-- Includel del menú -->
		  <div class="row-fluid">
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
				  
					<?php if(!isset($_POST['grupo'])){ ?>
						<!-- Formulario para editar el permiso de un grupo -->
						<form class="form-horizontal" role="form" action="../controllers/PERMISO_Controller.php?id=modificarPermiso" method="POST">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar permiso']; ?></h2></div>
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
						
						<!-- Formulario para seleccionar el controlador a editar -->
						<?php } else if(!isset($_POST['controlador'])){ ?>
						<form class="form-horizontal" role="form" action="../controllers/PERMISO_Controller.php?id=modificarPermiso" method="POST">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar permiso']; ?></h2></div>
								<div class="col-md-12"><hr></div>
								
								<!-- Muestra el grupo seleccionado -->
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
								
								<!-- Submit que envía grupo y controlador para seleccionar la acción -->
								 <div class="form-group">
									  <div class="col-sm-4"></div>
									  <input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit" >						
								 </div>
							</div>
						</form>						
							
						<!-- Formulario para la acción a modificar y seleccionar el nuevo controlador -->
						<?php }else if(!isset($_POST['accion'])){ ?>
						<form class="form-horizontal" role="form" method="POST" action="../controllers/PERMISO_Controller.php?id=modificarPermiso">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar permiso']; ?></h2></div>
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
							  
								<!-- Lista las acciones del controlador y grupo seleccionados para elegir una -->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['accion']; ?>:</label>
									</div><div class="col-sm-4">
										<select name="accion" required>
											<?php listarAccionGrupo($_POST['grupo'],$_POST['controlador']); ?>
										</select>
								</div></div>
							  <div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
									</div>
								</div>
							</div>
							
							<!-- Recoge los datos del nuevo controlador -->
							<input type="hidden" class="form-control" name="grupoN" value="<?php echo $_POST['grupo']; ?>">
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
								</div><div class="col-sm-4">
									<select name="controladorN" required>
										<?php listarControlador(); ?>
									</select>
							</div></div>
							
							<!-- Submit que envía controlador y acción a editar en los permisos del grupo -->
							<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class='btn btn-primary' value='<?php echo $strings['siguiente']; ?>' type="submit">
							</div></div>
						</form>
						
						<!-- Formulario para enviar los datos -->						
						<?php }else{ ?>
						<form class="form-horizontal" role="form" name="formulario" method="POST" action="">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar permiso']; ?></h2></div>
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
							  
								<!-- Muestra los datos de la acción seleccionada -->
								<div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['accion']; ?>:</label>
									</div><div class="col-sm-4">
									<?php echo $_POST['accion']; ?>
								</div></div>
								<input type="hidden" class="form-control" name="accion" value="<?php echo $_POST['accion']; ?>">
							  <div class="form-group">
									<div class="col-sm-4">
									<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
									</div>
								</div>
							</div>
							
							<!-- Muestra los datos del nuevo controlador seleccionado -->
							<input type="hidden" class="form-control" name="grupoN" value="<?php echo $_POST['grupoN']; ?>">
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['controlador']; ?>:</label>
								</div><div class="col-sm-4">
								<?php echo $_POST['controladorN']; ?>
							</div></div>
							<input type="hidden" class="form-control" name="controladorN" value="<?php echo $_POST['controladorN']; ?>">
							
							<!-- Recoge los datos de la nueva acción -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['accion']; ?>:</label>
								</div><div class="col-sm-4">
									<select name="accionN" required>
										<?php listarAccion($_POST['controladorN']); ?>
									</select>
							</div></div>
							
							<!-- Submit que envía controlador y acción a editar en los permisos del grupo -->
							<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class='btn btn-primary' value='<?php echo $strings['modificar']; ?>' type="button" onclick="pregunta()">
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