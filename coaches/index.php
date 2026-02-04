<?php
require_once '../global-library/database.php';
require_once '../include/functions.php';
checkUser();

if (isset($_SESSION['user_id'])) {
	$userId = $_SESSION['user_id'];
} else {
}

if (isset($_GET['coaches'])) {
    $view = 'coaches';
} else {
    $view = '';
}

$currentPage = 'coaches';

switch ($view) {
    case 'coaches':
        $content   = 'coaches.php';
        $pageTitle = 'Coaches';
        break;

    default:
        $content   = 'coaches.php';
        $pageTitle = 'coaches';
        break;
}


require_once '../include/template.php';

?>