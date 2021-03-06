<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin o secretario antes de cargar la página.
if(isset($_SESSION['grupo']) && (strcmp($_SESSION['grupo'],"Admin") == 0 OR strcmp($_SESSION['grupo'],"Secretario") == 0) ){

//Crea la clase e instancia la función render en el constructor.
class Evento_Borrar{

	function __construct(){
		$this->render();
	}

	function render(){
		require_once('../header.php');
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo borrar evento']; ?></title>

		<script>
		//Confirman el borrado.
		function pregunta(){
			if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
			   $("form").attr("action","../controllers/EVENTO_Controller.php?id=bajaEvento");
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

					<!-- Formulario para seleccionar el cliente a borrar -->
					<?php if(!isset($_POST['id_evento'])){ ?>
					<form class="form-horizontal" role="form" method="POST" action="../controllers/CLIENTEEXTERNO_Controller.php?id=bajaCliente">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar cliente']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Lista los eventos registrados -->
							<div class="form-group">
								<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['evento']; ?>:</label>
								</div><div class="col-sm-4">
								<select name="serv" required>
									<?php listarEventosBorrar(); ?>
								</select>
							</div></div>
						</div>

						<!-- Submit para visualizar evento a borrar -->
						<div class="form-group">
								<div class="col-sm-4"></div>
								<div class="col-sm-4">
								<input class="btn btn-primary" value="<?php echo $strings['siguiente']; ?>" type="submit">
							</div></div>
					</form>

					<!-- Formulario para mostrar el evento y confirmar el borrado -->
					<?php }else{ ?>
					<form class="form-horizontal" role="form" name="formulario" method="POST" action="">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar evento']; ?></h2></div>
								<div class="col-md-12"><hr></div>

							<!-- Muestra los datos del evento -->
							<table class="table table-striped">
							<thead><tr>
								<th><?php echo $strings['id_evento']; ?></th>
								<th><?php echo $strings['descripcion']; ?></th>
								<th><?php echo $strings['nombre']; ?></th>
							</thead><tbody>
								<?php consultarEvento($_POST['even']); ?>
							</tbody>
						</table>
							<input type="hidden" name="id_evento" value="<?php echo $_POST['even']; ?>">
						</div>

						<!-- Submit para borrar el evento, con confirmación -->
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