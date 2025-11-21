<?php
require_once __DIR__ . '/../models/mencion.model.php';

class MencionController {
    private $model;

    public function __construct() {
        $this->model = new MencionModel();
    }

    public function addForm() {
        require __DIR__ . '/../views/menciones/form.php';
    }

    public function create() {
        $jugador = $_POST['jugador'] ?? '';
        $puesto = $_POST['puesto'] ?? '';
        $justificacion = $_POST['justificacion'] ?? '';
        $club = $_POST['club'] ?? '';

        if (!empty($jugador) && is_numeric($puesto)) {
            $this->model->create($jugador, (int)$puesto, $justificacion, $club);
        }

        header('Location: ' . BASE_URL . 'menciones');
    }

    public function editForm($id) {
        $mencion = $this->model->getById($id);
        require __DIR__ . '/../views/menciones/form_edit.php';
    }

    public function update() {
        $id = $_POST['id'] ?? 0;
        $jugador = $_POST['jugador'] ?? '';
        $puesto = $_POST['puesto'] ?? '';
        $justificacion = $_POST['justificacion'] ?? '';
        $club = $_POST['club'] ?? '';

        if ($id && !empty($jugador) && is_numeric($puesto)) {
            $this->model->update($id, $jugador, (int)$puesto, $justificacion, $club);
        }

        header('Location: ' . BASE_URL . 'menciones');
    }

    public function detail($id) {
        $mencion = $this->model->getById($id);
        require __DIR__ . '/../views/menciones/detalle.php';
    }

    public function delete($id) {
        $this->model->delete($id);
        header('Location: ' . BASE_URL . 'menciones');
    }

    public function showMenciones() {
    $campo = null;
    $valor = null;

    if (isset($_GET['club'])) {
        $campo = 'club';
        $valor = $_GET['club'];
    }

    if (isset($_GET['jugador'])) {
        $campo = 'jugador';
        $valor = $_GET['jugador'];
    }

    if (isset($_GET['puesto'])) {
        $campo = 'puesto';
        $valor = $_GET['puesto'];
    }

    if ($campo && $valor !== '') {
        $menciones = $this->model->filterBy($campo, $valor);
    } else {
        
        $menciones = $this->model->getAll();
    }

    require __DIR__ . '/../views/menciones/listado.php';
}
}
