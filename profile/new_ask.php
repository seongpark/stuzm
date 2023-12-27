<?php 
    include "../../db.php";

    if(isset($_SESSION['userid'])){ 
        $writer_id = $_SESSION['userid'];
	}else{
        echo "<script>alert('비정상적인 접근입니다.');location.href='../../login';</script>";
    }

    $bno = mysqli_real_escape_string($db, $_GET["member"]);
    
    $sql_load_member = mysqli_query($db, "select * from member where idx='{$bno}'");
    while($member = $sql_load_member->fetch_array()) {
        $send_id = $member["id"];
        $send_idx = $member["idx"];
    }
    
    $content = mysqli_real_escape_string($db, $_POST["content"]);
    if($_POST["name"] == "") {
        $name = "익명";
    }else{
        $name = mysqli_real_escape_string($db, $_POST["name"]);
    }

    $date = date('Y-m-d H:i:s');

    $link = "../friend/profile/index.php?idx".$send_idx;

    //에스크 질문 등록
    $sql = mysqli_query($db, "insert into ask(name,content,date,userid,send_id,answer) values('".$name."','".$content."','".$date."','".$writer_id."','".$send_id."',0)"); 

    //에스크 받는 사람에게 새 알림 전송
    $sql_alert = mysqli_query($db, "insert into alert(title,content,date,userid,link) values('"."새 에스크가 등록되었습니다."."','"."지금 바로 확인해보세요!"."','".$date."','".$send_id."','".$link."')"); 
    
    $sql_load_mail = mysqli_query($db, "select * from member where id='{$send_id}'");
    while($member2 = $sql_load_mail->fetch_array()){
    $writer_mail = $member2['email'];
    }
    
    $to_id=$writer_mail;
    $from_id="noreply_stuzm@naver.com";
    $pass="SoCurious2020";
    $title="[STUZM] 새로운 글이 작성되었습니다.";
    $article='<br>
                    <span style="font-size:20px;">💬  <b>내 프로필에 새로운 에스크가 등록되었습니다.</b></span> 
                    <p>바로 확인해보세요!</p>
        <hr>
           '.$content.'
    <hr>
                    <span style="color:gray;font-size:12px;">해당 메일은 <b>발신 전용</b>으로 회신을 받지 않습니다.
                    만약 문의하실 사항이 있다면 <b>전체 메뉴의 문의하기</b>를 사용해 주세요.</span>
    ';

require '../../login/member/class.phpmailer.php';
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


    //새 알림 등록
    $sql_alert_new = mysqli_query($db, "update member set alert_read='1' where id='".$send_id."'"); 

    echo '<script>location.href="index.php?idx='.$send_idx.'";</script>';
?>