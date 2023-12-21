<?php 
    if(!$_SESSION['loggedin']) {
        header('Location: /phpmotors');
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/base.css?v=<?php echo time(); ?>" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/larger.css?v=<?php echo time(); ?>" media="screen">
    
    <title>PHP Motors Admin Landing Page</title>
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
    <main id="admin-main">
    <?php
        if (isset($passwordMessage)) {
            echo $passwordMessage;
        } elseif (isset($_SESSION['passwordMessage'])) {
            echo $_SESSION['passwordMessage'];
            unset($_SESSION['passwordMessage']);
        }
        ?>
        <?php
            if (isset($_SESSION['loggedin'])) {
                echo "<h1>{$_SESSION['clientData']['clientFirstname']} {$_SESSION['clientData']['clientLastname']}</h1>";
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                echo "<ul>
                        <li>First Name: {$_SESSION['clientData']['clientFirstname']}</li>
                        <li>Last Name: {$_SESSION['clientData']['clientLastname']}</li>
                        <li>Email: {$_SESSION['clientData']['clientEmail']}</li>
                    </ul>";
                if ($_SESSION['clientData']['clientLevel'] > 1) {
                    echo "<p>Administer Inventory</p>";
                    echo "<a href='/phpmotors/vehicles'>Vehicle Management</a>";
                }
            }
        ?>
        <a href="/phpmotors/accounts?action=editAccount&clientId=<?php if(isset($_SESSION['clientData']['clientId'])){ echo $_SESSION['clientData']['clientId'];} ?>">Edit Account</a>
        
    </main>
    <footer id="page_footer">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
    </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']); ?>
