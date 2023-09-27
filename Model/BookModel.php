<?php
class BookModel extends Database
{
    public function getBooks($q, $limit)
    {
        $query = "SELECT * FROM libro WHERE titolo LIKE ? OR autore LIKE ? LIMIT ?";
        $params = ["$q%", "$q%", $limit];
        return $this->select($query, $params);
    }

    public function getBook($id)
    {
        $query = "SELECT * FROM libro WHERE id = ?";
        $params = [$id];
        return $this->select($query, $params);
    }

    public function addBook($userId, $bookId, $description)
    {
        $query = "INSERT INTO possesso (proprietario,libro,descrizione) VALUES (?,?,?)";
        $params = [$userId, $bookId, $description];
        return $this->createUpdateDelete($query, $params);

    }

    public function removeBook($userId, $bookId){
        $query = "DELETE FROM possesso WHERE user = ? AND book = ?";
        $params = [$userId, $bookId];
        return $this->createUpdateDelete($query, $params);
    }
}