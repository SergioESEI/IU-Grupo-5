<?php
//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 OR strcmp($_SESSION['grupo'],"Secretario") == 0) ){

//Crea la clase e instancia la función render en el constructor.
class Cliente_Buscar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php');
?>
		<title><?php echo $strings['buscarCliente']; ?></title>
		<script>
		function empty() {
			var id = document.getElementById("id_cliente").value;
			var dni = document.getElementById("dni").value;
			var nombre = document.getElementById("nombre").value;
			var tlf = document.getElementById("tlf").value;
			var email = document.getElementById("email").value;
			var direccion = document.getElementById("direccion").value;

			if (id == "" && dni == "" && nombre == "" && tlf == "" && email == "" && direccion == "") {
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
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['buscar cliente']; ?></h2></div>
						<div class="col-md-12"><hr></div>
					</div>

					<!-- Formulario que recoge el cliente a buscar -->
					<?php if(!isset($_POST['id_cliente'])){ ?>
					<form class="form-horizontal" role="form" action="../controllers/CLIENTEEXTERNO_Controller.php?id=buscarCliente" method="POST" onsubmit="return empty();">

						<!-- Campo id_cliente-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['id_cliente']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" id="id_cliente" class="form-control" name="id_cliente" pattern="[0-9A-Za-z]{4,16}" title="<?php echo $strings['error id_cliente']; ?>">
							</div>
						</div>
						<!-- Campo nombre-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" id="nombre" class="form-control" name="nombre" pattern="/^\s*([\pL\w\s]+)\s*" title="<?php echo $strings['error nombre']; ?>">
							</div>
						</div>

						<!-- Campo DNI-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" id="dni" class="form-control" name="dni" onblur="nif(this.value)">
							</div>
						</div>

						<!-- Campo Tlf-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['tlf']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" id="tlf" class="form-control" name="tlf" pattern="[0-9]{9}" title="<?php echo $strings['error tlf']; ?>">
							</div>
						</div>

						<!-- Campo Email-->
						<div class="form-group">
						  <div class="col-sm-4">
							<label for="email" class="control-label"><?php echo $strings['email']; ?>:</label>
						  </div>
						  <div class="col-sm-4">
							<input type="text" id="email" class="form-control" name="email" pattern="[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})" title="<?php echo $strings['error email']; ?>">
						  </div>
						</div>

						<!-- Campo Direccion-->
						<div class="form-group">
						  <div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['direccion']; ?>:</label>
						  </div>
						  <div class="col-sm-4">
							<input type="text" id="direccion" class="form-control" name="direccion" pattern="[0-9A-Za-z\d_]{4,50}" title="<?php echo $strings['error direccion']; ?>">
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
							<?php $cliente1=new clienteExterno($_POST['id_cliente'],$_POST['nombre'],$_POST['dni'],$_POST['tlf'],$_POST['email'],$_POST['direccion']);
							 		consultarClienteBorrar($cliente1);?>
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
