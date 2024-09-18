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

let clickCarrinho = document.getElementsByName('add_to_cart');

function openJanelaCarrinho (nome){
  
}
