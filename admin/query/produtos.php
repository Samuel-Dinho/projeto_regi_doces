<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

$sqlquery = "
    SELECT pd.*, d.categoria
    FROM projeto_final.produto AS pd
    JOIN projeto_final.categoria AS d
    ON pd.categoria_idcategoria = d.idcategoria
";
$resultQuery = mysqli_query($conn, $sqlquery);


echo "<h2 style='text-align:center;'>Produtos</h2>";
echo "<table>
        <tr>
            <th >Id Produto</th>
            <th >Nome</th>
            <th >Categoria</th>
            <th >Preço</th>
            <th >Descrição</th>
            <th >Rotulo</th>
            <th >Local</th>
            <th >Destaque</th>
            <th >Carrosel</th>
            <th> Quantidade</th>
            <th >Editar</th>
            <th >Excluir</th>
        </tr>";

if ($resultQuery->num_rows > 0) {
    while ($row2 = $resultQuery->fetch_assoc()) {
        // Substitui 1 e 0 por "Sim" e "Não"
        $row2['prod_destaque'] = $row2['prod_destaque'] == 1 ? 'Sim' : 'Não';
        $row2['prod_carrosel'] = $row2['prod_carrosel'] == 1 ? 'Sim' : 'Não';

        echo "<tr>
                <td data-label='id Produto'>" . htmlspecialchars($row2['prod_id_produto']) . "</td>
                <td data-label='Nome'>" . htmlspecialchars($row2['prod_nome_produto']) . "</td>
                <td data-label='Categoria'> " . htmlspecialchars($row2['categoria']) . "</td>
                <td data-label='Preço'>R$: " . number_format($row2['prod_preco'], 2, ',', '.') . "</td>
                <td data-label='Descrição' class='descricao-cell'>" . htmlspecialchars($row2['prod_descricao']) . "</td>
                <td data-label='Rotulo'> " . htmlspecialchars($row2['prod_rotulo']) . "</td>
                <td data-label='Local'>" . htmlspecialchars($row2['prod_arquivo']) . "</td>
                <td data-label='Destaque'>" . htmlspecialchars($row2['prod_destaque']) . "</td>
                <td data-label='Carrosel'>" . htmlspecialchars($row2['prod_carrosel']) . "</td>
                <td data-label='Quantidade'>" . htmlspecialchars($row2['prod_quantidade']) . "</td>
                <td data-label='Editar'>
                    <button  onclick='openModal(" . htmlspecialchars($row2['prod_id_produto']) . ")'>Editar</button>
                </td>
                <td data-label='Excluir'>
                    <button  onclick='openExcluirModal(" . htmlspecialchars($row2['prod_id_produto']) . ")'>Excluir</button>
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
        <input name='prod_id_produto' readonly id='modalExcluirIdProduto'></input>
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
                <input type='hidden' name='prod_id_produto' id='modalIdProduto' />
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
                <label>Rotulo:</label>
                <input type='text' name='rotulo' id='rotulo'</input>
                <label>Arquivo:</label>
                
                <select name='arquivo' id='modalArquivo' required onchange='updatePreview()' onmouseover='showPreview()' >
                ";
            foreach ($files as $file) {
                echo "<option onmouseover='showImage('../imagens/" . htmlspecialchars($file) . "')' value='" . htmlspecialchars($file) . "'>" . htmlspecialchars($file) . " </option>";
            }
            
            echo "
            </select>
            <img id='preview' src='' alt='' style'display:'none';'>
            
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
                <label>Quantidade</label>
                <input type:'text' name='quantidade' id='quantidade'></input>
                <input  type='submit' value='Atualizar' />
            </form>
        </div>
    </div>";

// Fechar conexão
mysqli_close($conn);
?>
<script src="script/produto.js"></script>i
<link rel="stylesheet" href="style/produto.css">