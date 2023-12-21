<?php 
    if(!$_SESSION['loggedin']) {
        header('Location: /phpmotors');
    }
    if($_SESSION['clientData']['clientLevel'] <= 2) {
        header('Location: /phpmotors');
        exit;
    }
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/base.css?v=<?php echo time(); ?>" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/larger.css?v=<?php echo time(); ?>" media="screen">
    
    <title>PHP Motors Vehicle Management</title>
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
        <h1>Vehicle Management</h1>

        <?php
            if (isset($message)) {
                echo $message;
            }
            if (isset($classificationList)) {
                echo '<h2>Vehicles By Classification</h2>';
                echo '<p>Choose a classification to view the vehicles in that classification.</p>';
                echo $classificationList;
            }
        ?>
        <noscript>
            <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
        </noscript>
        <table id="inventoryDisplay"></table>

        <div class="vehicle-management-div">
            <p>Add Classification:</p>
            <a href="/phpmotors/vehicles/index.php?action=addClassificationView"><img src="/phpmotors/images/icons8-wheel-50.png" alt="Wheel icon" class="imgButton"></a>
        </div>
        <div class="vehicle-management-div">
            <p>Add Vehicle: </p>
            <a href="/phpmotors/vehicles/index.php?action=addVehicleView"><img src="/phpmotors/images/icons8-vehicle-50.png" alt="Vehicle icon" class="imgButton"></a>
        </div>
    </main>
    <footer id="page_footer">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
    </footer>
    </div>
    <script src="../js/inventory.js"></script>
</body>
</html><?php unset($_SESSION['message']); ?>
