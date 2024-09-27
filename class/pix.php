<?php
require 'vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$valor = isset($_GET['valor']) ? $_GET['valor'] : '0.0';
// Exemplo de uso



function gerarQrCodePix($valor)
{
    $chavePix = '47999762985'; // Substitua pela sua chave PIX
    
    $infoAdicional = 'Obrigado por comprar na Delicias da Regi'; // Informações adicionais (opcional)
     // Formato do QR Code PIX
     $payload = "00020101021126540014br.gov.bcb.pix0114{$chavePix}0206{$valor}52040000";
     if ($infoAdicional) {
         $payload .= "{$infoAdicional}";
     }
     $payload .= "6304"; // Adiciona a parte final do QR Code
 
     // Criar o QR Code
     $qrCode = QrCode::create($payload)
         ->setSize(300)
         ->setMargin(10);
     
     // Definir o cabeçalho para PNG
     header('Content-Type: image/png');
 
     // Criar um escritor e enviar a imagem diretamente para o navegador
     $writer = new PngWriter();
     $writer->write($qrCode)->saveToFile('php://output');
     
}



