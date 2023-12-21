<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/base.css?v=<?php echo time(); ?>" media="screen">
    <link rel="stylesheet" href="/phpmotors/css/larger.css?v=<?php echo time(); ?>" media="screen">
    
    <title>Search Page</title>
</head>
<body>
    <div id="body">
    <header id="page_header">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?> 
    </header>
    <nav id="page_navigation">
        <?php echo $navList; ?>    
    </nav>
    <main>
        <h1>Search</h1>
        <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            
        ?>
        <form action="/phpmotors/search/index.php" method="GET">
            <div id="searchForm">
            <label for="searchText">What are you looking for today?</label>
            <input type="text" id="searchText" name="searchText" required <?php if(isset($searchText)) {echo "value='$searchText'";} ?> >

            <input type="submit" value="Search" id="searchButton" class="submitButton">
            <input type="hidden" name="action" value="searchAction">
            </div>
        </form>
        <div id="searchResults">
        <?php 
            if (isset($searchResults)) { 
                echo $searchResults;
            }
            if (isset($searchDisplay)) {    
                echo $searchDisplay;
            }
            if (isset($paginationBar)) {
                echo $paginationBar; 
            }
        ?>
        </div>
    </main>
    <footer id="page_footer">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?> 
    </footer>
    </div>
</body>
</html><?php unset($_SESSION['message']); ?>