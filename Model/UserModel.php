<?php
require_once PROJECT_ROOT_PATH . "Model/Database.php";

class UserModel extends Database
{
    private $message = "";
    public function getUsers($limit)
    {
        $query = "SELECT * FROM utente ORDER BY id ASC LIMIT ?";
        $params = [$limit];
        return $this->select($query, $params);
    }
    public function getUser($userId)
    {
        $query = "SELECT id,username, email, avatar,stato FROM utente WHERE id = ?";
        $params = [$userId];
        return $this->select($query, $params);
    }

    public function getUserBookIds($userId)
    {
        $query = "SELECT libro FROM possesso WHERE proprietario = ?";
        $params = [$userId];
        return $this->select($query, $params);
    }

    public function getUserBooks($userId)
    {
        $query = "SELECT id,titolo, editore, copertina, anno, lingua,descrizione FROM possesso INNER JOIN libro ON libro.id = possesso.libro WHERE proprietario = ?";
        $params = [$userId];
        return $this->select($query, $params);
    }

    public function getUserExchanges($userId)
    {
        $query = "SELECT scambio.data_creazione,scambio.id, scambio.stato, proponente.username as proponente, proponente.id as proponente_id, proponente.avatar as proponente_avatar, offerente.username as offerente,
		offerente.id as offerente_id, offerente.avatar as offerente_avatar, libro_proposto.titolo as libro_proposto_titolo, libro_proposto.id as libro_proposto_id,
        libro_proposto.copertina as libro_proposto_copertina, libro_offerto.titolo as libro_offerto_titolo, libro_offerto.id as libro_offerto_id, libro_offerto.copertina as libro_offerto_copertina
FROM scambio
INNER JOIN utente as proponente ON scambio.proponente = proponente.id
INNER JOIN utente as offerente ON scambio.offerente = offerente.id
INNER JOIN libro as libro_proposto ON scambio.libro_proposto = libro_proposto.id
INNER JOIN libro as libro_offerto ON scambio.libro_offerto = libro_offerto.id
WHERE scambio.proponente = ? OR scambio.offerente = ? ORDER BY scambio.data_creazione DESC";
        $params = [$userId, $userId];
        return $this->select($query, $params);
    }

    public function registerUser($username, $email, $password, $avatar)
    {
        $query = "INSERT INTO utente (username, email, password, avatar) VALUES (?, ?, ?, ?)";
        $params = [$username, $email, $password, $avatar];
        try {
            return $this->createUpdateDelete($query, $params);
        } catch (Exception $e) {
            $this->message = $e->getMessage();
            return 0;
        }
    }

    public function loginUser($email, $password)
    {
        $query = "SELECT * FROM utente WHERE (email = ?)";
        $params = [$email];
        $response = $this->select($query, $params);

        if (empty($response)) {
            $this->message = "Wrong email";
            return null;
        }

        $user = $response[0];

        if (password_verify($password, $user["password"])) {
            $this->message = "User logged in successfully";
            $query = "UPDATE utente SET stato = 1 WHERE email = ?";
            $params = [$email];
            $this->createUpdateDelete($query,$params);

            return $response;
        }

        $this->message = "Wrong password";
        return null;

    }

    public function logoutUser($id)
    {
        $query = "UPDATE utente SET stato = 0 WHERE id = ?";
        $params = [$id];

        //handle session and status value

        return $this->createUpdateDelete($query, $params);
    }

    public function getMessage()
    {
        $message = $this->message;
        $this->message = "";
        return $message;
    }
}