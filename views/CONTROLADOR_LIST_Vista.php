<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Controlador_Listar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>	
	<!-- Titulo de la página -->
	<title><?php echo $strings['titulo listar controlador']; ?></title>

	<body>

      <div class="row-fluid">
		<!-- Include del menú -->
        <?php include_once('menu.php'); ?>
        <div class="col-sm-10 text-left">
			<div class="section-fluid">
			  <div class="container-fluid">
				
				<!-- Lista acciones por controlador (funcionalidades) -->
				<div class="form-group">
					<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['ver controlador']; ?></h2></div>
					<div class="col-md-12"><hr></div>
					<table class="table table-striped">
						<thead><tr> 
							<th><?php echo $strings['controlador']; ?></th>
							<th><?php echo $strings['accion']; ?></th></tr> 
						</thead><tbody>
							<?php listarFuncionalidades(); ?>
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