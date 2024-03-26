<?php
    require_once('../model/news.php');
    $news = new news();

    if(isset($_GET['getnews'])){
        echo $news->getnews();
    }

    if(isset($_POST['savenews'])){
        $newsid = $_POST['newsid'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        echo $news->savenews($newsid,$title,$content);
    }

    if(isset($_POST['deletenews'])){
        $newsid = $_POST['newsid'];
        echo $news->deletenews($newsid);
    }
    if(isset($_POST['checknews'])){
        $newsid = $_POST['newsid'];
        echo $news->checknews($newsid);
    }
?>