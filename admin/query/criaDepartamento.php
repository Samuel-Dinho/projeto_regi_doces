<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Processar dados do formulário
    $departamento = !empty($_POST['novo-depat']) ? $_POST['novo-depat'] : "";

    // Preparar a consulta SQL
    $stmt = $conn->prepare("INSERT INTO projeto_individual.departamento (departamento) VALUE (?)");
    
    // Verificar se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Vincular parâmetros
        $stmt->bind_param("s", $departamento); // "ssis" indica os tipos: string, string, int, string

        // Executar a consulta
        if ($stmt->execute()) {
            header('Location: ../admin.php');
            exit; // Certifique-se de sair após o redirecionamento
        } else {
            echo "Erro ao inserir o produto: " . $stmt->error;
        }

        // Fechar a declaração
        $stmt->close();
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}

// Fechar conexão
$conn->close();
?>
