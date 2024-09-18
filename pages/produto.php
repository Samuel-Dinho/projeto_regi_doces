<php>
    <?
    session_start();
    
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
                    <li><a href="">Carrinho</a></li>
                    <li><a href="#">Conta</a></li>
                </ul>

            </nav>
            <h1 class="name">Delicias da Regi</h1>
        </header>

        <div class="container">
            <?php  
            include '../db/query/produto.php';
        ?>
        </div>


    </body>

    </html>
    <script src="../script/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</php>