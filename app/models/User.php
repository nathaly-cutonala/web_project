<?php
require_once __DIR__ . '/../db/database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function create($name, $email, $password) {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function read() {
        try {
            $result = $this->db->query("SELECT * FROM users WHERE status = 'active'");
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }


    public function update($id, $name, $email, $password) {
        $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE user_id = ?");
        $stmt->bind_param("sssi", $name, $email, $password, $id);

        return $stmt->execute();
    }


   /*  public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    } */

    public function delete($id) {
        $status = 'inactive';
        $stmt = $this->db->prepare("UPDATE users SET status = ? WHERE user_id = ?");
        $stmt->bind_param("si",$status, $id);
        return $stmt->execute();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

}
