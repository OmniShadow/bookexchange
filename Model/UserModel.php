<?php
require_once PROJECT_ROOT_PATH . "Model/Database.php";

class UserModel extends Database
{
    public function getUsers($limit)
    {
        $query = "SELECT * FROM utente ORDER BY id ASC LIMIT ?";
        $params = [$limit];
        return $this->select($query, $params);
    }
    public function getUser($userId){
        $query = "SELECT * FROM utente WHERE id = ?";
        $params = [$userId];
        return $this->select($query, $params);
    }

    public function getUserBookIds($userId){
        $query = "SELECT (libro) FROM possesso WHERE proprietario = ?";
        $params = [$userId];
        return $this->select($query, $params);
    }
}