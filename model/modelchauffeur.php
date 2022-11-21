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
    public function create(string $Nom, string $Adresse)
    {
        $q = $this->getconnexion()->prepare("INSERT INTO chauffeur (Nom, Adresse)  VALUES (:Nom, :Adresse)");
        return $q->execute([
            'Nom' => $Nom,
            'Adresse' => $Adresse
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
    public function update( int $IDchauffeur, string $Nom, string $Adresse)
    {
        // rehefa manao update dia tsy atao update ny ID, jereo tsara foana ny correspondance des variables
        // ito ny code taloha
        // $q = $this->getconnexion()->prepare("UPDATE quai SET NumQuai=:NumQuai Capacite=:Capacite, ville=:ville WHERE NumQuai=:NumQuai");

        $q = $this->getconnexion()->prepare("UPDATE chauffeur SET Nom=:Nom, Adresse=:Adresse WHERE IDchauffeur=:IDchauffeur");

        //ity ny code teo aloha,
        // return $q->execute([
        //     'Capacite' => $Capacite,
        //     'ville' => $ville,
        //     'NumQuai' => $NumQuai
        // ]);

        return $q->execute([
            'Nom' => $Nom,
            'Adresse' => $Adresse,
            'IDchauffeur'=>$IDchauffeur
        ]);
    }
    public function delete(int $IDchauffeur)
    {
        $q = $this->getconnexion()->prepare(" DELETE FROM chauffeur WHERE IDchauffeur=:IDchauffeur");
        return $q->execute(['IDchauffeur' => $IDchauffeur]);
    }
}
