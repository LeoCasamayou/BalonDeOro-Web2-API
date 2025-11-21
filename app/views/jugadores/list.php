<?php require_once __DIR__ . '/../templates/header.php'; ?>

<main class="container mt-4">
    <header class="mb-4 text-center">
        <h1 class="text-primary">Jugadores (Top 10)</h1>
    </header>

    <section>
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Puesto</th>
                    <th>Nombre</th>
                    <th>Posición</th>
                    <th>Equipo</th>
                    <?php if (!empty($_SESSION['USER'])): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jugadores as $jugador): ?>
                    <tr>
                        <td><?= htmlspecialchars($jugador->id_jugador) ?></td>
                        <td><?= htmlspecialchars($jugador->nombre) ?></td>
                        <td><?= htmlspecialchars($jugador->posicion) ?></td>
                        <td><?= htmlspecialchars($jugador->equipo) ?></td>
                        <?php if (!empty($_SESSION['USER'])): ?>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-sm btn-outline-primary" href="<?= BASE_URL ?>jugadores/detalle/<?= (int)$jugador->id_jugador ?>">Ver</a>
                                    <a href="<?= BASE_URL ?>jugadores/editar/<?= $jugador->id_jugador ?>" class="btn btn-success btn-sm">Editar</a>
                                    <a href="<?= BASE_URL ?>jugadores/eliminar/<?= $jugador->id_jugador ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que querés eliminar este jugador?')">Eliminar</a>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <?php if (!empty($_SESSION['USER'])): ?>
        <footer class="mt-3 text-center">
            <a href="<?= BASE_URL ?>jugadores/agregar" class="btn btn-primary">Agregar Jugador</a>
        </footer>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
