<?php
    require_once('db.php');

    class news extends db{
        public function getnews(){
            $sql = 'CALL `sp_getnews`()';
            return $this->getJSON($sql);
        }

        public function checknews($newsid){
            $sql = 'CALL `sp_checknews`({$newsid})';
            return $this->getJSON($sql);
        }

        public function savenews($newsid,$title,$content){
            if(!$this->checknews($newsid)){
                return "News already exists";
            }

            else{
                $sql = "CALL `sp_savenews`({$newsid},'{$title}','{$content}')";
                $this->getData($sql);
                return "News successfully saved";
            }
        }

        public function deletenews($newsid){
            $sql = 'CALL `sp_deletenews`({newsid})';
            $this->getData($sql);
            return "news successfully deleted";
        }
    }
?>