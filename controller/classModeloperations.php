<?php
    require_once('../model/classModel.php');
    $classModel = new classModel();

    if(isset($_GET['getclasses'])){
        echo $classModel->getclasses();
    }
    if(isset($_POST['saveclass'])){
        $classid = $_POST['classid'];
        $classname = $_POST['classname'];
        $teacherid = $_POST['teacherid'];
        $schedule = $_POST['schedule'];
        $studentsenrolled = $_POST['studentsenrolled'];
        echo $classModel->saveclass($classid,$classname,$teacherid,$schedule,$studentsenrolled);
    }
    if(isset($_POST['checkclass'])){
        $classid = $_POST['classid'];
        echo $classModel->checkclass($classid);
    }
    if(isset($_POST['deleteclass'])){
        $classid =$_POST['classid'];
        echo $classModel->deleteclass($classid);
    }
?>