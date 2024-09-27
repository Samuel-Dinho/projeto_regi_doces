<?php

function sendWhatsAppMessage($number, $message) {
    $url = 'http://localhost:3000/send-message';
    
    $data = [
        'number' => $number,
        'message' => $message
    ];

    $options = [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ],
        CURLOPT_POSTFIELDS => json_encode($data)
    ];

    $ch = curl_init();
    curl_setopt_array($ch, $options);
    
    $response = curl_exec($ch);
    
    if ($error = curl_error($ch)) {
        echo 'Erro: ' . $error;
    } else {
        echo 'Resposta: ' . $response;
    }

    curl_close($ch);
}

// Exemplo de uso
sendWhatsAppMessage('5511999999999', 'Olá, esta é uma mensagem enviada pelo PHP via Venom Bot!');
?>
