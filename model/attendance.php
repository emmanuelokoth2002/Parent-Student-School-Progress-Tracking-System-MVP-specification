<?php
    require_once('db.php');

    class attendance extends db{
        public function getattendace(){
            $sql = 'CALL `sp_getattendance`()';
            return $this->getJSON($sql);
        }
        public function checkattendace($attendanceid){
            $sql = 'CALL `sp_checkattendance`({$attendanceid})';
            return $this->getJSON($sql);
        }
        public function saveattendance($attendanceid,$studentid,$status){
            if(!$this->checkattendace($attendanceid)){
                return "Attendance already exists";
            }
            else{
                $sql = "CALL `sp_saveattendance`({$attendanceid},{$studentid},'{$status}')";
                $this->getData($sql);
                return "Attendance saved successfully";
            }
        }
        public function deleteattendance($attendanceid){
            $sql = "CALL `sp_deleteattendance`({$attendanceid})";
            $this->getData($sql);
            return "Attendance successfully deleted";
        }
    }
?>