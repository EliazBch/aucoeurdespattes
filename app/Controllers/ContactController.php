<?php

namespace App\Controllers;
use App\Controllers\MainController;
use App\Utility\DataBase; 

class ContactController extends MainController{
    
    public function renderContact(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->checkForm();
        }else{
            $this->render();
        }
    }

    public function checkForm(){
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $message = filter_input(INPUT_POST, 'message');
        $checkbox = filter_input(INPUT_POST, 'checkbox');
        
        if ($email)
        {
            $data = [
                "status" => true,
                "error" => []
            ];
            
            if (!$email || !$name || !$message) 
            {
                $data["status"] = false;
                array_push($data["error"], 'Tous les champs sont obligatoires');
            }
            if($checkbox == false){
                $data["status"] = false;
                array_push($data["error"], 'RGPD non accepté');
            }
            
            $email = filter_var($email, FILTER_VALIDATE_EMAIL); 
            if(!$email)
            {
                $data["status"] = false;
                array_push($data["error"], 'Le format de l\'email n\'est pas valide.');
            }
            
            if ($data["status"]) {
                $pdo = DataBase::connectPDO();
                $sql = $pdo->prepare("INSERT INTO `contact`(`email`, `name`, `message`) VALUES (:email, :name, :message)");
                
                $params = [
                    'email' => $email, 
                    'name' => $name,
                    'message' => $message
                ];
                
                $sql->execute($params);
            }
            echo json_encode($data);
        }
    }
}

?>
