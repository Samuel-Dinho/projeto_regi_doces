<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão apenas se não estiver ativa
}

require '../class/Carrinho.php';
$session_data = json_encode($_SESSION);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de Compras</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class='div-table w-50'>
        <?php displayCarte(); ?>
        <h1>Agendamento de Data</h1>
        <input type="date" id="dataAgendamento" min="" value="" onchange="mudarDataTotal(this.value)" />
        <button onclick="agendar()">Agendar</button>
        <p id="resultado"></p>
    </div>
    <div class="cart-container">
        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            displayTotal();
        }
        ?>

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
            let dataFormatada = `${ano}-${mes}-${dia}`;
            const inputData = document.getElementById("dataAgendamento");
            inputData.setAttribute("min", dataFormatada);
            inputData.setAttribute("value", dataFormatada);
            inputData.focus();

        }

        function mudarDataTotal(data) {
            let pData = document.getElementById("pData");
            pData.innerText = "Entrega: " + data.split('-').reverse().join('/');
        }

        // Define o mínimo e o valor assim que a página for carregada e foca no campo de data
        window.onload = definirMinimoEValor;

        // Função para pegar todos os itens da sessionStorage e transformar em JSON
       
        var sessionData = <?php echo $session_data; ?>;
        console.log(sessionData); // Aqui você pode acessar os dados da sessão no console do navegador



  
        $(document).ready(function() {
            $('#finalizar').on('click', function(e) {
                $.ajax({
                    url: '../class/addCart.php',
                    type: 'POST',
                    data: sessionData,
                    success: function(response) {
                        console.log(response);



                    }
                });

            })
        })
    </script>
    <script src="../script/scripts.js"></script>

</body>

</html>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
    }

    /*
    .remove-btn {
        margin: 10px;
    }
*/
    .product-info {
        display: flex;
        align-items: center;
        justify-content: space-around;
    }

    /*
    .adicionarRemover {
        border: none;
        margin: 0 auto;
        padding: 10px;
        box-shadow: none;
        background-color: transparent;
        width: 10px;
    }
*/
    .cart-container {
        max-width: 1200px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-evenly;
        align-items: center;
    }

    .cart-title {
        text-align: center;
        font-size: px;
        margin-bottom: 20px;
    }

    .cart-item {
        display: flex;
        padding: 15px;

        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fafafa;

        flex-direction: column-reverse;
        justify-content: center;
    }

    .product-image {
        flex: 0 0 100px;
        max-width: 150px;
        max-height: 150px;
    }

    .product-image img {

        max-width: 150px;
        max-height: 150px;
        border-radius: 5px;
    }

    .product-details {
        display: flex;

        padding: 0 15px;
        flex-direction: column;
        width: 30%;

    }

    .product-name {
        font-weight: bold;
        font-size: 2rem;
        margin-bottom: 20%;
    }


    .product-quantity,
    .product-total {
        display: block;
        margin-top: 5px;
    }

    /*
    .action-btn,
    .remove-btn {

        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
    }

    .action-btn {
        background-color: #28a745;
       
        color: white;
    }

    .action-btn:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }

    .remove-btn {
        background-color: #dc3545;
        
        color: white;
    }

    .remove-btn:hover {
        background-color: #c82333;
        transform: translateY(-2px);
    }
*/
    .total-container {
        margin-top: 20px;
        font-size: 18px;
        font-weight: bold;
        text-align: right;
    }

    /*
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
*/
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
            padding: 5px;
        }

        .cart-summary {
            margin: 10px auto;
        }

        .div-table {
            display: block;
        }

        .product-image img {
            width: 50px;
            height: 50px;
        }

        .product-details {
            display: flex;
            font-size: 0.5rem;
            flex-direction: column;
            padding: 0;
        }

        .product-image {
            margin: 2px;
            height: auto;
            flex: 0;
        }

        .cart-item {
            width: auto;
            padding: 0;
        }

        .product-name {
            font-size: 1rem;
            margin: 0;
        }

        .productPrice {
            font-size: 0.7rem;
        }

        .product-details {
            font-size: 0.4rem;
        }

        /*
        .adicionarRemover {
            padding: 1px;
            margin: 1px;
        }

        .action-btn {
            padding: 2px 2px;
            font-size: 10px;
        }
*/
        #totalQuanti {
            width: auto;
            font-size: small;
            margin: 2px;
        }

        .remove-btn {
            font-size: 10px;
            padding: 1px;
            margin: 1px;
        }

        .product-actions {
            width: auto;
            margin: 1px;
        }

        .product-quantity,
        .product-total {
            font-size: 0.8rem;
            text-align: center;
        }

    }
</style>