<?php 
    if(!$_SESSION['loggedin']) {
        header('Location: /phpmotors');
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/base.css?v=<?php echo time(); ?>" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/larger.css?v=<?php echo time(); ?>" media="screen">
    
    <title>PHP Motors Update Account</title>
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
    <main id="admin-main">
        <h1><?php 
        if(isset($clientData['clientFirstname']) && isset($clientData['clientLastname'])) {
            echo "Edit {$clientData['clientFirstname']} {$clientData['clientLastname']} Account";
        } elseif(isset($clientFirstname) && isset($clientLastname)) {
            echo "Edit {$clientFirstname} {$clientLastname} Account";
        }
    ?></h1>
        <?php
        if (isset($message)) {
            echo $message;
        } elseif (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
    <form action="/phpmotors/accounts/index.php" method="POST">
            <fieldset>
                <legend>Account Update</legend>
                <div class="form-group">
                    <label class="top" for="clientFirstname">First name:</label>
                    <input type="text" name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($clientData['clientFirstname'])) {echo "value='$clientData[clientFirstname]'"; } ?> required>

                    <label class="top" for="clientLastname">Last name:</label>   
                    <input type="text" name="clientLastname" id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($clientData['clientLastname'])) {echo "value='$clientData[clientLastname]'"; }  ?> required> 

                    
                    <label class="top" for="clientEmail">Email:</label>
                    <input type="text" name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($clientData['clientEmail'])) {echo "value='$clientData[clientEmail]'"; }  ?> required> 
                </div>
                
                <div class="form-group">
                    <input type="submit" value="Update Account" class="submitButton">
                    <input type="hidden" name="action" value="updateAccount">
                    <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} elseif(isset($clientId)) { echo $clientId; } ?>">
                </div>    
            </fieldset>
        </form>     

        <?php
        if (isset($passwordMessage)) {
            echo $passwordMessage;
        } elseif (isset($_SESSION['passwordMessage'])) {
            echo $_SESSION['passwordMessage'];
            unset($_SESSION['passwordMessage']);
        }
        ?>

        <form action="/phpmotors/accounts/index.php" method="POST">
            <fieldset>
                <legend>Password Update</legend>
                <div class="form-group">
                    <span>Min 8 characters, 1 uppercase, 1 number, 1 special character</span>
                    <label class="top" for="clientPassword">New Password:</label>
                    <input type="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" id="clientPassword" required> 
                </div>
                <div class="form-group">
                    <input type="submit" value="Update Password" class="submitButton">
                    <input type="hidden" name="action" value="updatePassword">
                    <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} ?>">
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
