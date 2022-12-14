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
    public function create($Nom, $codeMarchandise, $typesMarchandise, $nombreSacs, $dateEntree, $numInventaire, $matriculeChauffeur, $dateNav)
    {
        $q = $this->getconnexion()->prepare("INSERT INTO magasinentree (Nom, codeMarchandise, typesMarchandise, nombreSacs, dateEntree, numInventaire, matriculeChauffeur, dateNav )
             VALUES (:Nom, :codeMarchandise, :typesMarchandise, :nombreSacs, :dateEntree , :numInventaire, :matriculeChauffeur, :dateNav)");
        return $q->execute([
            'Nom' => $Nom,
            'codeMarchandise' => $codeMarchandise,
            'typesMarchandise' => $typesMarchandise,
            'nombreSacs' => $nombreSacs,
            'dateEntree' => $dateEntree,
            'numInventaire' =>$numInventaire,
            'matriculeChauffeur,' => $matriculeChauffeur,
            'dateNav'=>$dateNav
        ]);
    }
    public function read()
    {
        return $this->getconnexion()->query("SELECT * FROM magasinentree ORDER BY idMagEntree")->fetchAll(PDO::FETCH_OBJ);
    }
    public function countBills(): int
    {
        return (int)$this->getconnexion()->query("SELECT COUNT(idMagEntree) as count FROM magasinentree")->fetch()[0];
    }
    public function getSingleBill(int $idMagEntree)
    {
        $q = $this->getConnexion()->prepare("SELECT * FROM magasinentree WHERE idMagEntree = :idMagEntree");
        $q->execute(['idMagEntree' => $idMagEntree]);
        return $q->fetch(PDO::FETCH_OBJ);
    }
    public function update($Nom, $codeMarchandise, $typesMarchandise, $nombreSacs, $dateEntree, $numInventaire, $matriculeChauffeur, $dateNav, $idMagEntree)
    {
        $q = $this->getconnexion()->prepare("UPDATE magasinentree  SET Nom=:Nom, codeMarchandise=:codeMarchandise, typesMarchandise=:typesMarchandise, nombreSacs=:nombreSacs, dateEntree=:dateEntree , numInventaire=:numInventaire, matriculeChauffeur=:matriculeChauffeur, dateNav=:dateNav WHERE idMagEntree=:idMagEntree");
        return $q->execute([
            'Nom' => $Nom,
            'codeMarchandise' => $codeMarchandise,
            'typesMarchandise' => $typesMarchandise,
            'nombreSacs' => $nombreSacs,
            'dateEntree' => $dateEntree,
            'numInventaire' =>$numInventaire,
            'matriculeChauffeur,' => $matriculeChauffeur,
            'dateNav'=>$dateNav,
            'idMagEntree'=>$idMagEntree

        ]);
    }
    public function delete(int $idMagEntree)
    {
        $q = $this->getconnexion()->prepare(" DELETE FROM magasinentree WHERE idMagEntree = :idMagEntree");
        return $q->execute(['idMagEntree' => $idMagEntree]);
    }
}
