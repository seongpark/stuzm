<?php 
    include "../../db.php";

    if(isset($_SESSION['userid'])){ 
	}else{
        echo "<script>alert('비정상적인 접근입니다.');location.href='../../login';</script>";
    }

    $original_idx = mysqli_real_escape_string($db, $_GET["idx"]);
    $content = mysqli_real_escape_string($db, $_POST["content"]);

    $date = date('Y-m-d H:i:s');

    //에스크 질문 등록
    $sql = mysqli_query($db, "insert into ask_answer(original_ask,content,date) values('".$original_idx."','".$content."','".$date."')"); 
    //답변 등록
    $sql_ask_1 = mysqli_query($db, "update ask set answer='1' where idx='".$original_idx."'"); 

    echo '<script>history.back();</script>';
?>