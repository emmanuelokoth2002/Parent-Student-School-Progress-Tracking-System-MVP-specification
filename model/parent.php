<?php
    require_once('db.php');

    class parentModel extends db{
        public function getparents(){
            $sql = 'CALL `sp_getparents`()';
            return $this->getJSON($sql);
        }
        public function checkparent($parentid){
            $sql = 'CALL `sp_checkparent`({$parentid})';
            return $this->getJSON($sql);
        }

        public function saveparent($parentid,$firstname,$lastname,$email,$phonenumber,$address){
            if(!$this->checkparent($parentid)){
                return "Parent already exists";
            }
            else{
                $sql = "CALL `sp_saveparent`({$parentid},'{$firstname}','{$lastname}','{$email}','{$phonenumber}','{$address}')";
                $this->getData($sql);
                return "Parent successfully saved";
            }
        }

        public function deleteparent($parentid){
            $sql = 'CALL `sp_deleteparent`({$parentid})';
            $this->getData($sql);
            return "Student successfully saved";
        }
    }    

?>