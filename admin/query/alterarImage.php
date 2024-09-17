<?php

require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

$caminhoBase = $_SERVER['DOCUMENT_ROOT'] . "/imagens" . "/";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $oldName = $_POST['oldName'];
    $newName = $_POST['nameImage'];
    $extensao = $_POST['extensao'];

    rename("$caminhoBase$oldName.$extensao","$caminhoBase$newName.$extensao");

    header('Location: ../admin.php');

}


?>