<?php
require_once __DIR__ . '/../models/mencion.model.php';

class MencionApiController {
    private $model;

    public function __construct() {
        $this->model = new MencionModel();
        header("Content-Type: application/json");
    }


    // GET /api/menciones   (con búsqueda + filtros + paginación)

    public function getAll() {

        // filtros GET
        $search      = $_GET['search'] ?? null;
        $club        = $_GET['club'] ?? null;
        $min_puesto  = isset($_GET['min']) ? (int)$_GET['min'] : null;
        $max_puesto  = isset($_GET['max']) ? (int)$_GET['max'] : null;

        // paginación simple
        $page  = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $limit = isset($_GET['limit']) ? max(1, (int)$_GET['limit']) : 10;
        $offset = ($page - 1) * $limit;

        // pedir al modelo
        $orden = $_GET['orden'] ?? null;

        $data = $this->model->getFiltered($search,$club,$min_puesto,$max_puesto,$limit,$offset,$orden);

        echo json_encode($data);
    }


    // GET /api/menciones/orden/{campo}
    // (OPCIONAL 8 – ordenar por campo)

    public function getOrdered($campo) {
        $data = $this->model->getAllOrdered($campo);

        if ($data)
            echo json_encode($data);
        else {
            http_response_code(400);
            echo json_encode(["error" => "Campo de orden inválido"]);
        }
    }

 
    // GET /api/menciones/filter/{campo}/{valor}
    // (OPCIONAL 9 – filtrar por campo)

    public function filterField($campo, $valor) {
        $data = $this->model->filterBy($campo, $valor);

        if (!empty($data))
            echo json_encode($data);
        else {
            http_response_code(404);
            echo json_encode(["error" => "No se encontraron resultados"]);
        }
    }


    // GET /api/menciones/{id}

    public function getById($id) {
        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(['error' => 'ID inválido']);
            return;
        }

        $mencion = $this->model->getById($id);

        if ($mencion) {
            echo json_encode($mencion);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Mención no encontrada']);
        }
    }


    // POST /api/menciones

    public function create() {
        $body = json_decode(file_get_contents("php://input"));

        if (!$body || empty($body->jugador) || !is_numeric($body->puesto)) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos inválidos']);
            return;
        }

        $this->model->create(
            $body->jugador,
            (int)$body->puesto,
            $body->justificacion ?? '',
            $body->club ?? ''
        );

        http_response_code(201);
        echo json_encode(['msg' => 'Mención creada']);
    }


    // PUT /api/menciones/{id}

    public function update($id) {
        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(['error' => 'ID inválido']);
            return;
        }

        $body = json_decode(file_get_contents("php://input"));

        if (!$body || empty($body->jugador) || !is_numeric($body->puesto)) {
            http_response_code(400);
            echo json_encode(['error' => 'Datos inválidos']);
            return;
        }

        $mencion = $this->model->getById($id);
        if (!$mencion) {
            http_response_code(404);
            echo json_encode(['error' => 'Mención no encontrada']);
            return;
        }

        $this->model->update(
            $id,
            $body->jugador,
            (int)$body->puesto,
            $body->justificacion ?? '',
            $body->club ?? ''
        );

        echo json_encode(['msg' => 'Mención actualizada']);
    }

    // DELETE /api/menciones/{id}
 
    public function delete($id) {
        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(['error' => 'ID inválido']);
            return;
        }

        $mencion = $this->model->getById($id);
        if (!$mencion) {
            http_response_code(404);
            echo json_encode(['error' => 'Mención no encontrada']);
            return;
        }

        $this->model->delete($id);

        http_response_code(204);
    }
}