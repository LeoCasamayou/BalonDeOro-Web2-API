<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1><?= $jugador ? 'Editar jugador' : 'Agregar jugador' ?></h1>

<form method="post" action="<?= BASE_URL . ($jugador ? 'jugadores/actualizar' : 'jugadores/crear') ?>" style="max-width:520px">
    <?php if ($jugador): ?>
        <input type="hidden" name="id_jugador" value="<?= $jugador->id_jugador ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input class="form-control" name="nombre" required value="<?= $jugador ? htmlspecialchars($jugador->nombre) : '' ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Posición</label>
        <input class="form-control" name="posicion" required value="<?= $jugador ? htmlspecialchars($jugador->posicion) : '' ?>">
    </div>

    <div class="mb-3">
        <label class="form-label">Equipo</label>
        <select class="form-select" name="id_equipo" required>
            <option value="" disabled <?= $jugador ? '' : 'selected' ?>>Seleccioná un equipo</option>
            <?php foreach ($equipos as $e): ?>
                <option value="<?= $e->id_equipo ?>" <?= ($jugador && $e->id_equipo == $jugador->id_equipo) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($e->nombre) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <a class="btn btn-secondary" href="<?= BASE_URL ?>listar">Cancelar</a>
    <button class="btn btn-primary"><?= $jugador ? 'Guardar cambios' : 'Crear' ?></button>
</form>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
