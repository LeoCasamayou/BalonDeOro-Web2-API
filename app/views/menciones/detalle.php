<?php require_once __DIR__ . '/../templates/header.php'; ?>

<main class="container mt-4">
    <header class="mb-4 text-center">
        <h1 class="text-primary">Detalle de Mención Honorífica</h1>
        <p class="text-muted">Jugador destacado del 2025</p>
    </header>

    <section class="mx-auto" style="max-width: 700px;">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Campo</th>
                    <th>Información</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Jugador</strong></td>
                    <td><?= htmlspecialchars($mencion->jugador) ?></td>
                </tr>
                <tr>
                    <td><strong>Puesto</strong></td>
                    <td><?= htmlspecialchars($mencion->puesto) ?></td>
                </tr>
                <tr>
                    <td><strong>Justificación</strong></td>
                    <td><?= htmlspecialchars($mencion->justificacion) ?></td>
                </tr>
                <tr>
                    <td><strong>Club</strong></td>
                    <td><?= htmlspecialchars($mencion->club) ?></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="<?= BASE_URL ?>menciones" class="btn btn-secondary">Volver</a>

            <?php if (!empty($_SESSION['USER'])): ?>
                <a href="<?= BASE_URL ?>menciones/editar/<?= $mencion->id ?>" class="btn btn-success">Editar</a>
                <a href="<?= BASE_URL ?>menciones/eliminar/<?= $mencion->id ?>" 
                   onclick="return confirm('¿Seguro que querés eliminar esta mención?')" 
                   class="btn btn-danger">Eliminar</a>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
