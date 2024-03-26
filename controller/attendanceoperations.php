<?php
    require_once('../model/attendance.php');
    $attendance = new attendance();

    if(isset($_POST['getattendance'])){
        echo $attendance->getattendace();
    }
    if(isset($_POST['saveattendance'])){
        $attendanceid = $_POST['$attendanceid'];
        $studentid = $_POST['studentid'];
        $status = $_POST['status'];
        echo $attendance->saveattendance($attendanceid,$studentid,$status);
    }
    if(isset($_POST['checkattendance'])){
        $attendanceid = $_POST['attendanceid'];
        echo $attendance->checkattendace($attendanceid);
    }
    if(isset($_POST['deleteattendance'])){
        $attendanceid = $_POST['attendanceid'];
        echo $attendance->deleteattendance($attendanceid);
    }

?>