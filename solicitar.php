<?php
$conn = include_once "conectionDataBase.php";
include('getDay.php');

$matricula = $_POST['matricula'];
settype($matricula,"integer");
$practica = $_POST['practica'];
$docente = $_POST['docente'];
$salon = $_POST['salon'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$hora = substr($hora,0,2).':00';

$status = 'Solicitud en Proceso';
$message = '...';
$color = '';

$hoy=date('Y-m-d');
$dia = get_dia($fecha);
if($hoy > $fecha || $dia=='Dom'){ //Si ya paso la fecha  no se agenda
    header("location:index.php?status='Error en la fecha'&".$fecha."&".$dia);
}else{ //Si la fecha es futura

    //Verificación de que no haya una clase
    $verifica_clase = $conn->query("SELECT * FROM clases WHERE id_salon='$salon' AND dias LIKE '%$dia%' AND (hora_inicio<='$hora' AND '$hora'<hora_fin );"); //Query para ver clases en el salon,dia,hora especificos
    $clase_dia = $verifica_clase->fetch_all(MYSQLI_ASSOC);
    
    if(sizeof($clase_dia)){
        $color = 'text-danger';
        $status = 'Solicitud Denegada-Clase impartiéndose';
        $message = 'No se pudo agendar la solicitud porque el salon '.$salon.' <u>se encuentra ocupado con la clase '.$clase_dia[0]["clase"].'</u> para el día '.$fecha.' y la hora '.$hora;
    }else{ //Si no hay clase puede continuar el proceso de solicitud

        $verifica_alumno = $conn->query("SELECT * FROM alumnos WHERE matricula=".$matricula);
        $alumno = $verifica_alumno->fetch_all(MYSQLI_ASSOC);

        if (count($alumno) > 0){ //Si el alumno ya existe -> revisamos la agenda    
            $verifica_agenda = $conn->query("SELECT * FROM solicitudes WHERE id_salon='$salon' AND fecha='$fecha' AND hora='$hora';"); //Query para ver agenda
            $sol_agendadas = $verifica_agenda->fetch_all(MYSQLI_ASSOC);

            $espacios_salon = $conn->query("SELECT * FROM salones"); //Query consultar lugares de salon
            $espacios = $espacios_salon->fetch_all(MYSQLI_ASSOC);
            foreach ($espacios as $espacio){
                if($espacio["nombre_salon"] == $salon){
                    $lugares = $espacio["lugares"];
                    break;
                }
            }
            if (count($sol_agendadas) < $lugares){ //Si hay lugar disponible

                $agregar_solicitud = $conn->prepare("INSERT INTO solicitudes (fecha,hora,practica,docente,id_salon,id_alumno) VALUES (?,?,?,?,?,?);");
                $agregar_solicitud->bind_param("sssssi",$fecha,$hora,$practica,$docente,$salon,$matricula);
                $agregar_solicitud->execute();


                //Cambiamos el estatus
                $color = 'text-success';
                $status = 'Solicitud Aprobada';
                $message = 'Solicitud procesada correctamente se agendo la solicitud en el salon '.$salon.' para el día '.$fecha.' y la hora '.$hora.'hrs <br> Para poder asistir deberas presentar tu identificación con matricula.';

            }else{ //Si ya no hay lugar disponible
                //echo "Ya no hay espacios";
                $color = 'text-warning';
                $status = 'Solicitud Denegada';
                $message = 'No se pudo agendar la solicitud porque el salon '.$salon.' <u>se encuentra totalmente ocupado</u> para el día '.$fecha.' y la hora '.$hora;
            }

        }else{ //Si no existe el alumno lo creamos
            //echo "mat ".gettype($matricula);
            $agregar_alumno = $conn->prepare("INSERT INTO alumnos (matricula,solicitudes) VALUES (?,1);");
            $agregar_alumno->bind_param("i",$matricula);
            $agregar_alumno->execute();

            //agendar($salon,$fecha,$hora,$practica,$docente,$matricula);
            $verifica_agenda = $conn->query("SELECT * FROM solicitudes WHERE id_salon='$salon' AND fecha='$fecha' AND hora='$hora';"); //Query para ver agenda
            $sol_agendadas = $verifica_agenda->fetch_all(MYSQLI_ASSOC);
            //echo "SELECT * FROM solicitudes WHERE id_salon='$salon' AND fecha='$fecha' AND hora='$hora';";

            $espacios_salon = $conn->query("SELECT * FROM salones"); //Query consultar lugares de salon
            $espacios = $espacios_salon->fetch_all(MYSQLI_ASSOC);
            foreach ($espacios as $espacio){
                if($espacio["nombre_salon"] == $salon){
                    $lugares = $espacio["lugares"];
                    break;
                }
            }
            
            if (count($sol_agendadas) < $lugares){ //Si hay lugar disponible

                $agregar_solicitud = $conn->prepare("INSERT INTO solicitudes (fecha,hora,practica,docente,id_salon,id_alumno) VALUES (?,?,?,?,?,?);");
                $agregar_solicitud->bind_param("sssssi",$fecha,$hora,$practica,$docente,$salon,$matricula);
                $agregar_solicitud->execute();
                //Cambiamos el estatus
                $color = 'text-success';
                $status = 'Solicitud Aprobada';
                $message = 'Solicitud procesada correctamente se agendo la solicitud en el salon '.$salon.' para el día '.$fecha.' y la hora '.$hora.'hrs <br> Para poder asistir deberas presentar tu identificación con matricula.';

            }else{ //Si ya no hay lugar disponible
                //echo "Ya no hay espacios";
                $color = 'text-warning';
                $status = 'Solicitud Denegada';
                $message = 'No se pudo agendar la solicitud porque el salon '.$salon.' <u>se encuentra totalmente ocupado</u> para el día '.$fecha.' y la hora '.$hora;
            }
        }
    }
    
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="shortcut icon" type="image/png" href="assets/fav.png">
</head>
<body>
    <?php echo $dia;?>
    <main class="container">
    <h1 class="visually-hidden">Solicitud generada</h1>

    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold <?php echo $color; ?>"><?php echo $status;?></h1>
        <i class="bi bi-ticket-detailed"></i>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4"><?php echo $message; ?> <br> Te recomendamos verificar la agenda del salon correspondiente para ver las solicitudes agendadas.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="verAgenda.php?<?php echo 'salon='.$salon.'&fecha='.$fecha.'&hora='.$hora?>" class="btn btn-primary my-2">Ver agenda</a>
                <a href="index.php" class="btn btn-secondary my-2">Regresar</a>
            </div>
        </div>
    </div>
    <div class="px-4 py-5 my-5 text-center">
        <ul class="list-group list-group-flush">
            <?php
                echo "<li class='list-group-item'> Matricula: ".$matricula."</li>";
                echo "<li class='list-group-item'> Practica a realizar: ".$practica."</li>";
                echo "<li class='list-group-item'> Docente/Supervisor: ".$docente."</li>";
                echo "<li class='list-group-item'> Salón: ".$salon."</li>";
                echo "<li class='list-group-item'> fecha: ".$fecha."</li>";
                echo "<li class='list-group-item'> hora: ".$hora."hrs</li>";
            ?>
        </ul>
    </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
</html>