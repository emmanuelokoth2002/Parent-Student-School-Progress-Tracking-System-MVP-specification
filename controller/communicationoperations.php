<?php
    require_once('../model/communication.php');
    $communication = new communication();

    if(isset($_GET['getcommunications'])){
        echo $communication->getcommunications();
    }

    if(isset($_POST['savecommunication'])){
        $messageid = $_POST['messageid'];
        $senderid = $_POST['senderid'];
        $recipientid = $_POST['recipientid'];
        $subject = $_POST['subject'];
        $content = $_POST['content'];
        echo $communication->savecommunication($messageid,$senderid,$recipientid,$subject,$content);
    }
    if(isset($_POST['checkcommunication'])){
        $messageid = $_POST['messageid'];
        echo $communication->checkcommunication($messageid);
    }
    if(isset($_POST['deletecommunication'])){
        $messageid = $_POST['messageid'];
        echo $communication->deletecommunication($messageid);
    }
?>