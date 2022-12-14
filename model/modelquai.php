<?php

class Database
{
    private $host = 'mysql:host=localhost;dbname=crudajax';
    private $user = 'root';
    private $password = '';

    private function getconnexion()
    {
        try {
            return new PDO($this->host, $this->user, $this->password);
        } catch (PDOException $e) {
            die('erreur:' . $e->getMessage());
        }
    }
    public function create(string $Capacite, string $ville)
    {
        $q = $this->getconnexion()->prepare("INSERT INTO quai (Capacite, ville)  VALUES (:Capacite, :ville)");
        return $q->execute([
            'Capacite' => $Capacite,
            'ville' => $ville
        ]);
    }
    public function read()
    {
        return $this->getconnexion()->query("SELECT * FROM quai ORDER BY NumQuai")->fetchAll(PDO::FETCH_OBJ);
    }
    public function countBills(): int
    {
        return (int)$this->getconnexion()->query("SELECT COUNT(NumQuai) as count FROM quai")->fetch()[0];
    }
    public function getSingleBill(int $NumQuai)
    {
        $q = $this->getConnexion()->prepare("SELECT * FROM quai WHERE NumQuai = :NumQuai");
        $q->execute(['NumQuai' => $NumQuai]);
        return $q->fetch(PDO::FETCH_OBJ);
    }
    public function update(int $NumQuai, string $Capacite, string $ville)
    {
        $q = $this->getconnexion()->prepare("UPDATE quai SET Capacite=:Capacite, ville=:ville WHERE NumQuai=:NumQuai");
        return $q->execute([
            'Capacite' => $Capacite,
            'ville' => $ville,
            'NumQuai' => $NumQuai
        ]);
    }
    public function delete(int $NumQuai)
    {
        $q = $this->getconnexion()->prepare(" DELETE FROM quai WHERE NumQuai=:NumQuai");
        return $q->execute(['NumQuai' => $NumQuai]);
    }
}
