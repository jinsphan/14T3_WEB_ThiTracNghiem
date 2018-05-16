<?php 

class quiz_model extends vendor_crud_model {

    protected $error;

    public function __construct()
    {
        parent::__construct();
    }

    public function create($datas) {
        return $this->createRecord($datas);
    }
}