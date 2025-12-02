<?php

require_once 'admin/models/Card.php';

class CardController
{

    // LISTAR CARTAS
    public function list()
    {
        $model = new Card();
        $cards = $model->getAll();
        $view = 'admin/views/cards/list.php';

        include 'admin/header.php';
        include $view;
    }

    // MOSTRAR FORMULARIO DE CREACIÓN
    public function create()
    {
        $error = "";
        $view = 'admin/views/cards/create.php';
        include 'admin/header.php';
        include $view;
    }

    // GUARDAR NUEVA CARTA
    public function save()
    {
        $model = new Card();

        // Recogemos datos del formulario
        $nombre = trim($_POST['nombre'] ?? "");
        $ataque = filter_var($_POST['ataque'] ?? null, FILTER_VALIDATE_INT);
        $defensa = filter_var($_POST['defensa'] ?? null, FILTER_VALIDATE_INT);
        $poder = trim($_POST['poder'] ?? "");
        $tipo = trim($_POST['tipo'] ?? "");
        $descripcion = trim($_POST['descripcion'] ?? "");

        if (
            $nombre === "" || 
            $ataque === false || $defensa === false ||
            $tipo === "" || $tipo === ""
        ) {
            $error = "Esos campos son obligatorios.";
            require_once "views/layout.php";
            require_once "views/cards/create.php";
            return;
        }

        // Manejo de imagen
        $imagen = null;
        if (!empty($_FILES['imagen']['name'])) {
            $imagen =$_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'], "assets/images/cards/" . $imagen);
        }

        // Guardamos en la base de datos
        $model->create($nombre, $ataque, $defensa, $poder, $tipo, $imagen, $descripcion);

        // Redirigimos al listado
        header("Location: index.php?controller=card&action=list");
        exit();
    }

    // MOSTRAR FORMULARIO DE EDICIÓN
    public function edit()
    {
        $id = $_GET['id'];

        $model = new Card();
        $card = $model->getById($id);

        $view = 'admin/views/cards/edit.php';
        include 'admin/header.php';
        include $view;
    }

    // ACTUALIZAR CARTA
    public function update()
    {
        $id = $_POST['id'];

        $model = new Card();

        $nombre = trim($_POST['nombre'] ?? "");
        $ataque = filter_var($_POST['ataque'] ?? null, FILTER_VALIDATE_INT);
        $defensa = filter_var($_POST['defensa'] ?? null, FILTER_VALIDATE_INT);
        $poder = trim($_POST['poder'] ?? "");
        $tipo = trim($_POST['tipo'] ?? "");
        $descripcion = trim($_POST['descripcion'] ?? "");

        if (
            $nombre === "" || 
            $ataque === false || $defensa === false ||
            $tipo === "" || $tipo === ""
        ) {
            $error = "Esos campos son obligatorios.";
            require_once "views/layout.php";
            require_once "views/cards/create.php";
            return;
        }

        // Manejo de imagen (si sube una nueva)
        $imagen = $_POST['imagen_actual']; // por defecto mantiene la que tenía

        if (!empty($_FILES['imagen']['name'])) {
            $imagen =$_FILES['imagen']['name'];
            move_uploaded_file($_FILES['imagen']['tmp_name'], "assets/images/cards/" . $imagen);
        }

        // Actualizamos
        $model->update($id, $nombre, $ataque, $defensa, $poder, $tipo, $imagen, $descripcion);

        header("Location: index.php?controller=card&action=list");
        exit();
    }

    // ELIMINAR CARTA
    public function delete()
    {
        $id = $_GET['id'];

        $model = new Card();
        $model->delete($id);

        header("Location: index.php?controller=card&action=list");
        exit();
    }
}
