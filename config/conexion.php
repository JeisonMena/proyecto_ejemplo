<?php

$host = "localhost";
$usuario = "root";
$contrasena = "";
$baseDeDatos = "examen3";



$conn = mysqli_connect($host, $usuario, $contrasena, $baseDeDatos);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
