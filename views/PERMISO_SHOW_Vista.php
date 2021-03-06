<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Permiso_Buscar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>
		<!-- Título de la página -->
		<title><?php echo $strings['buscarPermiso']; ?></title>

		<body>
		  <div class="row-fluid">
		  
			<!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<!-- Nombre de la página -->
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['buscar permiso']; ?></h2></div>
						<div class="col-md-12"><hr></div>
					</div>
					
					<!-- Formulario que recoge el grupo del que se buscan permisos -->
					<?php if(!isset($_POST['grupo'])){ ?>
					<form class="form-horizontal" role="form" action="../controllers/PERMISO_Controller.php?id=buscarPermiso" method="POST">
					
						<!-- Campo grupo-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" class="form-control" name="grupo" pattern="[A-ZÑña-zÁÉÍÓÚáéíóú]{4,30}" title="<?php echo $strings['error grupo']; ?>" required>
							</div>
						</div>
						
						<!-- Submit que envía los datos para crear el permiso -->
						 <div class="form-group">
							  <div class="col-sm-4"></div>
							  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['buscar']; ?>" type="submit">
							  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
						 </div>
					</form>
					
					<?php }else{ ?>
					<!-- Lista los datos del permiso del grupo en una tabla-->
					<table class="table table-striped">
						<thead><tr> 
							<th><?php echo $strings['grupo']; ?></th>
							<th><?php echo $strings['controlador']; ?></th>
							<th><?php echo $strings['accion']; ?></th>
						</thead><tbody>
							<?php consultarPermisos($_POST['grupo']); ?>
						</tbody>
					</table>
				
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