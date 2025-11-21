<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isLoggedIn(): bool {
    return !empty($_SESSION['user']);
}

function currentUser(): ?array {
    return $_SESSION['user'] ?? null;
}

function loginUser(array $user): void {
    $_SESSION['user'] = [
        'id'   => (int)$user['id_usuario'],
        'user' => (string)$user['usuario'],
        'rol'  => (string)($user['rol'] ?? 'admin'),
    ];
}

function logoutUser(): void {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p["path"], $p["domain"], $p["secure"], $p["httponly"]);
    }
    session_destroy();
}

function requireLoginOrRedirect(string $baseUrl): void {
    if (!isLoggedIn()) {
        header('Location: ' . $baseUrl . 'login');
        exit;
    }
}