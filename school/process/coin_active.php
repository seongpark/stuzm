<?php
    include "../../db.php";

    $bno = mysqli_real_escape_string($db, $_GET["idx"]);
    $date = date('Y-m-d');

    if(isset($_SESSION['userid'])){
        //coin 정보 불러오기
        $sql_coin_load = mysqli_query($db, "select * from group_coin where idx='{$bno}'");
        while($coin_load = $sql_coin_load->fetch_array()) {
            //요청한 코인 갯수 
            $coin = $coin_load["coin"];
            //코인 지급을 요청한 아이디
            $userid = $coin_load["id"];
        }

        $sql_member_load = mysqli_query($db, "select * from member where id='{$userid}'");
        while($member = $sql_member_load->fetch_array()) {


        $sql_member_load_access = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while($member2 = $sql_member_load_access->fetch_array()) {
            $access = $member2["access"];
        }
        
        //선샐님만 제한
        if($access == "teacher") {
            //코인 지급하기
                $coin_member = $member['coin'] + $coin;
                $insert_coin = mysqli_query($db, "update member set coin='$coin_member' where id='".$userid."'"); 

                //승인 처리
                $sql_coin_active = mysqli_query($db, "update group_coin set status='active' where idx='".$bno."'"); 

                $sql_alert_push = mysqli_query($db, "insert into alert(title,content,date,userid,link) values('"."화폐 적립 신청이 승인되었습니다."."','"."$coin 화폐가 적립되었습니다."."','".$date."','".$userid."','"."../school"."')"); 
                $sql_alert = mysqli_query($db, "update member set alert_read='1' where id='".$userid."'"); 

                echo "<script>alert('화폐 지급이 승인되었습니다.');location.href='../teacher';</script>"; 
                
            }else{
            echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
        }
    }
    }else {
    echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
    }
?>