<?php 

class answer_model extends vendor_crud_model {
    public function __construct()
    {
        parent::__construct();
    }

    public function create($datas) {
        return $this->createRecord($datas);
    }
}

?>