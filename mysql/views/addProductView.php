<?php include 'layouts/header.php'; ?>

<div class="mx-auto" style="max-width: 600px;">
    <div class="d-flex align-items-center mb-4">
        <a href="index.php" class="btn btn-sm btn-light border me-3"><i class="bi bi-arrow-left"></i></a>
        <h3 class="fw-bold mb-0">Registrar Nou Actiu</h3>
    </div>

    <div class="card p-4">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger rounded-3">
                <ul class="mb-0 small">
                    <?php foreach ($errors as $err): ?>
                        <li><?= $err ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="index.php?ctrl=products&action=create" method="POST">
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Descripció (Nom)</label>
                <input type="text" name="nombre" class="form-control py-2.5" placeholder="Ex: Portàtil Dell Latitude" value="<?= $_POST['nombre'] ?? '' ?>">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Referència (Nom Curt)</label>
                <input type="text" name="short_name" class="form-control py-2.5" placeholder="Ex: DELL-LAT-01" value="<?= $_POST['short_name'] ?? '' ?>">
            </div>
            
            <div class="mb-3">
                <label class="form-label fw-semibold text-secondary">Categoria Relacionada</label>
                <select name="categoria_id" class="form-select py-2.5">
                    <option value="">-- Selecciona una categoria --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat->getId() ?>" <?= (isset($_POST['categoria_id']) && $_POST['categoria_id'] == $cat->getId()) ? 'selected' : '' ?>>
                            <?= $cat->getNombre() ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary">Preu de Compra (PVP)</label>
                <div class="input-group">
                    <input type="number" step="0.01" min="0" name="pvp" class="form-control py-2.5" placeholder="0.00" value="<?= $_POST['pvp'] ?? '' ?>">
                    <span class="input-group-text">€</span>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary w-100 py-2.5">Guardar Actiu</button>
                </div>
                <div class="col-6">
                    <a href="index.php" class="btn btn-outline-secondary w-100 py-2.5">Cancel·lar</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>