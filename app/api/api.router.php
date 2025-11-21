<?php
require_once __DIR__ . '/../models/mencion.model.php';
require_once __DIR__ . '/mencion.api.controller.php';

// Obtener ruta desde la query
$resource = $_GET['resource'] ?? '';
$params = explode('/', trim($resource, '/'));

$api = new MencionApiController();

switch ($params[0]) {

    // GET /api/menciones
    case 'menciones':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // GET /api/menciones
            if (empty($params[1])) {
                $api->getAll();
                break;
            }

            // GET /api/menciones/{id}
            $api->getById((int)$params[1]);
            break;
        }

        // POST /api/menciones
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $api->create();
            break;
        }

        // PUT /api/menciones/{id}
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            $api->update((int)$params[1]);
            break;
        }

        // DELETE /api/menciones/{id}
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            $api->delete((int)$params[1]);
            break;
        }

        break;

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Recurso no encontrado']);
}