<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Trabajador_Listar{
		var $tipo;

		function __construct($tipo){
			$this->tipo=$tipo;
			$this->render($tipo);
		}

		function render($tipo){
			require_once('../header.php');  
			?>
			<!-- Título de la página -->
			<title><?php echo $strings['titulo listar trabajador']; ?></title>



			<?php if($tipo=='activos'){ ?>
			<body>
				<div class="row-fluid">
					<!-- Include del menú -->
					<?php include_once('menu.php'); ?>
					<div class="col-sm-10 text-left">
						<div class="section-fluid">
							<div class="container-fluid">
								
								<!-- Lista los trabajadores -->
								<div class="form-group">
									<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['ver trabajadores']; ?></h2></div>
									<div class="col-md-12"><hr></div>
									<a href="../controllers/TRABAJADOR_Controller.php?id=consultarTrabajadorBorrado"  class="btn btn-primary"  >Consultar borrados</a>
									<table class="table table-striped">
										<thead><tr> 
											<th><?php echo $strings['dni']; ?></th>
											<th><?php echo $strings['nombre']; ?></th>
											<th><?php echo $strings['apellidos']; ?></th>
											<th><?php echo $strings['tipoemp']; ?></th>
										</thead><tbody>
										<?php verTrabajadores(); ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</body>

		<?php }else{ ?>

		<body>
			<div class="row-fluid">
				<!-- Include del menú -->
				<?php include_once('menu.php'); ?>
				<div class="col-sm-10 text-left">
					<div class="section-fluid">
						<div class="container-fluid">
							
							<!-- Lista los trabajadores -->
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['ver trabajadores']; ?></h2></div>
								<div class="col-md-12"><hr></div>
								<a href="../controllers/TRABAJADOR_Controller.php?id=consultarTrabajador" class="btn btn-default"  >Consultar activos</a>
								<table class="table table-striped">
									<thead><tr> 
										<th><?php echo $strings['dni']; ?></th>
										<th><?php echo $strings['nombre']; ?></th>
										<th><?php echo $strings['apellidos']; ?></th>
										<th><?php echo $strings['tipoemp']; ?></th>
									</thead><tbody>
									<?php verTrabajadoresBorrados(); ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php } ?>





	<?php 
}
}
}else
echo "Permiso denegado.";
?>