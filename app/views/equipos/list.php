<?php require_once __DIR__ . '/../templates/header.php'; ?>

<h1 class="text-primary mt-3 mb-4">Equipos</h1>

<table class="table table-bordered table-striped align-middle text-center">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Fundación</th>
            <th>Liga</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($equipos as $equipo): ?>
            <tr>
                <td><?= htmlspecialchars($equipo->id_equipo) ?></td>
                <td><?= htmlspecialchars($equipo->nombre) ?></td>
                <td><?= htmlspecialchars($equipo->fundacion) ?></td>
                <td><?= htmlspecialchars($equipo->liga) ?></td>
                <td>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="<?= BASE_URL ?>equipos/jugadores/<?= $equipo->id_equipo ?>" class="btn btn-sm btn-outline-primary">Ver jugadores</a>
                        <?php if (!empty($_SESSION['USER'])): ?>
                            <a href="<?= BASE_URL ?>equipos/editar/<?= $equipo->id_equipo ?>" class="btn btn-sm btn-success">Editar</a>
                            <a href="<?= BASE_URL ?>equipos/eliminar/<?= $equipo->id_equipo ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que querés eliminar este equipo?')">Eliminar</a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if (!empty($_SESSION['USER'])): ?>
    <div class="mt-3">
        <a href="<?= BASE_URL ?>equipos/agregar" class="btn btn-primary">Agregar Equipo</a>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
