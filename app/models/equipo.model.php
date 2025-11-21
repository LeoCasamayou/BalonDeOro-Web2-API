<?php
require_once __DIR__ . '/../../config.php';

class EquipoModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    }

    public function getEquipos() {
        $q = $this->db->query("SELECT * FROM equipos ORDER BY id_equipo ASC");
        return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById(int $id) {
        $q = $this->db->prepare("SELECT * FROM equipos WHERE id_equipo=?");
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_OBJ);
    }

    public function create(string $nombre, int $fundacion, string $liga) {
        $q = $this->db->prepare("INSERT INTO equipos (nombre, fundacion, liga) VALUES (?,?,?)");
        $q->execute([$nombre, $fundacion, $liga]);
        return (int)$this->db->lastInsertId();
    }

    public function update(int $id, string $nombre, int $fundacion, string $liga) {
        $q = $this->db->prepare("UPDATE equipos SET nombre=?, fundacion=?, liga=? WHERE id_equipo=?");
        $q->execute([$nombre, $fundacion, $liga, $id]);
    }

    public function delete(int $id) {
        $q = $this->db->prepare("DELETE FROM equipos WHERE id_equipo=?");
        $q->execute([$id]);
    }
}
