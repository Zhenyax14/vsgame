<div class="card-container">

    <h1>Editar Carta</h1>

    <form action="index.php?controller=card&action=update" method="POST" enctype="multipart/form-data">

        <!-- ID oculto -->
        <input type="hidden" name="id" value="<?= $card['id'] ?>">

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input 
                type="text" 
                name="nombre" 
                id="nombre" 
                value="<?= htmlspecialchars($card['nombre']) ?>" 
                required
            >
        </div>

        <div class="form-group">
            <label for="ataque">Ataque</label>
            <input 
                type="number" 
                name="ataque" 
                id="ataque"
                value="<?= $card['ataque'] ?>" 
                required
            >
        </div>

        <div class="form-group">
            <label for="defensa">Defensa</label>
            <input 
                type="number" 
                name="defensa" 
                id="defensa" 
                value="<?= $card['defensa'] ?>" 
                required
            >
        </div>

        <div class="form-group">
            <label for="poder">Poder especial</label>
            <input 
                type="number" 
                name="poder" 
                id="poder"
                value="<?= $card['poder'] ?>" 
                required
            >
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <input 
                type="text" 
                name="tipo" 
                id="tipo"
                value="<?= htmlspecialchars($card['tipo']) ?>"
                required
            >
        </div>

        <div class="form-group">
            <label>Imagen actual</label><br>

            <?php if (!empty($card['imagen'])): ?>
                <img src="<?= BASE_URL ?>assets/images/cards/<?=$card['imagen'] ?>" width="90" style="border-radius: 6px; margin-bottom: 10px;">
            <?php else: ?>
                <i>(sin imagen)</i>
            <?php endif; ?>

            <input type="hidden" name="imagen_actual" value="<?= $card['imagen'] ?>">
        </div>

        <div class="form-group">
            <label for="imagen">Subir nueva imagen (opcional)</label>
            <input 
                type="file" 
                name="imagen" 
                id="imagen" 
                accept="image/*"
            >
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input 
                type="text" 
                name="descripcion" 
                id="descripcion"
                value="<?= htmlspecialchars($card['descripcion']) ?>"
            >
        </div>

        <button type="submit" class="btn-submit">Guardar cambios</button>
    </form>

    <a href="index.php?controller=card&action=list" class="btn-back">
        ← Volver al listado
    </a>

</div>

<style>
    .card-container {
        background: #ffffff;
        padding: 30px;
        margin: 30px auto;
        width: 550px;
        border-radius: 12px;
        box-shadow: 0 0 12px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 26px;
    }

    .form-group {
        margin-bottom: 18px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 6px;
    }

    input[type="text"],
    input[type="number"],
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #bbb;
        border-radius: 6px;
        font-size: 16px;
    }

    .btn-submit {
        width: 100%;
        background: #0A5BF1;
        color: white;
        padding: 12px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
        margin-top: 10px;
    }

    .btn-submit:hover {
        background: #094acc;
    }

    .btn-back {
        display: inline-block;
        margin-top: 15px;
        text-decoration: none;
        color: #333;
        font-size: 16px;
    }

    .btn-back:hover {
        text-decoration: underline;
    }
</style>
