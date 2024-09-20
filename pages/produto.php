<php>

    <?php
    include '../class/Carrinho.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); // Inicia a sessão apenas se não estiver ativa
    }

    ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produtos</title>
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/styleDepartamento.css">
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
                    <li><a href="carrinho.php">Carrinho</a></li>
                    <li><a href="#">Conta</a></li>
                </ul>

            </nav>
            <div id='carrinho-icon' class='carrinho-icone'>
                <a href="carrinho.php">🛒<span id='cart-count'><?php displayQuantidade() ?></span></a>
            </div>
            <h1 class="name">Delicias da Regi</h1>
        </header>
        <div id="notification" class="notification hidden">
            Produto adicionado ao carrinho com sucesso!

            <button id='verCarrinho'>
                <a href="carrinho.php">Ver Carrinho</a>
            </button>

        </div>
        <div class="container">
            <button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>
            <?php
            include '../db/query/produto.php';
            ?>
        </div>


    </body>

    </html>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="../script/scripts.js"></script>

</php>