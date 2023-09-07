<?php

namespace App\Controllers;

class MainController
{
    // Propriétés de la classe
    protected string $view; // Vue à afficher
    protected $subPage; // Sous-page (non utilisée dans ce code)
    protected $data; // Données associées à la vue (non utilisées dans ce code)
    protected string $viewType = 'front'; // Type de vue (front-end dans ce cas)

    // Méthode pour afficher la vue
    public function render(): void
    {
        $base_uri = explode('/public/', $_SERVER['REQUEST_URI']);
        $data=$this->data;
        require(__DIR__ . '/../views/front/layouts/header.phtml'); // Inclusion de l'en-tête de la page
        require(__DIR__ . '/../views/front/partials/' . $this->view . '.phtml'); // Inclusion de la vue spécifique
        require(__DIR__ . '/../views/front/layouts/footer.phtml'); // Inclusion du pied de page
    }
    
    protected function checkUserAuthorization(int $role): bool
    {
        if (isset($_SESSION['userObject'])) {
            
            $currentUser = $_SESSION['userObject'];
            
            $currentUserRole = $currentUser->getRole();
        
            if ($currentUserRole <= $role) {
                
                return true;
            } else {
                
                http_response_code(403);
                
                $this->view = '403';
               
                $this->render();
                
                exit();
            }
        } else {
            
            $redirect = explode('/public/', $_SERVER['REQUEST_URI']);
            
            header('Location: ' . $redirect[0] . '/public/login');
            
            exit();
        }
    }
    
    // Méthode pour obtenir le nom de la vue
    public function getView()
    {
        return $this->view;
    }

    // Méthode pour définir le nom de la vue
    public function setView($view)
    {
        $this->view = $view;
    }
    public function getData(){
        return $this->data;
    }
    public function setData($newData){
        $this->data=$newData;
    }
    public function getSubPage(): string
    {
        return $this->subPage;
    }
    public function setSubPage(?string $value): void
    {
        $this->subPage = $value;
    }
}


    
    
    

