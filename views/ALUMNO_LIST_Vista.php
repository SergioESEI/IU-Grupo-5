
<meta charset="utf-8"> 

<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 || strcmp($_SESSION['grupo'],"Secretario") == 0) ){ 

//Crea la clase e instancia la función render en el constructor. 
class Alumno_Listar{

	function __construct(){
		$this->render();
	}

	function render(){
		require('../header.php');  
?>
		<!-- Título de la página -->
		<title><?php echo $strings['titulo listar alumno']; ?></title>

		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<!-- Lista los alumnos -->
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['ver alumno']; ?></h2></div>
						<div class="col-md-12"><hr></div>
						<table class="table table-striped">
							<thead><tr> 
								<th><?php echo $strings['dni']; ?></th>
                                                                <th><?php echo $strings['apellidos']; ?></th>
                                                                <th><?php echo $strings['nombre']; ?></th>
                                                                <th><?php echo $strings['direccion']; ?></th>
                                                                <th><?php echo $strings['email']; ?></th>
                                                                <th><?php echo $strings['nacimiento']; ?></th>
                                                                <th><?php echo $strings['profesion']; ?></th> 
                                                                <th><?php echo $strings['observaciones']; ?></th>
                                                                
							</thead><tbody>
								<?php verAlumnos(); ?>
							</tbody>
						</table>
					</div>
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