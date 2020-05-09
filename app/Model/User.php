<?php

namespace App\Model;

class User{

    private $name;

    private $email;

    private $id;

    function __construct($id, $name, $email){
        $this->name = $name;
        $this->email = $email;
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function getId(){
        return $this->id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setEmail($email){
        $this->email = $email;
    }




}

?>