function changeQty(btn, delta) {
  const valueEl = btn.parentElement.querySelector('.value');
  let qty = parseInt(valueEl.textContent) + delta;
  if (qty < 1) qty = 1;
  valueEl.textContent = qty;
  valueEl.classList.add('pop');
  setTimeout(() => valueEl.classList.remove('pop'), 200);
}

function removeItem(btn) {
  const item = btn.closest('.cart-item');
  item.remove();
  const remaining = document.querySelectorAll('.cart-item');
  if (remaining.length === 0) {
    document.getElementById('cartItems').style.display = 'none';
    document.getElementById('cartSummary').classList.add('hidden');
    document.getElementById('emptyState').style.display = 'block';
  }
}
