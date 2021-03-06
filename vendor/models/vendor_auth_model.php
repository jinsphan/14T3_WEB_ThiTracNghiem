<?php 

class vendor_auth_model extends vendor_main_model {

    public function __construct() {
        parent::__construct();
    }
    public function login($account) {
        $sql = "SELECT account_id, username, password, role_id, fullname FROM accounts WHERE username = :username";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $account["username"]);

        $stmt->execute();
        if($stmt->rowCount() != 1) {
            return false;
        }
        else {
            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            if(password_verify($account["password"], $record["password"])) {
                $_SESSION["loginUser"]["account_id"] = $record["account_id"];
                $_SESSION["loginUser"]["username"] = $record["username"];
                $_SESSION["loginUser"]["role_id"] = $record["role_id"];
                $_SESSION["loginUser"]["fullname"] = $record["fullname"];
                return true;
            }
            return false;
        }
    }

    public function loginAdmin($account) {
        $sql = "SELECT account_id, username, password, role_id, fullname FROM accounts WHERE username = :username AND role_id = 1";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":username", $account["username"]);

        $stmt->execute();
        if($stmt->rowCount() != 1) {
            return false;
        }
        else {
            $record = $stmt->fetch(PDO::FETCH_ASSOC);

            if(password_verify($account["password"], $record["password"])) {
                $_SESSION["loginUser"]["account_id"] = $record["account_id"];
                $_SESSION["loginUser"]["username"] = $record["username"];
                $_SESSION["loginUser"]["role_id"] = $record["role_id"];
                $_SESSION["loginUser"]["fullname"] = $record["fullname"];
                return true;
            }
            return false;
        }
    }
}

?>