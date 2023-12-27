<?php 
    include "../../../db.php";

    $id = $_COOKIE['userid'];

    $year = mysqli_real_escape_string($db, $_POST['year']);
    
    $sequence = mysqli_real_escape_string($db, $_POST['sequence']);
    $subject = mysqli_real_escape_string($db, $_POST['subject']);
    $number = mysqli_real_escape_string($db, $_POST['number']);
    $detail_subject = mysqli_real_escape_string($db, $_POST['detail_subject']);
    if($detail_subject == "") {
        $detail_subject_com = "";
    }else{
        $detail_subject_com = "(".$detail_subject.")";
    }
   
    
    $sql = mq("insert into exam(userid,year,sequence,subject,detail_subject,number) values('".$id."','".$year."','".$sequence."','".$subject."','".$detail_subject_com."','".$number."')"); 
    
    echo "<script>
    location.href='../';</script>";
    
?>