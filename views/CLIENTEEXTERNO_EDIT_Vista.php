<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){

//Crea la clase e instancia la función render en el constructor.
class Cliente_Editar{

	//Si se le pasa, crea un array con los datos del cliente.
	function __construct($datos=null){
		$this->render($datos);
	}

	function render($datos){
		require_once('../header.php');
?>
		<!-- Título de la página -->
		<title><?php echo $strings['titulo editar cliente']; ?></title>

		<script>
		//Compruba que el formato del DNI sea válido.
		function nif(dni) {
		  var numero
		  var letr
		  var letra
		  var expresion_regular_dni

		  expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

		  if(expresion_regular_dni.test (dni) == true){
			 numero = dni.substr(0,dni.length-1);
			 letr = dni.substr(dni.length-1,1);
			 numero = numero % 23;
			 letra='TRWAGMYFPDXBNJZSQVHLCKET';
			 letra=letra.substring(numero,numero+1);
			if (letra!=letr.toUpperCase()) {
			   alert('<?php echo $strings['error letra dni']; ?>');
			 }
		  }else{
			if (dni != "")
				alert('<?php echo $strings['error dni']; ?>');
		   }
		}

		//Confirman la edición.
		function pregunta(){
			var dni = document.getElementById("dniN").value;
			var nombre = document.getElementById("nombreN").value;
			var tlf = document.getElementById("tlfN").value;
			var email = document.getElementById("emailN").value;
			var direccion = document.getElementById("direccionN").value;

			return empty();
			if (confirm('<?php echo $strings['confirmar modificacion']; ?>'+
				'\n\n<?php echo $strings['dni']; ?>: '+dni +
				'\n<?php echo $strings['tlf']; ?>: '+tlf +
				'\n<?php echo $strings['email']; ?>: '+email +
				'\n<?php echo $strings['direccion']; ?>: '+direccion +
				'\n<?php echo $strings['nombre']; ?>: '+nombre)){
			   document.formulario.submit();
			} else return false;
		}

		// Comprueba inputos vacíos
		function empty() {
			var dni = document.getElementById("dniN").value;
			var nombre = document.getElementById("nombreN").value;
			var tlf = document.getElementById("tlfN").value;
			var email = document.getElementById("emailN").value;
			var direccion = document.getElementById("direccionN").value;

			if (dni == "" && nombre == "" && tlf == "" && email == "" && direccion == "") {
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

					<!-- Formulario para seleccionar el cliente a editar -->
					<?php if(!isset($_POST['id_cliente'])){ ?>
					<form class="form-horizontal" role="form" method="POST" action="../controllers/CLIENTEEXTERNO_Controller.php?id=modificarCliente">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar cliente']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Lista los cliente registrados -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['cliente']; ?>:</label>
								</div><div class="col-sm-4">
								<select name="id_cliente" required>
									<?php listarClientesModificar(); ?>
								</select>
							</div></div>
						</div>

						<!-- Submit para visualizar cliente a modificar -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">
							</div></div>
					</form>

					<!-- Formulario para mostrar el cliente y confirmar la edición -->
					<?php }else{ ?>
					<form class="form-horizontal" role="form" name="formulario" method="POST" action="../controllers/CLIENTEEXTERNO_Controller.php?id=modificarCliente" onsubmit="return pregunta();">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['editar cliente']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Muestra los datos del cliente a editar -->
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

							<!-- Input oculto con el cliente a modificar -->
							<input type="hidden" name="id_cliente" value="<?php echo $_POST['id_cliente']; ?>">
							<input type="hidden" name="id_clienteN" value="<?php echo $_POST['id_cliente']; ?>">
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
							  <input type="text" id="nombreN" class="form-control" name="nombreN" pattern="/^\s*([\pL\w\s]+)\s*" title="<?php echo $strings['error nombre']; ?>" >
							</div>
						</div>

						<!-- Campo DNI-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" id="dniN" class="form-control" name="dniN" onblur="nif(this.value)">
							</div>
						</div>

						<!-- Campo Tlf-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['tlf']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" id="tlfN" class="form-control" name="tlfN" pattern="[0-9]{9}" title="<?php echo $strings['error tlf']; ?>" >
							</div>
						</div>

						<!-- Campo Email-->
						<div class="form-group">
						  <div class="col-sm-4">
							<label for="email" class="control-label"><?php echo $strings['email']; ?>:</label>
						  </div>
						  <div class="col-sm-4">
							<input type="text" id="emailN" class="form-control" name="emailN" pattern="[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})" title="<?php echo $strings['error email']; ?>" >
						  </div>
						</div>

						<!-- Campo Direccion-->
						<div class="form-group">
						  <div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['direccion']; ?>:</label>
						  </div>
						  <div class="col-sm-4">
							<input type="text" id="direccionN" class="form-control" name="direccionN" pattern="[0-9A-Za-z\d_]{4,50}" title="<?php echo $strings['error direccion']; ?>" >
						  </div>
						</div>

						<!-- Submit para editar el usuario, con confirmación -->
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
