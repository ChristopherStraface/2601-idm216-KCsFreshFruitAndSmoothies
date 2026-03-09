const catalogue = {
  'Custom Smoothie': { image: './img/smoothie.avif',      defaults: [] },
  'Fruit Salad':     { image: './img/fruit_salad.avif',   defaults: [] },
  'P.B. Banana':     { image: './img/pb_banana.avif',     defaults: ['Banana', 'Peanut Butter'] },
  'Taro':            { image: './img/taro.avif',          defaults: [] },
};

let currentPrice = 5.50;

// Read item from URL
const params = new URLSearchParams(window.location.search);
const itemName = params.get('item') || 'Custom Smoothie';
const data = catalogue[itemName] || catalogue['Custom Smoothie'];

document.getElementById('itemTitle').textContent = itemName;
document.getElementById('itemImage').src = data.image;
document.getElementById('itemImage').alt = itemName;

// Pre-check defaults
data.defaults.forEach(val => {
  const cb = document.querySelector(`input[value="${val}"]`);
  if (cb) cb.checked = true;
});

function selectSize(btn) {
  document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  currentPrice = parseFloat(btn.dataset.price);
  updateTotal();
}

function updateTotal() {
  const addons = document.querySelectorAll('.addon-checkbox:checked').length;
  document.getElementById('totalPrice').textContent = '$' + (currentPrice + addons).toFixed(2);
}
