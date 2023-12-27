<?php 
    include "../../db.php";

    $title = mysqli_real_escape_string($db, $_POST["title"]);
    $price = mysqli_real_escape_string($db, $_POST["price"]);
    $detail = mysqli_real_escape_string($db, $_POST["detail"]);
    
    if(isset($_SESSION['userid'])){
        $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        $member = $sql3->fetch_array();

        $sch = $member['school'];
        $grade = $member['grade'];
        $room = $member["room"];
        $sch = $sch.$grade."g".$room;

        if($member["access"] == "user") {
            echo '<script>location.href="../hold.php"</script>';
        }else{
            $sql_market_input = mysqli_query($db, "insert into group_maket(title,detail,price,group_divide) values('".$title."','".$detail."','".$price."','".$sch."')"); 
            echo "<script>alert('상품 등록이 완료되었습니다.');location.href='../teacher/market.php'</script>"; 
        }
        
    }else{
        echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
    }

    
?>