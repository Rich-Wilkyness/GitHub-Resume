<?php 
if(!$_SESSION['loggedin']) {
    header('Location: /phpmotors');
}
if($_SESSION['clientData']['clientLevel'] <= 2) {
    header('Location: /phpmotors');
    exit;
}
$classificationList = "<select id='classificationId' name='classificationId'>";
$classificationList .= "<option> Choose a Classification</option>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)) {
        if($classification['classificationId'] == $classificationId) {
            $classificationList .= ' selected ';
        } 
    } elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
            $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .='</select>';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/base.css?v=<?php echo time(); ?>" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/larger.css?v=<?php echo time(); ?>" media="screen">
    
    <title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?></title>
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
		echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
	elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?></h1>

        <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
        
        <form action="/phpmotors/vehicles/index.php" method="POST">
            <fieldset>
                <div class="form-group">
                    <?php echo $classificationList; ?>
                </div>
                <div class="form-group">
                    <label class="top" for="invMake">Vehicle Make:</label>
                    <input type="text" name="invMake" id="invMake" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; } ?> required>

                    <label class="top" for="invModel">Vehicle Model:</label>   
                    <input type="text" name="invModel" id="invModel" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }  ?> required> 

                    <label class="top" for="invDescription">Vehicle Description:</label>
                    <textarea name="invDescription" id="invDescription" rows="4" cols="50" required><?php if(isset($invDescription) && !empty($invDescription)){echo "$invDescription";}  elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; } ?></textarea>
                    <!-- To display the value of a variable in a textarea element, it must be echoed between the opening and closing tags with no extra spaces or line breaks between the html opening and closing tags and the PHP code block between them. -->

                    <label class="top" for="invImage">Upload Vehicle Image:</label>
                    <input type="file" name="invImage" id="invImage" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }  ?> required>

                    <label class="top" for="invThumbnail">Upload Vehicle Thumbnail:</label>
                    <input type="file" name="invThumbnail" id="invThumbnail" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; } ?> required>

                    <label class="top" for="invPrice">Vehicle Price:</label>
                    <input type="number" name="invPrice" id="invPrice" placeholder="$" step=".01" min="0" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; } ?> required>

                    <label class="top" for="invColor">Vehicle Color:</label>
                    <input type="text" name="invColor" id="invColor" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; } ?> required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Update Vehicle" class="submitButton">
                    <input type="hidden" name="action" value="updateVehicle">
                    <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                        elseif(isset($invId)){ echo $invId; } ?>">
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
