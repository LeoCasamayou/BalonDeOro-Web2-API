<?php
// CONFIGURACIÓN DE BASE DE DATOS
const DB_HOST = 'localhost';
const DB_NAME = 'balon_de_oro';
const DB_USER = 'root';
const DB_PASS = '';

// INICIO DE SESIÓN
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// URL BASE AUTOMÁTICA (NO HARDCODEADA)
$basePath = str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
define('BASE_URL', 
    sprintf(
        '%s://%s%s',
        (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        rtrim($basePath, '/')
    ) . '/'
);
