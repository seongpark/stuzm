<?php 
    include_once "../../db.php";

    //get로 정보 불러오기
    $bno = mysqli_real_escape_string($db, $_GET["idx"]);
    $title = mysqli_real_escape_string($db, $_POST["title"]);
    $detail = mysqli_real_escape_string($db, $_POST["detail"]);
    $price = mysqli_real_escape_string($db, $_POST["price"]);

    //정보 update
    $sql = mysqli_query($db, "update group_maket set title='".$title."',detail='".$detail."',price='".$price."' where idx='".$bno."'"); 

    echo '<script>location.href="../teacher/market.php"</script>';