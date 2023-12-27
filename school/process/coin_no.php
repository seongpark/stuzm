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
                      $coin_id = $coin_load["id"];
                  }

        $sql_member_load = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while($member = $sql_member_load->fetch_array()) {
        //선샐님만 제한
        if($member["access"] == "teacher") {
            //코인 거절
                $sql_coin_no = mysqli_query($db, "update group_coin set status='no' where idx='".$bno."'"); 

                                //알림 보내기

                                $sql_alert_push = mysqli_query($db, "insert into alert(title,content,date,userid) values('"."화폐 적립 신청이 거절되었습니다."."','"."선생님이 화폐 적립 신청을 거절했습니다."."','".$date."','".$coin_id."')"); 
                                $sql_alert = mysqli_query($db, "update member set alert_read='1' where id='".$coin_id."'"); 

                echo "<script>alert('화폐 지급이 거절되었습니다.');location.href='../teacher';</script>"; 
                
            }else{
            echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
        }
    }
    }else {
    echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
    }
?>