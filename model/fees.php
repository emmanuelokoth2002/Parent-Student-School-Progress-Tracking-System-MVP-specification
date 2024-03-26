<?php
    require_once('db.php');

    class fees extends db{

        public function getfees(){
            $sql = 'CALL `sp_getnews`()';
            return $this->getJSON($sql);
        }
        public function checkfees($feeid){
            $sql = 'CALL `sp_checkfee`({$feeid})';
            return $this->getJSON($sql);
        }

        public function savefees($feeid,$studentid,$amount,$duedate,$paymentstatus){
            if(!$this->checkfees($feeid)){
                return "Fee payment already exists";
            }
            else{
                $sql = "CALL `sp_savefee`({$feeid},'{$studentid}','{$amount}','{$duedate}','{$paymentstatus}')";
                $this->getData($sql);
                return "Fee payment saved";
            }
        }

        public function deletefee($feeid){
            $sql = 'CALL `sp_deletefee`({$feeid})';
            $this->getData($sql);
            return "Fee successfully deleted";
        }
    }
?>