<?php

namespace App\Models;

use App\Utility\DataBase;

class UserModel
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $role;
    
    public function registerUser():bool
    {
        $pdo = DataBase::connectPDO();
        
        $sql = "INSERT INTO `user`(`name`,`email`,`password`,`role`) VALUES (:name, :email, :password, :role)";
        
        $pdoStatement = $pdo->prepare($sql);
        
        $params = [
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => $this->password,
            ':role' => $this->role,
            ];
            
            $queryStatus = $pdoStatement->execute($params);
            
            return $queryStatus;
    }
    
    public function checkEmail():bool
    {
        $pdo = DataBase::connectPDO();
        
        $sql = "SELECT COUNT(*) FROM `user` WHERE `email` = :email";
        
        $query = $pdo->prepare($sql);
        
        $query->bindParam(':email',$this->email);
        
        $query->execute();
        
        $isMail = $query->fetchColumn();
        
        return $isMail > 0;
    }
    
    public function getUserByEmail($email): ?userModel
    {
        $pdo = DataBase::connectPDO();
        
        $sql ='
        SELECT *
        FROM user
        WHERE email = :email';
        $pdoStatement = $pdo->prepare($sql);
        
        $pdoStatement->execute([':email' => $email]);
        
        $result = $pdoStatement->fetchObject('App\Models\UserModel');
        
        if(!$result){
            $result = null;
        }
        return $result;
    }
    
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole(int $role): void
    {
        $this->role = $role;
    }
}