<?php

//Si no hay una sesión iniciada, la inicia.
if(!isset($_SESSION)){
    session_start();
}
//Comprueba si el usuario inició sesión y si es admin antes de cargar la página.
if(isset($_SESSION['grupo']) && strcmp($_SESSION['grupo'],"Admin") == 0 || strcmp($_SESSION['grupo'],'Secretario')==0 ){

//Crea la clase e instancia la función render en el constructor.
    class Reserva_crear{

        function __construct(){
            $this->render();
        }

        function render(){
            include_once('../header.php');
            $dia= date("d");
            $mes= date("m");
            $ano =date("Y");
            $completo= "$ano-$mes-$dia";
            ?>
            <!-- Título de la página -->
            <title><?php echo $strings['titulo editar espacio']; ?></title>

            <script>
                function fecha() {
                    var fechaIni =document.getElementById("Hora_Inicio").value;
                    var fechaFin = document.getElementById("Hora_Fin").value;
                    if(fechaFin <= fechaIni){
                        return true;
                    }
                    return false;
                }
            </script>


            <body>
            <div class="row-fluid">
                <!-- Include del menú -->
                <?php include_once('menu.php'); ?>
                <div class="col-sm-10 text-left">
                    <div class="section-fluid">
                        <div class="container-fluid">

                            <!-- Formulario para añadir una reserva -->

                            <form class="form-horizontal" role="form" method="POST" name="formulario" action="../controllers/ESPACIO_Controller.php?id=reservarEspacio" ">
                                <div class="form-group">
                                    <div class="col-md-12"> <h2 class="text-info "><?php echo $strings['realizar reserva']; ?></h2></div>
                                    <div class="col-md-12"><hr></div>

                                    <!-- datos de la reserva-->

                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="Telefono" class="control-label"><?php echo $strings['Telefono']; ?>:</label>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="tel" pattern="[0-9]{9}"  class="form-control" id="Telefono" name="Telefono" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <label for="nombre" class="control-label"><?php echo $strings['espacio']; ?>:</label>
                                        </div><div class="col-sm-4">
                                            <select  name="espacio" required>
                                                <?php listarEspacios(); ?>
                                            </select>
                                        </div></div>
                                </div>



                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="Hora_Inicio" class="control-label"><?php echo $strings['Hora_Inicio']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="time"  class="form-control" id="Hora_Inicio" name="Hora_Inicio" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="Hora_Fin" class="control-label"><?php echo $strings['Hora_Fin']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="time" step="60" min="7:00" max="23:00" onblur="if(fecha()==true){this.value=''}" class="form-control" id="Hora_Fin"  name="Hora_Fin" title="<?php echo $strings['error espacio'];  ?>" required>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="Fecha" class="control-label"><?php echo $strings['Fecha']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="date" class="form-control" min="<?php echo date("Y-m-d");?>" step="1" value="<?php echo date("Y-m-d");?>" id="Fecha" name="Fecha" title="<?php echo $strings['error espacio']; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="Descripcion" class="control-label"><?php echo $strings['Descripcion']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="texa" class="form-control" id="Descripcion" name="Descripcion" title="<?php echo $strings['error espacio']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        <label for="DNI_Reserva" class="control-label"><?php echo $strings['DNI_Reserva']; ?>:</label>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control"  pid="DNI_Reserva" name="DNI_Reserva" title="<?php echo $strings['error espacio']; ?>" required pattern="(([X-Z]{1})([-]?)(\d{7})([-]?)([A-Z]{1}))|((\d{8})([-]?)([A-Z]{1}))">
                                    </div>
                                </div>

                                <!-- Submit  con validacion de horas-->
                                <div class="form-group">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        <input class="btn btn-primary" value="<?php echo $strings['modificar']; ?>" type="submit">
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