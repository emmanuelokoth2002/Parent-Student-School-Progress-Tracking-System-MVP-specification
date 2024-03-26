<?php
    require_once('../model/parent.php');
    $parent = new parentModel();

    if(isset($_GET['getparents'])){
        echo $parent->getparents();
    }

    if(isset($_POST['saveparent'])){
        $parentid = $_POST['parentid'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $address = $_POST['address'];
        echo $parent->saveparent($parentid,$firstname,$lastname,$email,$phonenumber,$address);
    }

    if(isset($_POST['checkparent'])){
        $parentid = $_POST['parentid'];
        echo $parent->checkparent($parentid);
    }

    if(isset($_POST['deleteparent'])){
        $parentid = $_POST['parentid'];
        echo $parent->deleteparent($parentid);
    }
?>