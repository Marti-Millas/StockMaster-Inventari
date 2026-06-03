<?php include 'layouts/header.php'; ?>

<style>
    /* Efectes per a las targetes */
    .card-purple:hover {
        border-color: var(--neon-purple) !important;
        box-shadow: 0 0 25px rgba(157, 78, 221, 0.25) !important;
    }
    .card-cyan:hover {
        border-color: var(--neon-cyan) !important;
        box-shadow: 0 0 25px rgba(0, 240, 255, 0.25) !important;
    }
    .card-green:hover {
        border-color: var(--neon-green) !important;
        box-shadow: 0 0 25px rgba(57, 255, 20, 0.25) !important;
    }
</style>

<div class="mb-5">
    <h2 class="neon-title tracking-tight mb-1 fs-1">Panell de Monitorització</h2>
    <p class="text-secondary small mb-0">Analítica avançada en temps real de les capes de dades de l'inventari.</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-md-6 col-xl-4">
        <div class="cyber-glass-panel card-purple p-4 h-100 d-flex align-items-center justify-content-between" style="border-bottom: 3px solid var(--neon-purple) !important;">
            <div>
                <span class="text-secondary small text-uppercase fw-bold tracking-wider d-block mb-1">Volum de Catàleg</span>
                <h2 class="fw-bold text-white mb-0 fs-2" style="text-shadow: 0 0 10px rgba(157,78,221,0.4);"><?= $totalProducts ?> <span class="fs-6 text-secondary fw-normal">u.</span></h2>
            </div>
            <div class="p-3 rounded-4" style="background: rgba(157, 78, 221, 0.1); color: var(--neon-purple); border: 1px solid rgba(157, 78, 221, 0.2);">
                <i class="bi bi-box-seam fs-3"></i>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-md-6 col-xl-4">
        <div class="cyber-glass-panel card-cyan p-4 h-100 d-flex align-items-center justify-content-between" style="border-bottom: 3px solid var(--neon-cyan) !important;">
            <div>
                <span class="text-secondary small text-uppercase fw-bold tracking-wider d-block mb-1">Cost Mitjà Unitari</span>
                <h2 class="fw-bold text-white mb-0 fs-2" style="text-shadow: 0 0 10px rgba(0,240,255,0.4);"><?= number_format($avgPrice, 2) ?> <span class="fs-6 text-secondary fw-normal">€</span></h2>
            </div>
            <div class="p-3 rounded-4" style="background: rgba(0, 240, 255, 0.1); color: var(--neon-cyan); border: 1px solid rgba(0, 240, 255, 0.2);">
                <i class="bi bi-calculator fs-3"></i>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-md-12 col-xl-4">
        <div class="cyber-glass-panel card-green p-4 h-100 d-flex align-items-center justify-content-between" style="border-bottom: 3px solid var(--neon-green) !important;">
            <div class="pe-2">
                <span class="text-secondary small text-uppercase fw-bold tracking-wider d-block mb-1">Categoria Líder</span>
                <h2 class="fw-bold text-white mb-0 fs-4 text-wrap" style="text-shadow: 0 0 10px rgba(57,255,20,0.4);"><?= htmlspecialchars($leaderCategory) ?></h2>
                <span class="text-secondary small d-block mt-1"><?= $leaderCount ?> actius associats</span>
            </div>
            <div class="p-3 rounded-4 flex-shrink-0" style="background: rgba(57, 255, 20, 0.1); color: var(--neon-green); border: 1px solid rgba(57, 255, 20, 0.2);">
                <i class="bi bi-lightning-charge fs-3"></i>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-12">
        <div class="cyber-glass-panel p-4 d-flex flex-column flex-sm-row align-items-start align-items-sm-center justify-content-between gap-3" style="border-left: 4px solid var(--neon-pink) !important;">
            <div>
                <span class="text-secondary small text-uppercase fw-bold tracking-wider d-block mb-1">Producte Insígnia (Major Cost de Catàleg)</span>
                <h3 class="fw-bold text-white mb-0 fs-4 text-wrap"><?= htmlspecialchars($topProductName) ?></h3>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary small d-none d-md-inline">Inversió d'Alta Gamma</span>
                <span class="badge bg-danger bg-opacity-20 text-danger border border-danger border-opacity-30 px-4 py-2.5 fw-bold fs-5 flex-shrink-0" style="box-shadow: 0 0 15px rgba(255,0,127,0.25); border-radius: 10px;">
                    <?= number_format($topProductPrice, 2) ?> €
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-12 col-xl-6">
        <div class="cyber-glass-panel p-4 h-100">
            <div class="mb-4">
                <h5 class="fw-bold text-white mb-1"><i class="bi bi-pie-chart-fill me-2 text-info"></i>Ràtio de Distribució (Unitats)</h5>
                <p class="text-secondary small mb-0">Pes proporcional d'estoc calculat segons el volum d'actius.</p>
            </div>
            <div style="position: relative; height: 260px; width: 100%;">
                <canvas id="neonGlowDoughnut"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-6">
        <div class="cyber-glass-panel p-4 h-100">
            <div class="mb-4">
                <h5 class="fw-bold text-white mb-1"><i class="bi bi-bar-chart-line-fill me-2 text-warning"></i>Inversió Activa per Categoria (€)</h5>
                <p class="text-secondary small mb-0">Valor econòmic total acumulat assignat a cada grup estructural.</p>
            </div>
            <div style="position: relative; height: 260px; width: 100%;">
                <canvas id="neonGlowBarChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12">
        <div class="cyber-glass-panel p-4">
            <div class="mb-4">
                <h5 class="fw-bold text-white mb-1"><i class="bi bi-activity me-2 text-danger"></i>Últimes Incorporacions de Catàleg</h5>
                <p class="text-secondary small mb-0">Traçabilitat en temps real i auditoria dels darrers canvis detectats.</p>
            </div>
            <div class="table-responsive">
                <table class="table table-cyberpunk-neon align-middle mb-0 text-nowrap" style="background: transparent !important;">
                    <thead>
                        <tr>
                            <th>Nom del recurs</th>
                            <th>Categoria</th>
                            <th class="text-end">Cost Unitària</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($latestProducts)): ?>
                            <tr>
                                <td colspan="3" class="text-center text-secondary py-4">Sense moviments recents al magatzem.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($latestProducts as $lp): ?>
                            <tr>
                                <td class="fw-semibold text-white px-2"><?= htmlspecialchars($lp['nombre']) ?></td>
                                <td>
                                    <span class="badge rounded-pill bg-white bg-opacity-5 text-info border border-info border-opacity-20 px-3 py-2 fw-medium" style="font-size: 0.75rem;">
                                        <?= htmlspecialchars($lp['cat_name'] ?? 'Sense categoria') ?>
                                    </span>
                                </td>
                                <td class="fw-bold text-end text-white px-2"><?= number_format($lp['pvp'], 2) ?> €</td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const doughnutLabels = <?= json_encode($categoriesLabels) ?>;
    const doughnutCounts = <?= json_encode($productsCount) ?>;
    
    const barLabelsData = <?= json_encode($barLabels) ?>;
    const barInversionData = <?= json_encode($barInversionData) ?>;

    // Gràfic de rosca
    const ctxDoughnut = document.getElementById('neonGlowDoughnut').getContext('2d');
    new Chart(ctxDoughnut, {
        type: 'doughnut',
        data: {
            labels: doughnutLabels,
            datasets: [{
                data: doughnutCounts,
                backgroundColor: ['#00f0ff', '#ff007f', '#39ff14', '#9d4edd', '#ffb703'],
                borderWidth: 0,
                hoverOffset: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 8,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 15,
                        color: '#94a3b8',
                        font: { family: 'Plus Jakarta Sans', size: 11, weight: '500' }
                    }
                }
            },
            cutout: '82%',
            animation: { animateScale: true, animateRotate: true }
        },
        plugins: [{
            beforeDraw: (chart) => {
                const ctx = chart.ctx;
                ctx.save();
                ctx.shadowBlur = 15;
                ctx.shadowColor = 'rgba(0, 240, 255, 0.4)';
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 0;
            },
            afterDraw: (chart) => { chart.ctx.restore(); }
        }]
    });

    // Gràfic de barres
    const ctxBar = document.getElementById('neonGlowBarChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: barLabelsData,
            datasets: [{
                label: 'Inversió en €',
                data: barInversionData,
                backgroundColor: 'rgba(139, 92, 246, 0.25)',
                borderColor: '#8b5cf6',
                borderWidth: 2,
                borderRadius: 8,
                barPercentage: 0.6
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: { color: 'rgba(255, 255, 255, 0.05)' },
                    ticks: { color: '#64748b', font: { family: 'Plus Jakarta Sans', size: 10 } }
                },
                y: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { family: 'Plus Jakarta Sans', size: 11, weight: '500' } }
                }
            },
            plugins: {
                legend: { display: false }
            }
        },
        plugins: [{
            beforeDraw: (chart) => {
                const ctx = chart.ctx;
                ctx.save();
                ctx.shadowBlur = 12;
                ctx.shadowColor = 'rgba(139, 92, 246, 0.5)';
                ctx.shadowOffsetX = 0;
                ctx.shadowOffsetY = 0;
            },
            afterDraw: (chart) => { chart.ctx.restore(); }
        }]
    });
</script>

<?php include 'layouts/footer.php'; ?>