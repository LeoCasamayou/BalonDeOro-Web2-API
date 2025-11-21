<?php require __DIR__ . '/../templates/header.php'; ?>

<main class="container mt-4">
  <h2 class="text-center text-warning mb-4">Editar Mención</h2>

  <form action="<?= BASE_URL ?>menciones/actualizar" method="POST">
    <input type="hidden" name="id" value="<?= $mencion->id ?>">

    <div class="mb-3">
      <label for="jugador" class="form-label">Jugador</label>
      <input type="text" name="jugador" id="jugador" class="form-control" value="<?= htmlspecialchars($mencion->jugador) ?>" required>
    </div>

    <div class="mb-3">
      <label for="puesto" class="form-label">Puesto</label>
      <input type="number" name="puesto" id="puesto" class="form-control" value="<?= htmlspecialchars($mencion->puesto) ?>" required>
    </div>

    <div class="mb-3">
      <label for="club" class="form-label">Club</label>
      <input type="text" name="club" id="club" class="form-control" value="<?= htmlspecialchars($mencion->club) ?>">
    </div>

    <div class="mb-3">
      <label for="justificacion" class="form-label">Justificación</label>
      <textarea name="justificacion" id="justificacion" class="form-control" rows="3"><?= htmlspecialchars($mencion->justificacion) ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
  </form>
</main>

<?php require __DIR__ . '/../templates/footer.php'; ?>
