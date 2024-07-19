<?php
// routes/api.php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controllers/ClientController.php';
require_once __DIR__ . '/../controllers/ProductController.php';
require_once __DIR__ . '/../controllers/TaxRateController.php';
require_once __DIR__ . '/../controllers/InvoiceController.php';
require_once __DIR__ . '/../controllers/InvoiceItemController.php';

$clientController = new ClientController($pdo);
$productController = new ProductController($pdo);
$taxRateController = new TaxRateController($pdo);
$invoiceController = new InvoiceController($pdo);
$invoiceItemController = new InvoiceItemController($pdo);

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

function sendJsonResponse($response)
{
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

function handleRequest($controller, $id = null) {
    global $requestMethod;
    $data = json_decode(file_get_contents('php://input'), true);
    
    switch ($requestMethod) {
        case 'GET':
            $response = $id ? $controller->show($id) : $controller->index();
            sendJsonResponse($response);
            break;
        case 'POST':
            $response = $controller->store($data);
            sendJsonResponse($response);
            break;
        case 'PUT':
            $response = $controller->update($id, $data);
            sendJsonResponse($response);
            break;
        case 'DELETE':
            $response = $controller->destroy($id);
            sendJsonResponse($response);
            break;
        default:
            header("HTTP/1.0 405 Method Not Allowed");
            sendJsonResponse(['status' => 'error', 'message' => 'Method not allowed']);
            break;
    }
}

// Routing logic
if (preg_match('/^\/clients(\/(\d+))?$/', $requestUri, $matches)) {
    $id = $matches[2] ?? null;
    handleRequest($clientController, $id);
} elseif (preg_match('/^\/products(\/(\d+))?$/', $requestUri, $matches)) {
    $id = $matches[2] ?? null;
    handleRequest($productController, $id);
} elseif (preg_match('/^\/taxrates(\/(\d+))?$/', $requestUri, $matches)) {
    $id = $matches[2] ?? null;
    handleRequest($taxRateController, $id);
} elseif (preg_match('/^\/invoices(\/(\d+))?$/', $requestUri, $matches)) {
    $id = $matches[2] ?? null;
    handleRequest($invoiceController, $id);
} elseif (preg_match('/^\/invoiceitems(\/(\d+))?$/', $requestUri, $matches)) {
    $id = $matches[2] ?? null;
    handleRequest($invoiceItemController, $id);
} else {
    header("HTTP/1.0 404 Not Found");
    sendJsonResponse(['status' => 'error', 'message' => 'Route not found']);
}
?>
