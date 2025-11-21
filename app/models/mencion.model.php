<?php
require_once __DIR__ . '/../../config.php';

class MencionModel {
    private $db;

    public function __construct() {
        $this->db = new PDO(
            'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',
            DB_USER,
            DB_PASS
        );
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function getAll() {
        $q = $this->db->query("SELECT * FROM menciones_honorificas ORDER BY puesto ASC");
        return $q->fetchAll(PDO::FETCH_OBJ);
    }


    public function getAllOrdered($orden) {
        // Campos permitidos para evitar SQL Injection
        $permitidos = ['id', 'jugador', 'puesto', 'club'];

        if (!in_array($orden, $permitidos)) {
            $orden = 'id';
        }

        $sql = "SELECT * FROM menciones_honorificas ORDER BY $orden ASC";
        $q = $this->db->query($sql);
        return $q->fetchAll(PDO::FETCH_OBJ);
    }


    public function getById($id) {
        $q = $this->db->prepare("SELECT * FROM menciones_honorificas WHERE id = ?");
        $q->execute([$id]);
        return $q->fetch(PDO::FETCH_OBJ);
    }


    public function create($jugador, $puesto, $justificacion, $club) {
        $q = $this->db->prepare("
            INSERT INTO menciones_honorificas (jugador, puesto, justificacion, club) 
            VALUES (?, ?, ?, ?)
        ");
        $q->execute([$jugador, $puesto, $justificacion, $club]);
    }


    public function update($id, $jugador, $puesto, $justificacion, $club) {
        $q = $this->db->prepare("
            UPDATE menciones_honorificas 
            SET jugador=?, puesto=?, justificacion=?, club=? 
            WHERE id=?
        ");
        $q->execute([$jugador, $puesto, $justificacion, $club, $id]);
    }


    public function delete($id) {
        $q = $this->db->prepare("DELETE FROM menciones_honorificas WHERE id = ?");
        $q->execute([$id]);
    }

    public function getFiltered($search, $club, $min, $max, $limit, $offset, $orden = null) {

    $sql = "SELECT * FROM menciones_honorificas WHERE 1=1";
    $params = [];

    if (!empty($search)) {
        $sql .= " AND (jugador LIKE ? OR justificacion LIKE ? OR club LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    if (!empty($club)) {
        $sql .= " AND club = ?";
        $params[] = $club;
    }

    if (!empty($min)) {
        $sql .= " AND puesto >= ?";
        $params[] = $min;
    }

    if (!empty($max)) {
        $sql .= " AND puesto <= ?";
        $params[] = $max;
    }

    // ORDENAR (OPCIONAL 9)
    $permitidos = ['id', 'jugador', 'puesto', 'club'];
    if ($orden && in_array($orden, $permitidos)) {
        $sql .= " ORDER BY $orden ASC";
    } else {
        $sql .= " ORDER BY id ASC";
    }

    // paginación
    $sql .= " LIMIT $limit OFFSET $offset";

    $q = $this->db->prepare($sql);
    $q->execute($params);

    return $q->fetchAll(PDO::FETCH_OBJ);
}
}