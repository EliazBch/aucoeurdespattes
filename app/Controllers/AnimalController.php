<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\AnimalModel;
use App\Models\FavoriModel;

class AnimalController extends MainController{
    public function renderAnimal(){
      if (isset($_POST["animal_id"]))
      {
        if(!isset($_SESSION['user_id'])){
          echo '<div>Vous devez être connecté pour ajouter un animal aux favoris.</div>';
          return;
        }
        $favoriModel= new FavoriModel();
        if (isset($_POST["fav-button"])){
          $res= $favoriModel->addFavori($_POST['animal_id'],$_SESSION['user_id']);
        } else if (isset($_POST["remove-fav-button"])){
          $res= $favoriModel->removeFavori($_POST['animal_id'],$_SESSION['user_id']);
        }
          if ($res == true){
            echo '<div style="top: 870px; position:absolute; padding-left:200px; color: #067C1E;">Votre animal a été ajouté aux favoris</div>';
          } else if ($res == false){
            echo 'Il y a eu une erreur, votre animal n\'a pas été ajouté aux favoris';
          }
      }
      $AnimalModel= new AnimalModel();
      $this->data = $AnimalModel->getAnimalById($this->subPage);
      $this->render();  
    }
}


