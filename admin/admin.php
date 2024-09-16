<php>
    <?php
  // Diretório onde os arquivos estão armazenados
  $uploadFileDir = '../imagens/';
  // Obtém a lista de arquivos no diretório
  $files = array_diff(scandir($uploadFileDir), array('..', '.'));
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Produtos</title>
        <link rel="stylesheet" href="../../style/style.css">
        <link rel="stylesheet" href="style/style.css">
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
            <button id='uploda-img' type="button">Imagen</button>
            <button id='departamento-form' type="button">Categoria</button>
        </section>
        <section class='form-admin'>
            <!--Criar Produto-->
            <form class='form-cria hidden' id='form-cria' method="post" action="query/criarProduto.php">
                <h2 style='text-align:center;'>Criar Produto</h2>
                <label name='' for="">Nome</label>
                <input type="text" name="nameProduto" id="nameProduto" placeholder='Nome do Produto'>
                <label for="">categoria</label>
                <select name="departamento" id="departamento">
                    <?php
                include 'query/departamento.php';
                 ?>
                </select>
                <label for="">Preço</label>
                <input type="text" name="preco" id="preco" placeholder='R$:'>
                <label for="">Imagen</label>
                <select name='arquivo' id='arquivoSelect' required>
                    <?php
                // Exibe cada arquivo como uma opção no select
                foreach ($files as $file) {
                    echo "<option value='" . htmlspecialchars($file) . "'>" . htmlspecialchars($file) . "</option>";
                }
                ?>
                </select>

                <!-- Aqui a imagem será exibida -->
                <div class="image-container">
                    <img id="imagePreview" src="" alt="Preview da imagem"
                        style="max-width: 150px; max-height: 150px; display: none;">
                </div>
                <label for="">Descrição</label>
                <input type="text" name="descricao" id="descricao" placeholder="Informação do produto">
                <label for="">Rotulo</label>
                <input type="text" name='rotulo' placeholder='Rotulo:'>
                <button type='submit'>Criar</button>
            </form>
            <!--fazer upload-->
            <div class='hidden' id='edit-form'>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <p>Selecione a imagem:</p>
                    <input type="file" name="image" id='fileInput' onchange='updateFileName(this)'>
                    <p>Nome do arquivo desejado (sem extensão):</p>
                    <input type="text" name="filename">
                    <button id='file-button' type='submit'>Enviar</button>
                </form>
                <div class='div-table'>
                    <table class='table-image'>
                        <thead>
                            <th>ID</th>
                            <th>nome</th>
                            <th>Imagen</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </thead>
                        <?php
            $posicao = 1; // Inicializa a variável $posicao
            foreach ($files as $arquivo) {
                echo "
                <tr>
                <td style='width: 5%'>$posicao</td>
                <td style='width: 10%'>". htmlspecialchars($arquivo) ."</td>
                <td style='width: 5%'><img src='../imagens/" . htmlspecialchars($arquivo) . "' alt='' srcset=''></td>
                <td><button onclick='openImageModal(\"" . htmlspecialchars($arquivo) . "\")'>Editar</button></td>
                <td style='width: 5%'><button  onclick='excluirCategoriaModal(". htmlspecialchars($arquivo) .")'>Exluir</button>
                </tr>"
                ;
                $posicao++; // Incrementa a posição
            }
            ?>
                    </table>

                </div>
            </div>
            <!--Criar Departamento-->
            <section class='hidden' id='cria-dep'>
                <div id='dep-grid'>
                    <form action="query/criaDepartamento.php" method="post">
                        <div>
                            <label for="">Criar Categoria</label>
                            <input type="text" name='novo-depat' id='cria-dep-input' placeholder='Nome do Departamento'
                                required>
                            <button type='submit' id='cria-dep-button'>Criar</button>
                        </div>
                    </form>
                    <div>
                        <?php
                include 'query/tableDepartamento.php';
                ?>

                    </div>
            </section>
        </section>
        <div id='editImageModal' class='modal' style='display:none;'>
            <div class=''>

                <h2>Editar Produto</h2>
                <form id='editForm' method='post' action=''>
                    <span class='close' onclick='closeImageModal()'>&times;</span>
                    <input type='hidden' name='idImage' id='modalIdImage' />
                    <label>Nome:</label>
                    <input type='text' name='nameImage' id='modalNameImage' required />
                    <label for="">Imagem</label>
                    <img id="qualquer" src="" alt="Imagem do Modal" />

                </form>
            </div>
        </div>
        
        <?php
            include 'query/produtos.php';
        ?>
        <script src="script/admin.js"></script>
        <script>
        function openImageModal(fileName) {
            // Define os campos do modal com as informações da imagem
            document.getElementById('modalIdImage').value = fileName;
            document.getElementById('modalNameImage').value = fileName; // Você pode customizar o que será exibido
            // Exibe o modal
            document.getElementById('editImageModal').style.display = 'block';
        }

        function closeImageModal() {
            // Oculta o modal de edição de imagem
            document.getElementById('editImageModal').style.display = 'none';
        }
        </script>
</php>