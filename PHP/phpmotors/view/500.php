<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\phpmotors\css\base.css?v=<?php echo time(); ?>" media="screen">
    <link rel="stylesheet" href="\phpmotors\css\larger.css?v=<?php echo time(); ?>" media="screen">
    
    <title>PHP Motors Error 500</title>
</head>
<body>
    <div id="body">
    <header id="page_header">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?> 
    </header>
    <nav id="page_navigation">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/navigation.php'; ?> 
    </nav>
    <main>
        <h1>Server Error</h1>
        <p>Sorry our server seems to be experiencing some technical difficulties</p>
    </main>
    <footer id="page_footer">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
    </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']); ?>
