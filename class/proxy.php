<?php

$valor = isset($_GET['valor']) ? $_GET['valor'] : '0.0';
// URL da API que você quer acessar
$api_url = 'https://gerarqrcodepix.com.br/api/v1?nome=Samuel%20Miglio%20Maia%20Junior&cidade=Joinville&chave=47999762985&valor='.$valor.'&mcc=7372&saida=br';

// Inicializa a requisição cURL
$ch = curl_init();

// Define as opções da requisição cURL
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executa a requisição e captura a resposta
$response = curl_exec($ch);

// Verifica se houve erro na requisição
if ($response === false) {
    echo 'Erro: ' . curl_error($ch);
} else {
    // Define o tipo de conteúdo como texto
    header('Content-Type: text/plain');
    
    // Retorna a resposta
    echo $response;
}

// Fecha a requisição cURL
curl_close($ch);
?>