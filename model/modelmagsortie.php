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
    public function create($Nom, $codeMarchandise, $nombreSacs, $numInventaire, $client, $statClient, $dateSortie)
    {
        $q = $this->getconnexion()->prepare("INSERT INTO magasinsortie (Nom, codeMarchandise, nombreSacs, numInventaire, client, statClient, dateSortie)
             VALUES (:Nom, :codeMarchandise, :nombreSacs , :numInventaire, :client, :statClient, :dateSortie)");
        return $q->execute([
            'Nom' => $Nom,
            'codeMarchandise' => $codeMarchandise,
            'nombreSacs' => $nombreSacs,
            'numInventaire' =>$numInventaire,
            'client'=> $client,
            'statClient'=>$statClient,
            'dateSortie'=>$dateSortie
        ]);
    }
    public function read()
    {
        return $this->getconnexion()->query("SELECT * FROM magasinsortie ORDER BY idMagsortie")->fetchAll(PDO::FETCH_OBJ);
    }
    public function countBills(): int
    {
        return (int)$this->getconnexion()->query("SELECT COUNT(idMagsortie) as count FROM  magasinsortie")->fetch()[0];
    }
    public function getSingleBill(int $idMagsortie)
    {
        $q = $this->getConnexion()->prepare("SELECT * FROM  magasinsortie WHERE idMagsortie = :idMagsortie");
        $q->execute(['idMagsortie' => $idMagsortie]);
        return $q->fetch(PDO::FETCH_OBJ);
    }
    public function update($Nom, $codeMarchandise, $nombreSacs, $numInventaire, $client, $statClient, $dateSortie, $idMagSortie)
    {
        $q = $this->getconnexion()->prepare("UPDATE  magasinsortie  SET Nom=:Nom, codeMarchandise=:codeMarchandise, nombreSacs=:nombreSacs, numInventaire=:numInventaire, client=:client, statClient=:statClient, dateSortie=:dateSortie WHERE idMagSortie=:idMagSortie");
        return $q->execute([
            'Nom' => $Nom,
            'codeMarchandise' => $codeMarchandise,
            'nombreSacs' => $nombreSacs,
            'numInventaire' =>$numInventaire,
            'client'=> $client,
            'statClient'=>$statClient,
            'dateSortie'=>$dateSortie,
            'idMagSortie'=>$idMagSortie

        ]);
    }
    public function delete(int $idMagsortie)
    {
        $q = $this->getconnexion()->prepare(" DELETE FROM  magasinsortie WHERE idMagsortie = :idMagsortie");
        return $q->execute(['idMagsortie' => $idMagsortie]);
    }
}
