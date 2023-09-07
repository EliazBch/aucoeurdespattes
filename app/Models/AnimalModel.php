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