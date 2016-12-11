<?php
//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 OR strcmp($_SESSION['grupo'],"Secretario") == 0) ){

//Crea la clase e instancia la función render en el constructor.
class ReservaEvento_Buscar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php');
?>
		<title><?php echo $strings['buscarReservaEvento']; ?></title>
		<script>
		function empty() {
			var id_evento = document.getElementById("id_evento").value;
			var id_reserva = document.getElementById("id_reserva").value;
			
			if (id_evento == "" && id_reserva == "" ) {
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

					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['buscar reservaEvento']; ?></h2></div>
						<div class="col-md-12"><hr></div>
					</div>

					<!-- Formulario que recoge la reserva de evento a buscar -->
					<?php if(!isset($_POST['id_evento']) && !isset($_POST['id_reserva'])){ ?>
					<form class="form-horizontal" role="form" action="../controllers/RESERVAEVENTO_Controller.php?id=buscarReservaEvento" method="POST" onsubmit="return empty();">

						<!-- Campo id_evento-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['id_evento']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" id="id_evento" class="form-control" name="id_evento" pattern="[0-9A-Za-z]{4,16}" title="<?php echo $strings['error id_evento']; ?>">
							</div>
						</div>

						<!-- Campo id_reserva-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['id_reserva']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <select id="id_reserva" name="reserva" >
								  <?php listarReservas(); ?>
							  </select>
							</div>
						</div>


						<!-- Submit que envía los datos para buscar la reservaEvento -->
						 <div class="form-group">
							  <div class="col-sm-4"></div>
							  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['buscar']; ?>" type="submit">
							  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
						 </div>
					</form>

					<?php }else{ ?>
					
					<!-- Lista los datos de la reservaEvento -->
					<table class="table table-striped">
						<thead><tr>
							<th><?php echo $strings['id_evento']; ?></th>
							<th><?php echo $strings['id_reserva']; ?></th>
						</thead><tbody>
							<?php $reservaEvento1=new reservaEvento($_POST['id_evento'],$_POST['id_reserva']);
							 		consultarReservaEventoBorrar($reservaEvento1);?>
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
