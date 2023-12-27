<?php 
    include_once "../../db.php";

    $coin = $_POST["number"];
    $reason = $_POST["reason"];
    $date = date('Y-m-d');
    
    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];

        $sql_member_load = mysqli_query($db, "select * from member where id='".$userid."'");
        
        while($member = $sql_member_load->fetch_array()) {
            $sch = $member["school"].$member["grade"]."g".$member["room"];
        }

        $input_sql_coin = mysqli_query($db, "insert into group_coin(id,coin,reason,group_divide,date,status) values('".$userid."','".$coin."','".$reason."','".$sch."','".$date."','hold')"); 
    
        $sql_alert_push = mysqli_query($db, "insert into alert(title,content,date,userid) values('"."화폐 적립 신청이 완료되었습니다."."','"."선생님이 승인을 한다면 화폐가 적랍됩니다."."','".$date."','".$userid."')"); 
        $sql_alert = mysqli_query($db, "update member set alert_read='1' where id='".$userid."'"); 

        echo "<script>alert('화폐 적립 신청이 완료되었습니다.');location.href='../coinpage.php'</script>"; 
    }else{
        echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
    }
?>