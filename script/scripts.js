document.querySelector('.menu-toggle').addEventListener('click', function() {
  document.querySelector('.menu ul').classList.toggle('show');
});
document.querySelectorAll('.department-link').forEach(link => {
  link.addEventListener('click', function(event) {
    event.preventDefault();
    
    const department = this.getAttribute('data-department');
    
    
    if (department === null || department === '') {
      document.querySelectorAll('.product-item').forEach(item => {
        item.classList.remove('hidden');
      });
      return;
    }
    document.querySelectorAll('.product-item').forEach(item => {
      item.classList.add('hidden');
    });
    
    
    document.querySelectorAll('.items-' + department).forEach(item => {
      item.classList.remove('hidden');
    });
  });
});

$(document).ready(function() {
    $('#meuFormulario').on('submit', function(event) {
        event.preventDefault(); // Impede o envio padrão do formulário

        $.ajax({
            url: 'seu-script.php', // URL do seu script que processa os dados
            type: 'POST',
            data: $(this).serialize(), // Serializa os dados do formulário
            success: function(response) {
                $('#resultado').html(response); // Exibe a resposta
            },
            error: function() {
                $('#resultado').html('Ocorreu um erro.'); // Exibe mensagem de erro
            }
        });
    });
});

