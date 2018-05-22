<?php 

class quiz_model extends vendor_crud_model {
    public function __construct()
    {
        parent::__construct();
    }

    public function readAll($fields, $conditions) {
        return $this->readAllRecords($fields, $conditions);
    }

    public function readByID($datas) {
        return $this->readRecord($datas);
    }

    public function update($conditions, $datas) {
        return $this->updateRecord($conditions, $datas);
    }

    public function search($keyword) {
        $sql = "SELECT * FROM quizs 
                WHERE quiz_name LIKE ? OR description LIKE ?";
        
        $stmt = $this->conn->prepare($sql);
        $keyword = "%{$keyword}%";
        $stmt->bindParam(1, $keyword, PDO::PARAM_STR);
        $stmt->bindParam(2, $keyword, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>