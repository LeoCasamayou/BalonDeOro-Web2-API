<?php
require_once __DIR__ . '/../../../config.php';
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balón de Oro 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f9fafc;
        }
        nav {
            background-color: #fff;
            border-bottom: 2px solid #f0f0f0;
            padding: 0.8rem 1.5rem;
        }
        .navbar-brand {
            font-weight: bold;
            color: #007bff;
        }
        .nav-buttons {
            display: flex;
            gap: 0.8rem;
        }
        .btn-nav {
            border-radius: 6px;
            font-weight: 500;
            padding: 0.4rem 1rem;
        }
        .btn-jugadores {
            background-color: #007bff;
            color: white;
        }
        .btn-equipos {
            background-color: #6c757d;
            color: white;
        }
        .btn-menciones {
            background-color: #ffc107;
            color: #212529;
        }
        .btn-login {
            background-color: #28a745;
            color: white;
        }
        .btn-logout {
            background-color: #dc3545;
            color: white;
        }
        h1 {
            color: #007bff;
            font-weight: bold;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>

<nav class="d-flex justify-content-between align-items-center">
    <span class="navbar-brand">⚽ Balón de Oro 2025</span>

    <div class="nav-buttons">
        <a href="<?= BASE_URL ?>listar" class="btn btn-nav btn-jugadores">Jugadores</a>
        <a href="<?= BASE_URL ?>equipos" class="btn btn-nav btn-equipos">Equipos</a>
        <a href="<?= BASE_URL ?>menciones" class="btn btn-nav btn-menciones">Menciones</a>

        <?php if (!empty($_SESSION['USER'])): ?>
            <a href="<?= BASE_URL ?>logout" class="btn btn-nav btn-logout">
                Salir (<?= htmlspecialchars($_SESSION['USER']) ?>)
            </a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>login" class="btn btn-nav btn-login">Entrar</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container mt-4">
