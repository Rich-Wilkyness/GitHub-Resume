<?php
// accounts controller
// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/main-model.php';
require_once '../model/accounts-model.php';

$classifications = getClassifications();

$navList = buildNav($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

// $forgotPassword = 'Sup3rU$er';
// var_dump(password_hash($forgotPassword, PASSWORD_DEFAULT));

switch ($action){
    case 'loginView':
        
        include '../view/login.php';
        break;
    case 'registerView':
        $_SESSION['message'] = '';
        include '../view/registration.php';
        break;
    case 'register':
        // Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = "<p class='message'>Please provide information for all empty form fields.</p>";
            include '../view/registration.php';
            exit; 
        }
        // hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $emailExists = checkIfEmailExists($clientEmail);
        if($emailExists) {
            $message = "<p class='message'> Sorry the email: $clientEmail, already exists, try logging in.</p>";
            include '../view/login.php';
            exit;
        }
        //send data to model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        // report result
        if ($regOutcome === 1) {
            
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=loginView');
            exit;
        } else {
            $message = "<p class='message'>Sorry $clientFirstname, but the registration failed. Please try again.<p/>";
            include '../view/registration.php';
            exit;
        }
        break;
    case 'Login':
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        if(empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = "Sorry your email or password is incorrect, please try again.";
            include '../view/login.php';
            exit; 
        }

        // valid password and emial --> check db for user
        $clientData = getClient($clientEmail);
        // if($clientData) {
        //     $_SESSION['welcome'] = $clientData;
        // }
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        if (!$hashCheck) {
            $_SESSION['message'] = "Sorry your email or password is incorrect, please try again.";
            include '../view/login.php';
            exit;
        }

        if(isset($_SESSION['loggedin'])){
            $_SESSION['welcome'] = "Welcome {$_SESSION['clientData']['clientFirstname']}. <a href='/phpmotors/accounts/?action=Admin'>Go to the Client Admin view</a>";
            include '../view/admin.php';
            exit;
        }
        // user exists --> login 
        $_SESSION['loggedin'] = TRUE;
        // remove password from client data, pop removes last element
        array_pop($clientData);
        $_SESSION['clientData'] = $clientData;
        $_SESSION['welcome'] = "Welcome {$_SESSION['clientData']['clientFirstname']}. <a href='/phpmotors/accounts/?action=Admin'>Go to the Client Admin view</a>";
        include '../view/admin.php';
        exit;
        break;
    case 'Admin':
        include '../view/admin.php';
        break;
    case 'Logout':
        unset($_SESSION['welcome']);
        unset($_SESSION['message']);
        unset($_SESSION['loggedin']);
        unset($_SESSION['clientData']);
        header('Location: /phpmotors');
        break;
    case 'editAccount':
        $clientId = filter_input(INPUT_GET, 'clientId', FILTER_VALIDATE_INT);
        $clientData = getClientById($clientId);
        
        if(count($clientData) < 1) {
            $_SESSION['message'] = "<p class='message'>Sorry, the account you are trying to edit does not exist.</p>";
            header('Location: /phpmotors/accounts/?action=Admin');
            exit;
        } else {
            include '../view/account-update.php';
            exit;
        }
        break;
    case 'updateAccount':
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        if(empty($clientId)) {
            $_SESSION['message'] = "<p class='message'>Sorry, the account you are trying to edit does not exist.</p>";
            header('Location: /phpmotors/accounts/?action=Admin');
            exit;
        }

        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));


        $clientEmail = checkEmail($clientEmail);

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $message = "<p class='message'>Please provide information for all empty form fields.</p>";
            include '../view/account-update.php';
            exit; 
        }
        $sessionEmail = $_SESSION['clientData']['clientEmail'];
        if($clientEmail!= $sessionEmail) {
            $emailExists = checkIfEmailExists($clientEmail);
            if($emailExists) {
                $message = "<p class='message'> Sorry the email: $clientEmail, already exists, try a different email.</p>";
                include '../view/account-update.php';
                exit;
            }
        }

        //send data to model
        $regOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
        // report result
        if ($regOutcome !== 1) {
            $message = "<p class='message'>Sorry $clientFirstname, but the update failed. Please try again.<p/>";
            include '../view/account-update.php';
            exit;
        }
        $clientData = getClientById($clientId);
        // user exists --> login 
        $_SESSION['loggedin'] = TRUE;
        // remove password from client data, pop removes last element
        $_SESSION['clientData'] = $clientData;

        $_SESSION['welcome'] = "Welcome {$_SESSION['clientData']['clientFirstname']}. <a href='/phpmotors/accounts/?action=Admin'>Go to the Client Admin view</a>";
        $_SESSION['message'] = "Thanks for updating $clientFirstname.";
        include '../view/admin.php';
        break;
    case 'updatePassword': 
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        if(empty($clientId)) {
            $_SESSION['message'] = "<p class='message'>Sorry, the account you are trying to edit does not exist.</p>";
            header('Location: /phpmotors/accounts/?action=Admin');
            exit;
        }

        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

        $checkPassword = checkPassword($clientPassword);
        if(empty($checkPassword)) {
            $_SESSION['message'] = "Password does not match criteria.";
            include '../view/account-update.php';
            exit; 
        }

        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $regOutcome = updateClientPassword($hashedPassword, $clientId);
        if ($regOutcome === 1) {
            $_SESSION['passwordMessage'] = "Thanks for updating $clientFirstname password.";
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $passwordMessage = "<p class='message'>Sorry " . htmlspecialchars($_SESSION['clientData']['clientFirstname']) . ", but the update to the new password failed. Please try again.</p>";
            include '../view/account-update.php';
            exit;
        }
        break;
    default:
        if(isset($_SESSION['loggedin'])) {
            $_SESSION['welcome'] = "Welcome {$_SESSION['clientData']['clientFirstname']}. <a href='/phpmotors/accounts/?action=Admin'>Go to the Client Admin view</a>";
            include '../view/admin.php';
        } else {
            header('Location: /phpmotors');
        }
        break;
}

