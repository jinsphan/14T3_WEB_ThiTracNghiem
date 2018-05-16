<?php 

class vendor_main_model {
    protected $conn;
    protected $table;
    public function __construct() {
        try {
            $conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
                            DB_USER,
                            DB_PASSWORD,
                            DB_OPTIONS
                            );
            
            if(!$this->table) $this->setTableName();
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    protected function setTableName($table = null) {
        if($table) {
            $this->table = $table;
        } else {
            $cln = get_class($this);
            $clnf = str_split($cln, strrpos($cln, "_"))[0];
            if(strrpos($clnf, "y")) {
                if((strrpos($clnf, "y") + 1) == strlen($clnf)) {
                    $this->table = str_split($clnf, strrpos($clnf, "y"))[0]."ies";
                }
            } else {
                $this->table = $clnf."s";
            }
        }
    }

    public function getTableName() {
        return $this->table;
    }
}

?>