<?php function add_icons($content) {
    switch ($content) {
        case "bag":
?>

    <svg class="icon" viewBox="0 0 32 32" fill="none">
        <path d="M25.3333 9.33333H22.6667V8C22.6667 4.68629 19.9804 2 16.6667 2H15.3333C12.0196 2 9.33333 4.68629 9.33333 8V9.33333H6.66667C5.19391 9.33333 4 10.5272 4 12V26.6667C4 28.1394 5.19391 29.3333 6.66667 29.3333H25.3333C26.8061 29.3333 28 28.1394 28 26.6667V12C28 10.5272 26.8061 9.33333 25.3333 9.33333ZM12 8C12 6.15905 13.4924 4.66667 15.3333 4.66667H16.6667C18.5076 4.66667 20 6.15905 20 8V9.33333H12V8Z" fill="#1A1A1A"/>
    </svg>

<?php 
        break;
    case "profile":
?>

    <svg class="icon" viewBox="0 0 32 32" fill="none">
        <path d="M16 4C12.6863 4 10 6.68629 10 10C10 13.3137 12.6863 16 16 16C19.3137 16 22 13.3137 22 10C22 6.68629 19.3137 4 16 4ZM7.33333 24C7.33333 20.3181 10.3181 17.3333 14 17.3333H18C21.6819 17.3333 24.6667 20.3181 24.6667 24V26.6667C24.6667 27.403 24.0697 28 23.3333 28H8.66667C7.93029 28 7.33333 27.403 7.33333 26.6667V24Z" fill="#1A1A1A"/>
    </svg>

<?php 
        break;
    case "clock":
?>

    <svg class="order-status-icon" viewBox="0 0 24 24" fill="none">
        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
        <path d="M12 7v5l3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>

<?php 
        break;
    case "right_chevron":
?>

    <svg class="order-status-chevron" viewBox="0 0 24 24" fill="none">
        <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>

<?php 
        break;
    case "location":
?>

    <svg class="banner-icon" viewBox="0 0 24 24" fill="none">
        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="white"/>
    </svg>

<?php 
        break;
    case "smoothie":
?>

    <svg class="nav-icon" viewBox="0 0 32 32" fill="none">
        <line x1="19" y1="4" x2="15" y2="13" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
        <path d="M8 13H24L21.5 25.5C21.2 26.9 19.9 28 18.5 28H13.5C12.1 28 10.8 26.9 10.5 25.5L8 13Z" fill="currentColor" fill-opacity="0.15" stroke="currentColor" stroke-width="2.2" stroke-linejoin="round"/>
        <path d="M6.5 11C6.5 10.17 7.17 9.5 8 9.5H24C24.83 9.5 25.5 10.17 25.5 11V13H6.5V11Z" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
        <circle cx="13.5" cy="20" r="1.5" fill="currentColor" opacity="0.7"/>
        <circle cx="18" cy="22.5" r="1.2" fill="currentColor" opacity="0.7"/>
        <circle cx="16" cy="18" r="1" fill="currentColor" opacity="0.5"/>
    </svg>

<?php 
        break;
    case "history":
?>

    <svg class="nav-icon" viewBox="0 0 32 32" fill="none">
        <path d="M16 6V16L22 19" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        <circle cx="16" cy="16" r="10" stroke="currentColor" stroke-width="2.5" fill="none"/>
    </svg>

<?php 
        break;
    case "left_chevron":
?>

    <svg viewBox="0 0 36 36" fill="none" style="width:36px;height:36px;">
        <path d="M22.5 9L13.5 18L22.5 27" stroke="#1A1A1A" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
    </svg>

<?php 
        break;
    case "edit":
?>

    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
    </svg>

<?php 
        break;
    case "credit_card":
?>

    <svg class="payment-icon" viewBox="0 0 36 24" fill="none">
        <path d="M3 0C1.34315 0 0 1.34315 0 3V21C0 22.6569 1.34315 24 3 24H33C34.6569 24 36 22.6569 36 21V3C36 1.34315 34.6569 0 33 0H3ZM0 6H36V8H0V6ZM4 14H12V16H4V14Z" fill="#1A1A1A"/>
    </svg>

<?php 
        break;
    case "apple":
?>

    <svg viewBox="-3 5 22 22" fill="none" width="18" height="18">
        <path d="M17.23 18.27C16.89 19.09 16.48 19.84 16 20.52C15.32 21.48 14.77 22.13 14.36 22.46C13.69 23.05 12.97 23.35 12.19 23.36C11.64 23.36 10.97 23.2 10.19 22.87C9.4 22.55 8.68 22.39 8.02 22.39C7.33 22.39 6.59 22.55 5.8 22.87C5.01 23.2 4.37 23.37 3.88 23.38C3.13 23.4 2.4 23.09 1.69 22.46C1.24 22.09 0.66 21.42 0 20.45C-0.71 19.4 -1.28 18.18 -1.72 16.79C-2.19 15.26 -2.43 13.79 -2.43 12.38C-2.43 10.76 -2.11 9.36 -1.47 8.19C-0.97 7.27 -0.29 6.55 0.57 6.02C1.43 5.49 2.38 5.22 3.42 5.21C4 5.21 4.75 5.39 5.67 5.74C6.58 6.09 7.17 6.27 7.43 6.27C7.62 6.27 8.28 6.06 9.39 5.64C10.44 5.25 11.34 5.09 12.08 5.15C14.03 5.3 15.5 6.07 16.47 7.47C14.77 8.54 13.93 10.02 13.95 11.92C13.97 13.42 14.5 14.68 15.54 15.68C16.01 16.15 16.54 16.51 17.14 16.77C17.01 17.15 16.87 17.51 16.72 17.86L17.23 18.27Z" fill="#1A1A1A"/>
    </svg>

<?php 
        break;
    case "apple_pay":
?>

    <svg viewBox="-3 2 21 22" fill="none" class="ap-apple-icon">
        <path d="M17.23 18.27C16.89 19.09 16.48 19.84 16 20.52C15.32 21.48 14.77 22.13 14.36 22.46C13.69 23.05 12.97 23.35 12.19 23.36C11.64 23.36 10.97 23.2 10.19 22.87C9.4 22.55 8.68 22.39 8.02 22.39C7.33 22.39 6.59 22.55 5.8 22.87C5.01 23.2 4.37 23.37 3.88 23.38C3.13 23.4 2.4 23.09 1.69 22.46C1.24 22.09 0.66 21.42 0 20.45C-0.71 19.4 -1.28 18.18 -1.72 16.79C-2.19 15.26 -2.43 13.79 -2.43 12.38C-2.43 10.76 -2.11 9.36 -1.47 8.19C-0.97 7.27 -0.29 6.55 0.57 6.02C1.43 5.49 2.38 5.22 3.42 5.21C4 5.21 4.75 5.39 5.67 5.74C6.58 6.09 7.17 6.27 7.43 6.27C7.62 6.27 8.28 6.06 9.39 5.64C10.44 5.25 11.34 5.09 12.08 5.15C14.03 5.3 15.5 6.07 16.47 7.47C14.77 8.54 13.93 10.02 13.95 11.92C13.97 13.42 14.5 14.68 15.54 15.68C16.01 16.15 16.54 16.51 17.14 16.77C17.01 17.15 16.87 17.51 16.72 17.86L17.23 18.27Z" fill="white" transform="translate(0 -3)"/>
    </svg>

<?php 
        break;
    case "visa":
?>

    <svg class="ap-visa" viewBox="0 0 48 16" fill="none">
        <text x="0" y="14" font-family="Arial" font-size="16" font-weight="bold" fill="white">VISA</text>
    </svg>

<?php 
        break;
    case "face_id":
?>

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

<?php 
        break;
    case "apple_pay_success":
?>

    <svg viewBox="0 0 60 60" fill="none" class="ap-check-svg">
        <circle cx="30" cy="30" r="28" stroke="white" stroke-width="3" fill="none" class="ap-check-circle"/>
        <path d="M16 30 L25 40 L44 20" stroke="white" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" class="ap-check-path"/>
    </svg>

<?php 
        break;
    case "confirm_pickup":
?>

    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <path d="M12 6v6l4 2"/>
    </svg>

<?php 
        break;
    case "check":
?>

    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:18px;height:18px;flex-shrink:0;">
        <path d="M20 6L9 17l-5-5"/>
    </svg>

<?php 
        break;
    default: return "";
} } 
?>
