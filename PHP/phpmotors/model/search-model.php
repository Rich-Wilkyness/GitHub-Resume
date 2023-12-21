<?php
//search model

function searchDatabase($searchText){
    $db = phpmotorsConnect(); 

    // Use the MATCH and AGAINST operators for full-text search
    $sql = 'SELECT *
            FROM inventory 
            WHERE MATCH (invMake, invModel, invDescription, invColor) 
            AGAINST (:searchText IN NATURAL LANGUAGE MODE)';
    
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':searchText', $searchText, PDO::PARAM_STR); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
}

// displays an index of results based on page number up to the displayLimit
function paginate($searchText, $page, $displayLimit) {
    $startIndex = ($page - 1) * $displayLimit;

    $db = phpmotorsConnect(); 

    $sql = 'SELECT *
            FROM inventory 
            WHERE MATCH (invMake, invModel, invDescription, invColor) 
            AGAINST (:searchText IN NATURAL LANGUAGE MODE)
            LIMIT :startIndex, :displayLimit';
    
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':searchText', $searchText, PDO::PARAM_STR); 
    $stmt->bindValue(':startIndex', $startIndex, PDO::PARAM_INT); 
    $stmt->bindValue(':displayLimit', $displayLimit, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
}