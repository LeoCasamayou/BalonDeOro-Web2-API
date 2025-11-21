<?php require __DIR__ . '/../templates/header.php'; ?>

<div class="container mt-5" style="max-width:400px;">
  <h2 class="text-center text-primary mb-4">Iniciar sesión</h2>

  <?php if (!empty($error)): ?>
    <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST" action="<?= BASE_URL ?>verificar">
    <div class="mb-3">
      <label for="user" class="form-label">Usuario</label>
      <input type="text" name="user" id="user" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="pass" class="form-label">Contraseña</label>
      <input type="password" name="pass" id="pass" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Entrar</button>
  </form>
</div>

<?php require __DIR__ . '/../templates/footer.php'; ?>
