<?php
require_once '../global-library/database.php';
require_once '../include/functions.php';
checkUser();

if (isset($_SESSION['user_id'])) {
	$userId = $_SESSION['user_id'];
} else {
}

if (isset($_GET['scan'])) {
    $view = 'scan';
} else {
    $view = '';
}

$currentPage = 'scan';

switch ($view) {
    case 'scan':
        $content   = 'scan.php';
        $pageTitle = 'scan';
        break;

    default:
        $content   = 'scan.php';
        $pageTitle = 'scan';
        break;
}


require_once '../include/template.php';

?>