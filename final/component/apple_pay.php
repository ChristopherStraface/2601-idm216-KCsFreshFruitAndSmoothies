<div id="applePayOverlay">
    <div id="applePaySheet">
        <div class="ap-topbar"><div class="ap-notch"></div></div>
        <div class="ap-header">
            <div class="ap-logo">
                <svg viewBox="-3 2 21 22" fill="none" class="ap-apple-icon">
                    <path d="M17.23 18.27C16.89 19.09 16.48 19.84 16 20.52C15.32 21.48 14.77 22.13 14.36 22.46C13.69 23.05 12.97 23.35 12.19 23.36C11.64 23.36 10.97 23.2 10.19 22.87C9.4 22.55 8.68 22.39 8.02 22.39C7.33 22.39 6.59 22.55 5.8 22.87C5.01 23.2 4.37 23.37 3.88 23.38C3.13 23.4 2.4 23.09 1.69 22.46C1.24 22.09 0.66 21.42 0 20.45C-0.71 19.4 -1.28 18.18 -1.72 16.79C-2.19 15.26 -2.43 13.79 -2.43 12.38C-2.43 10.76 -2.11 9.36 -1.47 8.19C-0.97 7.27 -0.29 6.55 0.57 6.02C1.43 5.49 2.38 5.22 3.42 5.21C4 5.21 4.75 5.39 5.67 5.74C6.58 6.09 7.17 6.27 7.43 6.27C7.62 6.27 8.28 6.06 9.39 5.64C10.44 5.25 11.34 5.09 12.08 5.15C14.03 5.3 15.5 6.07 16.47 7.47C14.77 8.54 13.93 10.02 13.95 11.92C13.97 13.42 14.5 14.68 15.54 15.68C16.01 16.15 16.54 16.51 17.14 16.77C17.01 17.15 16.87 17.51 16.72 17.86L17.23 18.27Z" fill="white" transform="translate(0 -3)"/>
                </svg>
                <span>Pay</span>
            </div>
            <div class="ap-merchant">KC's Fresh Fruit &amp; Smoothies</div>
            <div class="ap-amount" id="apAmount">$0.00</div>
        </div>
        <div class="ap-card-section">
            <div class="ap-card">
                <div class="ap-card-top">
                    <div class="ap-card-bank">Chase</div>
                    <div class="ap-card-chip"></div>
                </div>
                <div class="ap-card-bottom">
                    <div class="ap-card-dots">•••• •••• •••• 4242</div>
                    <svg class="ap-visa" viewBox="0 0 48 16" fill="none">
                        <text x="0" y="14" font-family="Arial" font-size="16" font-weight="bold" fill="white">VISA</text>
                    </svg>
                </div>
            </div>
            <div class="ap-card-label">Visa ···· 4242</div>
        </div>
        <div class="ap-faceid-section" id="apFaceIdSection">
            <div class="ap-faceid-ring" id="apFaceIdRing">
                <div class="ap-faceid-icon" id="apFaceIdIcon">
                    <svg viewBox="0 0 80 80" fill="none" class="ap-faceid-svg">
                        <path d="M10 25 L10 10 L25 10" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M55 10 L70 10 L70 25" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M70 55 L70 70 L55 70" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M25 70 L10 70 L10 55" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="29" cy="34" r="3" fill="white"/>
                        <circle cx="51" cy="34" r="3" fill="white"/>
                        <path d="M40 38 L37 46 L43 46" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                        <path d="M32 52 Q40 58 48 52" stroke="white" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                    </svg>
                </div>
            </div>
            <p class="ap-faceid-label" id="apFaceIdLabel">Double-click to pay</p>
        </div>
        <div class="ap-success-section hidden" id="apSuccessSection">
            <div class="ap-success-ring">
                <svg viewBox="0 0 60 60" fill="none" class="ap-check-svg">
                    <circle cx="30" cy="30" r="28" stroke="white" stroke-width="3" fill="none" class="ap-check-circle"/>
                    <path d="M16 30 L25 40 L44 20" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" class="ap-check-path"/>
                </svg>
            </div>
            <p class="ap-success-label">Done</p>
        </div>
        <button class="ap-cancel-btn" id="apCancelBtn">Cancel</button>
    </div>

    <script>
        const subtotal = <?= number_format($subtotal, 2) ?>;
        const tax = <?= number_format($tax, 2) ?>;

        function fmt(n) { return '$' + n.toFixed(2); }
        function saveOrderAndNavigate() {
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

        let currentPayment = 'credit';

        function selectPayment(btn, type) {
            document.querySelectorAll('.payment-option').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentPayment = type;
            const orderBtn = document.getElementById('placeOrderBtn');
            orderBtn.textContent = type === 'apple' ? 'Pay with Apple Pay' : 'Place Order';
        }

        document.getElementById('placeOrderBtn').addEventListener('click', function() {
            if (currentPayment === 'apple') {
                openApplePaySheet();
            } else {
                saveOrderAndNavigate();
            }
        });

        function openApplePaySheet() {
            const total = subtotal + tax;
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
            const ring    = document.getElementById('apFaceIdRing');
            const icon    = document.getElementById('apFaceIdIcon');
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

                    const circle        = document.querySelector('.ap-check-circle');
                    const checkPath = document.querySelector('.ap-check-path');
                    circle.style.strokeDasharray        = '176';
                    circle.style.strokeDashoffset     = '176';
                    checkPath.style.strokeDasharray    = '40';
                    checkPath.style.strokeDashoffset = '40';

                    requestAnimationFrame(() => requestAnimationFrame(() => {
                        circle.style.transition                = 'stroke-dashoffset 0.4s ease';
                        circle.style.strokeDashoffset    = '0';
                        setTimeout(() => {
                            checkPath.style.transition                = 'stroke-dashoffset 0.3s ease';
                            checkPath.style.strokeDashoffset    = '0';
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

        // updateTotals();
    </script>
</div>
