<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Lesion_Editar{

		function __construct($datos){
			$this->render($datos);
		}
		

		function render($datos){
			require_once('../header.php'); 
			?>
			<!-- Titulo de la página -->
			<title><?php echo $strings['titulo modificar lesion']; ?></title>
			
			<script> 	
	</script>
	

	<body>
		<div class="row-fluid">
			<!-- Include del menú -->

			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
					<div class="container-fluid">
					<?php if(!isset($_GET['idles'])){ ?>
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['modificarLesion']; ?></h2></div>
							<div class="col-md-12"><hr></div>
							<table class="table table-striped">
								<thead><tr> 
									<th><?php echo $strings['dni']; ?></th>
									<th><?php echo $strings['id lesion']; ?></th>
									<th><?php echo $strings['tipo lesion']; ?></th>
								</thead><tbody>
								<?php verLesionesModificar($_GET['id2']); ?>
							</tbody>
						</table>
					</div>
					<?php }else{ ?>

					<form class="form-horizontal" role="form" name="formulario" method="POST" action="../controllers/LESION_Controller.php?id=modificarLesion&id2=<?php echo $_GET['id2'];?>&idles=<?php echo $_GET['idles'];?>"  onsubmit="return pregunta()">
						<div class="form-group">
							<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['modificarLesion']; ?></h2></div>
							<div class="col-md-12"><hr></div>
							
							<!-- Muestra los datos del trabajador a editar -->
							<table class="table table-striped">
								<thead><tr> 
									<th><?php echo $strings['dni']; ?></th>
									<th><?php echo $strings['id lesion']; ?></th>
									<th><?php echo $strings['tipo lesion']; ?></th>
								</thead><tbody>
								<?php consultarLesion($_GET['idles']); ?>
							</tbody>
						</table>
						
						<!-- Input oculto con el trabajador a modificar -->
						<input type="hidden" name="dniN" value="<?php echo $_GET['id2']; ?>">
						<div class="form-group">
							<div class="col-sm-4">
								<label for="nombre" class="control-label"><?php echo $strings['nuevos datos']; ?>:</label>
							</div>
						</div>
					</div>

					<!-- Campo DNI-->
					<div class="form-group">
						<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
						</div>
						<div class="col-sm-4">
							<?php if($datos['DNI'] != null){ ?>
							<input type="text" id="dni" readonly class="form-control" name="dniN" value="<?php echo $datos['DNI']; ?>" onblur="nif(this.value)">
							<?php }else{ ?>
							<input type="text" id="dni" readonly class="form-control" name="dniN" onblur="nif(this.value)">
							<?php } ?>
							
						</div>
					</div>
					
					
					<!-- Campo Tipo -->
					<div class="form-group">
						<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['tipo lesion']; ?>:</label>
						</div>
						<div class="col-sm-4">
							<?php if($datos['Tipo'] != null){ ?>
							<input type="text" id="tipoN" class="form-control" name="tipoN" value="<?php echo $datos['Tipo']; ?>" title="<?php echo $strings['error trabajador']; ?>" required>
							<?php }else{ ?>
							<input type="text" id="tipoN" class="form-control" name="tipoN"  title="<?php echo $strings['error trabajador']; ?>" required>
							<?php } ?>
						</div>
					</div>
					

					<!-- Campo ID -->
					<div class="form-group">
						<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['id lesion']; ?>:</label>
						</div>
						<div class="col-sm-4">
							
							<input type="text" id="idN" class="form-control" name="idLesion" value="<?php echo $datos['Id_Lesion']; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
							
						</div>
					</div>

					

					
				<!-- Campo Descripcion -->
				<div class="form-group">
					<div class="col-sm-4">
						<label for="nombre" class="control-label"><?php echo $strings['descripcion']; ?>:</label>
					</div>
					<div class="col-sm-4">
						<?php if($datos['Descripcion'] != null){ ?>
						<textarea id="descripcionN" name="descripcionN" rows="10" cols="40"><?php echo $datos['Descripcion']; ?></textarea>
						<?php }else{ ?>
						<textarea id="descripcionN" name="descripcionN" rows="10" cols="40"></textarea>
						<?php } ?>
					</div>
				</div>


				
				<!-- Campo Curada-->
				<div class="form-group">
					<div class="col-sm-4">
						<label for="nombre" class="control-label"><?php echo $strings['curada']; ?>:</label>
					</div>
					<div class="col-sm-4">
						<select name="CuradaN" >
											<?php if($datos['Curada'] == '1'){ ?> 
											<option selected value="curada"><?php echo $strings['curada']; ?></option>  
											<option value="nocurada"><?php echo $strings['no curada']; ?></option>  
											<?php }else{ ?> 
											<option value="curada"><?php echo $strings['curada']; ?></option>  
											<option selected value="nocurada"><?php echo $strings['no curada']; ?></option>  
											<?php } ?>
					</div>
				</div>
				

				<!-- Submit para editar el trabajador, con confirmación -->
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