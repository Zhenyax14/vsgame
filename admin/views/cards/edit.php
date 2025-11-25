    <h1>Editar carta</h1>

    <form action="index.php?controller=card&action=update" method="POST" enctype="multipart/form-data">

        <!-- ID oculto -->
        <input type="hidden" name="id" value="<?= $card['id'] ?>">

        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($card['nombre']) ?>" required><br><br>

        <label for="ataque">Ataque:</label><br>
        <input type="number" name="ataque" id="ataque" value="<?= $card['ataque'] ?>" required><br><br>

        <label for="defensa">Defensa:</label><br>
        <input type="number" name="defensa" id="defensa" value="<?= $card['defensa'] ?>" required><br><br>

        <label for="poder">Poder:</label><br>
        <input type="number" name="poder" id="poder" value="<?= $card['poder'] ?>" required><br><br>

        <label for="tipo">Tipo:</label><br>
        <input type="text" name="tipo" id="tipo" required><br><br>

        <!-- Imagen actual -->
        <p>Imagen actual:</p>
        <?php if (!empty($card['imagen'])): ?>
            <img src="uploads/<?= $card['imagen'] ?>" width="80"><br>
        <?php else: ?>
            <i>(sin imagen)</i><br>
        <?php endif; ?>

        <!-- Guardamos la imagen actual por si no se cambia -->
        <input type="hidden" name="imagen_actual" value="<?= $card['imagen'] ?>">

        <label for="imagen">Subir nueva imagen (opcional):</label><br>
        <input type="file" name="imagen" id="imagen" accept="image/*"><br><br>

        <label for="descripcion">Descripción</label><br>
        <input type="text" name="descripcion" id="descripcion"><br><br>

        <button type="submit">Guardar cambios</button>
    </form>

    <br>
    <a href="index.php?controller=card&action=list">← Volver al listado</a>