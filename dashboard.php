<?php
$conn= include_once "conectionDataBase.php";

$clases_query = $conn->query("SELECT * FROM clases ;");
$clases = $clases_query->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salones Practicas | Dashboard</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="assets/fav.png">
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
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cancelacion.php">Cancelación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="QyA.html">Indicaciónes</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container-lg">
        <div class="mt-5 bg-light p-5 rounded">
            <section class="mt-5 py-5 text-center container">
                <h2 class="fw-bold pt-3 pt-xl-5 pb-2 pb-xl-3">Bienvenid@ administrador!</h2>
                <table class="mt-5 table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">Clase</th>
                        <th scope="col">Salon</th>
                        <th scope="col">Días</th>
                        <th scope="col">Hora inicio</th>
                        <th scope="col">Hora fin</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(sizeof($clases) !=0 ){
                            foreach ($clases as $clase){
                                echo '<tr>';
                                echo '<th scope="row">'.$clase["clase"].'</th>';
                                echo '<td>'.$clase["id_salon"].'</td>';
                                echo '<td>'.$clase["dias"].'</td>';
                                echo '<td>'.$clase["hora_inicio"].'</td>';
                                echo '<td>'.$clase["hora_fin"].'</td>';
                                echo '<td> <a href="editClass.php?id='.$clase["clase"].'" class="btn btn-primary my-2">Editar</a> </td>';
                                echo '<td> <a href="deleteClass.php?id='.$clase["clase"].'" class="btn btn-danger my-2">Eliminar</a> </td>';
                                echo '</tr>';
                            }
                        }
                        echo '<td><a href="addClass.php" class="btn btn-success my-2">Agregar clase</a></td>';
                        ?>
                    </tbody>
                </table>                    
            </section>
        </div>
    </main>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>

</html>