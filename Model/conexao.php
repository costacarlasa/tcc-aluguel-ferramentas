<?php
// Arquivo: /Model/conexao.php

$host = 'localhost';
$db_name = 'aluguel_ferramentas';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}
?>