<div class="container">

    <h2>Editar Usuario</h2>

    <?php if (isset($mensaje)): ?>
        <div style="padding:10px; background:#ffdddd; border:1px solid #bb0000; margin-bottom:15px; border-radius:5px;">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>

    <form action="index.php?controller=user&action=update" method="POST">

        <!-- ID oculto -->
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <label>Nickname:</label><br>
        <input type="text" name="nickname" value="<?= htmlspecialchars($user['nickname']) ?>" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>

        <label>Nueva contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <label>¿Es administrador?</label><br>
        <select name="admin">
            <option value="0" <?= $user['admin'] == 0 ? 'selected' : '' ?>>No</option>
            <option value="1" <?= $user['admin'] == 1 ? 'selected' : '' ?>>Sí</option>
        </select>

        <br><br>
        <button type="submit">Guardar Cambios</button>
        <a class="btn-back" href="index.php?controller=user&action=list">← Volver</a>

    </form>

</div>

<style>
    .container {
        width: 400px;
        margin: 20px auto;
        padding: 25px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px #ccc;
        font-family: sans-serif;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    input[type=text],
    input[type=email],
    input[type=password],
    select {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    small {
        color: #666;
        font-size: 12px;
    }

    button {
        width: 100%;
        padding: 12px;
        background: #0A5BF1;
        color: white;
        border: none;
        font-size: 16px;
        border-radius: 6px;
        cursor: pointer;
    }

    button:hover {
        background: #0846b5;
    }

    .btn-back {
        display: inline-block;
        padding: 8px 12px;
        background: #555;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        margin-bottom: 15px;
    }

    .btn-back:hover {
        background: #333;
    }
</style>