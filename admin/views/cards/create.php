    <h1>Crear nueva carta</h1>

    <form action="index.php?controller=card&action=save" method="POST" enctype="multipart/form-data">

        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre" required><br><br>

        <label for="ataque">Ataque:</label><br>
        <input type="number" name="ataque" id="ataque" value="0" required><br><br>

        <label for="defensa">Defensa:</label><br>
        <input type="number" name="defensa" id="defensa" value="0" required><br><br>

        <label for="poder">Poder especial:</label><br>
        <input type="number" name="poder" id="poder" value="0" required><br><br>

        <label for="tipo">Tipo:</label><br>
        <input type="text" name="tipo" id="tipo" required><br><br>

        <label for="imagen">Imagen</label><br>
        <input type="file" name="imagen" id="imagen" accept="image/*"><br><br>

        <label for="descripcion">Descripción</label><br>
        <input type="text" name="descripcion" id="descripcion"><br><br>

        <button type="submit">Crear carta</button>
    </form>

    <br>
    <a href="index.php?controller=card&action=list">← Volver al listado</a>