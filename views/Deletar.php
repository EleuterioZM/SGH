<?php
include "Dados/conexao/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $userId = $_GET["id"];

    $sql = "DELETE FROM `pacientes` WHERE id = $userId";

    if (mysqli_query($conn, $sql)) {
        header("Location: Pesquisar.php"); // Redireciona para a página de pesquisa após a exclusão
        exit;
    } else {
        echo "Erro ao deletar usuário: " . mysqli_error($conn);
    }
} else {
    echo "ID de usuário não fornecido.";
    exit;
}

mysqli_close($conn);
