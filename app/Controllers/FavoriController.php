<?php

namespace App\Controllers;

use App\Controllers\MainController;
use App\Models\FavoriModel;
use App\Models\AnimalModel;

class FavoriController extends MainController
{
    public function renderFavori(){
        $FavoriModel= new FavoriModel();
        $this->data =  $FavoriModel->getFavoriByUser($_SESSION['user_id']);
        $this->render();
    }
}

?>