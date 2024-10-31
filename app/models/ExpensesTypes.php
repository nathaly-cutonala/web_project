<?php
require_once __DIR__ . '/../db/database.php';

class ExpensesTypes {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function read() {
        $result = $this->db->query("SELECT et.type_name, SUM(e.amount) AS total_amount
                                    FROM expenses e
                                    JOIN expense_types et ON e.expense_type_id = et.expense_type_id
                                    GROUP BY et.type_name
                                    ORDER BY total_amount DESC
                                    LIMIT 5");

                                    
        return $result->fetch_all(MYSQLI_ASSOC);
    }


   
}
