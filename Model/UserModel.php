<?php
require_once PROJECT_ROOT_PATH . "Model/Database.php";

class UserModel extends Database
{
    public $message = "";
    public function getUsers($limit)
    {
        $query = "SELECT * FROM utente ORDER BY id ASC LIMIT ?";
        $params = [$limit];
        return $this->select($query, $params);
    }
    public function getUser($userId)
    {
        $query = "SELECT * FROM utente WHERE id = ?";
        $params = [$userId];
        return $this->select($query, $params);
    }

    public function getUserBookIds($userId)
    {
        $query = "SELECT (libro) FROM possesso WHERE proprietario = ?";
        $params = [$userId];
        return $this->select($query, $params);
    }

    public function registerUser($username, $email, $password)
    {
        $query = "INSERT INTO utente (username, email, password) VALUES (?, ?, ?)";
        $params = [$username, $email, $password];
        try {
            return $this->createUpdateDelete($query, $params);
        } catch (Exception $e) {
            $this->message = $e->getMessage();
            return 0;
        }
    }

    public function loginUser($email)
    {
        $query = "SELECT * FROM utente WHERE (email = ?)";
        $params = [$email];
        return $this->select($query, $params);
    }

    public function logoutUser($id){
        $query = "UPDATE utente SET stato = 0 WHERE id = ?";
        $params = [$id];
        return $this->createUpdateDelete($query, $params);
    }

    public function getMessage(){
        $message = $this->message;
        $this->message = "";
        return $message;
    }
}