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
    public function create(string $Nombateau, string $Marque, string $categories, string $chargemax, $temps, string $typeproduit, int $NumQuai)
    {
        $q = $this->getconnexion()->prepare("INSERT INTO bateaux(Nombateau, Marque, categories, chargemax, datetimes, typeproduit, NumQuai )
             VALUES (:Nombateau, :Marque, :categories, :chargemax, :temps, :typeproduit, :NumQuai)");
        return $q->execute([
            'Nombateau' => $Nombateau,
            'Marque' => $Marque,
            'categories' => $categories,
            'chargemax' => $chargemax,
            'temps' => $temps,
            'typeproduit' => $typeproduit,
            'NumQuai' => $NumQuai
        ]);
    }
    public function read()
    {
        return $this->getconnexion()->query("SELECT * FROM bateaux ORDER BY id")->fetchAll(PDO::FETCH_OBJ);
    }
    public function countBills(): int
    {
        return (int)$this->getconnexion()->query("SELECT COUNT(id) as count FROM bateaux")->fetch()[0];
    }
    public function getSingleBill(int $id)
    {
        $q = $this->getConnexion()->prepare("SELECT * FROM bateaux WHERE id = :id");
        $q->execute(['id' => $id]);
        return $q->fetch(PDO::FETCH_OBJ);
    }
    public function update(int $id, string $Nombateau, string $Marque, string $categories, string $chargemax, $temps, string $typeproduit, $numQuai)
    {
        $q = $this->getconnexion()->prepare("UPDATE bateaux SET Nombateau=:Nombateau, Marque=:Marque, categories=:categories, chargemax=:chargemax, datetimes=:temps, typeproduit=:typeproduit, NumQuai=:NumQuai WHERE ID=:id");
        return $q->execute([
            'Nombateau' => $Nombateau,
            'Marque' => $Marque,
            'categories' => $categories,
            'chargemax' => $chargemax,
            'temps' => $temps,
            'typeproduit' => $typeproduit,
            'id' => $id,
            'NumQuai' => $numQuai

        ]);
    }
    public function delete(int $id)
    {
        $q = $this->getconnexion()->prepare(" DELETE FROM bateaux WHERE id = :id");
        return $q->execute(['id' => $id]);
    }
}
