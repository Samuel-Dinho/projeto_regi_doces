document.querySelector('.menu-toggle').addEventListener('click', function() {
  document.querySelector('.menu ul').classList.toggle('show');
});
document.querySelectorAll('.department-link').forEach(link => {
  link.addEventListener('click', function(event) {
      event.preventDefault();
      
      const department = this.getAttribute('data-department');
      
      // Esconder todos os produtos
      document.querySelectorAll('.product-item').forEach(item => {
          item.classList.add('hidden');
      });
      
      // Mostrar apenas os produtos do departamento clicado
      document.querySelectorAll('.items-' + department).forEach(item => {
          item.classList.remove('hidden');
      });
  });
});0