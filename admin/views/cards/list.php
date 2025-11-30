<div class="card-list-container">

    <h1>Listado de Cartas</h1>

    <a href="index.php?controller=card&action=create" class="btn-create">
        + Crear nueva carta
    </a>

    <table class="cards-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ataque</th>
                <th>Defensa</th>
                <th>Poder</th>
                <th>Tipo</th>
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($cards)): ?>
                <tr>
                    <td colspan="9" class="empty-message">
                        No hay cartas registradas.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($cards as $card): ?>
                    <tr>
                        <td><?= $card['id'] ?></td>
                        <td><?= htmlspecialchars($card['nombre']) ?></td>
                        <td><?= $card['ataque'] ?></td>
                        <td><?= $card['defensa'] ?></td>
                        <td><?= $card['poder'] ?></td>
                        <td><?= htmlspecialchars($card['tipo']) ?></td>

                        <td>
                            <?php if (!empty($card['imagen'])): ?>
                                <img src="<?= BASE_URL ?>assets/images/cards/<?= $card['imagen'] ?>" class="img-card">
                            <?php else: ?>
                                <span class="no-image">(sin imagen)</span>
                            <?php endif; ?>
                        </td>

                        <td class="desc">
                            <?= htmlspecialchars($card['descripcion']) ?>
                        </td>

                        <td class="actions">
                            <a class="btn-edit" 
                               href="index.php?controller=card&action=edit&id=<?= $card['id'] ?>">
                                Editar
                            </a>

                            <a class="btn-delete"
                               href="index.php?controller=card&action=delete&id=<?= $card['id'] ?>"
                               onclick="return confirm('¿Seguro que deseas eliminar esta carta?');">
                                Eliminar
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</div>


<style>
    .card-list-container {
        width: 95%;
        margin: 25px auto;
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 0 12px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }

    h1 {
        margin-top: 0;
        text-align: center;
        font-size: 26px;
    }

    .btn-create {
        display: inline-block;
        background: #0A5BF1;
        color: white;
        padding: 10px 15px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .btn-create:hover {
        background: #1e7d37;
    }

    .cards-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        font-size: 15px;
    }

    .cards-table th {
        background: #0A5BF1;
        color: white;
        padding: 12px;
        text-align: center;
    }

    .cards-table td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: center;
        vertical-align: middle;
    }

    .empty-message {
        padding: 25px;
        font-size: 18px;
        text-align: center;
        font-weight: bold;
        background: #f3f3f3;
    }

    .img-card {
        width: 70px;
        border-radius: 6px;
    }

    .no-image {
        color: #666;
        font-style: italic;
    }

    .desc {
        max-width: 220px;
        text-align: left;
        word-wrap: break-word;
    }

    .actions a {
        display: block;
        margin: 4px 0;
        text-decoration: none;
        padding: 5px 8px;
        border-radius: 6px;
        font-weight: bold;
    }

    .btn-edit {
        background: #ffc107;
        color: #333;
    }

    .btn-edit:hover {
        background: #e0a800;
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #b52a35;
    }
</style>
