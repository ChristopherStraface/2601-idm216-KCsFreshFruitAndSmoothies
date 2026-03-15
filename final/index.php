<?php include './database.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KC's Fresh Fruit and Smoothies</title>

    <!-- Fetch fonts and general CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles.css">
</head>
<body><div class="app-container">

    <?php include './component/header.php' ?>

    <main class="main-content"><div class="screen active">

        <!-- If there is an active receipt, provide an entry on the homepage -->
        <?php 
            if (isset($_SESSION['receipt'])) { 
                // Compose receipt summary
                $order_status_text = "Order #" . $_SESSION['receipt']["order_number"] . " - picking up at " . $_SESSION['receipt']["pick_up_time"];
        ?>
            <!-- Link to the receipt page -->
            <a href="./confirmation.php" class="order-status-banner" id="orderStatusBanner" style="text-decoration:none;">

                <div class="order-status-left">

                    <svg class="order-status-icon" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"/>
                        <path d="M12 7v5l3 3" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <!-- Print receipt summary -->
                    <span class="order-status-text" id="orderStatusText"><?= $order_status_text ?></span>

                </div>

                <svg class="order-status-chevron" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

            </a>

        <?php } ?>

        <!-- Display the truck's location -->
        <div class="location-banner">

            <svg class="banner-icon" viewBox="0 0 24 24" fill="none">
                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="white"/>
            </svg>

            <p class="banner-text">33rd St. &amp; Lancaster Walk</p>

        </div>

        <main class="welcome-section">

            <h2 class="welcome-title">What are you craving?</h2>

            <div class="welcome-hint">
                <p>👋 Tap any treat to customize!</p>
            </div>

            <div class="smoothie-grid">
            
                <?php foreach ($products as $product) { ?>

                    <!-- Link to the customization page -->
                    <a href="./customize.php?id=<?= $product['id'] ?>" class="smoothie-card" style="text-decoration:none;">

                        <div class="card-bg"></div>

                        <!-- Product image -->
                        <img src="./images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="smoothie-image">

                        <!-- Product name -->
                        <h3 class="smoothie-name"><?= $product['name'] ?></h3>

                    </a>

                <?php } ?>
            
            </div>

        </main>
        
    </div></main>

    <?php include './component/footer.php' ?> 

</div></body>
</html>
