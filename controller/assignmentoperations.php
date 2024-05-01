<?php
    require_once('../model/assignment.php');
    $assignment = new assignment();

    if(isset($_GET['getassignments'])){
        echo $assignment->getassignments();
    }
    if(isset($_POST['saveassignment'])){
        $assignmentid = $_POST['$assignmentid'];
        $classid = $_POST['classid'];
        $title = $_POST['title'];
        $duedate = $_POST['duedate'];
        $description = $_POST['description'];
        echo $assignment->saveassignment($assignmentid,$classid,$title,$duedate,$description);
    }
    if(isset($_POST['checkassignment'])){
        $assignmentid = $_POST['assignmentid'];
        echo $assignment->checkassignment($assignmentid);
    }
    if(isset($_POST['deleteassignment'])){
        $assignmentid = $_POST['assignmentid'];
        echo $assignment->deleteassignment($assignmentid);
    }
?>