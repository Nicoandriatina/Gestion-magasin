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
    public function create(string $Nom, string $Adresse, $statClient, $nifClient)
    {
        $q = $this->getconnexion()->prepare("INSERT INTO client (Nom, Adresse, statClient, nifClient)  VALUES (:Nom, :Adresse, :statClient, :nifClient)");
        return $q->execute([
            'Nom' => $Nom,
            'Adresse' => $Adresse,
            'statClient' => $statClient,
            'nifClient'=> $nifClient

        ]);
    }
    public function read()
    {
        return $this->getconnexion()->query("SELECT * FROM client ORDER BY codeClient")->fetchAll(PDO::FETCH_OBJ);
    }
    public function countBills(): int
    {
        return (int)$this->getconnexion()->query("SELECT COUNT(codeClient) as count FROM client")->fetch()[0];
    }
    public function getSingleBill(int $codeClient)
    {
        $q = $this->getConnexion()->prepare("SELECT * FROM client WHERE codeClient = :codeClient");
        $q->execute(['codeClient' => $codeClient]);
        return $q->fetch(PDO::FETCH_OBJ);
    }
    public function update( int $codeClient,string $Nom, string $Adresse, $statClient, $nifClient)
    {
        $q = $this->getconnexion()->prepare("UPDATE client SET Nom=:Nom, Adresse=:Adresse, statclient=:statclient ,nifclient=:nifclient WHERE codeClient=:codeClient");
        return $q->execute([
            'Nom' => $Nom,
            'Adresse' => $Adresse,
            'statClient' => $statClient,
            'nifClient'=> $nifClient,
            'codeClient'=>$codeClient
        ]);
    }
    public function delete(int $codeClient)
    {
        $q = $this->getconnexion()->prepare(" DELETE FROM client WHERE codeClient=:codeClient");
        return $q->execute(['codeClient' => $codeClient]);
    }
}
