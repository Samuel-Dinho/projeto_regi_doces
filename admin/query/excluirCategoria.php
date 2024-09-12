<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Processar dados do formulário
    $categoria = !empty($_POST['idCategoria']) ? $_POST['idCategoria'] : "";

    // Preparar a consulta SQL
    $stmt = $conn->prepare("delete from projeto_final.categoria where idcategoria = ?");
    // Verificar se a preparação da consulta foi bem-sucedida
    if ($stmt) {
        // Vincular parâmetros
        $stmt->bind_param("i", $categoria); // "ssis" indica os tipos: string, string, int, string

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
