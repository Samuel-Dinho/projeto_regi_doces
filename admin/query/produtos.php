<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

$sqlquery = "
    SELECT pd.*, d.Departamento
    FROM projeto_individual.produtos AS pd
    JOIN projeto_individual.departamento AS d
    ON pd.idDepartamento = d.idDepartamento
";
$resultQuery = mysqli_query($conn, $sqlquery);



echo "<table>
        <tr>
            <th >Id Produto</th>
            <th >Nome</th>
            <th >Departamento</th>
            <th >Preço</th>
            <th >Descrição</th>
            <th >Local</th>
            <th >Destaque</th>
            <th >Carrosel</th>
            <th >Editar</th>
            <th >Excluir</th>
        </tr>";

if ($resultQuery->num_rows > 0) {
    while ($row2 = $resultQuery->fetch_assoc()) {
        // Substitui 1 e 0 por "Sim" e "Não"
        $row2['destaque'] = $row2['destaque'] == 1 ? 'Sim' : 'Não';
        $row2['carrosel'] = $row2['carrosel'] == 1 ? 'Sim' : 'Não';

        echo "<tr>
                <td data-label='id Produto'>" . htmlspecialchars($row2['idProduto']) . "</td>
                <td data-label='Nome'>" . htmlspecialchars($row2['nameProduto']) . "</td>
                <td data-label='Departamento'> " . htmlspecialchars($row2['Departamento']) . "</td>
                <td data-label='Preço'>R$: " . number_format($row2['preco'], 2, ',', '.') . "</td>
                <td data-label='Descrição' class='descricao-cell'>" . htmlspecialchars($row2['descricao']) . "</td>
                <td data-label='Local'>" . htmlspecialchars($row2['arquivo']) . "</td>
                <td data-label='Destaque'>" . htmlspecialchars($row2['destaque']) . "</td>
                <td data-label='Carrosel'>" . htmlspecialchars($row2['carrosel']) . "</td>
                <td data-label='Editar'>
                    <button  onclick='openModal(" . htmlspecialchars($row2['idProduto']) . ")'>Editar</button>
                </td>
                <td data-label='Excluir'>
                    <button  onclick='openExcluirModal(" . htmlspecialchars($row2['idProduto']) . ")'>Excluir</button>
            </tr>";
    }
} else {
    echo "Nenhum produto encontrado.";
}
echo "</table>";

// Diretório onde os arquivos estão armazenados
$uploadFileDir = '../imagens/';

// Obtém a lista de arquivos no diretório
$files = array_diff(scandir($uploadFileDir), array('..', '.'));
echo "<div id='excluir' class='modal' style='display:none;'>
    <div class='modal-content'>
    <form method='post' action='query/excluir.php'>
        <span class='close' style='float:right; cursor:pointer;' onclick='closeModal()'>&times;</span>
        <label>ID Produto</label>
        <input name='idProduto' readonly id='modalExcluirIdProduto'></input>
        <label>Nome Produto</label>
        <input readonly id='modalExcluirNameProduto'></input>
        <label>Departamento</label>
        <input readonly id='modalExcluirDepartamento'></input>
        <label>Preço</label>
        <input  readonly id='modalExcluirPreco'></input>
        <h3>Você tem certeza que deseja excluir este Item?</h3>
        <button class='btn btn-confirm' id='confirmDelete'>Confirmar</button>
    </form>
    </div>
</div>";
// Modal HTML
echo "<div id='editModal' class='modal' style='display:none;'>
        <div class='modal-content'>
            <span class='close' onclick='closeModal()'>&times;</span>
            <h2>Editar Produto</h2>
            <form id='editForm' method='post' action='atualizar_produto.php'>
                <input type='hidden' name='idProduto' id='modalIdProduto' />
                <label>Nome:</label>
                <input type='text' name='nameProduto' id='modalNameProduto' required />
                <label>Departamento</label>
                <select name='departamento' id='modalDepartamento' required>
";
            include 'departamento.php';
echo "           
                </select>
                <label>Preço:</label>
                <input type='text' name='preco' id='modalPreco' required />
                <label>Descrição:</label>
                <textarea name='descricao' id='modalDescricao' required></textarea>
                <label>Arquivo:</label>
                <select name='arquivo'  id='modalArquivo' required>";
            foreach ($files as $file) {
                echo "<option value='" . htmlspecialchars($file) . "'>" . htmlspecialchars($file) . "</option>";
            }
            echo "</select>
                <label>Destaque:</label>
                <select name='destaque' id='modalDestaque'>
                    <option value='1'>Sim</option>
                    <option value='0'>Não</option>
                </select>
                <label>Carrosel:</label>
                <select name='carrosel' id='modalCarrosel'>
                    <option value='1'>Sim</option>
                    <option value='0'>Não</option>
                </select>
                <input type='submit' value='Atualizar' />
            </form>
        </div>
    </div>";

// Fechar conexão
mysqli_close($conn);
?>

<script>
function openModal(id) {
    fetch('get_produto.php?idProduto=' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalIdProduto').value = data.idProduto;
            document.getElementById('modalNameProduto').value = data.nameProduto;
            document.getElementById('modalDepartamento').value = data.idDepartamento;
            document.getElementById('modalPreco').value = data.preco;
            document.getElementById('modalDescricao').value = data.descricao;
            document.getElementById('modalArquivo').value = data.arquivo;
            document.getElementById('modalDestaque').value = data.destaque;
            document.getElementById('modalCarrosel').value = data.carrosel;

            document.getElementById('editModal').style.display = 'block';
        })
        .catch(error => console.error('Erro ao buscar dados do produto:', error));
}
function openExcluirModal(id){
    fetch('get_produto.php?idProduto=' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalExcluirIdProduto').value = data.idProduto;
            document.getElementById('modalExcluirNameProduto').value = data.nameProduto;
            document.getElementById('modalExcluirDepartamento').value = data.idDepartamento;
            document.getElementById('modalExcluirPreco').value = data.preco;
            document.getElementById('excluir').style.display = 'block';
        })
        .catch(error => console.error('Erro ao buscar dados do produto:', error));
}
function closeModal() {
    document.getElementById('editModal').style.display = 'none';
    document.getElementById('excluir').style.display = 'none';
}

window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target === modal) {
        closeModal();
    }
}
</script>

<style>
/* Estilos para o modal */
.modal {
    display: none;
    /* Mantém o modal oculto por padrão */
    position: fixed;
    /* Fixa o modal na tela */
    z-index: 1000;
    /* Garante que o modal fique acima de outros elementos */
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    /* Habilita a rolagem caso o conteúdo do modal seja muito grande */
    background-color: rgba(0, 0, 0, 0.6);
    /* Fundo semitransparente */
    backdrop-filter: blur(5px);
    /* Adiciona um leve desfoque ao fundo */
}

/* Estilos para o conteúdo do modal */
.modal-content {
    background-color: #fff;
    /* Cor de fundo branca */
    margin: 5% auto;
    /* Centraliza o modal na tela */
    padding: 20px;
    /* Espaçamento interno */
    border-radius: 8px;
    /* Bordas arredondadas */
    width: 90%;
    /* Largura do modal */
    max-width: 600px;
    /* Largura máxima para telas maiores */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    /* Sombra ao redor do modal */
    animation: fadeIn 0.3s ease;
    /* Animação de aparição suave */
}

/* Estilos para o botão de fechar */
.close {
    color: #aaa;
    float: right;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: #333;
    /* Cor mais escura ao passar o mouse */
    text-decoration: none;
    /* Remove sublinhado */
}

/* Estilos para os campos do formulário */
.modal-content form label {
    display: block;
    margin-top: 10px;
    font-weight: bold;
    color: #333;
}

.modal-content form input[type="text"],
.modal-content form textarea,
.modal-content form select {
    width: 100%;
    /* Largura total do campo */
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    /* Borda padrão */
    border-radius: 4px;
    /* Bordas levemente arredondadas */
    box-sizing: border-box;
    /* Inclui padding e borda na largura total */
}

.modal-content form input[type="submit"] {
    background-color: #28a745;
    /* Cor de fundo verde */
    color: white;
    /* Texto branco */
    padding: 10px 20px;
    /* Espaçamento interno */
    border: none;
    /* Remove borda padrão */
    border-radius: 4px;
    /* Bordas arredondadas */
    cursor: pointer;
    /* Cursor de ponteiro */
    margin-top: 10px;
    /* Espaçamento superior */
    width: 100%;
    /* Largura total do botão */
}

.modal-content form input[type="submit"]:hover {
    background-color: #218838;
    /* Fundo mais escuro ao passar o mouse */
}
.btn-confirm {
            background-color: #f44336; /* Vermelho */
            margin: 10px auto;
        }

.btn-cancel {
            background-color: #555; /* Cinza */
            margin: 10px auto;
}

/* Animação de aparição suave */
@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}
</style>