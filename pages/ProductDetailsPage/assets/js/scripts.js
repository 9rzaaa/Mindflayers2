(() => {
  const modalEl = document.getElementById('productDetailModal');
  if (!modalEl || typeof bootstrap === 'undefined') return;

  const productModal = new bootstrap.Modal(modalEl);
  productModal.show();
})();

