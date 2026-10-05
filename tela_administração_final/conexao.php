<?php

/* REALIZA A CONEXAO COM O BANCO DE DADOS */

$usuario = 'root';
$senha = '';
$database = 'comanda';
$host = 'localhost';

$conn = mysqli_connect($host, $usuario, $senha, $database);

if($conn->error) {
    die("Falha ao conectar ao banco de dados: " . $conn->error);
}

?>