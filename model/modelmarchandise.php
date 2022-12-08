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
    public function create(int $bateau, string $libelle, string $typesMarchandise, int $quantite, int $nombreSacs)
    {
        $q = $this->getconnexion()->prepare("INSERT INTO marchandise (bateau, libelle, typesMarchandise, quantite, nombreSacs) VALUES (:bateau, :libelle, :typesMarchandise, :quantite, :nombreSacs)");
        return $q->execute([
            'bateau' => $bateau,
            'libelle' => $libelle,
            'typesMarchandise' => $typesMarchandise,
            'quantite' => $quantite,
            'nombreSacs'=> $nombreSacs

        ]);
    }
    public function read()
    {
        return $this->getconnexion()->query("SELECT * FROM marchandise ORDER BY codeMarchandise")->fetchAll(PDO::FETCH_OBJ);
    }
    public function countBills(): int
    {
        return (int)$this->getconnexion()->query("SELECT COUNT(codeMarchandise) as count FROM marchandise")->fetch()[0];
    }
    public function getSingleBill(int $codeMarchandise)
    {
        $q = $this->getConnexion()->prepare("SELECT * FROM marchandise WHERE codeMarchandise = :codeMarchandise");
        $q->execute(['codeMarchandise' => $codeMarchandise]);
        return $q->fetch(PDO::FETCH_OBJ);
    }
    public function update( $bateau, string $libelle, string $typesMarchandise, $quantite, int $codeMarchandise, $nombreSacs)
    {
        $q = $this->getconnexion()->prepare("UPDATE  marchandise SET libelle=:libelle,typesMarchandise=:typesMarchandise, quantite=:quantite, nombreSacs=:nombreSacs WHERE codeMarchandise=:codeMarchandise");
        return $q->execute([
            'libelle' => $libelle,
            'typesMarchandise' => $typesMarchandise,
            'quantite' => $quantite,
            'codeMarchandise' => $codeMarchandise,
            'nombreSacs'=> $nombreSacs
        ]);
    }
    public function delete(int $codeMarchandise)
    {
        $q = $this->getconnexion()->prepare(" DELETE FROM marchandise WHERE codeMarchandise = :codeMarchandise");
        return $q->execute(['codeMarchandise' => $codeMarchandise]);
    }
}
