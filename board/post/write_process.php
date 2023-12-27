<?php
include "../../db.php";

date_default_timezone_set('Asia/Seoul');

if (isset($_SESSION['userid'])) {
    $username = $_SESSION['userid'];

    $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
    while ($member = $sql3->fetch_array()) {
        $nickname = $member['nickname'];
        $mymail = $member['email'];
    }
}

if (isset($_SESSION['userpw'])) {
    $userpw = $_SESSION['userpw'];
}

$title = mysqli_real_escape_string($db, $_POST['title']);
$content = mysqli_real_escape_string($db, $_POST['content']);
@$board = mysqli_real_escape_string($db, $_POST['board']);

$sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
while ($member = $sql3->fetch_array()) {
    $sch = $member['school'];
}

if ($board === "") {
    echo "<script>
    alert('카테고리가 선택되지 않았습니다.');
    history.back();</script>";
} else {
    $date = date('Y-m-d H:i:s');

    if ($board === "mysch") {
        $boardValue = $sch . "b_1";
    } else {
        $boardValue = $board;
    }

    $sql2 = mysqli_query($db, "insert into board(name, pw, title, content, date, board, userid) 
               values('{$nickname}', '{$userpw}', '{$title}', '{$content}', '{$date}', '{$boardValue}', '{$username}')");

    //글 등록 완료 알림 추가
    $sql3 = mysqli_query($db, "insert into alert(title, content, date, userid) 
                values('" . "새 글이 등록되었습니다." . "','" . "글제목 : " . $title . "','" . $date . "','" . $username . "')");
    $sql4 = mysqli_query($db, "update member set alert_read='1' where id='{$username}'");

    echo "<script>
            location.href='../index.php';
          </script>";

    //작성 완료 이메일 발송
    $to_id = $mymail;

    //STUZM 이메일용 네이버 계정
    $from_id = "noreply_stuzm@naver.com";
    $pass = "SoCurious2020";
    $title = "[STUZM] 새로운 글이 작성되었습니다.";
    $article = '<br>
                <span style="font-size:20px;">💬  <b>새로운 글이 작성되었습니다.</b></span> 
                <p>지금 바로 내가 쓴 새 글을 확인해보세요.</p>
                <hr>
                글 제목 : ' . $title . ' <br> ' . $content . '
                <hr>
                <span style="color:gray;font-size:12px;">해당 메일은 <b>발신 전용</b>으로 회신을 받지 않습니다.
                만약 문의하실 사항이 있다면 <b>전체 메뉴의 문의하기</b>를 사용해 주세요.</span>
              ';

    require '../../login/member/class.phpmailer.php';
    $smtp = "smtp.naver.com";
    $mail = new PHPMailer(true);
    $mail->IsSMTP();

    try {
        $mail->Host = $smtp;
        $mail->SMTPAuth = true;
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";
        $mail->Username = $from_id;
        $mail->Password = $pass;
        $mail->CharSet = "UTF-8";
        $mail->SetFrom($from_id);
        $mail->AddAddress($to_id);
        $mail->Subject = $title;
        $mail->MsgHTML($article);
        $mail->Send();
    } catch (phpmailerException $e) {
        echo $e->errorMessage();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>