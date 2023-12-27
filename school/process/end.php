<?php
    include "../../db.php";

    $bno = mysqli_real_escape_string($db, $_GET["idx"]);

    $sql = mysqli_query($db, "delete from market_buy where idx='$bno'");

    echo "<script>alert('사용 완료 처리가 완료되었습니다.');location.href='../teacher/log_market.php'</script>";
?>