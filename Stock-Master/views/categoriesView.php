<?php include 'layouts/header.php'; ?>

<div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-5 gap-3">
    <div>
        <h2 class="neon-title mb-1">Estratificació de Categories</h2>
        <p class="text-secondary small mb-0">Agrupació estructural i capes lògiques del catàleg d'actius.</p>
    </div>
    <a href="index.php?ctrl=categories&action=create" class="btn btn-cyber-action px-4 py-2.5 shadow-sm d-flex align-items-center" style="border-color: var(--neon-purple); color: #fff; background: rgba(157, 78, 221, 0.1); box-shadow: 0 0 15px rgba(157, 78, 221, 0.25);">
        <i class="bi bi-tag-fill me-2 text-warning" style="filter: drop-shadow(0 0 5px var(--neon-purple));"></i> Nova Categoria
    </a>
</div>

<div class="cyber-glass-panel overflow-hidden" style="max-width: 900px; border: 1px solid rgba(157, 78, 221, 0.2) !important;">
    <div class="table-responsive">
        <table class="table table-cyberpunk-neon align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4" style="width: 140px; border-bottom: 1px solid rgba(157, 78, 221, 0.3) !important;">Codi ID</th>
                    <th style="border-bottom: 1px solid rgba(157, 78, 221, 0.3) !important;">Nom de la Categoria Estratificada</th>
                    <th class="text-center" style="width: 140px; border-bottom: 1px solid rgba(157, 78, 221, 0.3) !important;">Accions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($categories)): ?>
                    <tr>
                        <td colspan="3" class="text-center text-secondary py-5">No s'han localitzat categories estructurades al sistema.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($categories as $cat) : ?>
                    <tr>
                        <td class="ps-4 fw-bold text-warning" style="text-shadow: 0 0 8px rgba(255,183,3,0.4);">#<?= $cat->getId(); ?></td>
                        <td>
                            <span class="fw-semibold text-white">
                                <?= !empty(trim($cat->getNombre())) ? htmlspecialchars($cat->getNombre()) : '<span class="text-muted fst-italic fw-normal">Sense especificar</span>'; ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group shadow-sm border border-secondary border-opacity-10 rounded-3 overflow-hidden">
                                <a href="index.php?ctrl=categories&action=edit&id=<?= $cat->getId(); ?>" class="btn btn-sm btn-cyber-action border-0 px-3 py-2 text-primary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="index.php?ctrl=categories&action=delete&id=<?= $cat->getId(); ?>" class="btn btn-sm btn-cyber-action border-0 px-3 py-2 text-danger" onclick="return confirm('Atenció: Es desvincularan els productes d\'aquesta categoria. Continuar?')" title="Eliminar">
                                    <i class="bi bi-trash3"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>