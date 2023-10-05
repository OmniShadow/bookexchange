<?php
class MessageModel extends Database
{
    public function sendMessage($conversationId, $messaggio, $mittente, $destinatario)
    {
        $query = "INSERT INTO messaggio (conversazione,mittente,destinatario,messaggio) VALUES (?,?,?,?)";
        $params = [$conversationId, $mittente, $destinatario, $messaggio];
        return $this->createUpdateDelete($query, $params);
    }

    public function getMessage($conversationId, $messageId)
    {

    }
    public function getMessages($conversationId)
    {
        $query = "SELECT * FROM messaggio WHERE conversazione = ? ORDER BY data_creazione ASC";
        $params = [$conversationId];
        return $this->select($query, $params);
    }

    public function deleteMessage($messageId)
    {

    }

    public function hasConversationWith($utente1, $utente2){
        $query ="SELECT * FROM conversazione WHERE ((utente1 = ? AND utente2 = ?) OR (utente2 = ? AND utente1 = ?))";
        $params = [$utente1,$utente2,$utente1,$utente2];
        $result = $this->select($query,$params);
        if(!empty($result))
            return $result[0]["id"];
        return null;
    }

    public function getConversation($conversationId)
    {
        $query = "SELECT utente1,utente2 FROM conversazione WHERE id = ?";
        $params = [$conversationId];
        return $this->select($query, $params);
    }

    public function getUserConversations($userId)
    {
        $query = "SELECT id,utente1,utente2 FROM conversazione WHERE utente1 = ? OR utente2 = ?  ORDER BY id DESC";
        $params = [$userId,$userId];
        return $this->select($query, $params);

    }

    public function createConversation($utente1, $utente2){
        $query = "INSERT IGNORE INTO conversazione (utente1, utente2) VALUES (?,?)";
        $params = [$utente1,$utente2];
        return $this->createUpdateDelete($query,$params);
    }

    public function listMessages($conversationId)
    {
        $query = "SELECT mittente,destinatario,messaggio FROM messaggio WHERE conversazione = ?";
        $params = [$conversationId];
        return $this->select($query, $params);
    }
}
?>