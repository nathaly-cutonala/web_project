<?php
require_once 'app/models/User.php';
require_once 'app/controllers/UserController.php';

$user = new User();
$controller = new UserController();

$method = $_SERVER['REQUEST_METHOD'];


//http://localhost/web_project/router.php?action=read
switch ($method) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);//The json_decode() function is used to decode or convert a JSON object to a PHP object.
        $controller->store($data);
        break;

    case 'PUT':
        $jsonData = file_get_contents('php://input');
        $data = json_decode($jsonData, true);
        $controller->update($data);
        break;

    case 'GET':

        $controller->index();
        break; 

    case 'DELETE':
        $id = $_GET['id'];
        $controller->delete($id);
        break;

    default:
        echo json_encode(['status' => 'Invalid action']);
        break;
}
