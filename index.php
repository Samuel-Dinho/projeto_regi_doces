<php>
    <?php
session_start();
?>
    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Delicias Regi</title>
        <link rel="stylesheet" href="/style/style.css">
               <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 
    </head>

    <body>
        <header>
            <nav class="menu">
            <button class="menu-toggle">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="pages/produto.php">Produto</a></li>
                    <li><a href="pages/sobre.php">Sobre</a></li>
                    <li><a href="pages/carrinho.php">Carrinho</a></li>
                    <li><a href="pages/conta.php">Conta</a></li>
                </ul>
            </nav>
            <h1 class="name">Delicias da Regi</h1>
        </header>
        <?php
                include 'db/query/carrosel.php';
                 ?>

        <section class="grid grid-template-columns-1">
            <?php
        include 'db/query/destaque.php';
   ?>
 
        </section>
    </body>
    <script>
    document.querySelectorAll('.department-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Previne o comportamento padrão do link
            const selectedDepartment = this.getAttribute('data-department');

            // Mostra/oculta produtos com base na categoria selecionada
            document.querySelectorAll('.product-item').forEach(item => {
                if (selectedDepartment === "" || item.classList.contains('items-' + selectedDepartment)) {
                    item.style.display = 'block'; // Mostra o item
                } else {
                    item.style.display = 'none'; // Oculta o item
                }
            });
        });
    });
</script>
<script src="script/scripts.js"></script>
    </html>
</php>
