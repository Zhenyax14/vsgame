<div class="container">

    <h2>Usuarios Registrados</h2>

    <a class="btn-create" href="index.php?controller=user&action=register">
        + Crear Usuario
    </a>

    <table class="table-users">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nickname</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= $u['nickname'] ?></td>
                    <td><?= $u['email'] ?></td>
                    <td><?= $u['admin'] ? 'Sí' : 'No' ?></td>
                    <td>
                        <a class="btn-edit" href="index.php?controller=user&action=edit&id=<?= $u['id'] ?>">
                            Editar
                        </a>
                        <a class="btn-delete" 
                           href="index.php?controller=user&action=delete&id=<?= $u['id'] ?>"
                           onclick="return confirm('¿Seguro que quieres eliminar este usuario?');">
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

</div>

<style>

.container {
    width: 90%;
    margin: 30px auto;
    background: #fff;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 0 10px #ccc;
    font-family: Arial, sans-serif;
}

h2 {
    margin-top: 0;
    text-align: center;
}

.table-users {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table-users th, 
.table-users td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}

.table-users tbody tr:hover {
    background: #f3f3f3;
}

.btn-create {
    display: inline-block;
    padding: 10px 15px;
    background: #0A5BF1;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    margin-bottom: 15px;
}

.btn-create:hover {
    background: #0846b5;
}

.btn-edit {
    padding: 6px 10px;
    background: #ffc107;
    color: black;
    text-decoration: none;
    border-radius: 5px;
    margin-right: 10px;
}

.btn-edit:hover {
    background: #e0a800;
}

.btn-delete {
    padding: 6px 10px;
    background: #dc3545;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}

.btn-delete:hover {
    background: #a71d2a;
}

</style>
