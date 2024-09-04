<php>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delicias Regi</title>
        <link rel="stylesheet" href="/style/style.css">
        
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
                    <li><a href="index.php">Home</a></li>
                    <li><a href="pages/produto.php">Produto</a></li>
                    <li><a href="pages/sobre.php">Sobre</a></li>
                    <li><a href="">Carrinho</a></li>
                    <li><a href="pages/conta.php">Conta</a></li>
                </ul>
            </nav>
            <h1 class="name">Delicias da Regi</h1>
        </header>
        <div class="carousel">
            <div class="carousel-inner">
                <?php
                include 'db/query/carrosel.php';
           ?>
                <label for="carousel-3" class="carousel-control prev control-1">‹</label>
                <label for="carousel-2" class="carousel-control next control-1">›</label>
                <label for="carousel-1" class="carousel-control prev control-2">‹</label>
                <label for="carousel-3" class="carousel-control next control-2">›</label>
                <label for="carousel-2" class="carousel-control prev control-3">‹</label>
                <label for="carousel-1" class="carousel-control next control-3">›</label>
                <ol class="carousel-indicators">
                    <li>
                        <label for="carousel-1" class="carousel-bullet">•</label>
                    </li>
                    <li>
                        <label for="carousel-2" class="carousel-bullet">•</label>
                    </li>
                    <li>
                        <label for="carousel-3" class="carousel-bullet">•</label>
                    </li>
                </ol>
            </div>
        </div>
        <section class="grid grid-template-columns-1">
            <?php
        include 'db/query/destaque.php';
   ?>
        </section>

    </body>
    <script src="script/scripts.js"></script>
    </html>
</php>