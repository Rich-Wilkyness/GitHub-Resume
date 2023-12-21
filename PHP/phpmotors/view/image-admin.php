<?php
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
    
    <title>PHP Motors Image Management</title>
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
        <h1>Image Management</h1>
        <h2>Add New Vehicle Image</h2>
        <?php
        if (isset($message)) {
        echo $message;
        } ?>

        <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <fieldset class="vehicleImgManagement">
            <legend>Vehicle</legend>
            <div>
                <label for="invItem"></label>
                <?php echo $prodSelect; ?>
            </div>
            <div>
                <label>Is this the main image for the vehicle?</label>
            </div>
            <div class="radio-container">
                <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                <label for="priYes" class="pImage">Yes</label>
            </div>
            <div class="radio-container">
                <input type="radio" name="imgPrimary" id="priNo" class="pImage" value="0" checked>
                <label for="priNo" class="pImage">No</label>
            </div>
	        </fieldset>
          </div>
          <div class="form-group">
          <fieldset>
            <legend>Upload Image</legend>
          <input type="file" name="file1">
          </fieldset>
          <input type="submit" class="submitButton" value="Upload">
          <input type="hidden" name="action" value="upload">
          </div>
        </form>
        <hr>
        <h2>Existing Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
            echo $imageDisplay;
            } ?>
    </main>
    <footer id="page_footer">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
    </footer>
    </div>
</body>
</html><?php
    unset($_SESSION['message']); ?>