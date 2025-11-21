<?php require_once __DIR__ . '/../templates/header.php'; ?>
<h1>Detalle del jugador</h1>
<div class="card mt-3" style="max-width: 640px;">
  <div class="card-body">
    <h3 class="card-title mb-1"><?= htmlspecialchars($jugador->nombre) ?></h3>
    <p class="text-muted mb-3">Posición: <strong><?= htmlspecialchars($jugador->posicion) ?></strong></p>
    <ul class="list-group list-group-flush">
      <li class="list-group-item"><strong>Equipo:</strong> <?= htmlspecialchars($jugador->equipo_nombre) ?></li>
      <li class="list-group-item"><strong>Liga:</strong> <?= htmlspecialchars($jugador->liga) ?></li>
      <li class="list-group-item"><strong>Fundación del club:</strong> <?= htmlspecialchars($jugador->fundacion) ?></li>
    </ul>
    <div class="mt-3 d-flex gap-2">
      <a class="btn btn-outline-primary" href="<?= BASE_URL ?>listar">Volver a Jugadores</a>
      <a class="btn btn-outline-secondary" href="<?= BASE_URL ?>equipos/jugadores/<?= (int)$jugador->id_equipo ?>">Ver compañeros</a>
    </div>
  </div>
</div>
<?php require_once __DIR__ . '/../templates/footer.php'; ?>
