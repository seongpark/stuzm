<?php 
    include "../../db.php";

    $bno = mysqli_real_escape_string($db, $_GET["idx"]);

    //알림에서 사용
    $date = date('Y-m-d');

    //상품 정보 불러오기
    $sql_market_load = mysqli_query($db, "select * from group_maket where idx='{$bno}'");
    while($market = $sql_market_load->fetch_array()) {

        //상품 금액 불러오기
        $price = $market["price"];
    }

    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];

        //SQL 멤버 불러오기
        $sql_member = mysqli_query($db, "select * from member where id='{$userid}'");
        while($member = $sql_member->fetch_array()) {

            //학교 정보 가공
            $sch = $member["school"].$member["grade"]."g".$member["room"];
            
            //현재 내 잔액 불러오기
            $member_price = $member["coin"];

            //구매 프로세스
            if($member_price < $price) {
                echo "<script>alert('잔액이 부족합니다!');history.back();</script>";
            }else{
                //멤버 화폐 구매 처리
                $my_coin = $member_price - $price;
                $buy_price = mysqli_query($db, "update member set coin='$my_coin' where id='".$userid."'"); 

                //구매 기록 남기기
                $sql_buy_log = mysqli_query($db, "insert into market_buy(market_idx,buyer,use_coin,sch) values('".$bno."','".$userid."','".$price."','".$sch."')"); 

                //구매 완료 알림 발송
                $sql_alert_push = mysqli_query($db, "insert into alert(title,content,date,userid) values('"."상품 구매가 완료되었습니다."."','"."쓴 화폐 금액 : ".$price."','".$date."','".$userid."')"); 
                $sql_alert = mysqli_query($db, "update member set alert_read='1' where id='".$userid."'"); 

                echo "<script>alert('구매가 완료되었습니다.');history.back();</script>";
            }
            
        }
    }
?>