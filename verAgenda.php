<?php
$conn= include_once "conectionDataBase.php";

function saber_dia($nombredia) {
    /**
     * $nombredía : fecha formato date
     * Nos regresa el día de la semana en string de acuerdo al array
     */
    $dias = array('Dom','Lun','Mar','Mie','Jue','Vie','Sab');
    $fecha = $dias[date('N', strtotime($nombredia))];
    return $fecha;
}

$salon = $_GET['salon'];
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];
$hora = substr($hora,0,2).':00';

$dia = saber_dia($fecha);

//Verificación de que no haya una clase
$verifica_clase = $conn->query("SELECT * FROM clases WHERE id_salon='$salon' AND dias LIKE '%$dia%' AND (hora_inicio<='$hora' AND '$hora'<hora_fin );"); //Query para ver clases en el salon,dia,hora especificos
$clase_dia = $verifica_clase->fetch_all(MYSQLI_ASSOC);
//echo "SELECT * FROM clases WHERE id_salon='$salon' AND dias LIKE '%dia%' AND (hora_inicio<='$hora' AND '$hora'<=hora_fin );";
if(sizeof($clase_dia)){
    //Si existe una clase a esa hora no hay lugares disponibles
    $disponibles = '0. Se imparte la clase: '.$clase_dia[0]["clase"];
    
}else{
    $verifica_agenda = $conn->query("SELECT * FROM solicitudes WHERE id_salon='$salon' AND fecha='$fecha' AND hora='$hora';"); //Query para ver agenda
    $sol_agendadas = $verifica_agenda->fetch_all(MYSQLI_ASSOC);
    
    $espacios_salon = $conn->query("SELECT * FROM salones"); //Query consultar lugares de salon
        $espacios = $espacios_salon->fetch_all(MYSQLI_ASSOC);
        foreach ($espacios as $espacio){
            if($espacio["nombre_salon"] == $salon){
                //echo $espacio["nombre_salon"];
                $lugares = $espacio["lugares"];
                //echo $lugares;
                break;
            }
        }
    
    $i=1;
    
    $disponibles = $lugares - sizeof($sol_agendadas);
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salon <?php echo $salon; ?></title>
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
        <h2 class="fw-light">Salon: <?php echo $salon; ?></h2>
        <h3>Detalles: <?php echo $dia.' '.$fecha.' -> '.$hora; ?></h3>
        <?php echo 'Total de espacios en el salon: '.$lugares; ?>
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
                echo '<tr>';
                if($disponibles == 0){
                    echo '<td class="text-warning"><h5>Espacios disponibles: '.$disponibles.'</h5></td>';
                }else{
                    echo '<td class="text-success"><h5>Espacios disponibles: '.$disponibles.'</h5></td>';
                }
                echo '</tr>';
                ?>
            </tbody>
        </table>

        <?php
            if($disponibles != 0){
        ?>
        <div class="col-lg-6 col-md-8 mx-auto">
            <p>
                <a href="index.php" class="btn btn-primary my-2">Solicita Ahora</a>
            </p>
        </div>
        <?php
            }
        ?>
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
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
</html>