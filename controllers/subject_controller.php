<?php 

class subject_controller extends main_controller {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function readAll() {
        $subject_model = new subject_model();
        $subject_rela_model = new subject_relationship_model();

        $subject_data = [];

        // find root subject
        $allSubjects = $subject_model->readAll("subject_id, subject_name, description");
        foreach($allSubjects as $subject) {
            if($subject_rela_model->findParentSubject([
                "child_subject_id" => $subject["subject_id"]
            ]) == null) {
                $subject_data["{$subject["subject_id"]}"] = $subject;
                $subject_data["{$subject["subject_id"]}"]["childs"] = [];
            }
        }
        foreach($subject_data as $root_subject) {
            $this->findChildSubject($root_subject["subject_id"], $subject_data["{$root_subject["subject_id"]}"]["childs"]);
        }
        
        echo json_encode($subject_data);
    }

    private function findChildSubject($parent_subject_id, &$subject_data){
        $subject_rela_model = new subject_relationship_model();
        $subject_model = new subject_model();

        $childs = $subject_rela_model->findChildSubject("*", [
            "conditions" => "parent_subject_id = {$parent_subject_id}"
        ]);

        if($childs == null) {
            return null;
        }
        else {
            foreach($childs as $child) {
                $subject_data["{$child["child_subject_id"]}"] = $subject_model->readByID([
                    "subject_id" => $child["child_subject_id"]
                ], "subject_id, subject_name, description");

                $subject_data["{$child["child_subject_id"]}"]["childs"] = [];

                $this->findChildSubject($child["child_subject_id"], $subject_data["{$child["child_subject_id"]}"]["childs"]);
            }
        }
    }
}

?>