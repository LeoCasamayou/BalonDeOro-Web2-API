<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?= $equipo ? 'Editar equipo' : 'Agregar equipo' ?></h1>

<form method="post" action="<?= BASE_URL . ($equipo ? 'equipos/actualizar' : 'equipos/crear') ?>" style="max-width:520px">
    <?php if ($equipo): ?>
        <input type="hidden" name="id_equipo" value="<?= $equipo->id_equipo ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input class="form-control" name="nombre" required value="<?= $equipo ? htmlspecialchars($equipo->nombre) : '' ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Fundación (año)</label>
        <input type="number" min="1800" max="2100" class="form-control" name="fundacion" required value="<?= $equipo ? htmlspecialchars($equipo->fundacion) : '' ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Liga</label>
        <input class="form-control" name="liga" required value="<?= $equipo ? htmlspecialchars($equipo->liga) : '' ?>">
    </div>

    <a class="btn btn-secondary" href="<?= BASE_URL ?>equipos">Cancelar</a>
    <button class="btn btn-primary"><?= $equipo ? 'Guardar cambios' : 'Crear' ?></button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
