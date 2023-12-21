<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/base.css?v=<?php echo time(); ?>" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/larger.css?v=<?php echo time(); ?>" media="screen">
    
    <title>Login Page</title>
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
        <h1>Login</h1>

        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
        ?>

        <form  method="POST" action="/phpmotors/accounts/index.php">
        <fieldset>
            <div class="form-group">
                <label class="top" for="clientEmail">Email: </label>
                <input type="email" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required>
            </div>
            <div class="form-group">
                <span>Min 8 characters, 1 uppercase, 1 number, 1 special character</span>
                <label class="top" for="clientPassword">Password: </label>
                <input type="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" id="clientPassword" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Login" class="submitButton">
                <input type="hidden" name="action" value="Login">
                <p>No account? <a href="/phpmotors/accounts/index.php?action=registerView">Sign-up!</a></p>
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
