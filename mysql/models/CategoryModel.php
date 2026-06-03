<?php
require_once "ddbb/DBConexion.php";

class Category {
    protected $id;
    protected $nombre;

    public function __construct($row) {
        $this->id = $row["id"];
        $this->nombre = $row["nombre"];
    }

    public static function getAllCategories() {
        $db = DBConexion::connection();
        $data = $db->query("SELECT * FROM categories ORDER BY nombre ASC");
        $categories = array();

        while ($row = $data->fetch_assoc()) {
            $categories[] = new Category($row);
        }
        return $categories;
    }

    // --- GETTERS ---
    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }

    // --- MÈTODES CRUD ---
    public static function create($nombre) {
        $db = DBConexion::connection();
        $stmt = $db->prepare("INSERT INTO categories (nombre) VALUES (?)");
        $stmt->bind_param("s", $nombre);
        return $stmt->execute();
    }

    public static function getCategoryById($id) {
        $db = DBConexion::connection();
        $stmt = $db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ? new Category($row) : null;
    }

    public static function update($id, $nombre) {
        $db = DBConexion::connection();
        $stmt = $db->prepare("UPDATE categories SET nombre = ? WHERE id = ?");
        $stmt->bind_param("si", $nombre, $id);
        return $stmt->execute();
    }

    public static function delete($id) {
        $db = DBConexion::connection();
        // Si eliminem una categoria, els productes passaran a tenir NULL gràcies al ON DELETE SET NULL de la BBDD
        $stmt = $db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}