<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 OR strcmp($_SESSION['grupo'],"Secretario") == 0) ){

//Crea la clase e instancia la función render en el constructor.
class Evento_Editar{

	//Si se le pasa, crea un array con los datos del cliente.
	function __construct($datos=null){
		$this->render($datos);
	}

	function render($datos){
		require_once('../header.php');
?>
		<!-- Título de la página -->
		<title><?php echo $strings['titulo editar evento']; ?></title>

		<script>

		//Confirman la edición.
		function pregunta(){
			var id_evento = document.getElementById("id_eventoN").value;
			var nombre = document.getElementById("nombreN").value;
			var descripcion = document.getElementById("descripcionN").value;

			empty();
			if (confirm('<?php echo $strings['confirmar modificacion']; ?>'+
				'\n\n<?php echo $strings['id_evento']; ?>: '+id_evento +
				'\n<?php echo $strings['nombre']; ?>: '+nombre +
				'\n<?php echo $strings['descripcion']; ?>: '+descripcion +)){
			   document.formulario.submit();
			} else return false;
		}

		// Comprueba inputos vacíos
		function empty() {
			var id_evento = document.getElementById("id_eventoN").value;
			var nombre = document.getElementById("nombreN").value;
			var descripcion = document.getElementById("descripcionN").value;

			if (id_evento == "" && nombre == "" && descripcion == "") {
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

					<!-- Formulario para seleccionar el evento a editar -->
					<?php if(!isset($_POST['id_evento'])){ ?>
					<form class="form-horizontal" role="form" method="POST" action="../controllers/EVENTO_Controller.php?id=modificarServicio">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar evento']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Lista los eventos registrados -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['evento']; ?>:</label>
								</div><div class="col-sm-4">
								<select name="id_evento" required>
									<?php listarEventosModificar(); ?>
								</select>
							</div></div>
						</div>

						<!-- Submit para visualizar evento a modificar -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">
							</div></div>
					</form>

					<!-- Formulario para mostrar el evento y confirmar la edición -->
					<?php }else{ ?>
					<form class="form-horizontal" role="form" name="formulario" method="POST" action="../controllers/EVENTO_Controller.php?id=modificarEvento" onsubmit="return pregunta();">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar evento']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Muestra los datos del evento a editar -->
							<table class="table table-striped">
								<thead><tr>
									<th><?php echo $strings['id_evento']; ?></th>
									<th><?php echo $strings['nombre']; ?></th>
									<th><?php echo $strings['descripcion']; ?></th>
								</thead><tbody>
									<?php consultarEvento($_POST['id_evento']); ?>
								</tbody>
							</table>

							<!-- Input oculto con el evento a modificar -->
							<input type="hidden" name="id_evento" value="<?php echo $_POST['id_evento']; ?>">
							<input type="hidden" name="id_eventoN" value="<?php echo $_POST['id_evento']; ?>">
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?> <?php echo $strings['campos modificar']; ?>:</label>
								</div>
							</div>
						</div>

						<!-- Campo nombre-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" id="nombreN" class="form-control" name="nombre" pattern="/^\s*([\pL\w\s]+)\s*" title="<?php echo $strings['error nombre']; ?>" required>
							</div>
						</div>

						<!-- Campo Descripcion-->
						<div class="form-group">
						  <div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['descripcion']; ?>:</label>
						  </div>
						  <div class="col-sm-4">
							<input type="text" id="descripcionN" class="form-control" name="descripcion" pattern="[0-9A-Za-z\d_]{4,50}" title="<?php echo $strings['error descripcion']; ?>" required>
						  </div>
						</div>

						<!-- Submit para editar el evento, con confirmación -->
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
