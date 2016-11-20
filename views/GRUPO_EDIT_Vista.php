<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Grupo_Editar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>
			<!-- Título de la página -->
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
			  <div class="row-fluid">
			  <!-- Include del menú -->
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
									<select name="grupo" required>
										<?php listarGrupos(); ?>
									</select>
								</div></div>
								<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
								</div>
							</div>
							</div>
							
							<!-- Campo para escribir el grupo modificado -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
								</div><div class="col-sm-4">
								  <input type="text" class="form-control" name="grupoN" pattern="[A-ZÑña-zÁÉÍÓÚáéíóú]{4,30}" title="<?php echo $strings['error grupo']; ?>" required>
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
		</body>
<?php 
		}
	}
}else
	echo "Permiso denegado.";
?>