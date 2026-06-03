<?php
require_once "ddbb/DBConexion.php";

class Product {
    protected $cod;
    protected $name;
    protected $short_name;
    protected $pvp;
    protected $categoria_id;     // ID de la taula categories
    protected $categoria_nombre; // Nom real obtingut del JOIN

    public function __construct($row) {
        $this->cod = $row["cod"];
        $this->name = $row["nombre"];
        $this->short_name = $row["short_name"];
        $this->pvp = $row["pvp"];
        $this->categoria_id = $row["categoria_id"] ?? null;
        $this->categoria_nombre = $row["categoria_nombre"] ?? 'Sense categoria';
    }

    public static function getAllProducts() {
        $db = DBConexion::connection();
        // Fem un LEFT JOIN per extreure el nom de la categoria dinàmicament
        $sql = "SELECT p.cod, p.short_name, p.nombre, p.pvp, p.categoria_id, c.nombre AS categoria_nombre 
                FROM products p 
                LEFT JOIN categories c ON p.categoria_id = c.id";
        $data = $db->query($sql);
        $products = array();

        while ($row = $data->fetch_assoc()) {
            $products[] = new Product($row);
        }
        return $products;
    }

    // --- GETTERS ---
    public function getProductCode() { return $this->cod; }
    public function getProductName() { return $this->name; }
    public function getProductShortName() { return $this->short_name; }
    public function getProductPvp() { return $this->pvp; }
    public function getCategoriaId() { return $this->categoria_id; }
    public function getCategoriaNombre() { return $this->categoria_nombre; }

    // --- MÈTODES CRUD ---
    public static function create($short_name, $pvp, $nombre, $categoria_id) {
        $db = DBConexion::connection(); 
        $sql = "INSERT INTO products (short_name, pvp, nombre, categoria_id) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        // "sdsi" -> string, double, string, integer (el ID és un número)
        $stmt->bind_param("sdsi", $short_name, $pvp, $nombre, $categoria_id);
        return $stmt->execute();
    }

    public static function getProductById($id) {
        $db = DBConexion::connection();
        $stmt = $db->prepare("SELECT * FROM products WHERE cod = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $row = $stmt->get_result()->fetch_assoc();
        return $row ? new Product($row) : null;
    }

    public static function update($id, $short_name, $pvp, $nombre, $categoria_id) {
        $db = DBConexion::connection();
        $stmt = $db->prepare("UPDATE products SET short_name = ?, pvp = ?, nombre = ?, categoria_id = ? WHERE cod = ?");
        $stmt->bind_param("sdsii", $short_name, $pvp, $nombre, $categoria_id, $id);
        return $stmt->execute();
    }

    public static function delete($id) {
        $db = DBConexion::connection();
        $stmt = $db->prepare("DELETE FROM products WHERE cod = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}