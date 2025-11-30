<?php
include __DIR__ . '/../models/User.php';

class UserController
{

    // método para registrar
    public function register()
    {
        $model = new User();

        // si se envía por POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nickname = trim($_POST['nickname'] ?? null);
            $email    = trim($_POST['email'] ?? null);
            $password = trim($_POST['password'] ?? null);
            $admin    = isset($_POST['admin']) ? 1 : 0;

            // Validación campos
            if (!$nickname || !$email || !$password) {
                $mensaje = "Todos los campos son obligatorios.";
            }
            // Validación email duplicado
            elseif ($model->getByEmail($email)) {
                $mensaje = "Ya existe un usuario con ese email.";
            } else {
                // Crear usuario
                $model->create($nickname, $email, $password, $admin);
                header("Location: admin/login.php");
                exit;
            }
        }
        // si se manda por GET, se manda a formulario
        $view = 'admin/views/users/create.php';
        include 'admin/header.php';
        include $view;
    }

    // método para permitir logearse
    public function login()
    {
        session_start();


        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;


        $model = new User();
        $user = $model->getByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['login_error'] = "Usuario o contraseña incorrectos.";
            header("Location: admin/login.php");
            exit;
        }

        if (!$user['admin']) {
            $_SESSION['login_error'] = "No tienes permisos para acceder al panel.";
            header("Location: admin/login.php");
            exit;
        }

        $_SESSION['admin'] = [
            "id"       => $user['id'],
            "email"    => $user['email'],
            "nickname" => $user['nickname']
        ];

        header("Location: index.php?controller=user&action=list");
        exit;
    }

    // método para cerrar sesión
    public function logout()
    {
        session_start();
        // eliminar datos del usuario
        unset($_SESSION['admin']);
        session_destroy();
        
        header("Location: admin/login.php");
        exit;
    }
    // método para listar que lleva a list.php
    public function list()
    {
        $model = new User();
        $users = $model->getAll();

        $view = 'admin/views/users/list.php';
        include 'admin/header.php';
        include $view;
    }

    // método para obtener usuario
    public function getCurrentUser()
    {
        session_start();
        return $_SESSION['admin'] ?? null;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "Error: ID no válido.";
            exit;
        }

        $model = new User();
        $user = $model->getById($id);

        $view = 'admin/views/users/edit.php';
        include 'admin/header.php';
        include $view;
    }

    // método modificar usuario
    public function update()
    {
        $id       = $_POST['id'] ?? null;
        $nickname = $_POST['nickname'] ?? null;
        $email    = $_POST['email'] ?? null;
        $admin    = $_POST['admin'] ?? 0;
        $password = trim($_POST['password'] ?? "");

        $model = new User();

        // Validar que no exista otro usuario con ese email
        $users = $model->getAll();

        foreach ($users as $u) {
            // si el email coincide con otro usuario distinto del que estamos editando
            if ($u['email'] === $email && $u['id'] != $id) {

                $user = $model->getById($id); // cargar datos actuales para mantenerlos

                $mensaje = "El email ya está registrado por otro usuario.";

                require_once "admin/views/users/edit.php";
                return;
            }
        }
            $model->updateUser($id, $nickname, $email, $admin, $password);

            header("Location: index.php?controller=user&action=list");
            exit;
        
    }

    // método eliminar usuario
    public function delete()
    {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            echo "Error: ID no válido.";
            exit;
        }

        $model = new User();
        $model->delete($id);

        header("Location: index.php?controller=user&action=list");
    }
}
