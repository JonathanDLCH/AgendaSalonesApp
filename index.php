<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salones Practicas</title>
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
                        <a class="nav-link active" aria-current="page" href="index.php">Solicitar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="salones.html">Salones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="QyA.html">Q&A</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container">
        <div class="mt-5 bg-light p-5 rounded">
            <section id="forms">
                <h2 class="fw-bold pt-3 pt-xl-5 pb-2 pb-xl-3">Bienvenid@!</h2>

                <article class="my-3" id="overview">
                    <div class="bd-heading sticky-xl-top align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                        <h3>Solicita tu espacio para realizar practica</h3>
                        <a class="d-flex align-items-center" href="https://docs.google.com/document/d/1i_97b3GLz3kD7sqYQA_qV6IWHkDeg_1Q7wNn3W32abk/edit?usp=sharing" target="_blank">+INFO(Manual)</a>
                    </div>

                    <div>
                        <div class="bd-example-snippet bd-code-snippet">
                            <div class="bd-example">
                                <form action="solicitar.php" method="POST">
                                    <div class="mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control" id="floatingInput"
                                                placeholder="matricula" name="matricula" min="1" required>
                                            <label for="floatingInput">Matricula</label>
                                        </div>
                                        <div id="emailHelp" class="form-text">En caso de no ingresar la matricula no se realizara la solicitud.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="practica" name="practica">
                                            <label for="floatingInput">Practica a realizar</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="floatingInput"
                                                placeholder="docente" name="docente" required>
                                            <label for="floatingInput">Docente supervisor</label>
                                        </div>
                                    </div>

                                    <hr class="border-primary border-3 opacity-75">
                                    <div class="bd-heading sticky-xl-top align-self-start mt-5 mb-3 mt-xl-0 mb-xl-2">
                                        <h4>Indica tu espacio</h4>
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
                                            <?php
                                                if(isset($_GET['status'])){
                                            ?>
                                                    <label for="exampleInputEmail1" class="form-label">Fecha</label>
                                                    <input type="date" name="fecha" class="form-control is-invalid" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                                    <div class="invalid-feedback">
                                                        Porfavor selecciona una fecha valida.
                                                    </div>
                                            <?php
                                                }else{
                                            ?>
                                                    <label for="exampleInputEmail1" class="form-label">Fecha</label>
                                                    <input type="date" name="fecha" class="form-control" id="exampleInputEmail1"
                                                        aria-describedby="emailHelp" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                            <?php
                                                }
                                            ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Hora</label>
                                        <input type="time" name="hora" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Solicitar</button>
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