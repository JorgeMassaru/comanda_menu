<?php

$usuario = 'root';
$senha = '';
$database = 'login';
$host = 'localhost';

$mysqli = new mysqli($usuario, $senha, $database, $host);

if($mysqli->error){
    echo("falha ao conectar com o banco de dados" . $mysqli->error);
}
?>