<?php
require_once '../global-library/database.php';
require_once '../include/functions.php';
checkUser();

if (isset($_SESSION['user_id'])) {
	$userId = $_SESSION['user_id'];
} else {
}

if (isset($_GET['athletes'])) {
    $view = 'athletes';
} else {
    $view = '';
}

$currentPage = 'athletes';

switch ($view) {
    case 'athletes':
        $content   = 'athletes.php';
        $pageTitle = 'athletes';
        break;

    default:
        $content   = 'athletes.php';
        $pageTitle = 'athletes';
        break;
}


require_once '../include/template.php';

?>