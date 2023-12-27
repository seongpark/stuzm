<?php 
    include "db.php";
    
    //일정 제목
    $title = mysqli_real_escape_string($db, $_POST['title']);

    //일정 상세
    $detail = mysqli_real_escape_string($db, $_POST['detail']);

    //날짜
    $date = mysqli_real_escape_string($db, $_POST['date']);
        
    //교시
    $time = mysqli_real_escape_string($db, $_POST['period']);

    //학교,반 구분
    $sql2 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql2->fetch_array()){

    $sch = $member['school'].$member['grade']."g".$member['room'];

    }

    $sql3 = mysqli_query($db, "insert into sch_cal(title,detail,date,time,sch) values('".$title."','".$detail."','".$date."','".$time."','".$sch."')"); 

    echo "<script>alert('일정이 추가되었습니다.');location.href='index.php'</script>";

?>