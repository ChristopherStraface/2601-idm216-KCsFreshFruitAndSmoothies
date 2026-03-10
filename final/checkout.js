// ── Sample order data (PHP will inject real values) ──────────────────────────
const subtotal = 6.50;
const tax      = subtotal * 0.08;
let tipAmount  = subtotal * 0.20;

function fmt(n) { return '$' + n.toFixed(2); }

function updateTotals() {
  document.getElementById('sumSubtotal').textContent = fmt(subtotal);
  document.getElementById('sumTax').textContent      = fmt(tax);
  document.getElementById('sumTip').textContent      = fmt(tipAmount);
  document.getElementById('sumTotal').textContent    = fmt(subtotal + tax + tipAmount);
}

function selectTip(btn) {
  document.querySelectorAll('.tip-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  const wrapper = document.getElementById('customTipWrapper');
  const val     = btn.dataset.tip;
  if (val === 'custom') {
    wrapper.classList.add('visible');
    document.getElementById('customTipInput').focus();
    tipAmount = parseFloat(document.getElementById('customTipInput').value) || 0;
  } else {
    wrapper.classList.remove('visible');
    tipAmount = subtotal * (parseInt(val) / 100);
  }
  updateTotals();
}

document.getElementById('customTipInput').addEventListener('input', function() {
  tipAmount = parseFloat(this.value) || 0;
  updateTotals();
});

function selectPickup(btn, type) {
  document.querySelectorAll('.pickup-option').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  const dropdown = document.getElementById('timePickerDropdown');
  if (type === 'scheduled') {
    dropdown.classList.remove('hidden');
    populateTimes();
  } else {
    dropdown.classList.add('hidden');
  }
}

function populateTimes() {
  const sel = document.getElementById('scheduledTime');
  if (sel.options.length > 0) return;
  const now = new Date();
  now.setMinutes(now.getMinutes() + 30);
  const m = now.getMinutes();
  now.setMinutes(m <= 30 ? 30 : 0);
  if (m > 30) now.setHours(now.getHours() + 1);
  const end = new Date(); end.setHours(17, 0, 0, 0);
  while (now <= end) {
    const h = now.getHours(), min = now.getMinutes();
    const label = `${h % 12 || 12}:${String(min).padStart(2,'0')} ${h >= 12 ? 'PM' : 'AM'}`;
    sel.appendChild(new Option(label, label));
    now.setMinutes(now.getMinutes() + 30);
  }
}

let currentPayment = 'credit';

function selectPayment(btn, type) {
  document.querySelectorAll('.payment-option').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  currentPayment = type;
  const orderBtn = document.getElementById('placeOrderBtn');
  orderBtn.textContent = type === 'apple' ? 'Pay with Apple Pay' : 'Place Order';
}

function generateOrderNumber() {
  return Math.floor(Math.random() * 99) + 1;
}

function getPickupTime() {
  const sel = document.getElementById('scheduledTime');
  const isScheduled = document.querySelector('.pickup-option.active')?.dataset?.pickup === 'scheduled';
  if (isScheduled && sel && sel.value) return sel.value;
  const now = new Date();
  now.setMinutes(now.getMinutes() + 15);
  const h = now.getHours(), m = now.getMinutes();
  return `${h % 12 || 12}:${String(m).padStart(2,'0')} ${h >= 12 ? 'PM' : 'AM'}`;
}

function saveOrderAndNavigate() {
  const orderNumber = generateOrderNumber();
  const pickupTime  = getPickupTime();
  const total       = subtotal + tax + tipAmount;

  const order = {
    orderNumber,
    pickupTime,
    subtotal: subtotal.toFixed(2),
    tax:      tax.toFixed(2),
    tip:      tipAmount.toFixed(2),
    total:    total.toFixed(2),
    items: [
      // Placeholder — PHP will pass real items via a data attribute or inline JSON
      { qty: 1, name: 'P.B. Banana', size: 'Medium', price: '6.50', details: 'Banana, Peanut Butter' }
    ]
  };

  localStorage.setItem('kcs_last_order', JSON.stringify(order));
  showToast('Order Placed', 'Your order has been placed successfully!', 'success');
  setTimeout(() => { window.location.href = 'confirmation.php'; }, 600);
}

function showToast(title, message, type = 'success') {
  let container = document.getElementById('toastContainer');
  if (!container) {
    container = document.createElement('div');
    container.id = 'toastContainer';
    container.className = 'toast-container';
    document.body.appendChild(container);
  }
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.innerHTML = `
    <div class="toast-content">
      <div class="toast-title">${title}</div>
      <div class="toast-message">${message}</div>
    </div>`;
  container.appendChild(toast);
  setTimeout(() => {
    toast.style.animation = 'slideIn 0.3s ease-out reverse';
    setTimeout(() => toast.remove(), 300);
  }, 3000);
}

document.getElementById('placeOrderBtn').addEventListener('click', function() {
  if (currentPayment === 'apple') {
    openApplePaySheet();
  } else {
    saveOrderAndNavigate();
  }
});

// ── Apple Pay ─────────────────────────────────────────────────────────────────
function openApplePaySheet() {
  const total = subtotal + tax + tipAmount;
  document.getElementById('apAmount').textContent = fmt(total);
  document.getElementById('apFaceIdSection').classList.remove('hidden');
  document.getElementById('apSuccessSection').classList.add('hidden');
  document.getElementById('apFaceIdRing').classList.remove('scanning', 'success');
  document.getElementById('apFaceIdLabel').textContent = 'Double-click to pay';
  document.getElementById('apFaceIdIcon').classList.remove('scanning');
  document.getElementById('apCancelBtn').classList.remove('hidden');
  document.getElementById('applePayOverlay').classList.add('active');
  setTimeout(simulateFaceIdScan, 600);
}

function simulateFaceIdScan() {
  const ring  = document.getElementById('apFaceIdRing');
  const icon  = document.getElementById('apFaceIdIcon');
  const label = document.getElementById('apFaceIdLabel');

  label.textContent = 'Scanning...';
  ring.classList.add('scanning');
  icon.classList.add('scanning');

  setTimeout(() => {
    ring.classList.remove('scanning');
    ring.classList.add('success');
    icon.classList.remove('scanning');

    setTimeout(() => {
      document.getElementById('apFaceIdSection').classList.add('hidden');
      document.getElementById('apCancelBtn').classList.add('hidden');
      document.getElementById('apSuccessSection').classList.remove('hidden');

      const circle    = document.querySelector('.ap-check-circle');
      const checkPath = document.querySelector('.ap-check-path');
      circle.style.strokeDasharray    = '176';
      circle.style.strokeDashoffset   = '176';
      checkPath.style.strokeDasharray  = '40';
      checkPath.style.strokeDashoffset = '40';

      requestAnimationFrame(() => requestAnimationFrame(() => {
        circle.style.transition        = 'stroke-dashoffset 0.4s ease';
        circle.style.strokeDashoffset  = '0';
        setTimeout(() => {
          checkPath.style.transition        = 'stroke-dashoffset 0.3s ease';
          checkPath.style.strokeDashoffset  = '0';
        }, 200);
      }));

      setTimeout(() => {
        closeApplePaySheet();
        setTimeout(() => { saveOrderAndNavigate(); }, 300);
      }, 1400);

    }, 300);
  }, 1800);
}

function closeApplePaySheet() {
  document.getElementById('applePayOverlay').classList.remove('active');
}

document.getElementById('apCancelBtn').addEventListener('click', closeApplePaySheet);
document.getElementById('applePayOverlay').addEventListener('click', function(e) {
  if (e.target === this) closeApplePaySheet();
});

updateTotals();
