<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/base.css?v=<?php echo time(); ?>" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/larger.css?v=<?php echo time(); ?>" media="screen">
    
    <title>PHP Motors Home Page</title>
</head>
<body>
    <div id="body">
    <header id="page_header">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?> 
    </header>
    
    <nav id="page_navigation">
        <?php // require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/navigation.php'; ?> 
        <?php echo $navList; ?>
    </nav>
    <main id="home-page">
        <h1>Welcome to PHP Motors!</h1>
        <section id="home-first">
            <div>
                <h2>DMC Delorean</h2>
                <p>3 Cup holders</p>
                <p>Superman doors</p>
                <p>Fuzzy dice!</p>
                <img src="images/own-today-120.webp" alt="Own Today Button">
            </div>
            <picture id="delorean-home">
                <source media="(max-width: 650px)" srcset="images/vehicles/DMC_DeLorean.jpg">
                <img srcset="images/vehicles/DMC_DeLorean.jpg" alt="Delorean Image" width="908" height="463" loading="lazy">
            </picture>
            <picture>
                <source media="(max-width: 650px)" srcset="images/own-today-120.webp">
                <img src="images/own-today-240.webp" alt="Own Today Button" width="240" height="72" loading="lazy">
            </picture>
        </section>
        <section id="home-second">
            <h3>DMC Delorean Reviews</h3>
            <ul>
                <li>"So fast its almost like traveling in time." (4/5)</li>
                <li>"Coolest ride on the road." (4/5)</li>
                <li>"I'm feeling Marty McFly!" (5/5)</li>
                <li>"The most futuristic ride of our day." (4.5/5)</li>
                <li>"80's livin and I love it!" (5/5)</li>
            </ul>
        </section>
        <section id="home-third">
            <h3>Delorean Upgrades</h3>
            <div class="home-upgrades"><div class="home-upgrades-color"><img src="images/flux-cap.webp" alt="Flux capacitor image"></div><p>Flux Capacitor</p></div>
            <div class="home-upgrades"><div class="home-upgrades-color"><img src="images/flame.webp" alt="Flame decals image"></div><p>Flame Decals</p></div>
            <div class="home-upgrades"><div class="home-upgrades-color"><img src="images/bumper-sticker.webp" alt="Bumper stickers image"></div><p>Bumper Stickers</p></div>
            <div class="home-upgrades"><div class="home-upgrades-color"><img src="images/hub-cap.webp" alt="Hub caps image"></div><p>Hub Caps</p></div>
        </section>
    </main>
    <footer id="page_footer">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
    </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']); ?>
