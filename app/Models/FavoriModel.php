<?php

namespace App\Models;

use App\Utility\DataBase;
use \PDO;

class FavoriModel
{
   private $id;
   private $user_id;
   private $animal_id;

        public function addFavori($animal_id, $user_id) {
            $pdo = DataBase::ConnectPDO();
            $sql = "INSERT INTO `favori` (`animal_id`, `user_id`) VALUES (:animal_id, :user_id)";
            $query = $pdo->prepare($sql);
            $query->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $queryStatus = $query->execute();
            return $queryStatus;
        }

        public function removeFavori($animal_id, $user_id) {
            $pdo = DataBase::ConnectPDO();
            $sql = "DELETE FROM `favori` WHERE `animal_id` = :animal_id AND `user_id` = :user_id";
            $query = $pdo->prepare($sql);
            $query->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $queryStatus = $query->execute();
            return $queryStatus;
        }

        public function isFavori($animal_id, $user_id) {
            $pdo = DataBase::ConnectPDO();
            $sql = "SELECT 1 FROM `favori` WHERE `animal_id` = :animal_id AND `user_id` = :user_id";
            $query = $pdo->prepare($sql);
            $query->bindParam(':animal_id', $animal_id, PDO::PARAM_INT);
            $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchColumn() !== false;
         }
        
        public function getFavoriByUser($user_id){
            $pdo = DataBase::ConnectPDO();
            $sql = "SELECT animal_id FROM `favori` WHERE `user_id` = :user_id";
            $query = $pdo->prepare($sql);
            $query->execute(['user_id'=>$user_id]);
            $favoris = $query->fetchAll(PDO::FETCH_ASSOC);
            return $favoris;
        }
        
        public function getUser_id(): int
        {
            return $this->user_id;
        }

        public function setUser_id(int $user_id): void
        {
            $this->user_id = $user_id;
        }
        
        public function getAnimal_id(): int
        {
            return $this->animal_id;
        }

        public function setAnimal_id(int $animal_id): void
        {
            $this->animal_id = $animal_id;
        }
}

?>