<?php 
require_once __DIR__ . '/../templates/header.php'; 
if (session_status() === PHP_SESSION_NONE) session_start(); 
?>

<main class="container mt-4">
    <header class="mb-4 text-center">
        <h1 class="text-primary">Menciones Honoríficas</h1>
    </header>

    <section>
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Jugador</th>
                    <th>Puesto</th>
                    <th>Club</th>
                    <th>Justificación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menciones as $mencion): ?>
                    <tr>
                        <td><?= htmlspecialchars($mencion->id) ?></td>
                        <td><?= htmlspecialchars($mencion->jugador) ?></td>
                        <td><?= htmlspecialchars($mencion->puesto) ?></td>
                        <td><?= htmlspecialchars($mencion->club) ?></td>
                        <td><?= htmlspecialchars($mencion->justificacion) ?></td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="<?= BASE_URL ?>menciones/detalle/<?= $mencion->id ?>" class="btn btn-outline-primary btn-sm">Ver</a>
                                <?php if (!empty($_SESSION['USER'])): ?>
                                    <a href="<?= BASE_URL ?>menciones/editar/<?= $mencion->id ?>" class="btn btn-success btn-sm">Editar</a>
                                    <a href="<?= BASE_URL ?>menciones/eliminar/<?= $mencion->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que querés eliminar esta mención?')">Eliminar</a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <?php if (!empty($_SESSION['USER'])): ?>
        <footer class="mt-3 text-center">
            <a href="<?= BASE_URL ?>menciones/agregar" class="btn btn-primary">Agregar Mención</a>
        </footer>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
