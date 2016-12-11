<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Lesion_Listar_DNI{
		var $tipo;

		function __construct($tipo,$dni){
			$this->tipo=$tipo;
			$this->dni=$dni;
			$this->render($tipo,$dni);
		}

		function render($tipo,$dni){
			require_once('../header.php'); 
			$log = new Log_Lesion("logAccesoLesiones","/var/www/html/logs/");
			$log->insertar('LESION_LIST_Vista.php', $_SESSION['user'],$dni,null, false); 
			?>
			<!-- Título de la página -->
			<title><?php echo $strings['titulo listar lesiones']; ?></title>



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
									<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['ver lesiones']; ?></h2></div>
									<div class="col-md-12"><hr></div>
									<a href="../controllers/LESION_Controller.php?id=verLesionesBorradas&id2=<?php echo $dni;?>"  class="btn btn-primary"  >Consultar borradas</a>
									<table class="table table-striped">
										<thead><tr> 
											<th><?php echo $strings['id lesion']; ?></th>
											<th><?php echo $strings['tipo lesion']; ?></th>
										</thead><tbody>
										<?php verLesiones($dni); ?>
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
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['ver lesiones']; ?></h2></div>
								<div class="col-md-12"><hr></div>
								<a href="../controllers/LESION_Controller.php?id=verLesiones&id2=<?php echo $dni;?>" class="btn btn-default"  >Consultar activas</a>
								<table class="table table-striped">
									<thead><tr> 
										<th><?php echo $strings['id lesion']; ?></th>
											<th><?php echo $strings['tipo lesion']; ?></th>
									</thead><tbody>
									<?php verLesionesBorradas($dni); ?>
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