<?php 
    include_once "../db.php" ;

    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }else{
        echo "<script>location.href='../login';</script>"; 
    }

    $filtered_idx = mysqli_real_escape_string($db, $_GET['idx']);
    
    $sql9 = mysqli_query($db, "select * from member where idx='{$filtered_idx}'"); 
    while($member = $sql9->fetch_array())
    {
        $friend_id = $member["id"];
        $friend_email = $member["email"];
        $friend_name = $member["name"];
    }

    $sql11 = mysqli_query($db, "select * from member where id='{$userid}'"); 
    while($member2 = $sql11->fetch_array())
    {
        $myname = $member2["name"];
        $mymail = $member2["email"];
    }


    $date = date('Y-m-d H:i:s');

    if($userid == $friend_id) {
        echo "<script>alert('나와 나는 언제나 영원한 친구입니다.');history.back();</script>"; 
    }else{
        $sql3 = mysqli_query($db, "insert into friend(friend_id,userid) values('".$friend_id."','".$userid."')"); 
        echo "<script>location.href='index.php';</script>"; 

        //알림 보내기
        $sql4 = mysqli_query($db, "insert into alert(title,content,date,userid,link) values('"."새 친구를 맺었습니다."."','"."더 많은 친구를 맺어보세요!"."','".$date."','".$userid."','"."../friend"."')");
        $sql4 = mysqli_query($db, "update member set alert_read='1' where id='".$userid."'");  

        $sql4 = mysqli_query($db, "insert into alert(title,content,date,userid,link) values('"."새 친구를 맺었습니다."."','"."더 많은 친구를 맺어보세요!"."','".$date."','".$friend_id."','"."../friend"."')");
        $sql4 = mysqli_query($db, "update member set alert_read='1' where id='".$userid."'");  

        $to_id=$mymail;
$from_id="noreply_stuzm@naver.com";
$pass="SoCurious2020";
$title="[STUZM] 새 친구를 맺으신 것을 축하합니다!";
$article='<br>
                <span style="font-size:20px;">👭 <b>새 친구를 맺으신 것을 축하드려요 :)</b></span> 
                <p>TIP : 홈에서 다시 친구 불러오기 버튼을 누르면 다른 친구도 볼 수 있어요!</p>
<hr>
                <span style="color:gray;font-size:12px;">해당 메일은 <b>발신 전용</b>으로 회신을 받지 않습니다.
                만약 문의하실 사항이 있다면 <b>전체 메뉴의 문의하기</b>를 사용해 주세요.</span>
';

//푸시 대체 메일
require '../login/member/class.phpmailer.php';
$smtp="smtp.naver.com";	
$mail=new PHPMailer(true);	
$mail->IsSMTP();

try{		
$mail->Host=$smtp;		
$mail->SMTPAuth=true;		
$mail->Port=465;		
$mail->SMTPSecure="ssl";		
$mail->Username=$from_id;		
$mail->Password=$pass;	
$mail->CharSet = "UTF-8";	
$mail->SetFrom($from_id);		
$mail->AddAddress($to_id);		
$mail->Subject=$title;		
$mail->MsgHTML($article);		
$mail->Send();	
	
}	catch (phpmailerException $e){		
echo $e->errorMessage();	
}	catch (Exception $e){		
echo $e->getMessage();	
}


//메일 1트 더
$to_id=$friend_email;
$from_id="noreply_stuzm@naver.com";
$pass="SoCurious2020";
$title="[STUZM] ".$myname."님이 친구 추가를 헀습니다.";
$article='<br>
                <span style="font-size:20px;">👭 <b>새로운 친구가 생기신 것을 축하드려요 :)</b></span> 
                <p>TIP : 홈에서 다시 친구 불러오기 버튼을 누르면 다른 친구도 볼 수 있어요!</p>
<hr>
                <span style="color:gray;font-size:12px;">해당 메일은 <b>발신 전용</b>으로 회신을 받지 않습니다.
                만약 문의하실 사항이 있다면 <b>전체 메뉴의 문의하기</b>를 사용해 주세요.</span>
';

require '../login/member/class.phpmailer.php';
$smtp="smtp.naver.com";	
$mail=new PHPMailer(true);	
$mail->IsSMTP();

try{		
$mail->Host=$smtp;		
$mail->SMTPAuth=true;		
$mail->Port=465;		
$mail->SMTPSecure="ssl";		
$mail->Username=$from_id;		
$mail->Password=$pass;	
$mail->CharSet = "UTF-8";	
$mail->SetFrom($from_id);		
$mail->AddAddress($to_id);		
$mail->Subject=$title;		
$mail->MsgHTML($article);		
$mail->Send();	
	
}	catch (phpmailerException $e){		
echo $e->errorMessage();	
}	catch (Exception $e){		
echo $e->getMessage();	
}

    }
?>
\