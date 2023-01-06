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
    public function create(int $numMatricule, string $typesEngin, int $chauffeur, int $numInventaire, $dateAquis, $marque)
    {
        $q = $this->getconnexion()->prepare("INSERT INTO engin(numMatricule,  numInventaire, marque, typesEngin, chauffeur, dateAquis)VALUES (:numMatricule, :numInventaire, :typesEngin, :marque ,:chauffeur ,:dateAquis)");
        return $q->execute([
           'numMatricule' => $numMatricule,
           'typesEngin'=>$typesEngin,
           'chauffeur'=>$chauffeur,
           'numInventaire'=>$numInventaire,
           'dateAquis'=> $dateAquis,
           'marque'=> $marque,
           
        ]);
    }
    public function read()
    {
        return $this->getconnexion()->query("SELECT * FROM engin ORDER BY numMatricule")->fetchAll(PDO::FETCH_OBJ);
    }
    public function countBills(): int
    {
        return (int)$this->getconnexion()->query("SELECT COUNT(numMatricule) as count FROM engin")->fetch()[0];
    }
    public function getSingleBill(int $numMatricule)
    {
        $q = $this->getConnexion()->prepare("SELECT * FROM engin WHERE numMatricule = :numMatricule");
        $q->execute(['numMatricule' => $numMatricule]);
        return $q->fetch(PDO::FETCH_OBJ);
    }
    public function update(int $numMatricule,  $typesEngin, int $chauffeur, int $numInventaire, $dateAquis, $marque)
    {
        $q = $this->getconnexion()->prepare("UPDATE  engin SET typesEngin=:typesEngin, chauffeur=:chauffeur, numInventaire=:numInventaire, dateAquis=:dateAquis , marque=:marque WHERE numMatricule=:numMatricule");
        return $q->execute([
            'numMatricule' => $numMatricule,
            'typesEngin'=>$typesEngin,
            'chauffeur'=>$chauffeur,
            'numInventaire'=>$numInventaire,
            'dateAquis'=> $dateAquis,
            'marque'=>$marque,
        ]);
    }
    public function delete(int $numMatricule){
        $q = $this->getconnexion()->prepare(" DELETE FROM engin WHERE numMatricule = :numMatricule");
        return $q->execute(['numMatricule' => $numMatricule]);
    }
}
