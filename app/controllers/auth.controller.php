<?php
require_once __DIR__ . '/../models/usuario.model.php';
require_once __DIR__ . '/../../config.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new UsuarioModel();
        if (session_status() === PHP_SESSION_NONE) session_start();
    }

    public function showLogin() {
        if (!empty($_SESSION['USER'])) {
            header('Location: ' . BASE_URL . 'listar');
            exit;
        }
        require __DIR__ . '/../views/auth/login.php';
    }

    public function login() {
        $user = trim($_POST['user'] ?? '');
        $pass = trim($_POST['pass'] ?? '');

        $dbUser = $this->model->getByUsername($user);

        if ($dbUser && password_verify($pass, $dbUser->password)) {
            $_SESSION['USER'] = $dbUser->usuario;
            $_SESSION['ROL'] = $dbUser->rol;
            header('Location: ' . BASE_URL . 'listar');
            exit;
        } else {
            $error = 'Usuario o contraseña incorrectos';
            require __DIR__ . '/../views/auth/login.php';
        }
    }

    public function logout() {
        session_destroy();
        header('Location: ' . BASE_URL . 'login');
        exit;
    }
}
