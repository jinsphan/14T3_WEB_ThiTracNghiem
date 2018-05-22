<?php 

class account_model extends vendor_crud_model {

    public function __construct()
    {
        parent::__construct();
    }

    public function update($conditions, $datas) {
        return $this->updateRecord($conditions, $datas);
    }
}

?>