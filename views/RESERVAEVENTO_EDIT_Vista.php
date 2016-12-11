<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 OR strcmp($_SESSION['grupo'],"Secretario") == 0) ){

//Crea la clase e instancia la función render en el constructor.
class ReservaEvento_Editar{

	//Si se le pasa, crea un array con los datos del cliente.
	function __construct($datos=null){
		$this->render($datos);
	}

	function render($datos){
		require_once('../header.php');
?>
		<!-- Título de la página -->
		<title><?php echo $strings['titulo editar servicio']; ?></title>

		<script>

		//Confirman la edición.
		function pregunta(){
			var id_reserva = document.getElementById("id_reservaN").value;
			

			empty();
			if (confirm('<?php echo $strings['confirmar modificacion']; ?>'+
				'\n\n<?php echo $strings['id_reserva']; ?>: '+id_reserva +)){
			   document.formulario.submit();
			} else return false;
		}

		// Comprueba inputos vacíos
		function empty() {
			var id_reserva = document.getElementById("id_reservaN").value;
			

			if (id_reserva == "") {
				alert('<?php echo $strings['empty']; ?>');
				return false;
			}
		}
		</script>

		<body>
		  <div class="row-fluid">
			<!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
					<div class="container-fluid">

					<!-- Formulario para seleccionar la reserva de evento a editar -->
					<?php if(!isset($_POST['id_evento']) && !isset($_POST['id_reserva'])){ ?>
					<form class="form-horizontal" role="form" method="POST" action="../controllers/RESERVAEVENTO_Controller.php?id=modificarReservaEvento">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar reserva evento']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Lista las reservas de eventos registradas -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['evento']; ?>:</label>
								</div><div class="col-sm-4">
								<select name="id_servicio" required>
									<?php listarReservaEventosModificar(); ?>
								</select>
							</div></div>
						</div>

						<!-- Submit para visualizar reserva evento a modificar -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">
							</div></div>
					</form>

					<!-- Formulario para mostrar la reservaEvento y confirmar la edición -->
					<?php }else{ ?>
					<form class="form-horizontal" role="form" name="formulario" method="POST" action="../controllers/RESERVAEVENTO_Controller.php?id=modificarReservaEvento" onsubmit="return pregunta();">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar ReservaEvento']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Muestra los datos de la reservaEvento a editar -->
							<table class="table table-striped">
								<thead><tr>
									<th><?php echo $strings['id_evento']; ?></th>
									<th><?php echo $strings['id_reserva']; ?></th>
									
								</thead><tbody>
									<?php consultarReservaEvento($_POST['id_evento']); ?>
								</tbody>
							</table>

							<!-- Input oculto con la reservaEvento a modificar -->
							<input type="hidden" name="id_evento" value="<?php echo $_POST['id_evento']; ?>">
							<input type="hidden" name="id_eventoN" value="<?php echo $_POST['id_evento']; ?>">
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?> <?php echo $strings['campos modificar']; ?>:</label>
								</div>
							</div>
						</div>

						<!-- Campo id reserva-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['id_reserva']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <select id="id_reservaN" name="reserva" required>
								  <?php listarReservas(); ?>
							  </select>
							</div>
						</div>

						<!-- Submit para editar la reservaEvento, con confirmación -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['modificar']; ?>" type="submit">
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
