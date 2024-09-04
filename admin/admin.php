<php>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produtos</title>
        <link rel="stylesheet" href="../../style/style.css">
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
                    <li><a href="../pages/produto.php">Produto</a></li>
                    <li><a href="../pages/sobre.php">Sobre</a></li>
                    <li><a href="">Carrinho</a></li>
                    <li><a href="#">Conta</a></li>
                </ul>

            </nav>
            <h1 class="name">Delicias da Regi</h1>
        </header>
        <section>
            <button id='cria-button' type="button">Criar Produto</button>
            <button id='uploda-img' type="button">Upload Img</button>
            <button id='departamento-form' type="button">Departamento</button>
        </section>
        <section class='form-admin'>
            <form class='form-cria' method="post" action="query/criarProduto.php">
                <h2 style='text-align:center;'>Criar Produto</h2>
                <label name='' for="">Nome</label>
                <input type="text" name="nameProduto" id="nameProduto" placeholder='Nome do Produto'>
                <label for="">Departamento</label>
                <select name="departamento" id="departamento">
                    <?php
            include 'query/departamento.php';
            ?>
                </select>
                <label for="">Preço</label>
                <input type="text" name="preco" id="preco" placeholder='R$:'>
                <label for="">Imagen</label>
                <select name='arquivo' required>"
                    <?php
                // Diretório onde os arquivos estão armazenados
                $uploadFileDir = '../imagens/';

                // Obtém a lista de arquivos no diretório
                $files = array_diff(scandir($uploadFileDir), array('..', '.'));
            foreach ($files as $file) {
                echo "<option value='" . htmlspecialchars($file) . "'>" . htmlspecialchars($file) . "</option>";
            }
            ?>
                </select>
                <label for="">Descrição</label>
                <input type="text" name="descricao" id="descricao" placeholder="Informação do produto">
                <button type='submit'>Criar</button>
            </form>
            <form id='editForm' method='post' action='upload.php' enctype='multipart/form-data'>
                <p class='upload'>
                    <label for=''>Upload Imagen:</label>
                    <input name='upload' type='file' id='fileInput' onchange='updateFileName(this)' />
                    <button id='file-button' type='submit'>Enviar</button>
                </p>
            </form>
            <form action="query/criaDepartamento.php" id='cria-dep' method="post">
                <label for="">Criar Departamento</label>
                <input type="text" name='novo-depat' id='cria-dep-input' placeholder='Nome do Departamento' required>
                <button type='submit' id='cria-dep-button'>Criar</button>
            </form>
        </section>
        <?php
            include 'query/produtos.php';
        ?>

        <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.menu ul').classList.toggle('show');
        });
        document.getElementById('departamento-form').addEventListener('click', function(){
            
        });
        </script>
</php>