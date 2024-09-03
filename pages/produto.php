<php>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produtos</title>
        <link rel="stylesheet" href="../style/style.css">
        <link rel="stylesheet" href="../style/styleDepartamento.css">
    </head>

    <body>
        <nav class="menu">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="produto.php">Produto</a></li>
                <li><a href="">Sobre</a></li>
                <li><a href="">Carrinho</a></li>
            </ul>
            
        </nav>
        <h1 class="name">Delicias da Regi</h1>
        

        <div class="container">
            <?php  
            include '../db/query/produto.php';
        ?>
        </div>

       
    </body>

    </html>
    <script src="../script/depart-script.js"></script>

</php>