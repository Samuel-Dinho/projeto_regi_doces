<?php
if ( isset( $_FILES[ 'upload' ] ) ) {
    $arquivo = $_FILES[ 'upload' ];

    if ( $arquivo[ 'error' ] )
    die( 'Falha ao enviar arquivo' );

    if ( $arquivo[ 'size' ]>2097152 )
    die( 'Arquivo muito grande!! MAX: 2MB' );
}

$pasta = '../imagens/';
$nomeDoArquivo = $arquivo[ 'name' ];
$novoNomeDoArquivo = uniqid();
$extensao = strtolower( pathinfo( $nomeDoArquivo, PATHINFO_EXTENSION ) );

if ( $extensao != 'jpg' && $extensao != 'png' )
die( 'Tipo de arquivo não aceito' );

$deu_certo = move_uploaded_file( $arquivo[ 'tmp_name' ], $pasta . $novoNomeDoArquivo . '.' . $extensao );
if ( $deu_certo )
    header( 'Location: admin.php' );

?>