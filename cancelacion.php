<?php
$conn= include_once "conectionDataBase.php";

if(isset($_POST['matricula'])){
    $matricula = $_POST['matricula'];
    $salon = $_POST['salon'];

        $sol_matricula = $conn->query("SELECT * FROM solicitudes WHERE id_alumno='$matricula' AND id_salon='$salon';"); //Query para ver clases en el salon,dia,hora especificos

}

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
                        <a class="nav-link" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="cancelacion.php">Cancelación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="QyA.html">Indicaciónes</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container">
        <div class="mt-5 bg-light p-5 rounded">
            <section id="forms">
                <article class="my-3" id="overview">
                    <div class="bd-heading sticky-xl-top align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                        <h3>Cancelar espacio Agendado</h3>
                        <?php
                            if(isset($clase)){
                                if($status=='missing'){
                                    echo '<div class="alert alert-warning" role="alert">No hay registros con esa matricula</div>';
                                }
                            }
                        ?>
                    </div>

                    <div>
                        <div class="bd-example-snippet bd-code-snippet">
                            <div class="bd-example">
                                <form action="cancelacion.php" method="POST">
                                    <div class="mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="matricula" name="matricula" min="1" required>
                                            <label for="floatingInput">Matricula</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select form-select mb-3" aria-label=".form-select example" name="salon" required>
                                            <option selected>Selecciona el salon</option>
                                            <option value="Shiatsu">Shiatsu</option>
                                            <option value="Holistico">Holistico</option>
                                            <option value="LomiLomi">LomiLomi</option>
                                            <option value="Body Paint">Body Paint</option>
                                            <option value="Colorimetria">Colorimetria</option>
                                            <option value="Balayage">Balayage</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>

                <table class="mt-5 table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">id</th>
                        <th scope="col">Salon</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Practica</th>
                        <th></th>
                        <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        foreach ($sol_agendadas as $solicitud){
                            echo '<tr>';
                            echo '<th scope="row">'.$i.'</th>';
                            echo '<td>'.$solicitud["id_alumno"].'</td>';
                            echo '<td>'.$solicitud["practica"].'</td>';
                            echo '<td>'.$solicitud["docente"].'</td>';
                            echo '</tr>';
                            $i=$i+1;
                        }
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