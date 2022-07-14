<?php
$conn= include_once "conectionDataBase.php";

$matricula = $_POST['matricula'];
settype($matricula,"integer");
$practica = $_POST['practica'];
$docente = $_POST['docente'];

$salon = $_POST['salon'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$status = 'Solicitud en Proceso';

/*Generamos la solicitud para verificar
$verifica_agenda = "SELECT * FROM ciudadanos";
$verifica_alumno = "SELECT * FROM ciudadanos"; /*tienen limite de practicas por semana?

$agendar = "INSERT INTO solicitudes (fecha,hora,practica,docente,id_salon,id_alumno) VALUES ('$fecha','$hora','$practica','$docente','$salon','$alumno')";
$result = mysqli_query($conn, $agendar);

if($result){
    echo "funciono";
}else{
    echo "error";
}*/

$verifica_alumno = $conn->query("SELECT * FROM alumnos WHERE matricula=".$matricula);
$alumno = $verifica_alumno->fetch_all(MYSQLI_ASSOC);

if (count($alumno) > 0){ //Si el alumno ya existe -> revisamos la agenda    
    /*
    echo "datos: ".$alumno[0]["matricula"];
    echo $alumno[0]["solicitudes"];
    echo $salon;
    echo $hora;
    echo $fecha;*/
    
    $verifica_agenda = $conn->query("SELECT COUNT(*) FROM solicitudes WHERE id_salon='.$salon.' AND fecha='.$fecha.' AND hora='.$hora.';");
    $sol_agendadas = $verifica_agenda->fetch_all(MYSQLI_ASSOC);

    echo "SELECT COUNT(*) FROM solicitudes WHERE id_salon='.$salon.' AND fecha='.$fecha.' AND hora='.$hora.';";
    if (count($sol_agendadas) > 0){ //Verificamos que haya espacio en las camillas
        echo "ya se agendaron:".count($sol_agendadas);
    }else{
        $agregar_solicitud = $conn->prepare("INSERT INTO solicitudes (fecha,hora,practica,docente,id_salon,id_alumno) VALUES (?,?,?,?,?,?);");
        $agregar_solicitud->bind_param("sssssi",$fecha,$hora,$practica,$docente,$salon,$matricula);
        $agregar_solicitud->execute();
        echo "Se agendo";
        //Cambiamos el estatus
        $status = 'Solicitud Aprobada';
    }

}else{ //Si no existe el alumno lo creamos
    echo "mat ".gettype($matricula);
    $agregar_alumno = $conn->prepare("INSERT INTO alumnos (matricula,solicitudes) VALUES (?,1);");
    $agregar_alumno->bind_param("i",$matricula);
    $agregar_alumno->execute();
    echo "Se genero el registro del alumno.";
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
</head>
<body>
    <main class="container">
    <h1 class="visually-hidden">Solicitud generada</h1>

    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold"><?php echo $status;?></h1>
        <i class="bi bi-ticket-detailed"></i>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Tu solicitud se proceso correctamente y validando los campos tu solicitud fue ... Te recomendamos verificar tu solicitud en la agenda del salon correspondiente.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Ver agenda</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Finalizar</button>
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
                echo "<li class='list-group-item'> hora: ".$hora."</li>";
            ?>
        </ul>
    </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
</html>