<?php
    require_once('db.php');

    class user extends db{
        public function getusers(){
            $sql = 'CALL `sp_getusers`()';
            return $this->getJSON($sql);
        }

        public function checkuser($userid){
            $sql = 'CALL `sp_checkuser`({$userid})';
            return $this->getJSON($sql);
        }

        public function saveuser($userid,$username,$password,$email,$firstname,$lastname,$role){
            if(!$this->checkuser($userid)){
                return "User exists in database";
            }else{
                $sql = "CALL `sp_saveuser`({$userid},'{$username}','{$password}','{$email}','{$firstname}','{$lastname}','{$role}')";
                $this->getData($sql);
                return "User saved/updated successfully";
        }
    }

        public function deleteuser($userid){
            $sql = "CALL `sp_deleteuser`({$userid})";
            $this->getJSON($sql);
            return "User successfully deleted";
    }
}
?>