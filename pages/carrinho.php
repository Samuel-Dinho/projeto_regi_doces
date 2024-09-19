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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
            <h1>Agendamento de Data</h1>
            <input type="date" id="dataAgendamento" min="" value="" />
            <button onclick="agendar()">Agendar</button>
            <p id="resultado"></p>
        </div>
        <?php displayTotal(); ?>
    </div>


    <script>
    // Função para definir o mínimo de dias e valor padrão
    function definirMinimoEValor() {
        const dataAtual = new Date();
        const dataMinima = new Date(dataAtual);
        dataMinima.setDate(dataAtual.getDate() + 3);

        // Formata a data no formato YYYY-MM-DD
        const dia = String(dataMinima.getDate()).padStart(2, '0');
        const mes = String(dataMinima.getMonth() + 1).padStart(2, '0'); // Janeiro é 0!
        const ano = dataMinima.getFullYear();
        const dataFormatada = `${ano}-${mes}-${dia}`;

        // Define o mínimo e o valor padrão
        const inputData = document.getElementById("dataAgendamento");
        inputData.setAttribute("min", dataFormatada);
        inputData.setAttribute("value", dataFormatada);

        // Foca no campo de data para destacar ao carregar a página
        inputData.focus();
    }

    function agendar() {
        const inputData = document.getElementById("dataAgendamento").value;
        const dataSelecionada = new Date(inputData);
        const dataAtual = new Date();

        if (dataSelecionada < new Date(dataAtual.getTime() + 3 * 24 * 60 * 60 * 1000)) {
            document.getElementById("resultado").innerText = "A data deve ser ao menos 3 dias a partir de hoje.";
        } else {
            document.getElementById("resultado").innerText = "Data agendada com sucesso para " + dataSelecionada
                .toLocaleDateString();
        }
    }

    // Define o mínimo e o valor assim que a página for carregada e foca no campo de data
    window.onload = definirMinimoEValor;
    </script>
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

.cart-container {
    display: flex;
    align-content: flex-start;
    justify-content: center;
}

h1 {
    text-align: center;
    margin: 10px;
}

.div-table {
    max-height: 400px;
    overflow: auto;
}

.cart-table {
    margin: 0 auto 10px;
    border-collapse: collapse;

    overflow: scroll;
    max-height: 300px;

}

.cart-table th,
.cart-table td {
    border: none;
    text-align: left;

}

.formatInput {
    display: flex;
    align-items: center;
}

.adicionarRemover {
    border: none;
    margin: 10px auto;
    padding: 10px;
    box-shadow: none;
    background-color: transparent;

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
::-webkit-scrollbar-thumb:hover {}

@media (max-width: 768px) {
    .cart-container {
        display: block;
    }

    .cart-summary {
        margin: 10px auto;
    }
}
</style>