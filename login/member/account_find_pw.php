<?php 
ini_set('display_errors', '1');
    include "../../db.php";
    $email = mysqli_real_escape_string($db, $_POST["email"]);

    function getRandStr($length = 6) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

 	$code =	getRandStr(8);
    
    $member = mysqli_query($db, "select * from member where email='{$email}'");
    $member = $member->fetch_array();   

    if($member >= 1){
        $userid = $member["id"];

        $sql2 = mysqli_query($db, "insert into pw_code(code,userid) values('".$code."','".$userid."')");   
    
        $content = '<h2>비밀번호 찾기를 요청하셨나요?</h2><p>아래 링크로 비밀번호를 변경하실 수 있습니다.</p><br><p><a href="https://stuzm.kro.kr/login/member/mail_pw_change.php?code='.$code.'">비밀번호 변경</a></p><br>수동 입력 : https://stuzm.kro.kr/login/member/mail_pw_change.php?code='.$code.'<br>(만약 비밀번호 찾기를 요청하시지 않았다면 누군가 이메일을 잘못 입력했을지도 모릅니다. 그러니 이 이메일을 무시하여 주세요.)';
    
        //STMP 메일 발송
    
        require_once("class.phpmailer.php");
    
        $to_id=$email;
    $from_id="noreply_stuzm@naver.com";
    $pass="SoCurious2020";
    $title="[STUZM] 비밀번호 변경을 요청하셨나요?";
    $article=$content;
    
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
    
    echo '<script>alert("비밀번호 변경 이메일이 발송되었습니다.");history.back();</script>';
    }else {
        echo '<script>alert("존재하지 않는 계정입니다. 만약 가입 시 이메일을 잘못 입력하셨다면 contact@stuzm.com으로 문의주신다면 도와드리겠습니다.");history.back();</script>';
;    }

   
?>