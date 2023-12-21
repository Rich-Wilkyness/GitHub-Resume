<?php
// vehicles controller
// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../library/functions.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../model/search-model.php';

$classifications = getClassifications();

$navList = buildNav($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
    case 'searchAction':
        $searchText = trim(filter_input(INPUT_GET, 'searchText', FILTER_SANITIZE_STRING));

        if(empty($searchText)){
            $_SESSION['message'] = "<p class='message'>No text was given</p>";
            include '../view/search.php';
            exit;
        }

        $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);
        if (empty($page)) {
            $page = 1;
        }

        $searchArray = searchDatabase($searchText);
        

        if(!count($searchArray)){
            $_SESSION['message'] = "<p class='message'>No results could be found for $searchText.</p>";

        } else {
            $searchCount = count($searchArray);
            if ($searchCount > 10) {
                $displayLimit = 10;
                $totalPages = ceil($searchCount / $displayLimit);

                $paginatedResults = paginate($searchText, $page, $displayLimit);

                $searchDisplay = buildSearchDisplay($paginatedResults);
                $paginationBar = pagination($totalPages, $page, $searchText);
            }
            else {
                $searchDisplay = buildSearchDisplay($searchArray);
            }
        }
        $searchResults = "<h2>Returned $searchCount results for $searchText</h2>";
        include '../view/search.php';
        break;
    default:
        include '../view/search.php';
        break;
}