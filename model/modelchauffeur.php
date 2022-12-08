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
    public function create(string $Nom, string $Adresse, $matChauffeur)
    {
        $q = $this->getconnexion()->prepare("INSERT INTO chauffeur (Nom, Adresse, matChauffeur)  VALUES (:Nom, :Adresse, :matChauffeur)");
        return $q->execute([
            'Nom' => $Nom,
            'Adresse' => $Adresse,
            'matChauffeur' => $matChauffeur
        ]);
    }
    public function read()
    {
        return $this->getconnexion()->query("SELECT * FROM chauffeur ORDER BY IDchauffeur")->fetchAll(PDO::FETCH_OBJ);
    }
    public function countBills(): int
    {
        return (int)$this->getconnexion()->query("SELECT COUNT(IDchauffeur) as count FROM chauffeur")->fetch()[0];
    }
    public function getSingleBill(int $IDchauffeur)
    {
        $q = $this->getConnexion()->prepare("SELECT * FROM chauffeur WHERE IDchauffeur = :IDchauffeur");
        $q->execute(['IDchauffeur' => $IDchauffeur]);
        return $q->fetch(PDO::FETCH_OBJ);
    }
    public function update( int $IDchauffeur, string $Nom, string $Adresse, $matChauffeur)
    {
           $q = $this->getconnexion()->prepare("UPDATE chauffeur SET Nom=:Nom, Adresse=:Adresse, matChauffeur=:matChauffeur WHERE IDchauffeur=:IDchauffeur");
        return $q->execute([
            'Nom' => $Nom,
            'Adresse' => $Adresse,
            'IDchauffeur'=>$IDchauffeur,
            'matChauffeur' => $matChauffeur
        ]);
    }
    public function delete(int $IDchauffeur)
    {
        $q = $this->getconnexion()->prepare(" DELETE FROM chauffeur WHERE IDchauffeur=:IDchauffeur");
        return $q->execute(['IDchauffeur' => $IDchauffeur]);
    }
}
