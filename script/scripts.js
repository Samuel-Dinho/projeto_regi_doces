document.querySelector('.menu-toggle').addEventListener('click', function () {
  document.querySelector('.menu ul').classList.toggle('show');
});
document.querySelectorAll('.department-link').forEach(link => {
  link.addEventListener('click', function (event) {
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

$(document).ready(function () {
  $('.ajax-form').on('submit', function (event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    $.ajax({
      url: '../class/Carrinho.php', // URL do script backend
      type: 'POST',
      data: $(this).serialize(), // Serializa os dados do formulário
      success: function (response) {
        const data = JSON.parse(response);
        cartQuantidade = data.cartQuantidade;
        if (data.cartQuantidade) {
          document.getElementById('cart-count').innerText = data.cartQuantidade;
        }
      },
      error: function (xhr, status, error) {
        console.error("Erro no AJAX: ", status, error);
        $('#resultado').html('Ocorreu um erro.'); // Exibe mensagem de erro
      }
    });
  });
});

$(document).ready(function () {
  $('.adicionarRemover').on('submit', function (e) {
    e.preventDefault(); // Impede o envio padrão do formulário

    const form = $(this);
    // Obtém o valor do label com ID 'quantity'
    const quantityValue = $('#quantity').text();

    $.ajax({
      url: 'Carrinho.php',
      type: 'POST',
      data: form.serialize(),
      success: function (response) {
        const data = JSON.parse(response); // Analisa a resposta JSON
        id = data.id;
        
        document.getElementById('quantity' + id).innerText = data.quantidade;
        document.getElementById('sub-total').innerText = "Subtotal: R$:" + data.total;
        document.getElementById('total').innerText = "Total: R$:" + data.total;
        document.getElementById('totalItem' + id).innerText = "R$:" + data.totalItem;
        if (data.remove) {
          document.getElementById("item" + data.id).remove(); // Remove o item do DOM
        }
        if ($('#total').text() === "Total: R$: 0,00") {
          $('.cart-container').html("<h1>Seu carrinho está vazio.</h1><button id='verCarrinho'><a  href='produto.php'>Adicionar Produto</a></button>");
          $('.cart-container').css('display','block');
          $('$verCarrinho').css('margin','auto');
        }
        else{
          $('.cart-container').css('display','flex');
        }
      },
      error: function () {
        alert('Ocorreu um erro ao atualizar o carrinho.');
      }
    });
  });
});

function addToCart() {
  // Lógica de adicionar o produto ao carrinho

  // Exibir notificação
  const notification = document.getElementById('notification');
  notification.classList.remove('hidden');
  notification.classList.add('show');

  // Ocultar notificação após 3 segundos
  setTimeout(() => {
    notification.classList.remove('show');
    notification.classList.add('hidden');
  }, 3000);
}

// Get the button:

// When the user scrolls down 20px from the top of the document, show the button
document.addEventListener("DOMContentLoaded", function () {
  window.onscroll = function () {
    scrollFunction();
  };
});

function scrollFunction() {
  // Obtém os elementos
  let mybutton = document.getElementById("myBtn");
  let depart = document.getElementById('depart');
  let cart = document.getElementById('carrinho-icon');
  // Verifica se o botão existe
  if (mybutton) {
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
      mybutton.style.display = "block"; // Mostra o botão
      // Verifica se 'depart' existe antes de manipulá-lo
      if (depart) {
        depart.classList.remove('departamento');
        depart.classList.add('stickDepartamento');
      }
      if(cart){
        cart.classList.remove('carrinho-icone');
        cart.classList.add('cart-icone');
      }
    } else {
      mybutton.style.display = "none"; // Esconde o botão
      // Verifica se 'depart' existe antes de manipulá-lo
      if (depart) {
        depart.classList.add('departamento');
        depart.classList.remove('stickDepartamento');
      }
      if(cart){
        cart.classList.add('carrinho-icone');
        cart.classList.remove('cart-icone');
      }
    }
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}



