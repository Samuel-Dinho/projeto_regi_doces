<?php
session_start();
session_destroy(); // Isso vai apagar todas as variáveis de sessão
session_start();
require 'Carrinho.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Carrinho de Compras</title>
</head>
<body>
    <h1>Sistema de Carrinho de Compras</h1>

    <h2>Adicionar Item ao Carrinho</h2>
    <form method="POST">
        <label for="item_id">ID do Item:</label>
        <input type="text" name="item_id" required>
        <input for="" name='quantity' value='11' style:'''></input>
        <input type="submit" name="add" value="Adicionar ao Carrinho">
    </form>

    <hr>

    <?php displayCart(); ?>
</body>
</html>
