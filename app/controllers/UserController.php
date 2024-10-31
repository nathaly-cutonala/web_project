<?php
// controllers/UserController.php

//require_once '__DIR__'. 'models/User.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/ExpensesTypes.php';

class UserController {
    private $userModel;
    private $expensesModel;

     public function __construct() {        
        $this->userModel = new User();
        $this->expensesModel = new ExpensesTypes();
    }

    // Display all users
    public function index() {
        $users = $this->userModel->read();       
        echo json_encode($users);
    }

    // Store a new user
     public function store($data) {
        $this->userModel->create($data['name'], $data['email'], $data['password']);
        echo json_encode(['status' => 'User created']);    
    } 

    // Show a single user by ID
    public function show($id) {
      return $this->userModel->getById($id);
      
    }

    // Update a user
    public function update($data) {
        if (isset($data['id']) && isset($data['name']) && isset($data['email'], $data['password'])) {
            $result = $this->userModel->update($data['id'], $data['name'], $data['email'], $data['password']);
            echo json_encode(['status' => $result ? 'User updated successfully' : 'Error updating user']);
        } else {
            echo json_encode(['status' => 'Invalid data']);
        }
    }

    // Delete a user
    public function delete($id) {
        $users = $this->userModel->delete($id);       
        echo json_encode(['status' => 'User '. $id .' deleted ']);
    } 


    public function chart(){
        $expenses = $this->expensesModel->read();     
        echo json_encode($expenses);
    }
}
