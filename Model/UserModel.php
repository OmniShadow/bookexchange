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
        $query = "SELECT possesso.id as id,libro.id as libro,titolo, editore, copertina, anno, lingua,descrizione FROM possesso INNER JOIN libro ON libro.id = possesso.libro WHERE proprietario = ?";
        $params = [$userId];
        return $this->select($query, $params);
    }

    public function getUserExchanges($userId)
    {
        $query = "SELECT 
        proponente.id AS proponente, proponente.username as proponente_username, proponente.avatar as proponente_avatar,
        libro_proposto.titolo as libro_proposto_titolo,  libro_proposto.copertina as libro_proposto_copertina,
        possesso_proposta.id as proposta,
        offerente.id as offerente, offerente.username as offerente_username, offerente.avatar as offerente_avatar,
        libro_offerto.titolo as libro_offerto_titolo, libro_offerto.copertina as libro_offerto_copertina,
        possesso_offerta.id as offerta,
        scambio.stato as stato,
        scambio.id as id
        FROM scambio 
                    INNER JOIN possesso AS possesso_proposta ON proposta = possesso_proposta.id 
                    INNER JOIN possesso AS possesso_offerta ON offerta = possesso_offerta.id
                    INNER JOIN utente AS proponente ON possesso_proposta.proprietario = proponente.id
                    INNER JOIN utente AS offerente ON possesso_offerta.proprietario = offerente.id
                    INNER JOIN libro AS libro_proposto ON possesso_proposta.libro = libro_proposto.id
                    INNER JOIN libro AS libro_offerto ON possesso_offerta.libro = libro_offerto.id
                    WHERE proponente.id = ? OR offerente.id = ? ORDER BY scambio.data_creazione DESC";
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
            $this->createUpdateDelete($query, $params);

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