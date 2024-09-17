<?php
session_start();

require '../class/Carrinho.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
 
</head>
<body>
    <div class="cart-container">
        <h1>Meu Carrinho</h1>
        <?php

?>

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço(un)</th>
                    <th>Quantidade</th>
                    <th>Total</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
            <?php displayCarte(); ?>
                
            
            </tbody>
        </table>

        
    </div>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.cart-container {
    width: 80%;
    margin: 50px auto;
    background-color: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
}

.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.cart-table th, .cart-table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.product-info {
    display: flex;
    align-items: center;
}

.product-info img {
    width: 100px;
    margin-right: 10px;
}

input[type="number"] {
    width: 50px;
    padding: 5px;
    text-align: center;
}

.remove-btn {
    background-color: #ff4d4d;
    color: white;
    padding: 8px 12px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

.remove-btn:hover {
    background-color: #e60000;
}

.cart-summary {
    text-align: right;
}

.cart-summary h3 {
    margin-top: 0;
}

.cart-summary h2 {
    margin-top: 20px;
    font-size: 24px;
}

.checkout-btn {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

.checkout-btn:hover {
    background-color: #45a049;
}

</style>