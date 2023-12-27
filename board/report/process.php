<?php 
    include '../../db.php';

    $reason = mysqli_real_escape_string($db, $_POST["reason"]);
    $bno = mysqli_real_escape_string($db, $_GET["idx"]);
    
    $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql3->fetch_array()){
    $writer_mail = $member['email'];
    }
    $sql2 = mysqli_query($db, "insert into report(post_idx,reason) values('".$bno."','".$reason."')"); 
    date_default_timezone_set('Asia/Seoul');
    echo "<script>
alert('신고가 접수되었습니다.');
location.href='../read.php?idx=".$bno."';</script>";
$date = date('Y-m-d H:i:s');
$sql4 = mysqli_query($db, "update member set alert_read='1' where id='".$_SESSION['userid']."'"); 
$sql3 = mysqli_query($db, "insert into alert(title,content,date,userid) values('"."신고가 접수되었습니다."."','"."검토 후 24시간 이내 처리됩니다.".""."','".$date."','".$_SESSION['userid']."')");

$to_id=$writer_mail;
$from_id="noreply_stuzm@naver.com";
$pass="SoCurious2020";
$title="[STUZM] 신고가 접수되었습니다.";
$article='<br>
                <span style="font-size:20px;">💬  <b>신고가 접수되었습니다.</b></span> 
                <p>검토 후 24시간 이내 처리됩니다.</p>

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


echo "메일이 발송되었습니다";

	
?>