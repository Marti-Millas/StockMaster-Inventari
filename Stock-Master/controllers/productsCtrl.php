<?php
// Carrega de models necessaris
require_once "models/productsModel.php";
require_once "models/CategoryModel.php";

class ProductsCtrl {

    // Llistar productes
    public function index() {
        $products = Product::getAllProducts();
        require_once "views/productsView.php";
    }

    // Crear producte
    public function create() {
        $errors = [];
        
        // Obtenir categories per al formulari
        $categories = Category::getAllCategories(); 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $short_name = trim($_POST['short_name'] ?? '');
            $pvp = $_POST['pvp'] ?? null;
            $nombre = $_POST['nombre'] ?? null;
            $categoria_id = $_POST['categoria_id'] ?? null;
            
            if ($short_name === ''){
                $errors[] = "El short name és obligatori";
            }elseif(strlen($short_name) < 3 ){
                $errors[] = "El short name minim ha de tenir 3 caracters";     
            }
            
            if ($pvp === null or $pvp ===''){
                $errors[] = "El pvp és obligatori";
            }elseif(!is_numeric($pvp) or $pvp < 0){
                $errors[]=" El pvp no ha de ser un numero i no pot ser negatiu";
            }

            if ($nombre === null or $nombre === ''){
                $errors[] ="El nom es obligatori";
            }
        
            if ($categoria_id === null or $categoria_id === ''){
                $errors[] ="La categoria es obligatoria";
            }
            
            if (empty($errors)) {
                // Guardar a la base de dades
                if (Product::create($short_name, $pvp, $nombre, $categoria_id)) {
                    header("Location: index.php");
                    exit;
                }
            }
        }
        require_once "views/addProductView.php";
    }

    // Editar producte
    public function edit($id) {
        $errors = [];
        
        // Obtenir categories
        $categories = Category::getAllCategories(); 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $short_name = trim($_POST['short_name'] ?? '');
            $pvp = $_POST['pvp'] ?? null;
            $nombre = $_POST['nombre'] ?? null;
            $categoria_id = $_POST['categoria_id'] ?? null;
            
            if ($pvp < 0) 
                die("Error: Preu negatiu");

            if (Product::update($id, $short_name, $pvp, $nombre, $categoria_id)) {
                header("Location: index.php");
                exit;
            }
        }
        
        $product = Product::getProductById($id);
        require_once "views/editProductView.php";
    }

    // Eliminar producte
    public function delete($id) {
        if ($id) {
            Product::delete($id);
        }
        header("Location: index.php");
        exit;
    }
}