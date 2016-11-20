<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
	session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 ){ 

//Crea la clase e instancia la función render en el constructor. 
class Grupo_Borrar{

	function __construct(){
		$this->render();
	}

	function render(){
		include_once('../header.php'); 
?>
		<!-- Titulo de la página -->
		<title><?php echo $strings['titulo borrar grupo']; ?></title>
		
		<script> 	
		//Confirman el borrado.
		function pregunta(){
			if (confirm('<?php echo $strings['confirmar borrado']; ?>')){
			   $("form").attr("action","../controllers/GRUPO_Controller.php?id=bajaGrupo");
			   document.formulario.submit();
			}else return false;
		}
		</script>
		
		<body>
		  <div class="row-fluid">
		  <!-- Include del menú -->
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10 text-left">
				<div class="section-fluid">
				  <div class="container-fluid">
					
					<!-- Formulario para seleccionar el grupo a borrar -->
					<form class="form-horizontal" role="form" name="formulario" onsubmit="return pregunta()" method="POST" action="">
					<div class="form-group">
						<div class="col-md-12"> <h2 class="text-info "><?php echo $strings['borrar grupo']; ?></h2></div>
							<div class="col-md-12"><hr></div>
						
						<!-- Lista los grupos registrados -->						
						<div class="form-group">
							<div class="col-sm-4">
							<label for="nombre" class="control-label"><?php echo $strings['grupo']; ?>:</label>
							</div><div class="col-sm-4">
							<select name="grupo" required>
								<?php listarGrupos(); ?>
							</select>
						</div></div>
					</div>
					
					<!-- Submit para borrar el grupo, con confirmación -->
					<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-4">
							<input class="btn btn-primary" value="<?php echo $strings['borrar']; ?>" type="submit">						
						</div></div>
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