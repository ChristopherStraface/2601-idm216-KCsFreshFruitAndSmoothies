<?php include "./include/database.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>
    <?php include "./include/styles.php" ?>
</head>
<body>
<div class="app-container">

    <?php include "./components/header.php" ?>

    <main class="main-content">
        <div class="screen active">

            <?php if ($_SESSION["receipt"] != $receipt_default) { ?>

            <a href="./confirmation.php" class="order-status-banner visible" id="orderStatusBanner" style="text-decoration:none;">
                <div class="order-status-left">
                    <?php add_icons("clock") ?>
                    <span class="order-status-text" id="orderStatusText">KC is preparing your order</span>
                </div>
                <?php add_icons("right_chevron") ?>
            </a>

            <?php } ?>

            <div class="location-banner">
                <?php add_icons("location") ?>
                <p class="banner-text">33rd St. &amp; Lancaster Walk</p>
            </div>

            <div class="welcome-section">
                <h2 class="welcome-title">What are you craving?</h2>
                <div class="welcome-hint"><p>👋 Tap any treat to customize!</p></div>
                <div class="smoothie-grid">

                <?php foreach ($products as $product) { ?>

                    <a href="./customize.php?id=<?= $product["id"] ?>" class="smoothie-card" style="text-decoration:none;">
                        <div class="card-bg"></div>
                        <img src="../images/<?= $product["image"] ?>" alt="<?= $product["name"] ?>" class="smoothie-image">
                        <h3 class="smoothie-name"><?= $product["name"] ?></h3>
                    </a>
                
                <?php } ?>

                </div>
            </div>
        </div>
    </main>

    <?php include "./components/footer.php" ?>

</div>
</body>
</html>