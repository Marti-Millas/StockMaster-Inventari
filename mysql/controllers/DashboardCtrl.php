<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once "ddbb/DBConexion.php";

class DashboardCtrl {
    public function index() {
        $db = DBConexion::connection();

        // Total de productes
        $totalProducts = 0;
        $resTotal = $db->query("SELECT COUNT(*) as total FROM products");
        if ($resTotal) {
            $row = $resTotal->fetch_assoc();
            $totalProducts = (int)($row['total'] ?? 0);
        }

        // Valor total del magatzem
        $totalValue = 0.0;
        $resSuma = $db->query("SELECT SUM(pvp) as total_valor FROM products");
        if ($resSuma) {
            $row = $resSuma->fetch_assoc();
            $totalValue = (float)($row['total_valor'] ?? 0.0);
        }

        // Preu mitjà dels productes
        $avgPrice = 0.0;
        $resAvg = $db->query("SELECT AVG(pvp) as mitja_valor FROM products");
        if ($resAvg) {
            $row = $resAvg->fetch_assoc();
            $avgPrice = (float)($row['mitja_valor'] ?? 0.0);
        }

        // Categoria amb més productes
        $leaderCategory = "Cap";
        $leaderCount = 0;
        $resLeader = $db->query("SELECT c.nombre, COUNT(p.cod) as total 
                                 FROM categories c 
                                 LEFT JOIN products p ON c.id = p.categoria_id 
                                 GROUP BY c.id 
                                 ORDER BY total DESC, c.nombre ASC LIMIT 1");
        if ($resLeader && $resLeader->num_rows > 0) {
            $row = $resLeader->fetch_assoc();
            $leaderCategory = $row['nombre'] ?? 'Sense especificar';
            $leaderCount = (int)($row['total'] ?? 0);
        }

        // Producte més car
        $topProductName = "Cap recurs";
        $topProductPrice = 0.0;
        $resTop = $db->query("SELECT nombre, pvp FROM products ORDER BY pvp DESC LIMIT 1");
        if ($resTop && $resTop->num_rows > 0) {
            $row = $resTop->fetch_assoc();
            $topProductName = $row['nombre'];
            $topProductPrice = (float)$row['pvp'];
        }

        // Dades per al gràfic de distribució
        $categoriesLabels = [];
        $productsCount = [];
        $sqlChart = "SELECT c.nombre as categoria, COUNT(p.cod) as total 
                     FROM categories c 
                     LEFT JOIN products p ON c.id = p.categoria_id 
                     GROUP BY c.id 
                     ORDER BY total DESC";
        $resChart = $db->query($sqlChart);
        if ($resChart) {
            while ($row = $resChart->fetch_assoc()) {
                $categoriesLabels[] = $row['categoria'] ?? 'Sense mètrica';
                $productsCount[] = (int)($row['total'] ?? 0);
            }
        }

        // Dades per al gràfic de valor per categoria
        $barLabels = [];
        $barInversionData = [];
        $sqlBarChart = "SELECT c.nombre as categoria, IFNULL(SUM(p.pvp), 0) as total_inversio 
                        FROM categories c 
                        LEFT JOIN products p ON c.id = p.categoria_id 
                        GROUP BY c.id 
                        ORDER BY total_inversio DESC";
        $resBar = $db->query($sqlBarChart);
        if ($resBar) {
            while ($row = $resBar->fetch_assoc()) {
                $barLabels[] = $row['categoria'] ?? 'Sense mètrica';
                $barInversionData[] = (float)($row['total_inversio'] ?? 0.0);
            }
        }

        // Els últims 3 productes afegits
        $latestProducts = [];
        $sqlLatest = "SELECT p.nombre, p.pvp, c.nombre as cat_name 
                      FROM products p 
                      LEFT JOIN categories c ON p.categoria_id = c.id 
                      ORDER BY p.cod DESC LIMIT 3";
        $resLatest = $db->query($sqlLatest);
        if ($resLatest) {
            while ($row = $resLatest->fetch_assoc()) {
                $latestProducts[] = $row;
            }
        }

        require_once "views/dashboardView.php";
    }
}