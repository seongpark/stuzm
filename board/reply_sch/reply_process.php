<?php
	include "../../db.php";

    date_default_timezone_set('Asia/Seoul');

    $bno = mysqli_real_escape_string($db, $_GET['idx']);
    $date = date('Y-m-d H:i:s');
    $writer = mysqli_real_escape_string($db, $_GET['writer']);
    $title = mysqli_real_escape_string($db, $_GET['title']);

    if(isset($_SESSION['userid'])){
        $username = $_SESSION['userid'];

        $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while($member = $sql3->fetch_array()){
        $nickname = $member['nickname'];
        $sch = $member['school'];
        }
    }
    if(isset($_SESSION['userpw'])){
        $userpw = $_SESSION['userpw'];
    }
    
    $sql_load_mail = mysqli_query($db, "select * from member where id='{$writer}'");
    while($member2 = $sql_load_mail->fetch_array()){
    $writer_mail = $member2['email'];
    }

    $sql = mysqli_query($db, "insert into reply_sch(con_num,name,pw,content,date,userid) values('".$bno.$sch."','".$nickname."','".$userpw."','".$_POST['content']."','".$date."','".$username."')");
    $sql3 = mysqli_query($db, "insert into alert(title,content,date,userid,link) values('"."내 글에 댓글이 달렸습니다."."','"."글제목 : ".$title."','".$date."','".$writer."','".$link."')"); 
    $sql4 = mysqli_query($db, "update member set alert_read='1' where id='".$writer."'"); 

    
$to_id=$writer_mail;
$from_id="noreply_stuzm@naver.com";
$pass="SoCurious2020";
$title="[STUZM] 내 글에 새로운 댓글이 달렸습니다.";
$article="글 제목 : ".$title1."<br>댓글 내용 : ".$_POST['content']."<br>이 주소는 회신을 받지 않습니다.";

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


    echo "<script>location.href='../read.php?idx=$bno&sch=1';</script>";
	
?>