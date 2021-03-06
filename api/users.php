<?php
session_start();
require __DIR__ . '/../inc/bootstrap.php';

use VanillaPHP\Repositories\UserRepository;
use VanillaPHP\Helpers\AuthManager;

AuthManager::redirect_unauthenticated_user_to_login($_SESSION);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$user_repo = new UserRepository($db);
$users = $user_repo->get_all();

if(count($users) > 0){
    http_response_code(200);
    echo json_encode($users);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No users found.")
    );
}
