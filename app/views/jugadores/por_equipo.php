<?php require_once __DIR__ . '/../templates/header.php'; ?>
<h1>Jugadores del <?= htmlspecialchars($equipo->nombre) ?></h1>
<p class="text-muted">Liga: <?= htmlspecialchars($equipo->liga) ?> — Fundación: <?= htmlspecialchars($equipo->fundacion) ?></p>
<table class="table table-bordered table-striped mt-3 text-center align-middle">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Posición</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($jugadores as $j): ?>
      <tr>
        <td><?= (int)$j->id_jugador ?></td>
        <td><?= htmlspecialchars($j->nombre) ?></td>
        <td><?= htmlspecialchars($j->posicion) ?></td>
        <td>
          <div class="d-flex justify-content-center gap-2">
            <a class="btn btn-sm btn-outline-primary" href="<?= BASE_URL ?>jugadores/detalle/<?= (int)$j->id_jugador ?>">Ver</a>
            <?php if (!empty($_SESSION['USER'])): ?>
              <a class="btn btn-sm btn-success" href="<?= BASE_URL ?>jugadores/editar/<?= (int)$j->id_jugador ?>">Editar</a>
              <a class="btn btn-sm btn-danger" href="<?= BASE_URL ?>jugadores/eliminar/<?= (int)$j->id_jugador ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            <?php endif; ?>
          </div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<a class="btn btn-outline-secondary mt-2" href="<?= BASE_URL ?>equipos">Volver a equipos</a>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>
