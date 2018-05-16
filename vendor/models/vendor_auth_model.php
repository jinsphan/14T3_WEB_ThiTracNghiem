<?php 

class vendor_auth_model extends vendor_main_model {

    public function login($user) {
        $sql = "SELECT username, password, salt, role_id FROM accounts WHERE username = :username";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $user["username"]);

        $stmt->execute();
        if($stmt->rowCount() != 1) {
            return false;
        }
        else {
            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            $password = vendor_app_util::generatePassword($user["password"], $record["salt"]);

            if($password != $record["password"])
                return false;
            
            $_SESSION["loginUser"]["username"] = $record["username"];
            $_SESSION["loginUser"]["role_id"] = $record["role_id"];
        }
    }
}

?>