<?php
require_once "models/CategoryModel.php";

class CategoriesCtrl {

    public function index() {
        $categories = Category::getAllCategories();
        require_once "views/categoriesView.php";
    }

    public function create() {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');

            if ($nombre === '') {
                $errors[] = "El nom de la categoria és obligatori";
            }

            if (empty($errors)) {
                if (Category::create($nombre)) {
                    header("Location: index.php?ctrl=categories");
                    exit;
                }
            }
        }
        require_once "views/addCategoryView.php";
    }

    public function edit($id) {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = trim($_POST['nombre'] ?? '');

            if ($nombre === '') {
                $errors[] = "El nom és obligatori";
            }

            if (empty($errors)) {
                if (Category::update($id, $nombre)) {
                    header("Location: index.php?ctrl=categories");
                    exit;
                }
            }
        }

        $category = Category::getCategoryById($id);
        require_once "views/editCategoryView.php";
    }

    public function delete($id) {
        if ($id) {
            Category::delete($id);
        }
        header("Location: index.php?ctrl=categories");
        exit;
    }
}