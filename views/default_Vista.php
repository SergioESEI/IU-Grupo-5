<html> 
	<!-- Titulo de la página e include de la cabecera -->
	<?php
	session_start();
	if(isset($_SESSION['user'])){
		include_once('../header.php');
	?>
	<title><?php echo $strings['principal']; ?></title>
	
	<style type="text/css">
	  .horario {width:90%; border-collapse: collapse; border:3px solid grey;}
	  .tabla_colores {width:50%; border-collapse: collapse; border:3px solid grey;}
	  .colores {width:25%}
	  tr {width:100%; border-collapse: collapse; border:1px solid grey}
	  td,th {width:12,86%;border-collapse: collapse; border:1px solid grey; color:black; text-align:center;}
	  th {font-size:15px; text-transform:uppercase; color: #F11FC2;}
	  .borde {border:solid 3px grey;}
	  .borde_especial {border: #FF0077 3px dotted;}
	  .sin_borde {border:1px solid transparent;}
	  .sin_borde_dcha { border-right:1px solid transparent;}
	  .dcha {font-size: 12px;}
	  .amarillo {background-color:#ffff99;}
	  .verde {background-color:#ccffcc;}
	  .lila {background-color:#cc99ff}
	  .azul {background-color:#99ccff}
	  .rosa_mn {background-color:#F9B1DE}
	  .rojo {background-color: #F75451}
	  .rosa {background-color: #ffccff}
	  .fucsia {background-color: #FF0077}
	  .azul_osc {background-color: #3366cc}
	</style>
	
	<!-- Include del menú lateral -->
	<body>
		<div class="row-fluid">
			<?php include_once('menu.php'); ?>
			<div class="col-sm-10">
				<div class="section-fluid">
					<div class="container-fluid">

					<center>
					<br/>
					<h3><?php echo $strings['octubre']; ?> - <?php echo $strings['diciembre']; ?> 2016</h3>

					<table class="horario">
					  <tr>
						<th colspan="2"></th>
						<th><?php echo $strings['lunes']; ?></th>
						<th><?php echo $strings['martes']; ?></th>
						<th><?php echo $strings['miercoles']; ?></th>
						<th><?php echo $strings['jueves']; ?></th>
						<th><?php echo $strings['viernes']; ?></th>
						<th><?php echo $strings['sabado']; ?></th>
					  </tr>
					  <tr>
						<th class="rosa">10 - 11</th>
						<td><?php echo $strings['sala 1']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					  </tr>
						<tr class="borde">
						<td colspan="2" class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
					  </tr>
					  <tr>
						<th class="rosa">11 - 12</th>
						<td><?php echo $strings['sala 1']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					  </tr>
					  <tr class="borde">
						<td colspan="2" class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
					  </tr>
					   <tr>
						<th class="rosa">12 - 13</th>
						<td><?php echo $strings['sala 1']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					  </tr>
					  <tr class="borde">
						<td colspan="2" class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
					  </tr>
					  <tr>
						<th class="rosa">16 - 17</th>
						<td><?php echo $strings['sala 1']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					  </tr>
					  <tr class="borde">
						<td colspan="2" class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
					  </tr>
					   <tr>
						<th class="rosa">17 - 18</th>
						<td><?php echo $strings['sala 1']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					  </tr>
					  <tr class="borde">
						<td colspan="2" class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
					  </tr>
					   <tr>
						<th class="rosa">18 - 19</th>
						<td><?php echo $strings['sala 1']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					  </tr>
					  <tr class="borde">
						<td colspan="2" class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
					  </tr>
					   <tr>
						<th class="rosa">19 - 20</th>
						<td><?php echo $strings['sala 1']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					  </tr>
					  <tr class="borde">
						<td colspan="2" class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
					  </tr>
					   <tr>
						<th class="rosa">20 - 21</th>
						<td><?php echo $strings['sala 1']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					  </tr>
						<tr class="borde">
						<td colspan="2" class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
					  </tr>
					   <tr>
						<th class="rosa">21 - 22</th>
						<td><?php echo $strings['sala 1']; ?></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					  </tr>
						<tr class="borde">
						<td colspan="2" class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
						<td class="sin_borde"></td>
					  </tr>
					</table>

					</div>
				</div>
			</div>
		</div>	
	</body>
</html>

<?php 
}else{
	echo "Permiso denegado.";
}
?>
