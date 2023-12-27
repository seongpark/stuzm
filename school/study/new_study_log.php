<?php 
    include "../../db.php";

    //날짜 가져오기
    $year = mysqli_real_escape_string($db, $_POST["year"]);
    $month = mysqli_real_escape_string($db, $_POST["month"]);
    $day = mysqli_real_escape_string($db, $_POST["day"]);

    //시간
    $time = mysqli_real_escape_string($db, $_POST["time"]);
    $minit = mysqli_real_escape_string($db, $_POST["minit"]);

    //범위
    $what = mysqli_real_escape_string($db, $_POST["what"]);

    //id 불러오기
    $userid = $_SESSION['userid'];
    
    //db 삽입
    //time = 시
    //hour = 분
    $sql_input = mysqli_query($db, "insert into study_log(userid,time,hour,what,year,month,day) values('".$userid."','".$time."','".$minit."','".$what."','".$year."','".$month."','".$day."')"); 

    //완료 alert
    echo "<script>alert('새 기록 추가가 완료되었어요.');location.href='index.php'</script>";
?>