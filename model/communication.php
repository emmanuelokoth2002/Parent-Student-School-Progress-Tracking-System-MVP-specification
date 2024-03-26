<?php
    require_once('db.php');

    class communication extends db{

        public function getcommunications(){
            $sql = 'CALL `sp_getcommunications`()';
            return $this->getJSON($sql);
        }
        public function checkcommunication($messageid){
            $sql = 'CALL `sp_checkcommunication`()';
            return $this->getJSON($sql);
        }
        public function savecommunication($messageid,$senderid,$recipientid,$subject,$content){
            if(!$this->checkcommunication($messageid)){
                return "Communication already exists";
            }
            else{
                $sql = "CALL `sp_savecommunication`({$messageid},{$senderid},{$recipientid},'{$subject}','{$content}')";
                $this->getData($sql);
                return "Message saved successfully";
            }
        }
        public function deletecommunication($messageid){
            $sql = 'CALL `sp_deletecommunication`({messageid})';
            $this->getData($sql);
            return "Message deleted successfully";
        }
    }
?>