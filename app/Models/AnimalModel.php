<?php

namespace App\Models;

use App\Utility\DataBase;
use \PDO;

class AnimalModel
{
    private $id;
    private $age;
    private $description;
    private $img;
    private $name;
    private $sexe;
    private $status;
    private $type;
    private $user_id;

    public static function getAnimal(): array
    {
        $pdo = DataBase::connectPDO();
        $query = $pdo->prepare('SELECT * FROM animal WHERE status="disponible" ');
        $query->execute();
        $animal = $query->fetchAll(PDO::FETCH_CLASS, 'App\Models\AnimalModel');
        return $animal;
    }

     public static function getAllAnimal(): array
    {
        $pdo = DataBase::connectPDO();
        $query = $pdo->prepare('SELECT * FROM animal');
        $query->execute();
        $animal = $query->fetchAll(PDO::FETCH_CLASS, 'App\Models\AnimalModel');
        return $animal;
    }
    
    public static function getAnimalById(int $id)
    {
        $pdo = DataBase::connectPDO();
        $query = $pdo->prepare('SELECT * FROM animal WHERE id=:id');
        $query->bindParam(':id', $id);
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, 'App\Models\AnimalModel');
        $animal = $query->fetch();
        return $animal;
    }
    
    public function insertAnimal(): bool
    {
        $pdo = DataBase::connectPDO();
        var_dump($_SESSION);
        $user_id = $_SESSION['user_id'];
        $sql ="INSERT INTO `animal`(`name`, `sexe`, `age`, `description`, `img`, `type`, `date`, `user_id`, `status`)
        VALUES (:name, :sexe, :age, :description, :img, :type, :date, :user_id, :status)";
        var_dump($sql);
        $params=[
            'name' => $this->name,
            'sexe' => $this->sexe,
            'age' => $this->age,
            'description' => $this->description,
            'img' => $this->img,
            'type' => $this->type,
            'status' => $this->status,
            'date' => $this->date,
            'user_id' => $user_id
            ];
        $query = $pdo->prepare($sql);
        $queryStatus = $query->execute($params);
        return $queryStatus;
    }
    
    public static function deleteAnimal(int $animal): bool
    {
        $pdo = DataBase::connectPDO();
        $sql = 'DELETE FROM `animal` WHERE id = :id';
        $query = $pdo->prepare($sql);
        $query->bindParam('id', $animal, PDO::PARAM_INT);
        $queryStatus = $query->execute();
        return $queryStatus;
    }

    

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id=$id;
    }
    public function getAge(){
        return $this->age;
    }
    public function setAge($age){
        $this->age=$age;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function getImg(){
        return $this->img;
    }
    public function setImg($img){
        $this->img=$img;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name=$name;
    }
    public function getSexe(){
        return $this->sexe;
    }
    public function setSexe($sexe){
        $this->sexe=$sexe;
    }
    public function getStatus(){
        return $this->status;
    }
    public function setStatus($status){
        $this->status=$status;
    }
    public function getType(){
        return $this->type;
    }
    public function setType($type){
        $this->type=$type;
    }
    public function getUser_id(){
        return $this->user_id;
    }
    public function setUser_id($user_id){
        $this->user_id=$user_id;
    }
}

?>