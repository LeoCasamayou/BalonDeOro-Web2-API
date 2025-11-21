<?php
require_once __DIR__ . '/../../config.php';

class JugadorModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    }

    public function getJugadores() {
        $q = $this->db->query("SELECT j.*, e.nombre AS equipo FROM jugadores j JOIN equipos e ON e.id_equipo = j.id_equipo ORDER BY j.id_jugador ASC");
        return $q->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById(int $id) {
        $q = $this->db->prepare("SELECT * FROM jugadores WHERE id_jugador = ?");
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_OBJ);
    }

    public function create($nombre, $posicion, $id_equipo) {
        $q = $this->db->prepare("INSERT INTO jugadores (nombre, posicion, id_equipo) VALUES (?, ?, ?)");
        $q->execute([$nombre, $posicion, $id_equipo]);
    }

    public function update($id, $nombre, $posicion, $id_equipo) {
        $q = $this->db->prepare("UPDATE jugadores SET nombre=?, posicion=?, id_equipo=? WHERE id_jugador=?");
        $q->execute([$nombre, $posicion, $id_equipo, $id]);
    }

    public function delete($id) {
        $q = $this->db->prepare("DELETE FROM jugadores WHERE id_jugador=?");
        $q->execute([$id]);
    }

    public function getByIdWithEquipo(int $id) {
        $sql = "SELECT j.*, e.nombre AS equipo_nombre, e.liga, e.fundacion
                FROM jugadores j
                JOIN equipos e ON e.id_equipo = j.id_equipo
                WHERE j.id_jugador = ?";
        $q = $this->db->prepare($sql);
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_OBJ);
    }

    public function getByEquipo(int $idEquipo) {
        $sql = "SELECT j.id_jugador, j.nombre, j.posicion, e.nombre AS equipo
                FROM jugadores j
                JOIN equipos e ON e.id_equipo = j.id_equipo
                WHERE j.id_equipo = ?
                ORDER BY j.id_jugador ASC";
        $q = $this->db->prepare($sql);
        $q->execute([$idEquipo]);
        return $q->fetchAll(PDO::FETCH_OBJ);
    }
}
