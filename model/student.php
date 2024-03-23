<?php
    require_once('db.php');

    class student extends db{

        public function getstudents(){
            $sql = 'CALL `sp_getstudents`()';
            return $this->getJSON($sql);
        }

        public function checkstudent($studentid){
            $sql = 'CALL `sp_checkstudent`()';
            return $this->getJSON($sql);
        }

        public function savestudent($studentid,$firstname,$lastname,$dateofbirth,$gradelevel,$parentid){
            if(!$this->checkstudent($studentid)){
                return "Student already exists in database";
            }
            else{
                $sql = "CALL `sp_savestudent`({$studentid},'{$firstname}','{$lastname}',{'$dateofbirth}','{$gradelevel}',{$parentid})";
                $this->getData($sql);
                return "student successfully saved/updated";
            }
        }

        public function deletestudent($studentid){
            $sql = 'CALL `sp_deletestudent`({$studentid})';
            $this->getData($sql);
            return "Student successfully deleted";
        } 
    }

?>