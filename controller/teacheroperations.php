<?php
    require_once('../model/teacher.php');
    $teacher = new teacher();

    if(isset($_GET['getteachers'])){
        echo $teacher->getteachers();
    }

    if(isset($_POST['saveteacher'])){
        $teacherid = $_POST['$teacherid'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $address = $_POST['address'];
        echo $teacher->saveteacher($teacherid,$firstname,$lastname,$email,$phonenumber,$addres);
    }

    if(isset($_POST['checkteacher'])){
        $teacherid = $_POST['teacherid'];
        echo $teacher->checkteacher($teacherid);
    }

    if(isset($_POST['deleteteacher'])){
        $teacherid = $_POST['teacherid'];
        echo $teacher->deleteteacher($teacherid);
    }
?>