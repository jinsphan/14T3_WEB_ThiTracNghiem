<?php 

class vendor_crud_model extends vendor_main_model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function readAllRecords($fields="*", $options = null) {
        $conditions = "";
        if(isset($options["conditions"])) {
            $conditions .= " WHERE ".$options["conditions"];
        }
        $sql = "SELECT ".$fields." FROM ".$this->table.$conditions;
        
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function readRecord($fields = "*", $options = null) {
        $conditions = "";
        if(isset($options["conditions"])) {
            $conditions .= " AND ".$options["conditions"];
        }

        $sql = "SELECT $fields FROM {$this->table} WHERE id = ?".$conditions;

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delRecord($id = null, $conditions = null) {
        if($conditions)
            $conditions = " AND ".$conditions;
        
        $sql = "DELETE FROM ".$this->table.
                " WHERE id = ?".$conditions;
        
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(1, $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return true;
        } catch(Exception $e) {
            return false;
        }
    }

    public function createRecord($datas) {
        $sql = sprintf("INSERT INTO %s (%s) VALUES (%s)"
                , $this->table,
                implode(", ", array_keys($datas)),
                ":".implode(", :", array_keys($datas)));
        
        $stmt = $this->conn->prepare($sql);
    
        try {
            $stmt->execute($datas);
            return $this->conn->lastInsertId();
        } catch(Exception $e) {
            return 0;
        }
    }

    public function updateRecord($id, $datas) {
        foreach($datas as $key => $value) {
            $setDatas[] = "$key = :$key";
        }

        $sql = sprintf("UPDATE %s SET %s WHERE %s",
                $this->table,
                implode(", ", $setDatas),
                "id = :id");
        

        $stmt = $this->conn->prepare($sql);

        foreach($datas as $key => &$value) {
            $stmt->bindParam(":".$key, $value);
        }
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return true;
        } catch(Exception $e) {
            return false;
        }
    }
}

?>