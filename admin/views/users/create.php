<div class="container">

    <h2>Crear Usuario</h2>

    <?php if (isset($mensaje)): ?>
        <div style="padding:10px; background:#ffdddd; border:1px solid #bb0000; margin-bottom:15px; border-radius:5px;">
            <?= $mensaje ?>
        </div>
    <?php endif; ?>

    <form action="index.php?controller=user&action=register" method="POST">

        <label>Nickname:</label><br>
        <input type="text" name="nickname" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <br><br>

        <button type="submit">Crear Usuario</button>
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
    input[type=password] {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 14px;
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
</style>
