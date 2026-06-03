<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StockMaster Pro | Cyberpunk Edition</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root { 
            --neon-pink: #ff007f;
            --neon-cyan: #00f0ff;
            --neon-purple: #9d4edd;
            --neon-green: #39ff14;
            --bg-dark: #03050c;
            --panel-glass: rgba(10, 15, 30, 0.6);
            --border-neon-subtle: rgba(0, 240, 255, 0.15);
            --text-main: #f1f5f9;
            --text-dim: #64748b;
        }
        
        /* Fons animat degradat */
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(-45deg, #02040a, #0b0f24, #18082c, #030714);
            background-size: 400% 400%;
            animation: fluidNeonBackground 15s ease infinite;
            color: var(--text-main);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        @keyframes fluidNeonBackground {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Estils per als títols */
        .neon-title {
            background: linear-gradient(135deg, #ffffff 20%, var(--neon-cyan) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            filter: drop-shadow(0 0 12px rgba(0, 240, 255, 0.3));
        }
        
        /* Menú lateral */
        .sidebar { 
            min-height: 100vh; 
            background: rgba(2, 3, 7, 0.8);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            padding: 30px 18px;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .brand-zone {
            padding: 14px;
            background: rgba(255, 255, 255, 0.01);
            border-radius: 14px;
            border: 1px solid rgba(0, 240, 255, 0.2);
            box-shadow: 0 0 15px rgba(0, 240, 255, 0.1);
        }
        
        .sidebar .nav-link { 
            color: #94a3b8; 
            font-weight: 500; 
            padding: 15px 20px; 
            border-radius: 14px; 
            margin-bottom: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
        }
        
        /* Animacions de les icones */
        .sidebar .nav-link i { 
            font-size: 1.3rem; 
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), color 0.3s ease, filter 0.3s ease;
        }
        
        .sidebar .nav-link:hover { 
            background: rgba(255, 255, 255, 0.02); 
            color: #fff; 
            transform: translateX(6px);
        }
        
        /* Efecte en passar el ratolí */
        .sidebar .nav-link:hover i {
            transform: scale(1.3) rotate(7deg);
            color: var(--neon-cyan);
            filter: drop-shadow(0 0 10px var(--neon-cyan));
        }
        
        .sidebar .nav-link.active { 
            background: linear-gradient(135deg, var(--neon-purple), #4f46e5); 
            color: #fff; 
            box-shadow: 0 0 25px rgba(157, 78, 221, 0.5); 
        }
        
        .sidebar .nav-link.active i {
            color: #fff !important;
            filter: none !important;
            transform: none !important;
        }
        
        /* Panells amb efecte de vidre */
        .cyber-glass-panel { 
            background: var(--panel-glass) !important;
            backdrop-filter: blur(20px) saturate(200%);
            -webkit-backdrop-filter: blur(20px) saturate(200%);
            border: 1px solid var(--border-neon-subtle) !important;
            border-radius: 24px; 
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }
        
        .cyber-glass-panel:hover {
            border-color: rgba(0, 240, 255, 0.4);
            box-shadow: 0 25px 60px rgba(0, 240, 255, 0.08);
        }
        
        /* Estils de les taules */
        .table-cyberpunk-neon th {
            background-color: rgba(255, 255, 255, 0.01) !important;
            color: #94a3b8 !important;
            font-weight: 600;
            text-uppercase: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
            padding: 18px 16px;
            border-bottom: 1px solid rgba(0, 240, 255, 0.2) !important;
        }
        
        .table-cyberpunk-neon td {
            padding: 18px 16px;
            color: var(--text-main) !important;
            background: transparent !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04) !important;
        }
        
        .table-cyberpunk-neon tr:hover td {
            background-color: rgba(255, 255, 255, 0.01) !important;
        }
        
        .btn-cyber-action {
            background: rgba(255, 255, 255, 0.01);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: var(--text-main);
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        .btn-cyber-action:hover {
            background: rgba(0, 240, 255, 0.1);
            border-color: var(--neon-cyan);
            color: #fff;
            box-shadow: 0 0 10px rgba(0, 240, 255, 0.3);
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-4 col-lg-3 col-xl-2 d-md-block sidebar collapse">
            <div class="brand-zone d-flex align-items-center mb-4 px-3 text-nowrap">
                <div class="p-2 rounded-3 text-white me-2 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, var(--neon-cyan), var(--neon-purple)); box-shadow: 0 0 15px rgba(0,240,255,0.4);">
                    <i class="bi bi-terminal-fill fs-4"></i>
                </div>
                <span class="fs-5 fw-bold text-white tracking-tight">StockMaster</span>
            </div>
            
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['ctrl']) && $_GET['ctrl'] == 'dashboard') ? 'active' : '' ?>" href="index.php?ctrl=dashboard">
                        <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (!isset($_GET['ctrl']) || $_GET['ctrl'] == 'products') ? 'active' : '' ?>" href="index.php?ctrl=products">
                        <i class="bi bi-box-seam-fill me-3"></i> Productes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (isset($_GET['ctrl']) && $_GET['ctrl'] == 'categories') ? 'active' : '' ?>" href="index.php?ctrl=categories">
                        <i class="bi bi-tags-fill me-3"></i> Categories
                    </a>
                </li>
            </ul>
        </nav>
        
        <main class="col-md-8 ms-sm-auto col-lg-9 col-xl-10 p-4 p-md-5">