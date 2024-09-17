document.querySelector('.menu-toggle').addEventListener('click', function() {
    document.querySelector('.menu ul').classList.toggle('show');
});
var criaProduto = document.getElementById("cria-button");
var upload = document.getElementById("uploda-img");
var departamento = document.getElementById("departamento-form");
var form1 = document.getElementById("form-cria");
var form2 = document.getElementById("cria-dep");
var form3 = document.getElementById("edit-form");

function toggleForm(form) {
    // Se o formulário já estiver visível, escondê-lo
    if (!form.classList.contains("hidden")) {
        form.classList.add("hidden");
    } else {
        // Ocultar todos os formulários
        form1.classList.add("hidden");
        form2.classList.add("hidden");
        form3.classList.add("hidden");
        
        // Exibir o formulário desejado
        form.classList.remove("hidden");
    }
}

criaProduto.onclick = function() {
    toggleForm(form1);
};

upload.onclick = function() {
    toggleForm(form3);
       
};

departamento.onclick = function() {
    toggleForm(form2);
};



const arquivoSelect = document.getElementById('arquivoSelect');
const imagePreview = document.getElementById('imagePreview');

// Diretório onde os arquivos estão armazenados
const uploadFileDir = '../imagens/';

// Atualiza a imagem de preview quando o select mudar
arquivoSelect.addEventListener('change', function() {
    let selectedFile = arquivoSelect.value;
    if (selectedFile) {
        imagePreview.src = uploadFileDir + selectedFile;
        imagePreview.style.display = 'block';
    } else {
        imagePreview.style.display = 'none';
    }
});

// Define a primeira imagem como preview por padrão
window.onload = function() {
    let selectedFile = arquivoSelect.value;
    if (selectedFile) {
        imagePreview.src = uploadFileDir + selectedFile;
        imagePreview.style.display = 'flex';
        imagePreview.style.margin = 'auto';
    }
};




function openImageModal(fileName,extencao) {   
    document.getElementById('modalNameImage').value = fileName; // Customiza o que será exibido*/
    let imagem = document.getElementById('imagenModal');
    document.getElementById("oldName").value = fileName;
    document.getElementById('extensao').value = extencao;
    imagem.setAttribute("src",`../imagens/${fileName}.${extencao}`);
    document.getElementById('editImageModal').style.display = 'block'; // Exibe o modal
}


function closeImageModal() {
    // Oculta o modal de edição de imagem
    document.getElementById('editImageModal').style.display = 'none';
    document.getElementById('excluidImagenModal').style.display = 'none';
}

function openExcluiImagenModal(fileName){
    let idImage = document.getElementById('NomeImage');
    idImage.value =  fileName;
    let imagem = document.getElementById('ExcluiImagenModal');
    imagem.src = `../imagens/` + fileName;
    document.getElementById('excluidImagenModal').style.display = 'block'; // Exibe o modal
}


