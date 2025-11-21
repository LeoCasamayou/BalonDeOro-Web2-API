<?php require_once __DIR__ . '/../templates/header.php'; ?>

<main class="container mt-4">
    <header class="mb-4 text-center">
        <h1 class="text-primary">
            <?= isset($mencion) ? 'Editar Mención Honorífica' : 'Agregar Mención Honorífica' ?>
        </h1>
    </header>

    <section class="mx-auto" style="max-width: 600px;">
        <form method="POST" 
              action="<?= BASE_URL ?>menciones/<?= isset($mencion) ? 'actualizar' : 'crear' ?>">

            <?php if (isset($mencion)): ?>
                <input type="hidden" name="id" value="<?= $mencion->id ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label for="jugador" class="form-label fw-bold">Jugador</label>
                <input type="text" 
                       class="form-control" 
                       id="jugador" 
                       name="jugador" 
                       value="<?= $mencion->jugador ?? '' ?>" 
                       placeholder="Nombre del Jugador" 
                       required>
            </div>

            <div class="mb-3">
                <label for="puesto" class="form-label fw-bold">Puesto</label>
                <input type="number" 
                       class="form-control" 
                       id="puesto" 
                       name="puesto" 
                       value="<?= $mencion->puesto ?? '' ?>" 
                       placeholder="1,2,3..." 
                       required>
            </div>

            <div class="mb-3">
                <label for="justificacion" class="form-label fw-bold">Justificación</label>
                <textarea class="form-control" 
                          id="justificacion" 
                          name="justificacion" 
                          rows="4" 
                          placeholder="Explicá el por qué"
                          required><?= $mencion->justificacion ?? '' ?></textarea>
            </div>

            <div class="mb-3">
                <label for="club" class="form-label fw-bold">Club</label>
                <input type="text" 
                       class="form-control" 
                       id="club" 
                       name="club" 
                       value="<?= $mencion->club ?? '' ?>" 
                       placeholder="Ingresá su Club" 
                       required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary">
                    <?= isset($mencion) ? 'Actualizar' : 'Guardar' ?>
                </button>
                <a href="<?= BASE_URL ?>menciones" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </section>
</main>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>
