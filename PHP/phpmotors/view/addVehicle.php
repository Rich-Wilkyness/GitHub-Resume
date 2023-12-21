<?php 
if(!$_SESSION['loggedin']) {
    header('Location: /phpmotors');
}
if($_SESSION['clientData']['clientLevel'] <= 2) {
    header('Location: /phpmotors');
    exit;
}
$classificationList = "<label class='top' for='classificationId'>Vehicle Classification:</label> <select id='classificationId' name='classificationId'>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)) {
        if($classification['classificationId'] === $classificationId) {
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
    
    <title>PHP Motors Add Vehicle</title>
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
        <h1>Add Vehicle</h1>

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
                    <input type="text" name="invMake" id="invMake" <?php if(isset($invMake)){echo "value='$invMake'";}  ?> required>

                    <label class="top" for="invModel">Vehicle Model:</label>   
                    <input type="text" name="invModel" id="invModel" <?php if(isset($invModel)){echo "value='$invModel'";}  ?> required> 

                    <label class="top" for="invDescription">Vehicle Description:</label>
                    <textarea name="invDescription" id="invDescription" rows="4" cols="50" required><?php if(isset($invDescription) && !empty($invDescription)){echo "$invDescription";}  ?></textarea>
                    <!-- To display the value of a variable in a textarea element, it must be echoed between the opening and closing tags with no extra spaces or line breaks between the html opening and closing tags and the PHP code block between them. -->

                    <label class="top" for="invPrice">Vehicle Price:</label>
                    <input type="number" name="invPrice" id="invPrice" placeholder="$" step=".01" min="0" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required>

                    <label class="top" for="invColor">Vehicle Color:</label>
                    <input type="text" name="invColor" id="invColor" <?php if(isset($invColor)){echo "value='$invColor'";}  ?> required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Add New Vehicle" class="submitButton">
                    <input type="hidden" name="action" value="addVehicle">
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
