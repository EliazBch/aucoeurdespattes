<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\AnimalModel;

class AdoptController extends MainController 
{
    public function renderAdopt():void
    {
        $AnimalModel= new AnimalModel();
        $this->data =  $AnimalModel->getAnimal();
        $this->render();
    }
}
