<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
	class Lesion_Mostrar{

		function __construct($datos=null){
			$this->render($datos);
		}

		
		function render($datos){
			include_once('../header.php'); 
			
			$log = new Log_Lesion("logAccesoLesiones","/var/www/html/logs/");
			$log->insertar('LESION_SHOW_Vista.php', $_SESSION['user'],$_GET['id2'],$datos['Id_Lesion'], false);

			?>
			<title><?php echo $strings['mostrarLesion']; ?></title>
			



			<body>


				<div class="row-fluid">
					<!-- Include del menú -->
					<?php include_once('menu.php'); ?>
					<div class="col-sm-10 text-left">
						<div class="section-fluid">
							<div class="container-fluid">
								
										<form class="form-horizontal" role="form" 
										<div class="form-group">
											<div class="col-md-20"> <h2 class="text-info "><?php echo $strings['buscar lesion']; ?></h2></div>
											<div class="col-md-20"><hr></div>
											

											<br>



											<!-- Campo ID -->
											<div class="form-horizontal">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['id lesion']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<input type="text" class="form-control" name="idlesion" value="<?php echo $datos['Id_Lesion']; ?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
												</div>
											</div>
											<br>
											<br>
											<br>

											
											


											<!-- Campo Tipo -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['tipo lesion']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php if($datos['Tipo'] != null){ ?>
													<input type="text" class="form-control" name="tipo" value="<?php echo $datos['Tipo'];?>" title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php }else{ ?>
													<input type="text" class="form-control" name="tipo"  title="<?php echo $strings['error trabajador']; ?>" readonly>
													<?php } ?>
												</div>
											</div>

											<!-- Campo DNI-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['dni']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php if($datos['DNI'] != null){ ?>
													<input type="text" id="dni" class="form-control" name="dniN" value="<?php echo $datos['DNI']; ?>" onblur="nif(this.value)" readonly>
													<?php }else{ ?>
													<input type="text" id="dni" class="form-control" name="dniN" onblur="nif(this.value)" readonly>
													<?php } ?>
													
												</div>
											</div>
											

											<!-- Campo Descripcion -->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['descripcion']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php if($datos['Descripcion'] != null){ ?>
													<textarea name="descripcion" readonly rows="10" cols="40"><?php echo $datos['Descripcion']; ?></textarea>
													<?php }else{ ?>
													<textarea name="descripcion" readonly rows="10" cols="40"></textarea>
													<?php } ?>
												</div>
											</div>



										
											<!-- Campo Curada-->
											<div class="form-group">
												<div class="col-sm-4">
													<label for="nombre" class="control-label"><?php echo $strings['curada']; ?>:</label>
												</div>
												<div class="col-sm-4">
													<?php if($datos['Curada'] != null){ 
														if($datos['Curada'] == 0){?>
														<input type="radio" readonly name="curada" value="0" disabled checked>No
														<br>
														<input type="radio" readonly name="curada" value="1" disabled>Si
														<?php }else{?>
														<input type="radio" readonly name="curada" value="0" disabled>No
														<br>
														<input type="radio" readonly name="curada" value="1" disabled checked>Sí
														<?php }
													}else{?>
													<input type="radio" readonly name="curada" value="0" disabled>No
													<br>
													<input type="radio" readonly name="curada" value="1" disabled>Sí
													<?php 	} ?>
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