<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/base.css?v=<?php echo time(); ?>" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/larger.css?v=<?php echo time(); ?>" media="screen">
    
    <title>PHP Motors Registration</title>
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
    <main id="login-register-main">
        <h1>Register: </h1>

    <?php
        if (isset($message)) {
            echo $message;
        }
    ?>

        <form method="POST" action="/phpmotors/accounts/index.php">
        <fieldset>
            <div class="form-group">
                <label class="top" for="clientFirstname">First Name*: </label>
                <input type="text" name="clientFirstname" id="fname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required>
            </div>
            <div class="form-group">
                <label class="top" for="clientLastname">Last Name*: </label>
                <input type="text" name="clientLastname" id="lname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} ?> required>
            </div>
            <div class="form-group">
                <label class="top" for="clientEmail">Email*: </label>
                <input type="email" name="clientEmail" id="email" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
            </div>
            <div class="form-group">
                <span>Min 8 characters, 1 uppercase, 1 number, 1 special character</span>
                <label class="top" for="clientPassword">Password*: </label>
                <input type="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" id="password" required> 
            </div>
            <div class="form-group">
                <input type="submit" value="Register My Account" class="submitButton">
                <input type="hidden" name="action" value="register">
            </div>
        </fieldset>
            
        </form>
    </main>
    <footer id="page_footer">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
    </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']); ?>
