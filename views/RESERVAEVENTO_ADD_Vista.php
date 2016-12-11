<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 OR strcmp($_SESSION['grupo'],"Secretario") == 0) ){

//Crea la clase e instancia la función render en el constructor.
class ReservaEvento_Crear{
	function __construct(){
		$this->render();
	}

	function render(){
		require_once('../header.php');

?>
		<!-- Título de la página -->
		<title><?php echo $strings['titulo añadir reserva evento']; ?></title>

		<body>
		<!-- Include del menú-->
		  <div class="row-fluid">
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">

						<!-- Formulario para añadir cliente -->
						<form class="form-horizontal" role="form" action="../controllers/RESERVAEVENTO_Controller.php?id=altaReservaEvento" method="POST">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nueva reserva evento']; ?></h2></div>
								<div class="col-md-12"><hr></div>

								<!-- Campo id evento-->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['id_evento']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="id_evento" pattern="[0-9A-Za-z]{4,16}" title="<?php echo $strings['error id_evento']; ?>" required>
									</div>
								</div>

								<!-- Campo id reserva-->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['id_reserva']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <select name="reserva" required>
										  <?php listarReservas(); ?>
									  </select>
									</div>
								</div>


								<!-- Submit que envía los datos para crear la reserva de evento -->
								 <div class="form-group">
									  <div class="col-sm-4"></div>
									  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['crear']; ?>" type="submit">
									  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
								 </div>
							</div>
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
