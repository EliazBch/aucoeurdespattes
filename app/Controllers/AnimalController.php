<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\AnimalModel;

class AnimalController extends MainController{
    public function renderAnimal(){
      $AnimalModel= new AnimalModel();
      $this->data = $AnimalModel->getAnimalById($this->subPage);
      $this->render();  
    }
}
