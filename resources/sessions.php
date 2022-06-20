<?php

class Sessions {

    public $APP_TITLE = "Citizenship Information Management";
    public $APP_SYMBOL = "C.I.M";
    private $DB_USER = "root";
    private $DB_PASSWORD = "";
    private $DB_DSN = "mysql:host=localhost;dbname=citizen";

    private function getConnection() { //create database connection
        try {
            $conn = new PDO($this->DB_DSN, $this->DB_USER, $this->DB_PASSWORD);
            return $conn;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function addLogin($loginid, $role, $password) {
        try {
            $conn = $this->getConnection();
            $query = "INSERT INTO login VALUES(?,?,?);";
            $ps = $conn->prepare($query);
            $ps->bindValue(1, $loginid);
            $ps->bindValue(2, $role);
            $ps->bindValue(3, $password);

            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function login($username, $password) {
        try {
            $conn = $this->getConnection();
            $role = NULL;
            $query = "SELECT * FROM login WHERE loginid=? AND password=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $username);
            $ps->bindParam(2, $password);
            $ps->execute();
            $res = $ps->fetchAll();
            foreach ($res as $r) {
                $role = $r['role'];
            }
            return $role;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function checkLogin($username) {
        try {
            $conn = $this->getConnection();
            $result = FALSE;
            $query = "SELECT * FROM login WHERE loginid=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $username);
            $ps->execute();
            $res = $ps->fetchAll();
            foreach ($res as $r) {
                $result = TRUE;
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function removeLogin($loginid) {
        try {
            $conn = $this->getConnection();
            $query = "DELETE FROM login WHERE loginid=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $loginid);
            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function addCitizen($nin, $fullname, $gender, $dob, $marital_status, 
            $children, $state, $lga, $home_address, $current_address, 
            $citizen_status, $email, $mobile) {
        try {
            $conn = $this->getConnection();
            $query = "INSERT INTO citizen VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);";
            $ps = $conn->prepare($query);
            $ps->bindValue(1, $nin);
            $ps->bindValue(2, $fullname);
            $ps->bindValue(3, $gender);
            $ps->bindValue(4, $dob);
            $ps->bindValue(5, $marital_status);
            $ps->bindValue(6, $children);
            $ps->bindValue(7, $state);
            $ps->bindValue(8, $lga);
            $ps->bindValue(9, $home_address);
            $ps->bindValue(10, $current_address);
            $ps->bindValue(11, $citizen_status);
            $ps->bindValue(12, $email);
            $ps->bindValue(13, $mobile);

            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function checkCitizen($nin) {
        try {
            $conn = $this->getConnection();
            $result = FALSE;
            $query = "SELECT * FROM citizen WHERE nin = ?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $nin);
            $ps->execute();
            $res = $ps->fetchAll();
            foreach ($res as $r) {
                $result = TRUE;
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSingleCitizenByNIN($nin) {
        try {
            $conn = $this->getConnection();
            $result = "";
            $query = "SELECT * FROM citizen WHERE nin=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $nin);
            $ps->execute();
            $res = $ps->fetchAll();
            foreach ($res as $rs) {
                $result = $rs;
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getAllCitizen() {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM citizen;";
            $ps = $conn->prepare($query);
            $ps->execute();
            return $ps->fetchAll();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function updateCitizenByNIN($nin, $marital_status, $children,
            $current_address, $citizen_status){
        try {
            $conn = $this->getConnection();
            $query = "UPDATE citizen SET marital_status=?, "
                    . "children=?, current_address=?, citizen_status=? WHERE nin=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $marital_status);
            $ps->bindParam(2, $children);
            $ps->bindParam(3, $current_address);
            $ps->bindParam(4, $citizen_status);
            $ps->bindParam(5, $nin);
            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function addCaseIssue($offences, $result, $penalty, $citizen) {
        try {
            $caseid = "case" . date("YmdHis");
            $case_date = date("d M Y");
            $conn = $this->getConnection();
            $query = "INSERT INTO case_issue VALUES(?,?,?,?,?,?);";
            $ps = $conn->prepare($query);
            $ps->bindValue(1, $caseid);
            $ps->bindValue(2, $offences);
            $ps->bindValue(3, $result);
            $ps->bindValue(4, $penalty);
            $ps->bindValue(5, $citizen);
            $ps->bindValue(6, $case_date);

            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function getSingleCaseIssueByID($caseID) {
        try {
            $conn = $this->getConnection();
            $result = "";
            $query = "SELECT * FROM case_issue WHERE caseid=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $caseID);
            $ps->execute();
            $res = $ps->fetchAll();
            foreach ($res as $r) {
                $result = $r;
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function getAllCaseIssueByNIN($nin) {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM case_issue WHERE citizen=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $nin);
            $ps->execute();
            return $ps->fetchAll();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function addHealth($citizen, $allergies, $genotype, $blood_group, $virus, $handicap) {
        try {
            $healthid = "health" . date("YmdHis");
            $last_update = date("d M Y");
            $conn = $this->getConnection();
            $query = "INSERT INTO health VALUES(?,?,?,?,?,?,?,?);";
            $ps = $conn->prepare($query);
            $ps->bindValue(1, $healthid);
            $ps->bindValue(2, $citizen);
            $ps->bindValue(3, $allergies);
            $ps->bindValue(4, $genotype);
            $ps->bindValue(5, $blood_group);
            $ps->bindValue(6, $virus);
            $ps->bindValue(7, $handicap);
            $ps->bindValue(8, $last_update);

            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function getSingleHealthByID($healthID) {
        try {
            $conn = $this->getConnection();
            $result = "";
            $query = "SELECT * FROM health WHERE healthid=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $healthID);
            $ps->execute();
            $res = $ps->fetchAll();
            foreach ($res as $r) {
                $result = $r;
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function getSingleHealthByNIN($nin) {
        try {
            $conn = $this->getConnection();
            $result = "";
            $query = "SELECT * FROM health WHERE citizen=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $nin);
            $ps->execute();
            $res = $ps->fetchAll();
            foreach ($res as $r) {
                $result = $r;
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function checkHealthByNIN($nin) {
        try {
            $conn = $this->getConnection();
            $result = FALSE;
            $query = "SELECT * FROM health WHERE citizen = ?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $nin);
            $ps->execute();
            $res = $ps->fetchAll();
            foreach ($res as $r) {
                $result = TRUE;
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function updateHealthByNIN($nin, $allergies, $genotype, $bloodgroup,
            $virus, $handicap){
            $last_update = date("d M Y");
        try {
            $conn = $this->getConnection();
            $query = "UPDATE health SET allergies=?, "
                    . "genotype=?, blood_group=?, virus=?, handicap=?, last_update=? WHERE citizen=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $allergies);
            $ps->bindParam(2, $genotype);
            $ps->bindParam(3, $bloodgroup);
            $ps->bindParam(4, $virus);
            $ps->bindParam(5, $handicap);
            $ps->bindParam(6, $last_update);
            $ps->bindParam(7, $nin);
            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function addHealthIssue($illness, $all_tests, $test_result, $citizen) {
        try {
            $issueid = "health" . date("YmdHis");
            $issue_date = date("d M Y");
            $conn = $this->getConnection();
            $query = "INSERT INTO health_issue VALUES(?,?,?,?,?,?);";
            $ps = $conn->prepare($query);
            $ps->bindValue(1, $issueid);
            $ps->bindValue(2, $illness);
            $ps->bindValue(3, $all_tests);
            $ps->bindValue(4, $test_result);
            $ps->bindValue(5, $issue_date);
            $ps->bindValue(6, $citizen);

            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function getSingleHealthIssueByID($issueID) {
        try {
            $conn = $this->getConnection();
            $result = "";
            $query = "SELECT * FROM health_issue WHERE issueid=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $issueID);
            $ps->execute();
            $res = $ps->fetchAll();
            foreach ($res as $r) {
                $result = $r;
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function getAllHealthIssueByNIN($nin) {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM health_issue WHERE citizen=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $nin);
            $ps->execute();
            return $ps->fetchAll();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function addSector($email, $sector_name, $mobile, $address) {
        try {
            $conn = $this->getConnection();
            $query = "INSERT INTO sector VALUES(?,?,?,?);";
            $ps = $conn->prepare($query);
            $ps->bindValue(1, $email);
            $ps->bindValue(2, $sector_name);
            $ps->bindValue(3, $mobile);
            $ps->bindValue(4, $address);

            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function getSingleSectorByEmail($email) {
        try {
            $conn = $this->getConnection();
            $result = "";
            $query = "SELECT * FROM sector WHERE email=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $email);
            $ps->execute();
            $res = $ps->fetchAll();
            foreach ($res as $r) {
                $result = $r;
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function getAllSector() {
        try {
            $conn = $this->getConnection();
            $query = "SELECT * FROM sector;";
            $ps = $conn->prepare($query);
            $ps->execute();
            return $ps->fetchAll();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    public function removeSector($email) {
        try {
            $conn = $this->getConnection();
            $query = "DELETE FROM sector WHERE email=?;";
            $ps = $conn->prepare($query);
            $ps->bindParam(1, $email);
            return $ps->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
