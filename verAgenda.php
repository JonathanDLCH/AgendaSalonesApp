<?php
$conn= include_once "conectionDataBase.php";

$salon = $_POST['salon'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$hora = substr($hora,0,2).':00';

    $verifica_agenda = $conn->query("SELECT * FROM solicitudes WHERE id_salon='$salon' AND fecha='$fecha' AND hora='$hora';"); //Query para ver agenda
    $sol_agendadas = $verifica_agenda->fetch_all(MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon <?php echo $salon ?></title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-warning" href="#">UMesoamericana</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Solicitar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="salones.html">Salones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="QyA.html">Q&A</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
    <section class="mt-5 py-5 text-center container">
        <h2 class="fw-light">Salon: <?php echo $salon?></h2>
        <h3>Detalles: <?php echo $fecha.' -> '.$hora ?></h3>
        <table class="mt-5 table table-hover">
            <thead>
                <tr>
                <th scope="col">#Cam</th>
                <th scope="col">alumna</th>
                <th scope="col">Practica</th>
                <th scope="col">Supervisor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </section>
    </main>

    <footer class="text-muted py-5">
        <div class="container">
            <p class="mb-1">Develop for &copy; Sistemas-Universidad Mesoamericana, si existe algun problema porfavor
                escribenos: <a href="mailto:sistemas@umesoamericana.edu.mx">sistemas@umesoamericana.edu.mx</a></p>
            <p class="mb-0">Descubre mas en nuestra <a href="/">pagina principal</a>.</p>
        </div>
    </footer>

</body>
</html>