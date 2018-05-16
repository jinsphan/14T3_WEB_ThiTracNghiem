<?php 

class vendor_reg_model extends vendor_main_model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function register($datas) {
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
                "accounts",
                implode(", ", array_keys($datas)),
                ":".implode(", :", array_keys($datas)));
        
        $stmt = $this->conn->prepare($sql);
    
        try {
            $stmt->execute($datas);
            return true; 
        } catch(Exception $e) {
            return false;
        }
    }
}

?>