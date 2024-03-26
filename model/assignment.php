<?php
    require_once('db.php');

    class assignment extends db{
        public function getassignments(){
            $sql = 'CALL `sp_getassignments`()';
            return $this->getJSON($sql);
        }
        public function checkassignment($assignmentid){
            $sql = 'CALL `sp_checkassignment`({$assignmentid})';
            return $this->getJSON($sql);
        }
        public function saveassignment($assignmentid,$classid,$title,$duedate,$description){
            if(!$this->checkassignment($assignmentid)){
                return "Assignment exists";
            }
            else{
                $sql = "CALL `sp_saveassignment`({$assignmentid},{$classid},'{$title}','{$duedate}','{$description}')";
                $this->getData($sql);
                return "Assignment successfully saved";
            }
        }
        public function deleteassignment($assignmentid){
            $sql = 'CALL `sp_deleteassignment`({$assignmentid})';
            $this->getData($sql);
            return "Assignment successfully saved";
        }
    }
?>