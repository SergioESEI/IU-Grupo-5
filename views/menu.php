<html>
	<head>
		<link href="../bootstrap/menu.css" rel="stylesheet">
	</head>

	<div class="col-sm-2">

	<!-- Muestra distintas opciones en el menú lateral en función del grupo de usuarios al que pertenece el usuario -->
	<nav class="navbar navbar-inverse sidebar" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
					<span class="sr-only"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand"><?php echo $strings['menu'] ?></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
				<ul class="nav navbar-nav">

				<!-- Gestión de facturas -->				
				<?php if((isset($_SESSION['permisos']) && in_array('Factura',$_SESSION['permisos'])) || strcmp($_SESSION['grupo'],'Admin')== 0){ ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['facturas']; ?>
					<span class="caret"></span>
					<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-file"></span></a>
					<ul class="dropdown-menu forAnimate" role="menu">
						<li>
						  <a href="../controllers/FACTURA_Controller.php?id=altaFactura">
						   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['titulo crear factura']; ?></a>
						</li>
						<li>
						  <a href="../controllers/FACTURA_Controller.php?id=buscarFactura">
						  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-file"></span><?php echo $strings['titulo gestionar factura']; ?></a>
						</li>
						<li>
						  <a href="../controllers/FACTURA_Controller.php?id=listarFacturas">
						  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-duplicate"></span><?php echo $strings['titulo ver facturas']; ?></a>
						</li>
					</ul>
				</li>	

				<!-- Gestión de caja -->
				<?php }if((isset($_SESSION['permisos']) && in_array('Caja',$_SESSION['permisos'])) || strcmp($_SESSION['grupo'],'Admin')== 0){ ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['caja']; ?>
					<span class="caret"></span>
					<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-euro"></span></a>
					<ul class="dropdown-menu forAnimate" role="menu">
						<li>
						  <a href="../controllers/CAJA_Controller.php?id=altaCaja">
						   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['menu añadir movimiento']; ?></a>
						</li>
						<li>
						  <a href="../controllers/CAJA_Controller.php?id=consultarCaja">
						   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-file"></span><?php echo $strings['gestionar caja']; ?></a>
						</li>
						<li>
						  <a href="../controllers/CAJA_Controller.php?id=verCaja">
						   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-duplicate"></span><?php echo $strings['ver movimientos']; ?></a>
						</li>
					</ul>
				</li>	

				<!-- Menú del Admin: -->
				<?php }if(strcmp($_SESSION['grupo'],'Admin')== 0){ ?>

					<!-- Gestión de usuarios -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarUsuario']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/USUARIO_Controller.php?id=altaUsuario">
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaUsuario']; ?></a>
							</li>
							<li>
							  <a href="../controllers/USUARIO_Controller.php?id=bajaUsuario">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaUsuario']; ?></a>
							</li>
							<li>
							  <a href="../controllers/USUARIO_Controller.php?id=modificarUsuario">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarUsuario']; ?></a>
							</li>
							<li>
							  <a href="../controllers/USUARIO_Controller.php?id=consultarUsuario">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarUsuario']; ?></a>
							</li>
							<li>
							  <a href="../controllers/USUARIO_Controller.php?id=buscarUsuario">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarUsuario']; ?></a>
							</li>
						</ul>
					</li>

					<!-- Gestión de grupos/perfiles -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarGrupos']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-briefcase"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/GRUPO_Controller.php?id=altaGrupo">
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaGrupo']; ?></a>
							</li>
							<li>
							  <a href="../controllers/GRUPO_Controller.php?id=bajaGrupo">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaGrupo']; ?></a>
							</li>
							<li>
							  <a href="../controllers/GRUPO_Controller.php?id=modificarGrupo">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarGrupo']; ?></a>
							</li>
							<li>
							  <a href="../controllers/GRUPO_Controller.php?id=consultarGrupo">
							 <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarGrupo']; ?></a>
							</li>
						</ul>
					</li>

					<!-- Gestión de funcionalidades/controladores -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarControladores']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-list-alt"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=altaControlador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaControlador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=altaAccion">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaAccion']; ?></a>
							</li>
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=bajaControlador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span></span><?php echo $strings['bajaControlador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=modificarControlador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarControlador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=consultarControlador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarControlador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/CONTROLADOR_Controller.php?id=buscarControlador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarFuncionalidad']; ?></a>
							</li>
						</ul>
					</li>

					<!-- Gestión de clientes -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarCliente']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-briefcase"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
								<li>
									<a href="../controllers/CLIENTEEXTERNO_Controller.php?id=altaCliente">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaCliente']; ?></a>
								</li>
								<li>
									<a href="../controllers/CLIENTEEXTERNO_Controller.php?id=bajaCliente">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaCliente']; ?></a>
								</li>
								<li>
									<a href="../controllers/CLIENTEEXTERNO_Controller.php?id=modificarCliente">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarCliente']; ?></a>
								</li>
								<li>
									<a href="../controllers/CLIENTEEXTERNO_Controller.php?id=consultarCliente">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarClientes']; ?></a>
								</li>
								<li>
								  <a href="../controllers/CLIENTEEXTERNO_Controller.php?id=buscarCliente">
								  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarCliente']; ?></a>
								</li>
							</ul>
					</li>

			
					<!-- Gestión de trabajadores -->
					<li class="dropdown">	
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarTrabajadores']; ?> 
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/TRABAJADOR_Controller.php?id=altaTrabajador">
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaTrabajador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/TRABAJADOR_Controller.php?id=bajaTrabajador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaTrabajador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/TRABAJADOR_Controller.php?id=modificarTrabajador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarTrabajador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/TRABAJADOR_Controller.php?id=consultarTrabajador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarTrabajador']; ?></a>
							</li>
							<li>
							  <a href="../controllers/TRABAJADOR_Controller.php?id=buscarTrabajador">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarTrabajador']; ?></a>
							</li>
						</ul>
					</li>

					<!-- Gestión de lesiones -->
					<li class="dropdown">	
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarLesiones']; ?> 
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-heart-empty"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/LESION_Controller.php?id=listarTrabajadores">
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['trabajadores']; ?></a>
							</li>
							<li>
							  <a href="../controllers/LESION_Controller.php?id=listarAlumnos">
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['alumnos']; ?></a>
							</li>

							
							<li>
							  <a href="../controllers/LESION_Controller.php?id=buscarLesion">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarLesion']; ?></a>
							</li>
						</ul>
					</li>

					
			
					<!-- Gestión de servicios -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarServicio']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-briefcase"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
								<li>
									<a href="../controllers/SERVICIO_Controller.php?id=altaServicio">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaServicio']; ?></a>
								</li>
								<li>
									<a href="../controllers/SERVICIO_Controller.php?id=bajaServicio">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaServicio']; ?></a>
								</li>
								<li>
									<a href="../controllers/SERVICIO_Controller.php?id=modificarServicio">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarServicio']; ?></a>
								</li>
								<li>
									<a href="../controllers/SERVICIO_Controller.php?id=consultarServicio">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarServicio']; ?></a>
								</li>
								<li>
								  <a href="../controllers/SERVICIO_Controller.php?id=buscarServicio">
								  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarServicio']; ?></a>
								</li>
							</ul>
					</li>

					<!-- Gestión de eventos -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarEvento']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-briefcase"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
								<li>
									<a href="../controllers/EVENTO_Controller.php?id=altaEvento">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaEvento']; ?></a>
								</li>
								<li>
									<a href="../controllers/EVENTO_Controller.php?id=bajaEvento">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaEvento']; ?></a>
								</li>
								<li>
									<a href="../controllers/EVENTO_Controller.php?id=modificarEvento">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarEvento']; ?></a>
								</li>
								<li>
									<a href="../controllers/EVENTO_Controller.php?id=consultarEvento">
									<span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarEvento']; ?></a>
								</li>
								<li>
								  <a href="../controllers/EVENTO_Controller.php?id=buscarEvento">
								  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarEvento']; ?></a>
								</li>
							</ul>
					</li>

					
					<!-- Gestión de permisos -->
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarPermisos']; ?>
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-lock"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/PERMISO_Controller.php?id=altaPermiso">
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaPermiso']; ?></a>
							</li>
							<li>
							  <a href="../controllers/PERMISO_Controller.php?id=bajaPermiso">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaPermiso']; ?></a>
							</li>
							<li>
							  <a href="../controllers/PERMISO_Controller.php?id=modificarPermiso">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarPermiso']; ?></a>
							</li>
							<li>
							  <a href="../controllers/PERMISO_Controller.php?id=consultarPermiso">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarPermiso']; ?></a>
							</li>
							<li>
							  <a href="../controllers/PERMISO_Controller.php?id=buscarPermiso">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarPermiso']; ?></a>
							</li>
						</ul>
					</li>

					<!--Gestión de reserva de masajes-->
					<li class="dropdown">
					<a href="../masajes/DNI.php" target=_blank ><?php echo $strings['gestion reserva masajes']; ?>
				
					<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-file"></span></a>
					</li>
					
					
					
					<!--Gestión de masajes-->
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestion masajes']; ?>
					<span class="caret"></span>
					<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-heart-empty"></span></a>
					
					<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../masajes/NuevoMasaje.php" target=_blank>
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['alta masaje']; ?></a>
							</li>
							<li>
							  <a href="../masajes/BorrarMasaje.php" target=_blank>
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['baja masaje']; ?></a>
							</li>
							<li>
							  <a href="../masajes/ModificarMasaje.php" target=_blank>
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificar masaje']; ?></a>
							</li>
							<li>
							  <a href="../masajes/ConsultarMasaje.php" target=_blank>
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultar masaje']; ?></a>
							</li>
							<li>
							  <a href="../masajes/ListarMasaje.php" target=_blank>
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['listar masaje']; ?></a>
							</li>
						</ul>
					</li>
			
					<?php } ?>
			 <?php if(strcmp($_SESSION['grupo'],'Admin')== 0 || strcmp($_SESSION['grupo'],'Secretario')==0){ ?>
                    <!-- Gestion de espacios-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarEspacios']; ?>
                            <span class="caret"></span>
                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tasks"></span></a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                            <li>
                                <a href="../controllers/ESPACIO_Controller.php?id=altaEspacio">
                                    <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaEspacio']; ?></a>
                            </li>
                            <li>
                                <a href="../controllers/ESPACIO_Controller.php?id=bajaEspacio">
                                    <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaEspacio']; ?></a>
                            </li>
                            <li>
                                <a href="../controllers/ESPACIO_Controller.php?id=modificarEspacio">
                                    <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarEspacio']; ?></a>
                            </li>
                            <li>
                                <a href="../controllers/ESPACIO_Controller.php?id=consultarEspacio">
                                    <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarEspacios']; ?></a>
                            </li>


                        </ul>
                    </li>

                    <!--Gestión de reservas de espacios-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarReservas']; ?>
                            <span class="caret"></span>
                            <span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tasks"></span></a>
                        <ul class="dropdown-menu forAnimate" role="menu">
                            <li>
                                <a href="../controllers/ESPACIO_Controller.php?id=reservarEspacio">
                                    <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['realizarReserva']; ?></a>
                            </li>
                            <li>
                                <a href="../controllers/ESPACIO_Controller.php?id=bajaReserva">
                                    <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaReserva']; ?></a>
                            </li>
                            <li>
                                <a href="../controllers/ESPACIO_Controller.php?id=consultarReserva">
                                    <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarReserva']; ?></a>
                            </li>
                            <li>
                                <a href="../controllers/ESPACIO_Controller.php?id=modificarReserva">
                                    <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarReserva']; ?></a>
                            </li>
                        </ul>
                            
                             <!--  
                                        
                                              -----------------------------------------------------------------
                                              -----------------------------------------------------------------
                                        
                                                                     MODIFICADO ALUMNOS
                                        
                                              -----------------------------------------------------------------
                                              -----------------------------------------------------------------
                                        
                                        -->


                                <?php } ?>
                                <?php if(strcmp($_SESSION['grupo'],'Admin') == 0 || strcmp($_SESSION['grupo'],'Secretario') == 0 ){ ?>

                                       <!-- Gestión de alumnos -->
					<li class="dropdown">	
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarAlumnos']; ?> 
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-education"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/ALUMNO_Controller.php?id=altaAlumno">
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['altaAlumno']; ?></a>
							</li>
							<li>
							  <a href="../controllers/ALUMNO_Controller.php?id=bajaAlumno">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-remove"></span><?php echo $strings['bajaAlumno']; ?></a>
							</li>
							<li>
							  <a href="../controllers/ALUMNO_Controller.php?id=modificarAlumno">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-pencil"></span><?php echo $strings['modificarAlumno']; ?></a>
							</li>
							<li>
							  <a href="../controllers/ALUMNO_Controller.php?id=consultarAlumno">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-book"></span><?php echo $strings['consultarAlumno']; ?></a>
							</li>
							<li>
							  <a href="../controllers/ALUMNO_Controller.php?id=buscarAlumno">
							  <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-search"></span><?php echo $strings['buscarAlumno']; ?></a>
							</li>
						</ul>
					</li>
                                        <!--  
                                        
                                              -----------------------------------------------------------------
                                              -----------------------------------------------------------------
                                        
                                                                      FIN ALUMNOS
                                        
                                              -----------------------------------------------------------------
                                              -----------------------------------------------------------------
                                        
                                        -->
                                        <!--  
                                        
                                              -----------------------------------------------------------------
                                              -----------------------------------------------------------------
                                        
                                                                MODIFICADO NOTIFICACIONES
                                        
                                              -----------------------------------------------------------------
                                              -----------------------------------------------------------------
                                        
                                        -->
                                        
                                        <li class="dropdown">	
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $strings['gestionarNotificaciones']; ?> 
						<span class="caret"></span>
						<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-envelope"></span></a>
						<ul class="dropdown-menu forAnimate" role="menu">
							<li>
							  <a href="../controllers/NOTIFICACION_Controller.php">
							   <span style="font-size:12px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-plus"></span><?php echo $strings['enviarNotificacion']; ?></a>
							</li>
							<li>
						</ul>
					</li>             
                                        
                                        <!--  
                                        
                                              -----------------------------------------------------------------
                                              -----------------------------------------------------------------
                                        
                                                                    FIN NOTIFICACIONES
                                        
                                              -----------------------------------------------------------------
                                              -----------------------------------------------------------------
                                        
                                        -->
                                        <?php } ?>

			</div>
		</div>
	</nav>
	</div>
</html>
