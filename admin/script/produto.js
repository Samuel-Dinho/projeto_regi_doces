function openModal(id) {
    fetch('get_produto.php?prod_id_produto=' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalIdProduto').value = data.prod_id_produto;
            document.getElementById('modalNameProduto').value = data.prod_nome_produto;
            document.getElementById('modalDepartamento').value = data.categoria_idcategoria;
            document.getElementById('rotulo').value = data.prod_rotulo;
            document.getElementById('quantidade').value = data.prod_quantidade;

            // Formatar o valor em estilo brasileiro (R$, com vírgula para decimal e ponto para milhar)
            
            document.getElementById('modalPreco').value = data.prod_preco;

            document.getElementById('modalDescricao').value = data.prod_descricao;
            document.getElementById('modalArquivo').value = data.prod_arquivo;
            document.getElementById('modalDestaque').value = data.prod_destaque;
            document.getElementById('modalCarrosel').value = data.prod_carrosel;

            document.getElementById('editModal').style.display = 'block';
        })
        .catch(error => console.error('Erro ao buscar dados do produto:', error));
}

function openExcluirModal(id){
    fetch('get_produto.php?prod_id_produto=' + id)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalExcluirIdProduto').value = data.prod_id_produto;
            document.getElementById('modalExcluirNameProduto').value = data.prod_nome_produto;
            document.getElementById('modalExcluirDepartamento').value = data.categoria;
            document.getElementById('modalExcluirPreco').value = data.prod_preco;
            document.getElementById('excluir').style.display = 'block';
        })
        .catch(error => console.error('Erro ao buscar dados do produto:', error));
}
function closeModal() {
    document.getElementById('editModal').style.display = 'none';
    document.getElementById('excluir').style.display = 'none';
    document.getElementById('editCategoriaModal').style.display = 'none';
    document.getElementById('excluirCategoria').style.display ='none';
}

window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target === modal) {
        closeModal();
    }
}

function updatePreview() {
            const select = document.getElementById('modalArquivo');
            const preview = document.getElementById('preview');
            const dirPath = '../imagens/'; // Altere para o seu diretório
            const selectedFile = dirPath + select.value; // Combine o diretório com o arquivo

            if (selectedFile) {
                preview.src = selectedFile; // Atualiza a imagem de preview
            }
        }

        function showPreview() {
            const select = document.getElementById('modalArquivo');
            const preview = document.getElementById('preview');
            const dirPath = '../imagens/'; // Altere para o seu diretório
            const selectedFile = dirPath + select.value; // Combine o diretório com o arquivo

            if (selectedFile) {
                preview.src = selectedFile; // Atualiza a imagem de preview
                preview.style.display = 'block'; // Mostra a imagem
            }
        }
