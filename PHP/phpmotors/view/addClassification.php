<?php 
    if(!$_SESSION['loggedin']) {
        header('Location: /phpmotors');
    }
    if($_SESSION['clientData']['clientLevel'] <= 2) {
        header('Location: /phpmotors');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/base.css?v=<?php echo time(); ?>" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/larger.css?v=<?php echo time(); ?>" media="screen">
    
    <title>PHP Motors Add Classification</title>
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
        <h1>Add Classification</h1>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>

        <form action="/phpmotors/vehicles/index.php" method="POST">
            <fieldset>
                <div class="form-group">
                    <span>Max 30 characters</span>
                    <label for="classificationName">Add new vehicle classification:</label>
                    <input type="text" id="classificationName" name="classificationName" max="30" required>    
                </div>
                <div class="form-group">
                    <input type="submit" value="Add New Classification" class="submitButton">
                    <input type="hidden" name="action" value="addClassification">
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
