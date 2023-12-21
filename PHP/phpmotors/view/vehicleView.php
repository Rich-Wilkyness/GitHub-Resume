<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/base.css?v=<?php echo time(); ?>" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/larger.css?v=<?php echo time(); ?>" media="screen">
    
    <title><?php echo "$vehicleData[invMake] $vehicleData[invModel]"; ?> | PHP Motors, Inc.

</title>
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
    <main>
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
            if (isset($message)) {
                echo $message;
            }
            if (isset($vehicleDisplay) && isset($thumbnailDisplay)) {
                // Use CSS media queries to control the layout
                echo '<div class="vehicle-layout">';
                echo '<div class="vehicle-info">';
                echo $vehicleDisplay;
                echo '</div>';
                echo '<div class="vehicle-thumbnails">';
                echo $thumbnailDisplay;
                echo '</div>';
                echo '</div>';
            } else if (isset($vehicleDisplay)) {
                echo $vehicleDisplay;
            }
        ?>

    </main>
    <footer id="page_footer">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
    </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']); ?>
