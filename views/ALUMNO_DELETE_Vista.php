<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 || strcmp($_SESSION['grupo'],"Secretario") == 0) ){ 

//Crea la clase e instancia la función render en el constructor. 
class Alumno_Borrar{

	function __construct(){
		$this->render();
	}

	function render(){
		require_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo borrar alumno']; ?></title>
		
	  <body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<!-- Formulario para seleccionar el alumno a borrar -->
	
					<form class="form-horizontal" role="form" method="POST" action="">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar alumno']; ?></h2></div>
								<div class="col-md-12"><hr></div>
							
							<!-- Lista los alumnos registrados -->						
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['alumno']; ?>:</label>
								</div><div class="col-sm-4">
								<select name="alumnoB" required>
									<?php listarAlumnosBorrar(); ?>
								</select>
							</div></div>
						</div>
                                            
                                            <input type="hidden" name="alumno" value="<?php echo $_POST['alumno']; ?>">
						
						<!-- Submit para visualizar alumno a borrar -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['borrar']; ?>" type="submit">						
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