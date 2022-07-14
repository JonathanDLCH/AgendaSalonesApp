<?php
include('conectionDataBase.php');

$nombre = $_POST['nombre'];
$practica = $_POST['practica'];
$docente = $_POST['docente'];

$salon = $_POST['salon'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];

$status = 'Solicitud Aprobada';

/*Generamos la solicitud para verificar*/
$verifica_agenda = "SELECT * FROM ciudadanos";
$verifica_alumno = "SELECT * FROM ciudadanos"; /*tienen limite de practicas por semana?*/

$agendar = "INSERT INTO solicitudes (fecha,hora,practica,docente,id_salon,id_alumno) VALUES ('$fecha','$hora','$practica','$docente','$salon','$alumno')";
$result = mysqli_query($conn, $agendar);

if($result){
    echo "funciono";
}else{
    echo "error";
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
        <?php
            echo $nombre."<br>";
            echo $practica."<br>";
            echo $docente."<br>";
            echo $salon."<br>";
            echo $fecha."<br>";
            echo $hora."<br>";
        ?>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
</html>