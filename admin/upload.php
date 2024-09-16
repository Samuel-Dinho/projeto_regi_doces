<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se o arquivo foi enviado sem erro
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {

        // Diretório onde o arquivo será salvo
        $target_dir = "../imagens/"; // Adicione uma barra no final

        // Tamanho máximo permitido (em bytes) - 2MB
        $max_file_size = 2 * 1024 * 1024; // 2MB

        // Tipos de arquivos permitidos
        $allowed_file_types = ['jpg', 'jpeg', 'png', 'gif'];

        // Obtém a extensão do arquivo enviado
        $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        // Verifica o tamanho do arquivo
        if ($_FILES['image']['size'] > $max_file_size) {
            echo "O arquivo é muito grande. O tamanho máximo permitido é de 2MB.";
            exit;
        }

        // Verifica se a extensão do arquivo é permitida
        if (!in_array($file_extension, $allowed_file_types)) {
            echo "Formato de arquivo inválido. Apenas JPG, JPEG, PNG e GIF são permitidos.";
            exit;
        }

        // Obtém o nome do arquivo a partir do input do usuário
        $custom_name = $_POST['filename'];

        // Verifica se o nome do arquivo não está vazio
        if (empty($custom_name)) {
            echo "Por favor, forneça um nome para o arquivo.";
            exit;
        }

        // Define o caminho completo do arquivo (nome customizado + extensão original)
        $target_file = $target_dir . basename($custom_name) . "." . $file_extension;

        // Verifica se o arquivo é uma imagem válida
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            // Move o arquivo para o diretório desejado
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                echo "O arquivo " . htmlspecialchars(basename($custom_name)) . " foi enviado com sucesso.";
            } else {
                echo "Desculpe, ocorreu um erro ao enviar seu arquivo.";
            }
        } else {
            echo "O arquivo enviado não é uma imagem.";
        }
    } else {
        echo "Nenhum arquivo foi enviado ou ocorreu um erro.";
    }
}
?>
