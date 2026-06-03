<?php include 'layouts/header.php'; ?>

<style>
    /* Estils del cercador */
    .cyber-search-input {
        background: rgba(13, 20, 38, 0.85) !important;
        border: 1px solid rgba(0, 240, 255, 0.3) !important;
        color: #ffffff !important;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .cyber-search-input:focus {
        border-color: var(--neon-cyan) !important;
        box-shadow: 0 0 15px rgba(0, 240, 255, 0.4) !important;
    }

    /* Color del text d'exemple */
    .cyber-search-input::placeholder {
        color: #cbd5e1 !important;
        opacity: 1 !important;
    }
    .cyber-search-input::-webkit-input-placeholder {
        color: #cbd5e1 !important;
        opacity: 1 !important;
    }
    .cyber-search-input::-moz-placeholder {
        color: #cbd5e1 !important;
        opacity: 1 !important;
    }

    /* Estils del desplegable d'ordre */
    .cyber-select {
        background-color: rgba(13, 20, 38, 0.85) !important;
        border: 1px solid rgba(157, 78, 221, 0.3) !important;
        color: #ffffff !important;
        border-radius: 12px;
        padding: 10px 40px 10px 20px !important;
        cursor: pointer;
        transition: all 0.3s ease;
        
        appearance: none !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%2300f0ff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
        background-repeat: no-repeat !important;
        background-position: right 14px center !important;
        background-size: 14px !important;
    }
    .cyber-select:focus {
        border-color: var(--neon-purple) !important;
        box-shadow: 0 0 15px rgba(157, 78, 221, 0.4) !important;
    }

    /* Opcions de la llista */
    .cyber-select option {
        background-color: #0b0f19 !important;
        color: #f1f5f9 !important;
        padding: 14px !important;
    }

    .product-row {
        transition: opacity 0.3s ease, transform 0.3s ease;
    }
    .row-hidden {
        display: none !important;
    }
</style>

<div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-5 gap-3">
    <div>
        <h2 class="neon-title mb-1">Mòdul d'Inventari Global</h2>
        <p class="text-secondary small mb-0">Llistat operacional i traçabilitat activa d'actius del sistema.</p>
    </div>
    <a href="index.php?ctrl=products&action=create" class="btn btn-primary px-4 py-2.5 shadow d-flex align-items-center" style="background: linear-gradient(135deg, var(--neon-cyan), #0284c7); border: none; border-radius: 12px; font-weight: 600; box-shadow: 0 0 15px rgba(0,240,255,0.3);">
        <i class="bi bi-plus-lg me-2"></i> Alta d'Actiu
    </a>
</div>

<div class="cyber-glass-panel p-3 mb-4 d-flex flex-column flex-md-row gap-3 align-items-center justify-content-between" style="border-left: 3px solid var(--neon-cyan) !important;">
    <div class="input-group" style="max-width: 450px;">
        <span class="input-group-text bg-transparent border-end-0 text-secondary" style="border-color: rgba(0, 240, 255, 0.3); border-radius: 12px 0 0 12px;"><i class="bi bi-search" style="color: var(--neon-cyan);"></i></span>
        <input type="text" id="cyberSearch" class="form-control cyber-search-input border-start-0" placeholder="Cerca actius per nom o referència..." autocomplete="off">
    </div>
    <div class="d-flex align-items-center gap-3 w-100 w-md-auto justify-content-end">
        <label for="cyberSort" class="text-secondary small text-nowrap fw-medium"><i class="bi bi-sort-down me-1" style="color: var(--neon-purple);"></i>Ordenar per:</label>
        <select id="cyberSort" class="form-select cyber-select">
            <option value="default">Identificador (Defecte)</option>
            <option value="price-desc">Preu: de Major a Menor</option>
            <option value="price-asc">Preu: de Menor a Major</option>
            <option value="alpha-asc">Nom: Alfabetitzat (A-Z)</option>
        </select>
    </div>
</div>

<div class="cyber-glass-panel overflow-hidden">
    <div class="table-responsive">
        <table class="table table-cyberpunk-neon align-middle mb-0">
            <thead>
                <tr>
                    <th class="ps-4" style="width: 120px;">Identificador</th>
                    <th>Nom de l'Actiu</th>
                    <th>Codi Referència</th>
                    <th>Categoria Relacionada</th>
                    <th>Cost Assignat (PVP)</th>
                    <th class="text-center" style="width: 140px;">Operacions</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
                <?php if (empty($products)): ?>
                    <tr id="emptyRow">
                        <td colspan="6" class="text-center text-secondary py-5">Sense registres actius en aquest moment.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $product) : ?>
                    <tr class="product-row" 
                        data-id="<?= $product->getProductCode(); ?>" 
                        data-name="<?= strtolower(htmlspecialchars($product->getProductName())); ?>" 
                        data-code="<?= strtolower(htmlspecialchars($product->getProductShortName())); ?>" 
                        data-price="<?= $product->getProductPvp(); ?>">
                        
                        <td class="ps-4 fw-bold text-info">#<?= $product->getProductCode(); ?></td>
                        <td><span class="fw-semibold text-white"><?= $product->getProductName(); ?></span></td>
                        <td><span class="badge bg-white bg-opacity-5 text-secondary border border-secondary border-opacity-10 px-2.5 py-1.5" style="border-radius: 6px; font-size: 0.8rem;"><?= $product->getProductShortName(); ?></span></td>
                        <td>
                            <span class="badge px-2.5 py-1.5 border" style="background-color: rgba(0, 240, 255, 0.05); color: #a5b4fc; border-color: rgba(0, 240, 255, 0.15); border-radius: 6px; font-size: 0.8rem;">
                                <?= $product->getCategoriaNombre(); ?>
                            </span>
                        </td>
                        <td class="fw-bold text-white"><?= number_format($product->getProductPvp(), 2); ?> €</td>
                        <td class="text-center">
                            <div class="btn-group shadow-sm border border-secondary border-opacity-10 rounded-3 overflow-hidden">
                                <a href="index.php?ctrl=products&action=edit&id=<?= $product->getProductCode(); ?>" class="btn btn-sm btn-cyber-action border-0 px-3 py-2 text-primary" title="Editar">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="index.php?ctrl=products&action=delete&id=<?= $product->getProductCode(); ?>" class="btn btn-sm btn-cyber-action border-0 px-3 py-2 text-danger" onclick="return confirm('Vols eliminar de forma permanent aquest element?')" title="Esborrar">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('cyberSearch');
    const sortSelect = document.getElementById('cyberSort');
    const tableBody = document.getElementById('productTableBody');
    const rows = Array.from(tableBody.querySelectorAll('.product-row'));

    // Filtre de cerca
    searchInput.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase().trim();
        
        rows.forEach(row => {
            const productName = row.getAttribute('data-name');
            const productCode = row.getAttribute('data-code');
            
            if (productName.includes(query) || productCode.includes(query)) {
                row.classList.remove('row-hidden');
            } else {
                row.classList.add('row-hidden');
            }
        });
    });

    // Ordenació de la taula
    sortSelect.addEventListener('change', function(e) {
        const criteria = e.target.value;
        let sortedRows = [...rows];
        
        if (criteria === 'price-desc') {
            sortedRows.sort((a, b) => parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price')));
        } else if (criteria === 'price-asc') {
            sortedRows.sort((a, b) => parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price')));
        } else if (criteria === 'alpha-asc') {
            sortedRows.sort((a, b) => a.getAttribute('data-name').localeCompare(b.getAttribute('data-name')));
        } else {
            sortedRows.sort((a, b) => parseInt(a.getAttribute('data-id')) - parseInt(b.getAttribute('data-id')));
        }
        
        sortedRows.forEach(row => tableBody.appendChild(row));
    });
});
</script>

<?php include 'layouts/footer.php'; ?>