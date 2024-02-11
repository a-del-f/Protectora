<?php

class AnimalSoap


{
    public function check($id)
    {
        $servername = "localhost:3333";
        $username = "root";
        $password = "";
        $check=0;
        $con = new PDO("mysql:host=$servername;dbname=protectora_animales", $username, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "Select id from animal where id=:id ";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":id",$id);

        $stmt->execute();
        $row=$stmt->fetchColumn(0);
            if ($row==$id) {
                $check = 1;
            }
        $sql = "Select idAnimal from adopcion  where id=:id ";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(":id",$id);

        $stmt->execute();
        $row=$stmt->fetchColumn(0);
        if ($row==$id){
            $check=2;
        }
        return $check;



    }
}