<?php
function conectar_banco() {
    $host = "localhost";       // Endereço do servidor MySQL
    $dbname = "nome_do_banco"; // Nome do banco de dados
    $user = "seu_usuario";     // Seu usuário do MySQL
    $password = "sua_senha";   // Sua senha do MySQL
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        // Definir o modo de erro do PDO para exceções
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
        return null;
    }
}
?>
