<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Lesion_Nueva{

		function __construct($dni){
			$this->render($dni);
		}
		function render($dni){
			require_once('../header.php'); 
			?>
			<!-- Título de la página -->
			<title><?php echo $strings['titulo añadir lesion']; ?></title>
			<script>
		//Compruba que el formato del DNI sea válido.
		

	
	</script>
	<body>
		<!-- Include del menú-->
		<div class="row-fluid">
			<?php include_once('menu.php'); ?>

			<div class="col-sm-10 text-left">
				<div class="section-fluid">
					<div class="container-fluid">

						
						<!-- Formulario para añadir usuario -->
						<form class="form-horizontal" role="form" action="../controllers/LESION_Controller.php?id=altaLesion&id2=<?php echo $dni;?>&ok=ok" method="POST"  onsubmit="return validateForm()">
							<div class="form-group"  >
								<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['nueva lesion']; ?></h2></div>
								<div class="col-md-12"><hr></div>

								<!-- Campo DNI-->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
									</div>
									<div class="col-sm-4"> 
										<input type="text" required class="form-control" name="dni" readonly value="<?php echo $dni; ?>" onblur="nif(this.value)">
									</div>
								</div>
								
								<!-- Campo Tipo -->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['tipo lesion']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<input type="text" class="form-control" name="tipo"  title="<?php echo $strings['error trabajador']; ?>" >
									</div>
								</div>
								

								<!-- Campo Descripcion -->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['descripcion']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<textarea name="descripcion" rows="10" cols="40"></textarea>
									</div>
								</div>


								<!-- Campo Curada-->
								<div class="form-group">
									<div class="col-sm-4">
										<label for="nombre" class="control-label"><?php echo $strings['curada']; ?>:</label>
									</div>
									<div class="col-sm-4">
										<select name="curada" >
											<option value="curada"><?php echo $strings['curada']; ?></option>  
											<option value="nocurada"><?php echo $strings['no curada']; ?></option>  
										</select>
									</div>
								</div>
								
								
								<!-- Submit que envía los datos para crear el trabajador -->
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
