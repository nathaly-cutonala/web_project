<?php
// controllers/UserController.php

//require_once '__DIR__'. 'models/User.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/ExpensesTypes.php';

class ExpensesTypesController {
    
    private $expensesModel;

     public function __construct() {
        $this->expensesModel = new ExpensesTypes();
    }
    
    public function chart(){
        $expenses = $this->expensesModel->read();     
        return json_encode($expenses);
    }
}
