<?php 
    include "../../db.php";

    $content = mysqli_real_escape_string($db, $_POST["content"]);
    
    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];

        $sql11 = mq("select * from member where id='{$userid}'"); 
        while($member2 = $sql11->fetch_array())
        {
            $mymail = $member2["email"];
        }
    
        $date = date('Y-m-d H:i:s');

        $sql3 = mq("insert into shook(content,date,userid) values('".$content."','".$date."','".$userid."')");
         
        echo "<script>location.href='../shook/list.php';</script>"; 

        $sql4 = mq("insert into alert(title,content,date,userid,link) values('"."숏이 업로드에 성공했습니다."."','"."아주 짧고 간단하게, 숏"."','".$date."','".$userid."','"."../friend/shook"."')");
        $sql4 = mq("update member set alert_read='1' where id='".$userid."'");  


        $to_id=$mymail;
        $from_id="noreply_stuzm@naver.com";
        $pass="SoCurious2020";
        $title="[STUZM] 새로운 숏이 업로드 되었습니다.";
        $article='<br>
                        <span style="font-size:20px;">💬 <b>아주 짧고 간단하게 숏</b></span> 
                        <p>숏이 정상적으로 업로드에 성공했습니다.</p>
        <hr>
                        <span style="color:gray;font-size:12px;">해당 메일은 <b>발신 전용</b>으로 회신을 받지 않습니다.
                        만약 문의하실 사항이 있다면 <b>전체 메뉴의 문의하기</b>를 사용해 주세요.</span>
        ';
        
        //푸시 대체 메일
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
        

    }else{
        echo "<script>location.href='login';</script>"; 
        }
?>