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
        $user_id = $_SESSION['user_id'];
        $sql ="INSERT INTO `animal`(`name`, `sexe`, `age`, `description`, `img`, `status`, `type`, `user_id`)
        VALUES (:name, :sexe, :age, :description, :img, :status, :type, :user_id)";
        $params=[
            'name' => $this->name,
            'sexe' => $this->sexe,
            'age' => $this->age,
            'description' => $this->description,
            'img' => $this->img,
            'status'=>'disponible',
            'type' => $this->type,
            'user_id'=> $user_id,
            ];
        $query = $pdo->prepare($sql);
        $queryStatus = $query->execute($params);
        return $queryStatus;
    }
    
    public function updateAnimal(): bool
    {
        $pdo = DataBase::ConnectPDO();
        $user_id = $_SESSION['user_id'];
        $sql = "UPDATE `animal` SET `name` = :name, `sexe` = :sexe, `age` = :age, `description` = :description,
        `status` = :status, `type` = :type, `user_id` = :user_id WHERE `id` = :id";
        $params = [
            'id' => $this->id,
            'name' => $this->name,
            'sexe' => $this->sexe,
            'age' => $this->age,
            'description' => $this->description,
            'status'=>'disponible',
            'type' => $this->type,
            'user_id'=> $user_id,
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
        $query->bindParam(':id', $animal, PDO::PARAM_INT);
        $queryStatus = $query->execute();
        return $queryStatus;
    }

    

public function getId(): int
{
    return $this->id;
}

public function setId(int $id): void
{
    $this->id = $id;
}

public function getAge(): int
{
    return $this->age;
}

public function setAge(int $age): void
{
    $this->age = $age;
}

public function getDescription(): string
{
    return $this->description;
}

public function setDescription(string $description): void
{
    $this->description = $description;
}

public function getImg(): string
{
    return $this->img;
}

public function setImg(string $img): void
{
    $this->img = $img;
}

public function getName(): string
{
    return $this->name;
}

public function setName(string $name): void
{
    $this->name = $name;
}

public function getSexe(): string
{
    return $this->sexe;
}

public function setSexe(string $sexe): void
{
    $this->sexe = $sexe;
}

public function getStatus(): string
{
    return $this->status;
}

public function setStatus(string $status): void
{
    $this->status = $status;
}

public function getType(): string
{
    return $this->type;
}

public function setType(string $type): void
{
    $this->type = $type;
}

public function getUser_id(): int
{
    return $this->user_id;
}

public function setUser_id(int $user_id): void
{
    $this->user_id = $user_id;
}

public function getDate(): string
{
    return $this->date;
}

public function setDate(string $date): void
{
    $this->date = $date;
}

}

?>