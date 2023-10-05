<?php
class ExchangeModel extends Database
{
    public function createExchange($offerente, $proponente, $libroOfferto, $libroProposto)
    {

        $query = "INSERT INTO scambio (offerente, proponente, libro_offerto, libro_proposto) VALUES (?,?,?,?)";
        $params = [$offerente, $proponente, $libroOfferto, $libroProposto];
        return $this->createUpdateDelete($query, $params);
    }

    public function getExchange($id)
    {
        $query = "SELECT * FROM scambio WHERE id = ? ";
        $params = [$id];
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
            $query = "SELECT offerente,proponente,libro_offerto,libro_proposto FROM scambio WHERE id = ? ";
            $params = [$exchangeId];
            $result = $this->select($query, $params);
            $scambioData = $result[0];

            $query = "UPDATE possesso SET proprietario = ? WHERE proprietario = ? AND libro = ?";
            $params = [
                $scambioData["proponente"],
                $scambioData["offerente"],
                $scambioData["libro_offerto"],
            ];
            $this->createUpdateDelete($query, $params);
            $query = "UPDATE possesso SET proprietario = ? WHERE proprietario = ? AND libro = ?";
            $params = [
                $scambioData["offerente"],
                $scambioData["proponente"],
                $scambioData["libro_proposto"],
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