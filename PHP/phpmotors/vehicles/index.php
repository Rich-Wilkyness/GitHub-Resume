<?php
// vehicles controller
// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';

$classifications = getClassifications();

$navList = buildNav($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'addVehicleView':
        include '../view/addVehicle.php';
        break;
    case 'addClassificationView':
        include '../view/addClassification.php';
        break;
    case 'addVehicle':
        // Filter and store the data
        $classificationId = trim(filter_input(INPUT_POST, 'classificationId'));
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // Check for missing data

        $checkPrice = checkPrice($invPrice);

        if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($checkPrice) || empty($invColor)) {
            $message = "<p class='message'>Please provide information for all empty form fields.</p>";
            include '../view/addVehicle.php';
            exit; 
        }

        //send data to model
        $addVehicle = newVehicle($classificationId, $invMake, $invModel, $invDescription, $invPrice, $invColor);
        // report result
        if ($addVehicle === 1) {
            $message = "<p class='message'>Thanks for adding new vehicle $invMake $invModel.</p>";
            include '../view/addVehicle.php';
            exit;
        } else {
            $message = "<p class='message'>Sorry $invMake $invModel failed to be added. Please try again.<p/>";
            include '../view/addVehicle.php';
            exit;
        }
        break;

    case 'addClassification':
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        if(empty($classificationName)) {
            $message = "<p class='message'>Please provide information for all empty form fields.</p>";
            include '../view/addClassification.php';
            exit; 
        }
        $addClassification = newClassification($classificationName);
        if($addClassification === 1) {
            $classifications = getClassifications();
            $navList = buildNav($classifications);
            include '../view/vehicleManagement.php';
            exit;
        } else {
            $message = "<p class='message'>Sorry $classificationName failed to be added. Please try again.<p/>";
            include '../view/addClassification.php';
            exit;
        }
        break;
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 

        echo json_encode($inventoryArray); 
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo) < 1) {
            $message = "<p class='message'>Sorry, no vehicle information could be found. Please try again.<p/>";
            include '../view/vehicleManagement.php';
        } else {
            include '../view/vehicle-update.php';
            exit;
        }
        break;
    case 'updateVehicle':
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $classificationId = trim(filter_input(INPUT_POST, 'classificationId'));
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // Check for missing data

        $checkPrice = checkPrice($invPrice);

        if(empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($checkPrice) || empty($invColor)) {
            $message = "<p class='message'>Please provide information for all empty form fields.</p>";
            include '../view/addVehicle.php';
            exit; 
        }
        if(empty($invId)) {
            $message = "<p class='message'>Sorry, no vehicle information could be found. Please try again.<p/>";
            include '../view/vehicleManagement.php';
            exit;
        }
        //send data to model
        $updateVehicle = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invPrice, $invColor, $invId);
        // report result
        if ($updateVehicle === 1) {
            $message = "<p class='message'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='message'>Sorry $invMake $invModel failed to be updated. Please try again.<p/>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo) < 1) {
            $message = "<p class='message'>Sorry, no vehicle information could be found. Please try again.<p/>";
            include '../view/vehicleManagement.php';
        } else {
            include '../view/vehicle-delete.php';
            exit;
        }
        break;
    case 'deleteVehicle':
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        // Check for missing data

        if(empty($invId)) {
            $message = "<p class='message'>Invalid vehicle ID.</p>";
            include '../view/vehicleManagement.php';
            exit; 
        }
        //send data to model
        $deleteVehicle = deleteVehicle($invId);
        // report result
        if ($deleteVehicle === 1) {
            $message = "<p class='message'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='message'>Sorry $invMake $invModel failed to be deleted. Please try again.<p/>";
            include '../view/vehicle-update.php';
            exit;
        }
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);
        if (!count($vehicles)) {
            $message = "<p class='message'>Sorry, no vehicle information could be found. Please try again.<p/>";
        } else {
            $vehiclesDisplay = buildVehiclesDisplay($vehicles);
        }
        include '../view/classificationView.php';
        break;
    case 'buildVehicleDisplay':
        $invId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicleData = getInvItemInfo($invId);
        $vehicleThumbnails = getThumbnailPathsByVehicleId($invId);
        if (!count($vehicleData)) {
            $message = "<p class='message'>Sorry, no vehicle information could be found. Please try again.<p/>";
        } else {
            $vehicleDisplay = buildVehicleDisplay($vehicleData);
            if (!count($vehicleThumbnails)) {
                $thumbnailDisplay = null;
            } else {
                $thumbnailDisplay = buildThumbnailDisplay($vehicleThumbnails);
            }
        }
        include '../view/vehicleView.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicleManagement.php';
        break;
}

