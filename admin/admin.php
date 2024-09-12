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
        <section class='buttons-admin'>
            <button id='cria-button' type="button">Criar Produto</button>
            <button id='uploda-img' type="button">Upload Img</button>
            <button id='departamento-form' type="button">Departamento</button>
        </section>
        <section class='form-admin'>
            <!--Criar Produto-->
            <form class='form-cria hidden' id='form-cria' method="post" action="query/criarProduto.php">
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
                <label for="">Rotulo</label>
                <input type="text" name='rotulo' placeholder='Rotulo:'>
                <button type='submit'>Criar</button>
            </form>
        <!--fazer upload-->
            <form class='hidden' id='editForm' method='post' action='upload.php' enctype='multipart/form-data'>
                <p class='upload'>
                    <label for=''>Upload Imagen:</label>
                    <input name='upload' type='file' id='fileInput' onchange='updateFileName(this)' />
                    <button id='file-button' type='submit'>Enviar</button>
                </p>
            </form>
        <!--Criar Departamento-->
        <section class='hidden' id='cria-dep'>
            <div id='dep-grid'>
            <form  action="query/criaDepartamento.php" method="post">
                <label for="">Criar Departamento</label>
                <input type="text" name='novo-depat' id='cria-dep-input' placeholder='Nome do Departamento' required>
                <button type='submit' id='cria-dep-button'>Criar</button>
            </form>
            <?php
                include 'query/tableDepartamento.php';
            ?>
            </div>
        </section>
        </section>
        <?php
            include 'query/produtos.php';
        ?>

        <script>
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.menu ul').classList.toggle('show');
        });
        var criaProduto = document.getElementById("cria-button");
        var upload = document.getElementById("uploda-img");
        var departamento = document.getElementById("departamento-form");
        var form1 = document.getElementById("form-cria");
        var form2 = document.getElementById("cria-dep");
        var form3 = document.getElementById("editForm");

        criaProduto.onclick = function() {
            form3.classList.add("hidden");
            form2.classList.add("hidden");
            if (form1.classList.contains("hidden")) {
                form1.classList.remove("hidden");
            } else {
                form1.classList.add("hidden");
            }
        }

        upload.onclick = function() {
            form2.classList.add("hidden");
            form1.classList.add("hidden");
            if (form3.classList.contains("hidden")) {
                form3.classList.remove("hidden");
            } else {
                form3.classList.add("hidden");
            }
        }

        departamento.onclick = function() {
            form1.classList.add("hidden");
            form3.classList.add("hidden");
            if (form2.classList.contains("hidden")) {
                form2.classList.remove("hidden");
            } else {
                form2.classList.add("hidden");
            }
        }
        </script>
</php>