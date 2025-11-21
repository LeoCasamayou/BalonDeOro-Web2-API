<?php
require_once __DIR__ . '/../models/jugador.model.php';
require_once __DIR__ . '/../models/equipo.model.php';
require_once __DIR__ . '/../../config.php';

class JugadorController {
    private $jugModel;
    private $equipoModel;

    public function __construct() {
        $this->jugModel = new JugadorModel();
        $this->equipoModel = new EquipoModel();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    private function mustBeLogged() {
        if (empty($_SESSION['USER'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    public function showJugadores() {
        $jugadores = $this->jugModel->getJugadores();
        require __DIR__ . '/../views/jugadores/list.php';
    }

    public function addForm() {
        $this->mustBeLogged();
        $equipos = $this->equipoModel->getEquipos();
        $jugador = null;
        require __DIR__ . '/../views/jugadores/form.php';
    }

    public function create() {
        $this->mustBeLogged();
        $nombre = trim($_POST['nombre'] ?? '');
        $posicion = trim($_POST['posicion'] ?? '');
        $id_equipo = (int)($_POST['id_equipo'] ?? 0);

        if ($nombre && $posicion && $id_equipo) {
            $this->jugModel->create($nombre, $posicion, $id_equipo);
        }
        header('Location: ' . BASE_URL . 'listar');
    }

    public function editForm(int $id) {
        $this->mustBeLogged();
        $jugador = $this->jugModel->getById($id);
        if (!$jugador) { header('Location: ' . BASE_URL . 'listar'); exit; }
        $equipos = $this->equipoModel->getEquipos();
        require __DIR__ . '/../views/jugadores/form.php';
    }

    public function update() {
        $this->mustBeLogged();
        $id = (int)($_POST['id_jugador'] ?? 0);
        $nombre = trim($_POST['nombre'] ?? '');
        $posicion = trim($_POST['posicion'] ?? '');
        $id_equipo = (int)($_POST['id_equipo'] ?? 0);

        if ($id && $nombre && $posicion && $id_equipo) {
            $this->jugModel->update($id, $nombre, $posicion, $id_equipo);
        }
        header('Location: ' . BASE_URL . 'listar');
    }

    public function delete(int $id) {
        $this->mustBeLogged();
        if ($id) $this->jugModel->delete($id);
        header('Location: ' . BASE_URL . 'listar');
    }

    public function detail(int $id) {
        $jugador = $this->jugModel->getByIdWithEquipo($id);
        if (!$jugador) { header('Location: ' . BASE_URL . 'listar'); exit; }
        require __DIR__ . '/../views/jugadores/detail.php';
    }

    public function byEquipo(int $idEquipo) {
        $equipo = $this->equipoModel->getById($idEquipo);
        if (!$equipo) { header('Location: ' . BASE_URL . 'equipos'); exit; }
        $jugadores = $this->jugModel->getByEquipo($idEquipo);
        require __DIR__ . '/../views/jugadores/por_equipo.php';
    }
}
