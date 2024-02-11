<?php
    require_once ('../model/user.php');
    $user = new user();

    if(isset($_GET['getusers'])){
        echo $user->getusers();
    }

    if(isset($_POST['saveuser'])){
        $userid = $_POST['userid'];
        $$username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $role = $_POST['role'];
        echo $user -> saveuser($userid,$username,$password,$email,$firstname,$lastname,$role);
    }

?>