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

                $this->addAnimal();
            }
            
            if (isset($_POST['deleteAnimal'])) {
                
                $this->removeAnimal();
           }
           
            if (isset($_POST['updateAnimal'])) {
               
                $this->updateAnimal();
            }
        }
        
        $this->viewType = 'admin';
        
        if (isset($this->subPage)) {
            
            $this->view = $this->subPage;
             
        }
        $animalModel = new AnimalModel();
    $this->setData($animalModel->getAllAnimal());
    $this->render();
    }
    
    public function deleteAnimal():void
    {
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_SPECIAL_CHARS);
        var_dump($user_id);
        if (AnimalModel::deleteAnimal($user_id)) {
              $this->data['infos'] = '<div class="alert-success>Article supprimé avec succès</div>';
        } else {
            $this->data['infos'] = '<div class="alert-danger">Il s\'est produit une erreur</div>';
        }
    }
}    
 



    
