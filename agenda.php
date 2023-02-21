<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>
    <!--FULL CALENDAR-->
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/es.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <style>
        .fc th {
            padding: 10px 0px;
            vertical-align: middle;
            background: #f2f2f2;
        }
    </style>

</head>

<body>


    <?php
    // Iniciar la sesión
    session_start();

    // Verificar si hay una sesión iniciada
    if (isset($_SESSION["user_id"])) {
        // Obtener el ID del usuario que inició sesión
        $user_id = $_SESSION["user_id"];

        // Conectar a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "php_login_base";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Obtener la información del usuario
        $sql = "SELECT name, email FROM users WHERE id = $user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mostrar la información del usuario
            $row = $result->fetch_assoc();
        } else {
            echo "No se encontró el usuario";
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "Debes iniciar sesión para ver esta página";
    }
    ?>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- icono o nombre -->

            <a class="navbar-brand" href="pagina_administracion.php">
                <i class="bi bi-flower1"></i>
                <span class="text-warning">ValorantStats</span>
            </a>

            <!-- boton del menu -->

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- elementos del menu colapsable -->

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="agenda.html">Calendario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="examen/preguntas_examen.html">Examen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="Estadisticas/Estadisticas.html">Estadisticas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="Contacto/contacto.php">Contacto</a>
                    </li>
                    <li class="nav-item dropdown">
                    <li class="nav-item">
                        <a class="nav-link active" href="../usuario/usuario.php">
                            <?php echo $row['name']; ?>
                        </a>
                    </li>
                    </li>
                </ul>

                <hr class="d-md-none text-white-50">
                <!--boton Informacion -->

                <form class="d-flex">
                    <a class="btn btn-outline-warning d-none d-md-inline-block" href="logout.php">
                        Cerrar Sesion
                    </a>
                </form>
            </div>

        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col-7"><br><br>
                <div id="CalendarioWeb"></div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#CalendarioWeb').fullCalendar({
                header: {
                    left: 'today,prev,next',
                    center: 'title',
                    right: 'month,basicWeek,basicDay,agendaWeek,agendaDay'
                },
                dayClick: function (date, jsEvent, view) {
                    $('#btnAgregar').prop("disabled", false)
                    $('#btnModificar').prop("disabled", true)
                    $('#btnEliminar').prop("disabled", true)


                    limpiarFormulario();
                    $('#txtFecha').val(date.format());
                    $("#ModalEventos").modal();
                },
                events: 'http://localhost/proyecto-main/eventos.php',

                eventClick: function (calEvent, jsEvent, view) {

                    $('#btnAgregar').prop("disabled", true)
                    $('#btnModificar').prop("disabled", false)
                    $('#btnEliminar').prop("disabled", false)

                    //h2
                    $('#tituloEvento').html(calEvent.title);
                    //mostrar la informacion del evento en los input
                    $('#txtDescripcion').val(calEvent.descripcion);
                    $('#txtID').val(calEvent.id);
                    $('#txtTitulo').val(calEvent.title);
                    $('#txtColor').val(calEvent.color);

                    FechaHora = calEvent.start._i.split(" ");
                    $('#txtFecha').val(FechaHora[0]);
                    $('#txtHora').val(FechaHora[1]);

                    $("#ModalEventos").modal();
                },
                editable: true,
                eventDrop: function (calEvent) {
                    $('#txtID').val(calEvent.id);
                    $('#txtTitulo').val(calEvent.title);
                    $('#txtColor').val(calEvent.color);
                    $('#txtDescripcion').val(calEvent.descripcion);

                    var fechaHora = calEvent.start.format().split("T");
                    $('#txtFecha').val(fechaHora[0]);
                    $('#txtHora').val(fechaHora[1]);

                    RecolectarDatosGUI();
                    EnviarInformacion('modificar', NuevoEvento, true)
                }
            });
        });
    </script>




    <!-- Modal(Añadir,modificar,eliminar) -->
    <div class="modal fade" id="ModalEventos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tituloEvento"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!--Utilizamos el hidden para ocultar la id y la fecha-->
                    <input type="hidden" id="txtID" /><br />
                    <input type="hidden" id="txtFecha" name="txtFecha" name="txtID" />

                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label>Titulo:</label>
                            <input type="text" id="txtTitulo" class="form-control" placeholder="Titulo del Evento">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Hora del evento:</label>
                            <div>
                                <input type="text" id="txtHora" value="10:30" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Descripcion</label>
                        <textarea id="txtDescripcion" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Color:</label>
                        <input type="color" value="#ff0000" id="txtColor" class="form-control" style="height:36px" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
                    <button type="button" id="btnModificar" class="btn btn-success">Modificar</button>
                    <button type="button" id="btnEliminar" class="btn btn-danger">Borrar</button>
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var NuevoEvento;

        $('#btnAgregar').click(function () {
            RecolectarDatosGUI();
            EnviarInformacion('agregar', NuevoEvento)
        });

        $('#btnEliminar').click(function () {
            RecolectarDatosGUI();
            EnviarInformacion('eliminar', NuevoEvento)
        });

        $('#btnModificar').click(function () {
            RecolectarDatosGUI();
            EnviarInformacion('modificar', NuevoEvento)
        });

        function RecolectarDatosGUI() {
            NuevoEvento = {
                id: $('#txtID').val(),
                title: $('#txtTitulo').val(),
                start: $('#txtFecha').val() + " " + $('#txtHora').val(),
                color: $('#txtColor').val(),
                descripcion: $('#txtDescripcion').val(),
                textColor: "#FFFFFF",
                end: $('#txtFecha').val() + " " + $('#txtHora').val()
            };
        }

        function EnviarInformacion(accion, objEvento, modal) {
            $.ajax({
                type: 'POST',
                url: 'eventos.php?accion=' + accion,
                data: objEvento,
                success: function (msg) {
                    if (msg) {
                        $('#CalendarioWeb').fullCalendar('refetchEvents');
                        if (!modal) {
                            $("#ModalEventos").modal('toggle');
                        }
                    }
                },
                error: function () {
                    alert("Hay un error ..");
                }
            });
        }

        function limpiarFormulario() {
            $('#txtID').val('');
            $('#txtTitulo').val('');
            $('#txtColor').val('');
            $('#txtDescripcion').val('');
        }
    </script>

    <footer class=" bg-light text-center text-lg-start">
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.87) ; color: white;  ">
            ValorantStats
        </div>
    </footer>
</body>

</html>