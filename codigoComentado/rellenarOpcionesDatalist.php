<?php
header('Content-Type: application/json');
include("connection.php");
$tabla = $_POST["tabla"];
$columnaId = $_POST["columnaId"];
$columnaLista = $_POST["columnaLista"];
$sql = "SELECT ". $columnaId ." , ". $columnaLista . " FROM " . $tabla;
$$query = $connection->query($sql);
$data = $$query->fetch_all(MYSQLI_ASSOC);
echo json_encode($data);
$connection->close();
?>