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
    
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?> | PHP Motors</title>
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
        <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Delete $invMake $invModel"; }?></h1>

        <p>Confirm Vehicle Deletion. The delete is permanent.</p>
        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        
        <form action="/phpmotors/vehicles/index.php" method="POST">
            <fieldset>
                <div class="form-group">
                    <label class="top" for="invMake">Vehicle Make:</label>
                    <input type="text" name="invMake" id="invMake" readonly <?php if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?>>

                    <label class="top" for="invModel">Vehicle Model:</label>   
                    <input type="text" name="invModel" id="invModel" readonly <?php if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }  ?>> 

                    <label class="top" for="invDescription">Vehicle Description:</label>
                    <textarea name="invDescription" id="invDescription" rows="4" cols="50" readonly><?php if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?></textarea>
                    <!-- To display the value of a variable in a textarea element, it must be echoed between the opening and closing tags with no extra spaces or line breaks between the html opening and closing tags and the PHP code block between them. -->

                </div>
                <div class="form-group">
                    <input type="submit" value="Delete Vehicle" class="submitButton">
                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} ?>">
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
