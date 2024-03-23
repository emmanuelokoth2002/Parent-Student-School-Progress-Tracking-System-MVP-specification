<?php
    require_once('../model/student.php');
    $student = new student();

    if(isset($_GET['getstudents'])){
        echo $student->getstudents();
    }

    if(isset($_POST['savestudent'])){
        $studentid = $_POST['studentid'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $dateofbirth = $_POST['dateofbirth'];
        $gradelevel = $_POST['gradelevel'];
        $parentid = $_POST['parentid'];
        echo $student->savestudent($studentid,$firstname,$lastname,$dateofbirth,$gradelevel,$parentid);
    }

    if(isset($_POST['checkstudent'])){
        $studentid = $_POST['studentid'];
        echo $student->checkstudent($studentid);
    }

    if(isset($_POST['deletestudent'])){
        $studentid = $_POST['studentid'];
        echo $student->deletestudent($studentid);
    }

?>