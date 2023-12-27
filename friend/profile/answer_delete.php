<?php
    include "../../db.php";

    if(isset($_SESSION['userid'])){
	}else{
        echo "<script>alert('비정상적인 접근입니다.');location.href='../../login';</script>";
    }

    $bno = mysqli_real_escape_string($db, $_GET["idx"]);
    $profile_link = mysqli_real_escape_string($db, $_GET["profile"]);
    $original_idx = mysqli_real_escape_string($db, $_GET["original"]);
    
    $sql = mysqli_query($db, "delete from ask_answer where idx='$bno'");

    $sql_ask_1 = mysqli_query($db, "update ask set answer='0' where idx='".$original_idx."'");
    echo "<script>alert({$bno})</script>";
    
?>