<?php
//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){

//Crea la clase e instancia la función render en el constructor.
class Cliente_Buscar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php');
?>
		<title><?php echo $strings['buscarCliente']; ?></title>

		<body>

		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">

					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['buscar cliente']; ?></h2></div>
						<div class="col-md-12"><hr></div>
					</div>

					<!-- Formulario que recoge el cliente a buscar -->
					<?php if(!isset($_POST['id_cliente'])){ ?>
					<form class="form-horizontal" role="form" action="../controllers/CLIENTEEXTERNO_Controller.php?id=buscarCliente" method="POST">

						<!-- Campo id_cliente-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['id_cliente']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" class="form-control" name="id_cliente" pattern="[0-9A-Za-z]{4,16}" title="<?php echo $strings['error id_cliente']; ?>" required>
							</div>
						</div>

						<!-- Submit que envía los datos para buscar el cliente -->
						 <div class="form-group">
							  <div class="col-sm-4"></div>
							  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['buscar']; ?>" type="submit">
							  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
						 </div>
					</form>

					<?php }else{ ?>
					<!-- Lista los datos del cliente -->
					<table class="table table-striped">
						<thead><tr>
							<th><?php echo $strings['id_cliente']; ?></th>
							<th><?php echo $strings['nombre']; ?></th>
							<th><?php echo $strings['dni']; ?></th>
							<th><?php echo $strings['tlf']; ?></th>
							<th><?php echo $strings['email']; ?></th>
							<th><?php echo $strings['direccion']; ?></th>
						</thead><tbody>
							<?php consultarCliente($_POST['id_cliente']); ?>
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
