    <h1>Listado de cartas</h1>

    <a href="index.php?controller=card&action=create">Crear nueva carta</a>
    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ataque</th>
                <th>Defensa</th>
                <th>Imagen</th>
                <th>Poder especial</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($cards)): ?>
                <tr>
                    <td colspan="8" style="text-align:center;">No hay cartas registradas.</td>
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
                                <img src="uploads/<?= $card['imagen'] ?>" width="60">
                            <?php else: ?>
                                (sin imagen)
                            <?php endif; ?>
                        </td>

                        <td>
                            <a href="index.php?controller=card&action=edit&id=<?= $card['id'] ?>">✏️ Editar</a>
                            |
                            <a href="index.php?controller=card&action=delete&id=<?= $card['id'] ?>"
                                onclick="return confirm('¿Seguro que deseas eliminar esta carta?');">
                                ❌ Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>