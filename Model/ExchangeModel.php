<?php
class ExchangeModel extends Database
{
    public function createExchange($offerta, $proposta)
    {

        $query = "INSERT INTO scambio (offerta,proposta) VALUES (?,?)";
        $params = [$offerta, $proposta];
        return $this->createUpdateDelete($query, $params);
    }

    public function getExchange($id)
    {
        $query = "SELECT * FROM scambio WHERE id = ? ";
        $params = [$id];
        return $this->select($query, $params);
    }

    public function getScambiOfferti($offerente, $libroOfferto)
    {
        $query = "SELECT id FROM scambio WHERE offerente = ? AND libro_offerto = ?";
        $params = [$offerente, $libroOfferto];
        return $this->select($query, $params);
    }

    public function updateExchangeStatus($exchangeId, $status)
    {
        $query = "UPDATE scambio SET stato = ? WHERE id = ?";
        $params = [$status, $exchangeId];
        return $this->createUpdateDelete($query, $params);
    }

    public function commitExchange($exchangeId)
    {

        try {
            $query = "SELECT 
            proponente.id AS proponente, possesso_proposta.libro as libro_proposto, possesso_proposta.id as proposta, 
            offerente.id as offerente, possesso_offerta.libro as libro_offerto, possesso_offerta.id as offerta 
            FROM scambio 
                        INNER JOIN possesso AS possesso_proposta ON proposta = possesso_proposta.id 
                        INNER JOIN possesso AS possesso_offerta ON offerta = possesso_offerta.id
                        INNER JOIN utente AS proponente ON possesso_proposta.proprietario = proponente.id
                        INNER JOIN utente AS offerente ON possesso_offerta.proprietario = offerente.id
                        WHERE scambio.id = ?";
            $params = [$exchangeId];
            $result = $this->select($query, $params);
            $scambioData = $result[0];

            $query = "UPDATE possesso SET proprietario = ? WHERE id = ?";
            $params = [
                $scambioData["proponente"],
                $scambioData["offerta"],
            ];
            $this->createUpdateDelete($query, $params);
            $query = "UPDATE possesso SET proprietario = ? WHERE id = ?";
            $params = [
                $scambioData["offerente"],
                $scambioData["proposta"],
            ];
            $this->createUpdateDelete($query, $params);

        } catch (Exception $e) {
            return false;
        }

    }

    public function listExchanges($limit)
    {

    }
}
?>