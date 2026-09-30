<?php
header('Content-Type: application/json');
// Pegá acá la URL de la API que descubriste en el paso anterior
$apiUrl = "https://mattprofe.com.ar/proyectos/app-estacion/datos.php?mode=list-stations"; 
echo file_get_contents($apiUrl);
?>