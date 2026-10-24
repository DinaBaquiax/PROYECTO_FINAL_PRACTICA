document.addEventListener('submit', async function (e) {
  var form = e.target;
  if (!form.dataset.confirmar) return;
  e.preventDefault();
  var r = await Swal.fire({
    title: form.dataset.confirmar, icon: 'warning', showCancelButton: true,
    confirmButtonText: 'Eliminar', cancelButtonText: 'Cancelar', confirmButtonColor: '#dc3545'
  });
  if (r.isConfirmed) form.submit();
});