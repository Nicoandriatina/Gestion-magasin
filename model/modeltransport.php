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
    public function create(  $dateTransport, $marchandise,  $vehicule, )
    {
      
        $q = $this->getconnexion()->prepare("INSERT INTO transport (dateTransport , marchandise, vehicule) 
        VALUES ( :dateTransport, :marchandise, :vehicule)");
        return $q->execute([
            'dateTransport' =>$dateTransport,
            'marchandise' => $marchandise,
            'vehicule,' => $vehicule,
            
        ]);
    }
    public function read()
    {
        return $this->getconnexion()->query("SELECT * FROM transport ORDER BY numTransport")->fetchAll(PDO::FETCH_OBJ);
    }
    public function countBills(): int
    {
        return (int)$this->getconnexion()->query("SELECT COUNT(numTransport) as count FROM transport")->fetch()[0];
    }
    public function getSingleBill(int $numTransport)
    {
        $q = $this->getConnexion()->prepare("SELECT * FROM transport WHERE numTransport = :numTransport");
        $q->execute(['numTransport' => $numTransport]);
        return $q->fetch(PDO::FETCH_OBJ);
    }
    public function update( $numTransport, $dateTransport, $marchandise, $vehicule, $magasin)
    {
        $q = $this->getconnexion()->prepare("UPDATE  transport SET dateTransport=:dateTransport WHERE numTransport=:numTransport");
        return $q->execute([
            'numTransport' => $numTransport,
            'dateTransport' =>$dateTransport,
            'marchandise' => $marchandise,
            'vehicule,' => $vehicule,
            'magasin'=>$magasin
        ]);
    }
    public function delete(int $numTransport)
    {
        $q = $this->getconnexion()->prepare(" DELETE FROM transport WHERE numTransport = :numTransport");
        return $q->execute(['numTransport' => $numTransport]);
        
    }
    public function readmarchandise()
    {
        return $this->getconnexion()->query("SELECT * FROM marchandise ORDER BY codeMarchandise")->fetchAll(PDO::FETCH_OBJ);
    }
    public function readengin()
    {
        return $this->getconnexion()->query("SELECT * FROM engin ORDER BY numMatricule")->fetchAll(PDO::FETCH_OBJ);
    }
}
