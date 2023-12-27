<?php 

date_default_timezone_set('Asia/Seoul');

include "../../db.php";

if(isset($_SESSION['userid'])){
    $username = $_SESSION['userid'];

    $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql3->fetch_array()){
    $nickname = $member['nickname'];
    $mymail = $member['email'];
    }
}
if(isset($_SESSION['userpw'])){
    $userpw = $_SESSION['userpw'];
}

$sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
while($member = $sql3->fetch_array()){

$sch = $member['school'];

}

$title = $_POST['title'];
$title2 = $_POST['title'];
$content = $_POST['content'];
$board = $sch."b_1";

$date = date('Y-m-d H:i:s');

$sql2 = mysqli_query($db, "insert into board_sch(name,pw,title,content,date,board,userid) values('".$nickname."','".$userpw."','".$title."','".$content."','".$date."','".$board."','".$username."')"); 
$sql3 = mysqli_query($db, "insert into alert(title,content,date,userid) values('"."새 글이 등록되었습니다."."','"."글제목 : ".$title."','".$date."','".$username."')"); 
?>
<?php
echo "<script>
alert('글쓰기 완료되었습니다.');
location.href='../index.php';</script>";

$to_id=$mymail;
$from_id="noreply_stuzm@naver.com";
$pass="SoCurious2020";
$title="[STUZM] 새로운 글이 작성되었습니다.";
$article='<br>
                <span style="font-size:20px;">💬  <b>새로운 글이 작성되었습니다.</b></span> 
                <p>지금 바로 내가 쓴 새 글을 확인해보세요.</p>
    <hr>
    글 제목 : '.$title2.' <br> '.$content.'
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