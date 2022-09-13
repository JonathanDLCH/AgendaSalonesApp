<?php
$conn= include_once "conectionDataBase.php";

$clase = $_POST['clase'];
$salon = $_POST['salon'];
$hora_inicio = $_POST['hora_inicio'];
$hora_inicio = substr($hora_inicio,0,2).':00';
$hora_fin = $_POST['hora_fin'];
$hora_fin = substr($hora_fin,0,2).':00';
$dias = '';
if(!empty($_POST['dias'])){
    foreach($_POST['dias'] as $selected){
        //echo $selected."</br>";// Imprime resultados
        $dias .= $selected.',';
    }
    $agregar_clase = $conn->prepare("INSERT INTO clases (clase,id_salon,hora_inicio,hora_fin,dias) VALUES (?,?,?,?,?);");
    $agregar_clase->bind_param("sssss",$clase,$salon,$hora_inicio,$hora_fin,$dias);
    $agregar_clase->execute();
    $status = 'done';
}else{
    $status = 'missing';
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
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salones.html">Cancelación</a>
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
                        <h3>Agregar Clase</h3>
                        <?php
                            if(isset($clase)){
                                if($status=='done'){
                                    echo '<div class="alert alert-success" role="alert">Se registro de forma exitosa!</div>';
                                }
                                if($status=='missing'){
                                    echo '<div class="alert alert-warning" role="alert">Faltan valores!</div>';
                                }
                            }
                        ?>
                    </div>

                    <div>
                        <div class="bd-example-snippet bd-code-snippet">
                            <div class="bd-example">
                                <form action="addClass.php" method="POST">
                                    <div class="mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="clase" name="clase" required>
                                            <label for="floatingInput">Clase</label>
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
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Hora inicio</label>
                                        <input type="time" name="hora_inicio" class="form-control"
                                            aria-describedby="emailHelp" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Hora fin</label>
                                        <input type="time" name="hora_fin" class="form-control"
                                            aria-describedby="emailHelp" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="dias[]" value="Lun">
                                            <label class="form-check-label" for="inlineCheckbox1">Lun</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="dias[]" value="Mar">
                                            <label class="form-check-label" for="inlineCheckbox2">Mar</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="dias[]" value="Mie">
                                            <label class="form-check-label" for="inlineCheckbox2">Mie</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="dias[]" value="Jue">
                                            <label class="form-check-label" for="inlineCheckbox2">Jue</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="dias[]" value="Vie">
                                            <label class="form-check-label" for="inlineCheckbox2">Vie</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="dias[]" value="Sab">
                                            <label class="form-check-label" for="inlineCheckbox2">Sab</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="docente" name="docente" required>
                                            <label for="floatingInput">Docente</label>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </article>
            </section>
        </div>
    </main>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>

</html>