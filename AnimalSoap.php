<?php

class AnimalSoap


{
    public function check($id ){
        $servername="localhost:3333";
        $username="root";
        $password="";
        $con = new PDO("mysql:host=$servername;dbname=pufosa", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $date=new DateTime($id);
        $nac=new DateTime();
        $response=$nac->diff($date);
        if($response->y >=18){
            return true;
        }
        else{
            return false;
        }



    }
}