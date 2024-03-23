<?php

require_once('db.php');

class teacher extends db{

    public function getteachers(){
        $sql = 'CALL `sp_getteachers`()';
        return $this->getJSON($sql);
    }

    public function checkteacher($teacherid){
        $sql = 'CALL `sp_checkteacher`({teacherid})';
        return $this->getJSON($sql);
    }

    public function saveteacher($teacherid,$firstname,$lastname,$email,$phonenumber,$addres){
        if(!$this->checkteacher($teacherid)){
            return "Teacher already exists in the database";
        }
        else{
            $sql = "CALL `sp_saveteacher`({$teacherid},'{$firstname}','{$lastname}','{$email}','{$phonenumber}','{$addres}')";
            $this->getData($sql);
            return "Teacher saved/updated successfully";
        }
    }

    public function deleteteacher($teacherid){
        $sql = 'CALL `sp_deleteteacher`({$teacherid})';
        $this->getJSON($sql);
        return "Teacher Successfully deleted";
    }
}
?>