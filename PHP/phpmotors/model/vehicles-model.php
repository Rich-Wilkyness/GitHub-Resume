<?php
// vehicle model

// add new classification to classifications table
function newClassification($classificationName) {
    $db = phpmotorsConnect();

    $sql = 'INSERT INTO carclassification (classificationName)
    VALUES (:classificationName)';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

    $stmt->execute();

    $rowsChanged = $stmt->rowCount();

    $stmt->closeCursor();

    return $rowsChanged;
}

// add new vehicle to inventory table
function newVehicle($classificationId, $invMake, $invModel, $invDescription, $invPrice, $invStock, $invColor) {
    $db = phpmotorsConnect();

    $sql = 'INSERT INTO inventory (classificationId, invMake, invModel, invDescription, invPrice, invColor)
    VALUES (:classificationId, :invMake, :invModel, :invDescription, :invPrice, :invColor)';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);

    $stmt->execute();

    $rowsChanged = $stmt->rowCount();

    $stmt->closeCursor();

    return $rowsChanged;
}

// get vehicles by classificationId
function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect(); 
    $sql = 'SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
}
function getVehiclesByClassification($classificationName){ 
    $db = phpmotorsConnect(); 
    $sql = 'SELECT inventory.*, images.imgPath AS primaryThumbnail
            FROM inventory
            JOIN images ON inventory.invId = images.invId
            WHERE inventory.classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)
            AND images.imgName LIKE "%-tn%"';
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR); 
    $stmt->execute(); 
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $vehicles;
}

// get vehicle info by id
function getInvItemInfo($invId) {
    $db = phpmotorsConnect(); 
    $sql = 'SELECT inventory.*, images.imgPath as largePrimaryImage
            FROM inventory
            LEFT JOIN images ON inventory.invId = images.invId
            WHERE inventory.invId = :invId';
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR); 
    $stmt->execute(); 
    $inventory = $stmt->fetch(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
}

// update vehicle info
function updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invPrice, $invColor, $invId) {
    $db = phpmotorsConnect();

    $sql = 'UPDATE inventory SET classificationId=:classificationId, invMake=:invMake, invModel=:invModel, invDescription=:invDescription, invPrice=:invPrice, invColor=:invColor WHERE invId=:invId';

    $stmt = $db->prepare($sql);

    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);

    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);

    $stmt->execute();

    $rowsChanged = $stmt->rowCount();

    $stmt->closeCursor();

    return $rowsChanged;
}

function deleteVehicle($invId) {
    $db = phpmotorsConnect(); 
    $sql = 'DELETE FROM inventory WHERE invId = :invId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR); 
    $stmt->execute(); 
    $rowsChanged = $stmt->rowCount(); 
    $stmt->closeCursor(); 
    return $rowsChanged; 
}

// Get information for all vehicles
function getVehicles(){
	$db = phpmotorsConnect();
	$sql = 'SELECT invId, invMake, invModel FROM inventory';
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$stmt->closeCursor();
	return $invInfo;
}