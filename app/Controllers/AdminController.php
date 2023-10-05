<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\AnimalModel;

class AdminController extends MainController
{
    public function renderAdmin(): void
    {
         $this->checkUserAuthorization(1);
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            if (isset($_POST["addAnimal"])) {

                $this->insertAnimal();
            }
            
            if (isset($_POST['deleteAnimal'])) {
                
                $this->deleteAnimal();
           }
           
            if (isset($_POST['updateAnimal'])) {
               
                $this->updateAnimal();
            }
        }
        
        $this->viewType = 'admin';
        
        if (isset($this->subPage)) {
            
            $this->view = $this->subPage;
        }
        
        if ($this->view === 'update') {
            if (isset($_GET['id'])) {
                $animal = AnimalModel::getAnimalByID($_GET['id']);
            if (!$animal) {
                $this->data['error'] = '<div class="alert-danger">L\'article n\'existe pas</div>';
            } else {
                $this->data['animal'] = $animal;
            }
          }
          
    } else {
        $this->data['animal'] = AnimalModel::getAnimal();
    }
        $this->render();
    }
    
    public function insertAnimal(): void
    {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_SPECIAL_CHARS);
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
        $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_SPECIAL_CHARS);
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $animalModel = new AnimalModel();
        
        $animalModel->setName($name);
        $animalModel->setSexe($sexe);
        $animalModel->setAge($age);
        $animalModel->setDescription($description);
        $animalModel->setImg($img);
        $animalModel->setType($type);
        
        if ($animalModel->insertAnimal()) {
            $this->data[] = '<div class="alert-success">Article enregistré avec succès</div>';
        } else {
            $this->data[] = '<div class="alert-danger">Il s\'est produit une erreur</div>';
        }
    }
    
    public function updateAnimal(): void
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $sexe = filter_input(INPUT_POST, 'sexe', FILTER_SANITIZE_SPECIAL_CHARS);
        $age = filter_input(INPUT_POST, 'age', FILTER_SANITIZE_NUMBER_INT);
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_SPECIAL_CHARS);
        
        $animalModel = new AnimalModel();
        
        $animalModel->setId($id);
        $animalModel->setName($name);
        $animalModel->setSexe($sexe);
        $animalModel->setAge($age);
        $animalModel->setDescription($description);
        $animalModel->setType($type);
        
        if ($animalModel->updateAnimal()) {
            $this->data['infos'] = '<div class="alert-success">Article enregistré avec succès</div>';
        } else {
            $this->data['infos'] = '<div class="alert-danger">Il s\'est produit une erreur</div>';
        }
    }
    
    
    public function deleteAnimal(): void
    {
        $animal_id = filter_input(INPUT_POST, 'animalid', FILTER_SANITIZE_SPECIAL_CHARS);
        
        if (AnimalModel::deleteAnimal($animal_id)) {
              $this->data['infos'] = '<div class="message-success">Article supprimé avec succès</div>';
        } else {
              $this->data['infos'] = '<div class="alert-danger">Il s\'est produit une erreur</div>';
        }
    }
}    
 



    
