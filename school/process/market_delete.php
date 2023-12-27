<?php 
    include "../../db.php";

    if(isset($_SESSION['userid'])){

        $sql_member_load = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while($member = $sql_member_load->fetch_array()) {
        //선샐님만 제한
        if($member["access"] == "teacher") {
    $bno = mysqli_real_escape_string($db, $_GET["idx"]);

    $sql = mysqli_query($db, "delete from group_maket where idx='$bno';");

    echo "<script>alert('상품이 삭제되었습니다.');location.href='../teacher/market.php';</script>"; 
        }
    }

    }else{
        echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
    }
?>