<?php
include 'models/User.php';

class UserController
{
    // método registrar
    public function register()
    {
        // se reciben datos del FE
        $nickname = $_POST['nickname'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        // validación entrada
        if (!$nickname || !$email || !$password) {
            echo json_encode([
                "success" => false,
                "message" => "Todos los campos son obligatorios."
            ]);

            return;
        }
        // instanciamos usuario
        $user = new User();

        // validación email único
        if ($user->getByEmail($email)) {
            echo json_encode([
                "success" => false,
                "message" => "Email ya registrado."
            ]);
            return;
        }

        // usamos método del modelo User para crear usuario nuevo
        $result = $user->create($nickname, $email, $password);

        // respuesta al FE
        echo json_encode([
            "success" => $result,
            "message" => $result ? "Usuario creado con éxito" : "Error al crear usuario"
        ]);
    }

    // método para permitir logearse
    public function login()
    {
        // se reciben datos del FE
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        // validación campos
        if (!$email || !$password) {
            echo json_encode([
                "success" => false,
                "message" => "Todos los campos son obligatorios."
            ]);
            return;
        }
        // instancia modelo
        $user = new User();
        // buscamos usuario por email y guardamos sus datos
        $datosUser = $user->getByEmail($email);
        // validación 
        if (!$datosUser) {
            echo json_encode([
                "success" => false,
                "message" => "Email no registrado."
            ]);
            return;
        }
        // validación contraseña
        if (!password_verify($password, $datosUser['password'])) {
            echo json_encode([
                "success" => false,
                "message" => "Contraseña incorrecta."
            ]);
            return;
        }
        // iniciar sesión y guardar datos usuario
        session_start();
        $_SESSION['user'] = [
            "id" => $datosUser['id'],
            "nickname" => $datosUser['nickname'],
            "email" => $datosUser['email']
        ];
        
        // respuesta al FE
        echo json_encode([
            "success" => true,
            "message" => "Login correcto",
            "user" => [
                "id" => $datosUser['id'],
                "nickname" => $datosUser['nickname'],
                "email" => $datosUser['email']
            ]
        ]);
    }
    // método para cerrar sesión
    public function logout()
    {
        session_start();
        // eliminar datos del usuario
        unset($_SESSION['user']);
        // destruir la sesión
        session_destroy();
        // respuesta al FE
        echo json_encode([
            "success" => true,
            "message" => "Sesión cerrada correctamente."
        ]);
    }

    // método para obtener usuario
    public function getCurrentUser()
    {
        session_start();

        echo json_encode([
            "success" => true,
            "user" => $_SESSION['user']
        ]);
    }

    // método obtener ranking
    public function getRanking() {
        // instancia usuario
        $user = new User();
        $ranking = $user->getRanking();

        echo json_encode([
            "success"=>true,
            "ranking"=>"ranking"
        ]);
    }
}
