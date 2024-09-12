<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/db.php';

$sqlquery = "
    SELECT * from projeto_final.categoria
";
$resultQuery = mysqli_query($conn, $sqlquery);

echo "<table>
        <tr>
        <th>id Categoria</th>
        <th>Categoria</th>
        <th >Editar</th>
        <th >Excluir</th>
        </tr>
    ";

    if ($resultQuery->num_rows > 0) {
        while ($row2 = $resultQuery->fetch_assoc()) {
            echo "<tr>
            <td data-label='idcategoria'>" . htmlspecialchars($row2['idcategoria']) . "</td>
            <td data-label='categoria'>" . htmlspecialchars($row2['categoria']) . "</td>
            <td data-label='Editar'>
                    <button  onclick='editaCategoriaModal(" . htmlspecialchars($row2['idcategoria']) . ")'>Editar</button>
                </td>
                <td data-label='Excluir'>
                    <button  onclick='excluirCategoriaModal(" . htmlspecialchars($row2['idcategoria']) . ")'>Excluir</button>
            </tr>
            </tr>
            ";

        }
        echo "</table>";

        echo "
        <div id='editCategoriaModal' class='modal' style='display:none;'>
        <div class='modal-content' style='display:grid;''>
            <span class='close' onclick='closeModal()'>&times;</span>
            <h2>Editar Categoria</h2>
            <form method='post' action='atualizar_categoria.php'>
            <div style='width:50%;margin:10px;padding:10px'>
            <label>id Categoria: </label>
            <input name='idCategoria' readonly style='background-color:#80808069' id='modalIdcategoria'></input>
            </div>
            <div style='width:50%;margin:10px;padding:10px'>
            <label>Categoria: </label>
            <input name='categoria' id='modalCategoria'></input>
            </div>
            <button>Atualizar</button>
            </form>
        </div>
        </div>
        ";
        echo "
    <div id='excluirCategoria' class='modal' style='display:none;'>
    <div class='modal-content'>
    <form method='post' action='query/excluirCategoria.php'>
        <span class='close' style='float:right; cursor:pointer;' onclick='closeModal()'>&times;</span>
        <label>ID Categoria</label>
        <input name='idCategoria' readonly id='modalExcluirIdCategoria'></input>
        <label>Categoria</label>
        <input readonly id='modalExCategoria'></input>
        <h3>Você tem certeza que deseja excluir este Item?</h3>
        <button class='btn btn-confirm' id='confirmDelete'>Confirmar</button>
    </form>
    </div>
</div>";
    };


?>
<script>
    function editaCategoriaModal(id) {
        fetch('get_categoria.php?idcategoria=' +id)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalIdcategoria').value = data.idcategoria;
                document.getElementById('modalCategoria').value = data.categoria;

                document.getElementById('editCategoriaModal').style.display = 'block';
            })
            .catch(error => console.error('Erro ao buscar dados da Categoria:', error));
    }
    function excluirCategoriaModal(id){
        fetch('get_categoria.php?idcategoria=' +id)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modalExcluirIdCategoria').value = data.idcategoria;
                document.getElementById('modalExCategoria').value = data.categoria;

                document.getElementById('excluirCategoria').style.display = 'block';
            })
            .catch(error => console.error('Erro ao buscar dados da Categoria:', error));
    }
    

</script>
<?
mysqli_close($conn);
?>