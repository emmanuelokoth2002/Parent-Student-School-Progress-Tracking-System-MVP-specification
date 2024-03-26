<?php
    require_once('db.php');

    class ClassModel extends db{
        public function getclasses(){
            $sql = 'CALL `sp_getclasses`()';
            return $this->getJSON($sql);
        }
        public function checkclass($classid){
            $sql = 'CALL `sp_checkclass`({$slassid})';
            return $this->getJSON($sql);
        }
        public function saveclass($classid,$classname,$teacherid,$schedule,$studentsenrolled){
            if(!$this->checkclass($classid)){
                return "Class already exists";
            }
            else{
                $sql = "CALL `sp_saveclass`({$classid},'{$classname}',{$teacherid},'{$schedule}',{$studentsenrolled})";
                $this->getData($sql);
                return "Class successfully saved";
            }
        }
        public function deleteclass($classid){
            $sql = 'CALL `sp_deleteclass`({$classid})';
            $this->getData($sql);
            return "Class successfully deleted";
        }
    }
?>