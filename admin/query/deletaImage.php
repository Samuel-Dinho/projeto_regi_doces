<?php

//require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

$caminhoBase = $_SERVER['DOCUMENT_ROOT'] . "/imagens" . "/";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fileToDelete = $_POST['NomeImage'];
    $filePath = $caminhoBase . $fileToDelete;

    echo $filePath;
if (file_exists($filePath)) {
    // Deleta o arquivo
    if (unlink($filePath)) {
        echo "Arquivo deletado com sucesso.";
        header('Location: ../admin.php');
    } else {
        echo "Erro ao tentar deletar o arquivo.";
    }
} else {
    echo "Arquivo não encontrado.";

}}
?>