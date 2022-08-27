<?php
$conn= include_once "conectionDataBase.php";

if (isset($_GET["id"])) {
    $id = $_GET['id'];
    $clase = $_GET['clase'];
    $salon = $_GET['salon'];
    $hora_inicio = $_GET['hora_inicio'];
    $hora_inicio = substr($hora_inicio,0,2).':00';
    $hora_fin = $_GET['hora_fin'];
    $hora_fin = substr($hora_fin,0,2).':00';
    $dias = '';
    if(!empty($_GET['dias'])){
        foreach($_GET['dias'] as $selected){
            $dias .= $selected.',';
        }
    }

    $query = "UPDATE clases SET clase='$clase', id_salon='$salon', hora_inicio='$hora_inicio', hora_fin='$hora_fin', dias='$dias' WHERE clase='$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        echo $query;
      die("Query Failed");
    }

    header("Location: dashboard.php");
}

?>