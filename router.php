<?php
require_once __DIR__ . '/config.php';

require_once __DIR__ . '/app/controllers/jugador.controller.php';
require_once __DIR__ . '/app/controllers/equipo.controller.php';
require_once __DIR__ . '/app/controllers/auth.controller.php';
require_once __DIR__ . '/app/controllers/mencion.controller.php';

$jug = new JugadorController();
$eq = new EquipoController();
$auth = new AuthController();
$mencion = new MencionController();

$action = $_GET['action'] ?? 'listar';
$params = explode('/', trim($action, '/'));

switch ($params[0]) {

    case 'login':
        $auth->showLogin();
        break;

    case 'verificar':
        $auth->login();
        break;

    case 'logout':
        $auth->logout();
        break;

    case 'listar':
    case 'jugadores':
        switch ($params[1] ?? '') {
            case 'agregar':     $jug->addForm(); break;
            case 'crear':       $jug->create(); break;
            case 'editar':      $jug->editForm((int)$params[2]); break;
            case 'actualizar':  $jug->update(); break;
            case 'eliminar':    $jug->delete((int)$params[2]); break;
            case 'detalle':     $jug->detail((int)$params[2]); break;
            default:            $jug->showJugadores(); break;
        }
        break;

    case 'equipos':

        if (($params[1] ?? '') === 'jugadores') {
            $jug->byEquipo((int)$params[2]);
            break;
        }

        switch ($params[1] ?? '') {
            case 'agregar':     $eq->addForm(); break;
            case 'crear':       $eq->create(); break;
            case 'editar':      $eq->editForm((int)$params[2]); break;
            case 'actualizar':  $eq->update(); break;
            case 'eliminar':    $eq->delete((int)$params[2]); break;
            default:            $eq->showEquipos(); break;
        }
        break;

    case 'menciones':
        switch ($params[1] ?? '') {
            case 'agregar':     $mencion->addForm(); break;
            case 'crear':       $mencion->create(); break;
            case 'editar':      $mencion->editForm((int)$params[2]); break;
            case 'actualizar':  $mencion->update(); break;
            case 'detalle':     $mencion->detail((int)$params[2]); break;
            case 'eliminar':    $mencion->delete((int)$params[2]); break;
            default:            $mencion->showMenciones(); break;
        }
        break;

        
    // API REST // 

    case 'api':
        require_once __DIR__ . '/app/api/mencion.api.controller.php';
        $api = new MencionApiController();

        // /api/menciones
        if ($params[1] === 'menciones') {

            // GET /api/menciones
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($params[2])) {
                $orden = $_GET['orden'] ?? null;
                $api->getAll($orden);
                break;
            }

            // GET /api/menciones/{id}
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($params[2])) {
                $api->getById((int)$params[2]);
                break;
            }

            // POST /api/menciones
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $api->create();
                break;
            }

            // PUT /api/menciones/{id}
            if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
                $api->update((int)$params[2]);
                break;
            }

            // DELETE /api/menciones/{id}
            if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
                $api->delete((int)$params[2]);
                break;
            }
        }

        // Si no coincide ninguna ruta API
        http_response_code(400);
        echo json_encode(["error" => "Ruta API no válida"]);
        break;

    default:
        http_response_code(404);
        echo "<h2 style='text-align:center; margin-top:40px;'>404 - Página no encontrada</h2>";
        break;
}