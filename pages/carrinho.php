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
    <link rel="stylesheet" href="../style/style.css">
 
</head>
<body>
    <header>
            <nav class="menu">
                <button class="menu-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="produto.php">Produto</a></li>
                    <li><a href="sobre.php">Sobre</a></li>
                    <li><a href="">Carrinho</a></li>
                    <li><a href="#">Conta</a></li>
                </ul>

            </nav>
            <h1 class="name">Delicias da Regi</h1>
    </header>
    <h1>Meu Carrinho</h1>
    <div class="cart-container">
        
        <?php

?>  
        <div class='div-table'>
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
        <?php displayTotal(); ?>
    </div>
    <script src="../script/scripts.js"></script>
</body>
</html>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}
/*
.cart-container {
    width: 80%;
    margin: 50px auto;
    background-color: white;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
    */
.cart-container{
    display: flex;
    align-content: flex-start;
    justify-content: center;
}

h1 {
    text-align: center;
    margin: 10px;
}
.div-table{
    max-height: 400px;
    overflow: auto;
}
.cart-table {
    margin: 0 auto 10px ;
    border-collapse: collapse;
    
    overflow: scroll;
    max-height: 300px;
    
}

.cart-table th, .cart-table td {
    border: none;
    text-align: left;
    
}
.formatInput{
    display: flex;
    align-items: center;
}
.adicionarRemover {
    border: none;
    margin: 10px auto;
    padding: 10px;
    box-shadow:none;
    background-color: none;
    
}

.product-info {
    display: flex;
    align-items: center;
}

.product-info img {
    width: 100px;
    margin-right: 10px;
    max-height: 80px;
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
    border-radius: 20px;

}

.remove-btn:hover {
    background-color: #e60000;
}

.cart-summary {
    margin: 0 2% auto;
    text-align: right;
    width: 200px;
    border-style: groove;
    padding: 20px;
    max-height: 250px;
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
/* width */
::-webkit-scrollbar {
  width: 1px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 1px grey; 
  border-radius: 10px;
}
/* Handle */
::-webkit-scrollbar-thumb {
  background: gray; 
  border-radius: 8px;
}
/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  
}

</style>
