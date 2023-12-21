<picture>
    <source media="(max-width: 650px)" srcset="/phpmotors/images/logo-100.webp">
    <img src="/phpmotors/images/logo-200.webp" alt="PHP Motors Logo" width="200" height="72" loading="lazy" id="header-image">
</picture>

<?php
    if (isset($_SESSION['loggedin'])) {
        echo $_SESSION['welcome'];
    }
?>

<?php
    if (isset($_SESSION['loggedin'])) {
        echo '<a href="/phpmotors/accounts/index.php?action=Logout">Log out</a>';
    } else {
        echo '<a href="/phpmotors/accounts/index.php?action=loginView">My Account</a>';
    }
?>
<a href="/phpmotors/search" title="Search PHP Motors">&#x1F50D;</a>
