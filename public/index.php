<?php
require '../vendor/autoload.php';

use App\Controller\UserController;

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]    
]);

$app->get('/users', UserController::class . ':getUsers');

$app->get('/users/{id}', UserController::class . ':getUser');

$app->put('/users/{id}', UserController::class . ':updateUser');

$app->delete('/users/{id}', UserController::class . ':deleteUser');

$app->post('/users', UserController::class . ':createUser');


$app->run();


?>