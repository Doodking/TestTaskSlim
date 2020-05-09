<?php

namespace App\Controller;
use App\Model\User;

class UserController{

    public function getUsers($req, $response, $args){
        $json = file_get_contents('../app/Repository/repository.json');
        $taskList = json_decode($json,TRUE);
        $response->withStatus(200);
        return $response->withJson($taskList);
    }

    public function getUser($req, $response, $args){
        $json = file_get_contents('../app/Repository/repository.json');
        $taskList = json_decode($json,TRUE);
        foreach($taskList as $k => $task):
            foreach($task as $key => $value):
                if($value == $args['id']){
                    $count++;
                    $index = $k;
                }
            endforeach;
        endforeach;
        if($count == 1){
            $response->withStatus(200);
            return $response->withJson($taskList[$index]);
        }else{
            $response->withStatus(404);
            $res = array('message' => 'User not found'); 
            return $response->withJson($res);
        }
    }

    public function createUser($req, $response, $args){
        $file = file_get_contents('../app/Repository/repository.json');  
        $taskList = json_decode($file,TRUE);
        $max = [];
        foreach($taskList as $k => $task):
            foreach($task as $key => $value):
                if($key == 'id'){
                    $max[] = $value;
                }
            endforeach;
        endforeach;                                                        
        $user = new User(max($max) + 1, $req->getParsedBody()['name'], $req->getParsedBody()['email']);
        $taskList[] = array("id" => $user->getId(), "name" => $user->getName(), "email" => $user->getEmail());       
        file_put_contents('../app/Repository/repository.json', json_encode($taskList));
        $response->withStatus(201);
        $res = array('message' => 'User was successfully created'); 
        return $response->withJson($res);     
    }

    public function updateUser($req, $response, $args){
        $json = file_get_contents('../app/Repository/repository.json');
        $taskList = json_decode($json,TRUE);
        $count = 0;
        $index;
        foreach($taskList as $k => $task):
            foreach($task as $key => $value):
                if($value == $args['id']){
                    $count++;
                    $index = $k;
                }
            endforeach;
        endforeach;
        if($count == 1){
                    $taskList[$index] = array("id" => $args['id'], "name" => $req->getParsedBody()['name'], "email" => $req->getParsedBody()['email']);
                    file_put_contents('../app/Repository/repository.json', json_encode($taskList));
                    $response->withStatus(201);
                    $res = array('message' => 'User was successfully updated'); 
                    return $response->withJson($res);
        }else{
                $response->withStatus(404);
                $res = array('message' => 'User not found'); 
                return $response->withJson($res);
        }

    }

    public function deleteUser($req, $response, $args){
        $json = file_get_contents('../app/Repository/repository.json');
        $taskList = json_decode($json,TRUE);
        $count = 0;
        $index;
        foreach($taskList as $k => $task):
            foreach($task as $key => $value):
                if($value == $args['id']){
                    $count++;
                    $index = $k;
                }
            endforeach;
        endforeach;
        if($count == 1){
            unset($taskList[$index]);
            $taskList = array_values($taskList);
            file_put_contents('../app/Repository/repository.json',json_encode($taskList));
            $response->withStatus(404);
            $res = array('message' => 'User was successfully deleted'); 
            return $response->withJson($res);
        }else{
            $response->withStatus(404);
            $res = array('message' => 'User not found'); 
            return $response->withJson($res);
        }
    }


}

?>