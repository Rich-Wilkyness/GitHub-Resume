<!-- phpmotors controller -->
<?php

// Create or access a Session
session_start();

require_once 'library/connections.php';
require_once 'library/functions.php';
require_once 'model/main-model.php';

$classifications = getClassifications();

$navList = buildNav($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action){
    case '':
        include 'view/home.php';
        break;
    default:
        break;
}

