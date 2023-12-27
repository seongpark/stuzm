<?php 
    include_once "../../db.php";

    $name = mysqli_real_escape_string($db, $_POST["name"]);

    if(isset($_SESSION['userid'])){
        $username = $_SESSION['userid'];
        
        $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while($member = $sql3->fetch_array()){
    
        //학생 User 차단
        $sch = $member['school'];
        $grade = $member['grade'];
        $room = $member["room"];
        $id = $member['id'];

        $sch = $sch.$grade."g".$room;

        $date = date('Y-m-d H:i:s');

        if($member["access"] == "user") {
            echo '<script>location.href="../hold.php"</script>';
        }else{
            $sql_class_input = mysqli_query($db, "insert into class_group(sch,teacher,name) values('".$sch."','".$username."','".$name."')"); 
            
            //알림 발송
            $sql_alert_push = mysqli_query($db, "insert into alert(title,content,date,userid) values('"."새 그룹이 생성되었어요."."','"."학생들이 자동으로 초대됩니다."."','".$date."','".$username."')"); 
            $sql_alert = mysqli_query($db, "update member set alert_read='1' where id='".$username."'"); 

            echo "<script>alert('그룹 생성이 완료되었습니다.');location.href='../coinpage.php'</script>"; 
        }
    }
        
    }else{
        echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
        }
?>