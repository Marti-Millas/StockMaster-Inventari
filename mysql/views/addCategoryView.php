<?php include 'layouts/header.php'; ?>

<div class="mx-auto" style="max-width: 500px;">
    <div class="d-flex align-items-center mb-4">
        <a href="index.php?ctrl=categories" class="btn btn-sm btn-light border me-3"><i class="bi bi-arrow-left"></i></a>
        <h3 class="fw-bold mb-0">Crear Nova Categoria</h3>
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

        <form action="index.php?ctrl=categories&action=create" method="POST">
            <div class="mb-4">
                <label class="form-label fw-semibold text-secondary">Nom de la Categoria</label>
                <input type="text" name="nombre" class="form-control py-2.5" placeholder="Ex: Informàtica, Mobiliari..." value="<?= $_POST['nombre'] ?? '' ?>">
            </div>

            <div class="row g-2">
                <div class="col-6">
                    <button type="submit" class="btn btn-primary w-100 py-2.5">Guardar</button>
                </div>
                <div class="col-6">
                    <a href="index.php?ctrl=categories" class="btn btn-outline-secondary w-100 py-2.5">Tornar</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>