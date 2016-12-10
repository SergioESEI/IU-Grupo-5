<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 || strcmp($_SESSION['grupo'],'Secretario')==0){

//Crea la clase e instancia la función render en el constructor.
    class Reserva_Listar{

        function __construct(){
            $this->render();
        }

        function render(){
            include_once('../header.php');
            ?>
            <!-- Titulo de la página -->
            <title><?php echo $strings['titulo listar reserva']; ?></title>

            <body>
            <div class="row-fluid">
                <!-- Include del menú -->
                <?php include_once('menu.php'); ?>
                <div class="col-sm-10 text-left">
                    <div class="section-fluid">
                        <div class="container-fluid">

                            <!-- Lista los grupos -->
                            <div class="form-group">
                                <div class="col-md-12"> <h2 class="text-info "><?php echo $strings['ver reserva']; ?></h2></div>
                                <div class="col-md-12"><hr></div>
                                <table class="table table-striped">
                                    <thead><tr>
                                        <th><?php echo $strings['Telefono']; ?></th>
                                        <th><?php echo $strings['Id_Reserva']; ?></th>
                                        <th><?php echo $strings['Id_Espacio']; ?></th>
                                        <th><?php echo $strings['Hora_Inicio']; ?></th>
                                        <th><?php echo $strings['Hora_Fin']; ?></th>
                                        <th><?php echo $strings['Fecha']; ?></th>
                                        <th><?php echo $strings['Descripcion']; ?></th>
                                        <th><?php echo $strings['DNI_Reserva']; ?></th>
                                    </thead><tbody>
                                    <?php verReservas(); ?>
                                    </tbody>
                                </table>
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