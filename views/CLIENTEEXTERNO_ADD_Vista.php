<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){

//Crea la clase e instancia la función render en el constructor.
class Cliente_Crear{
	function __construct(){
		$this->render();
	}

	function render(){
		require_once('../header.php');

?>
		<!-- Título de la página -->
		<title><?php echo $strings['titulo añadir cliente']; ?></title>

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
		</script>

		<body>
		<!-- Include del menú-->
		  <div class="row-fluid">
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">

						<!-- Formulario para añadir cliente -->
						<form class="form-horizontal" role="form" action="../controllers/CLIENTEEXTERNO_Controller.php?id=altaCliente" method="POST">
							<div class="form-group">
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nuevo cliente']; ?></h2></div>
								<div class="col-md-12"><hr></div>

								<!-- Campo id-->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['id_cliente']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="id_cliente" pattern="[0-9A-Za-z]{4,16}" title="<?php echo $strings['error id_cliente']; ?>" required>
									</div>
								</div>

								<!-- Campo nombre-->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['nombre']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="nombre" pattern="/^\s*([\pL\w\s]+)\s*" title="<?php echo $strings['error nombre']; ?>" required>
									</div>
								</div>

								<!-- Campo DNI-->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="dni" onblur="nif(this.value)">
									</div>
								</div>

                				<!-- Campo Tlf-->
								<div class="form-group">
									<div class="col-sm-4">
									  <label for="nombre" class="control-label"><?php echo $strings['tlf']; ?>:</label>
									</div>
									<div class="col-sm-4">
									  <input type="text" class="form-control" name="tlf" pattern="[0-9]{9}" title="<?php echo $strings['error tlf']; ?>" required>
									</div>
								</div>

				                <!-- Campo Email-->
				                <div class="form-group">
				                  <div class="col-sm-4">
				                    <label for="email" class="control-label"><?php echo $strings['email']; ?>:</label>
				                  </div>
				                  <div class="col-sm-4">
				                    <input type="text" class="form-control" name="email" pattern="[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})" title="<?php echo $strings['error email']; ?>" required>
				                  </div>
				                </div>

				                <!-- Campo Direccion-->
				                <div class="form-group">
				                  <div class="col-sm-4">
				                    <label for="nombre" class="control-label"><?php echo $strings['direccion']; ?>:</label>
				                  </div>
				                  <div class="col-sm-4">
				                    <input type="text" class="form-control" name="direccion" pattern="[0-9A-Za-z\d_]{4,50}" title="<?php echo $strings['error direccion']; ?>" required>
				                  </div>
				                </div>

								<!-- Submit que envía los datos para crear el usuario -->
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
