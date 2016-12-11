<?php
//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 OR strcmp($_SESSION['grupo'],"Secretario") == 0) ){

//Crea la clase e instancia la función render en el constructor.
class Evento_Buscar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php');
?>
		<title><?php echo $strings['buscarEvento']; ?></title>
		<script>
		function empty() {
			var id_evento = document.getElementById("id_evento").value;
			var nombre = document.getElementById("nombre").value;
			var descripcion = document.getElementById("descripcion").value;

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

					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['buscar evento']; ?></h2></div>
						<div class="col-md-12"><hr></div>
					</div>

					<!-- Formulario que recoge el evento a buscar -->
					<?php if(!isset($_POST['id_evento'])){ ?>
					<form class="form-horizontal" role="form" action="../controllers/EVENTO_Controller.php?id=buscarEvento" method="POST" onsubmit="return empty();">

						<!-- Campo id_evento-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['id_evento']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" id="id_evento" class="form-control" name="id_evento" pattern="[0-9A-Za-z]{4,16}" title="<?php echo $strings['error id_evento']; ?>">
							</div>
						</div
						
						<!-- Campo nombre-->
						<div class="form-group">
							<div class="col-sm-4">
							  <label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
							</div>
							<div class="col-sm-4">
							  <input type="text" id="nombre" class="form-control" name="nombre" pattern="/^\s*([\pL\w\s]+)\s*" title="<?php echo $strings['error nombre']; ?>" required>
							</div>
						</div>
						
						<!-- Campo Descripcion-->
						<div class="form-group">
						  <div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['descripcion']; ?>:</label>
						  </div>
						  <div class="col-sm-4">
							<input type="text" id="descripcion" class="form-control" name="descripcion" pattern="[0-9A-Za-z\d_]{4,50}" title="<?php echo $strings['error direccion']; ?>" required>
						  </div>
						</div>



						<!-- Submit que envía los datos para buscar el evento -->
						 <div class="form-group">
							  <div class="col-sm-4"></div>
							  <div class="col-sm-4"><input class="btn btn-primary" value="<?php echo $strings['buscar']; ?>" type="submit">
							  <input class="btn btn-default" value="<?php echo $strings['resetear']; ?>" type="reset"></div>
						 </div>
					</form>

					<?php }else{ ?>
					<!-- Lista los datos del evento -->
					<table class="table table-striped">
						<thead><tr>
							<th><?php echo $strings['id_evento']; ?></th>
							<th><?php echo $strings['nombre']; ?></th>
							<th><?php echo $strings['descripcion']; ?></th>
						</thead><tbody>
							<?php $evento1=new evento($_POST['id_evento'],$_POST['nombre'],$_POST['descripcion']);
							 		consultarEventoBorrar($evento1);?>
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