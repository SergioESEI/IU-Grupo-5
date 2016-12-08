<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 OR strcmp($_SESSION['grupo'],"Secretario") == 0) ){

//Crea la clase e instancia la función render en el constructor.
class Servicio_Editar{

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
			var dni = document.getElementById("id_trabajadorN").value;
			var nombre = document.getElementById("nombreN").value;
			var tlf = document.getElementById("precioN").value;
			var email = document.getElementById("descripcionN").value;

			empty();
			if (confirm('<?php echo $strings['confirmar modificacion']; ?>'+
				'\n\n<?php echo $strings['id_trabajador']; ?>: '+id_trabajador +
				'\n<?php echo $strings['nombre']; ?>: '+nombre +
				'\n<?php echo $strings['precio']; ?>: '+precio +
				'\n<?php echo $strings['descripcion']; ?>: '+descripcion +)){
			   document.formulario.submit();
			} else return false;
		}

		// Comprueba inputos vacíos
		function empty() {
			var id_trabajador = document.getElementById("id_trabjadorN").value;
			var nombre = document.getElementById("nombreN").value;
			var precio = document.getElementById("precioN").value;
			var descripcion = document.getElementById("descripcionN").value;

			if (id_trabjador == "" && nombre == "" && precio == "" && descripcion == "") {
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

					<!-- Formulario para seleccionar el servicio a editar -->
					<?php if(!isset($_POST['id_cliente'])){ ?>
					<form class="form-horizontal" role="form" method="POST" action="../controllers/SERVICIO_Controller.php?id=modificarServicio">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar servicio']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Lista los servicios registrados -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['servicio']; ?>:</label>
								</div><div class="col-sm-4">
								<select name="id_servicio" required>
									<?php listarServiciosModificar(); ?>
								</select>
							</div></div>
						</div>

						<!-- Submit para visualizar servicio a modificar -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">
							</div></div>
					</form>

					<!-- Formulario para mostrar el servicio y confirmar la edición -->
					<?php }else{ ?>
					<form class="form-horizontal" role="form" name="formulario" method="POST" action="../controllers/SERVICIO_Controller.php?id=modificarServicio" onsubmit="return pregunta();">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar servicio']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Muestra los datos del servicio a editar -->
							<table class="table table-striped">
								<thead><tr>
									<th><?php echo $strings['id_servicio']; ?></th>
									<th><?php echo $strings['id_trabajador']; ?></th>
									<th><?php echo $strings['nombre']; ?></th>
									<th><?php echo $strings['precio']; ?></th>
									<th><?php echo $strings['descripcion']; ?></th>
								</thead><tbody>
									<?php consultarServicio($_POST['id_servicio']); ?>
								</tbody>
							</table>

							<!-- Input oculto con el servicio a modificar -->
							<input type="hidden" name="id_servicio" value="<?php echo $_POST['id_servicio']; ?>">
							<input type="hidden" name="id_servicioN" value="<?php echo $_POST['id_servicio']; ?>">
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?> <?php echo $strings['campos modificar']; ?>:</label>
								</div>
							</div>
						</div>

						<!-- Campo id trabajador-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['id_trabajador']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <select id="id_trabajadorN" name="trabajador" required>
								  <?php listarTrabajadores(); ?>
							  </select>
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

						<!-- Campo Precio-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['precio']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" id="precioN" class="form-control" name="precio" pattern="[0-9]+(\.[0-9]+)" title="<?php echo $strings['error precio']; ?>" required>
							</div>
						</div>

						<!-- Campo Descripcion-->
						<div class="form-group">
						  <div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['descripcion']; ?>:</label>
						  </div>
						  <div class="col-sm-4">
							<input type="text" id="descripcionN" class="form-control" name="descripcion" pattern="[0-9A-Za-z\d_]{4,50}" title="<?php echo $strings['error direccion']; ?>" required>
						  </div>
						</div>

						<!-- Submit para editar el servicio, con confirmación -->
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
