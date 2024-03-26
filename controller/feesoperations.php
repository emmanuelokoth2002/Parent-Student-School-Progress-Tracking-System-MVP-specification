<?php
    require_once('../model/fees.php');
    $fees = new fees();

    if(isset($_GET['getfees'])){
        echo $fees->getfees();
    }
    if(isset($_POST['savefees'])){
        $feeid = $_POST['feeid'];
        $studentid = $_POST['studentid'];
        $amount = $_POST['amount'];
        $duedate = $_POST['duedate'];
        $paymentstatus = $_POST['paymentstatus'];
        echo $fees->savefees($feeid,$studentid,$amount,$duedate,$paymentstatus);
    }
    if(isset($_POST['checkfee'])){
        $feeid = $_POST['feeid'];
        echo $fees->checkfees($feeid);
    }
    if(isset($_POST['deletefee'])){
        $feeid = $_POST['feeid'];
        echo $fees->deletefee($feeid);
    }
?>