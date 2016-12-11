<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 OR strcmp($_SESSION['grupo'],"Secretario") == 0) ){

//Crea la clase e instancia la función render en el constructor.
class ReservaEvento_Borrar{

	function __construct(){
		$this->render();
	}

	function render(){
		require_once('../header.php');
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo borrar reserva evento']; ?></title>

		<script>
		//Confirman el borrado.
		function pregunta(){
			if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
			   $("form").attr("action","../controllers/RESERVAEVENTO_Controller.php?id=bajaReservaEvento");
			   document.formulario.submit();
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

					<!-- Formulario para seleccionar la reserva de evento a borrar -->
					<?php if(!isset($_POST['id_evento']) && !isset($_POST['id_reserva'])){ ?>
					<form class="form-horizontal" role="form" method="POST" action="../controllers/RESERVAEVENTO_Controller.php?id=bajaReservaEvento">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar reserva evento']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Lista las reservas de eventos registradas -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['reservaEvento']; ?>:</label>
								</div><div class="col-sm-4">
								<select name="serv" required>
									<?php listarReservaEventoBorrar(); ?>
								</select>
							</div></div>
						</div>

						<!-- Submit para visualizar reservaEvento a borrar -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">
							</div></div>
					</form>

					<!-- Formulario para mostrar la reserva de evento y confirmar el borrado -->
					<?php }else{ ?>
					<form class="form-horizontal" role="form" name="formulario" method="POST" action="">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar reservaEvento']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Muestra los datos de la reservaEvento -->
							<table class="table table-striped">
							<thead><tr>
								<th><?php echo $strings['id_evento']; ?></th>
								<th><?php echo $strings['id_reserva']; ?></th>
								
							</thead><tbody>
								<?php consultarReservaEvento($_POST['reseven']); ?>
							</tbody>
						</table>
							<input type="hidden" name="id_evento" value="<?php echo $_POST['reseven']; ?>">
						</div>

						<!-- Submit para borrar la reservaEvento, con confirmación -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['borrar']; ?>" type="button" onclick="pregunta()">
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
