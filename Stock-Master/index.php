<?php
require_once "ddbb/DBConexion.php";

// Mirem quin controlador vol usar l'usuari (per defecte: products)
$ctrlParam = $_GET['ctrl'] ?? 'products';
$action = $_GET['action'] ?? 'index';

// Instanciem el controlador correcte segons la URL
if ($ctrlParam === 'categories') {
    require_once "controllers/CategoriesCtrl.php";
    $controller = new CategoriesCtrl();
} elseif ($ctrlParam === 'dashboard') {
    require_once "controllers/DashboardCtrl.php";
    $controller = new DashboardCtrl();
} else {
    require_once "controllers/productsCtrl.php";
    $controller = new ProductsCtrl();
}

// Executem l'acció corresponent
switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'edit':
        $id = $_GET['id'] ?? null;
        $controller->edit($id);
        break;
    case 'delete':
        $id = $_GET['id'] ?? null;
        $controller->delete($id);
        break;
    case 'index':
    default:
        $controller->index();
        break;
}