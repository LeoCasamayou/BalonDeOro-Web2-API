<?php
require_once __DIR__ . '/../models/equipo.model.php';
require_once __DIR__ . '/../../config.php';

class EquipoController {
    private $model;

    public function __construct() {
        $this->model = new EquipoModel();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    private function mustBeLogged() {
        if (empty($_SESSION['USER'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    public function showEquipos() {
        $equipos = $this->model->getEquipos();
        require __DIR__ . '/../views/equipos/list.php';
    }

    public function addForm() {
        $this->mustBeLogged();
        $equipo = null;
        require __DIR__ . '/../views/equipos/form.php';
    }

    public function create() {
        $this->mustBeLogged();
        $nombre    = trim($_POST['nombre'] ?? '');
        $fundacion = (int)($_POST['fundacion'] ?? 0);
        $liga      = trim($_POST['liga'] ?? '');
        if ($nombre && $fundacion && $liga) {
            $this->model->create($nombre, $fundacion, $liga);
        }
        header('Location: ' . BASE_URL . 'equipos');
    }

    public function editForm(int $id) {
        $this->mustBeLogged();
        $equipo = $this->model->getById($id);
        if (!$equipo) { header('Location: ' . BASE_URL . 'equipos'); exit; }
        require __DIR__ . '/../views/equipos/form.php';
    }

    public function update() {
        $this->mustBeLogged();
        $id        = (int)($_POST['id_equipo'] ?? 0);
        $nombre    = trim($_POST['nombre'] ?? '');
        $fundacion = (int)($_POST['fundacion'] ?? 0);
        $liga      = trim($_POST['liga'] ?? '');
        if ($id && $nombre && $fundacion && $liga) {
            $this->model->update($id, $nombre, $fundacion, $liga);
        }
        header('Location: ' . BASE_URL . 'equipos');
    }

    public function delete(int $id) {
        $this->mustBeLogged();

        if ($id) {
            try {
                $this->model->delete($id);
            } catch (PDOException $e) {
                
                $error = "⚠️ No se puede eliminar el equipo porque tiene jugadores asociados.";
                $equipos = $this->model->getEquipos();
                require __DIR__ . '/../views/equipos/list.php';
                return;
            }
        }

        header('Location: ' . BASE_URL . 'equipos');
    }
}
