<?php
$conn= include_once "conectionDataBase.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "DELETE FROM clases WHERE clase = '$id'";
    echo $query;
    $result = mysqli_query($conn, $query);

    if (!$result) {
      die("Query Failed");
    }

    header("Location: dashboard.php");
}

?>