<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Lesion_Editar_Confirmar{

		function __construct($lesion){
			$this->render($lesion);
		}

		function render($lesion){
			include_once('../header.php'); 
			?>
			<title><?php echo $strings['titulo modificar lesion']; ?></title>

			<body>

				<div class="row-fluid">
					<!-- Include del menú -->
					<?php include_once('menu.php'); ?>
					<div class="col-sm-10 text-left">
						<div class="section-fluid">
							<div class="container-fluid">
										
										<form class="form-horizontal" role="form" name="formulario" action="../controllers/LESION_Controller.php?id=modificarLesion&id2=<?php echo $_GET['id2'];?>&idles=<?php echo $_GET['idles'];?>&confirm=ok" method="POST" >
										<div class="form-group">

											<div class="col-md-20"> <h2 class="text-info "><?php echo $strings['confirmar lesion']; ?></h2></div>
											<div class="col-md-20"><hr></div>
											<br>
											<input type="hidden" name="dniN" value="<?php echo $_GET['id2']; ?>">

											<!-- Campo DNI-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
												</div>
												<div class="col-sm-4">
													
													<input type="text" id="dni" class="form-control" name="dniN" value="<?php echo $lesion->dni; ?>" readonly>
													
												</div>
											</div>

											<!-- Campo ID -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['id lesion']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="idN" value="<?php echo $lesion->id; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												</div>
											</div>
											

											<!-- Campo Tipo -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['tipo lesion']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="tipoN" value="<?php echo $lesion->tipo; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												
												</div>
											</div>
											<br>

											
											
											<!-- Campo Descripcion -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['descripcion']; ?>:</label>
												</div>
												<div class="col-sm-4">
											
													<textarea name="descripcionN" readonly rows="10" cols="40"><?php echo $lesion->descripcion; ?></textarea>
												
												</div>
											</div>




											<!-- Campo Curada-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['curada']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php 

														if($lesion->curada == 0){?>
														<input type="radio" readonly name="curadaN" value="0" disabled checked><?php echo $strings['no curada'];?>
														<br>
														<input type="radio" readonly name="curadaN" value="1" disabled><?php echo $strings['curada'];?>
														<?php }else{?>
														<input type="radio" readonly name="curadaN" value="0" disabled><?php echo $strings['no curada'];?>
														<br>
														<input type="radio" readonly name="curadaN" value="1" disabled checked><?php echo $strings['curada'];?>
														<?php }?>
													
												</div>
											</div>
											

											<!-- Submit que envía los datos para crear el trabajador -->
											<div class="form-group">
												<div class="col-sm-4"></div>
												<div class="col-sm-4">
													<input class="btn btn-primary" value="<?php echo $strings['confirmar']; ?>" type="submit">
													<input type="button" class="btn btn-default" onclick="history.back()" name="volver atras" value="<?php echo $strings['volver atras'];?>">
												</div>
											</div>
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