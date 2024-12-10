<?php
require_once __DIR__ . '/../../controllers/ReportController.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

$controller = new ReportController();

switch ($action) {
    case 'salesReports':
        $controller->sellReports();
        break;

    case 'purchaseReports':
        $controller->buyReports();
        break;

    default:
        $controller->buyReports();
        break;
}