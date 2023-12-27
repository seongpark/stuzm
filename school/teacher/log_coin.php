<!DOCTYPE html>
<html lang="ko">

<head>

    <?php 

    include "../../db.php";
    include "../../include/header_down_down.php"; 

    //비로그인 방지 및 세션 ID 변수 저장
    $_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }else{
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../../login/index.php?redirect='.$nowUrl.'"</script>';
    }

    $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql3->fetch_array()){
        //그룹 생성 감지
        $group_check_info = $member["school"].$member["grade"]."g".$member["room"];
        
        $group_check = mysqli_query($db, "select * from class_group where sch='$group_check_info'");
		$group_check = $group_check->fetch_array();
        
		if($group_check >= 1){
            //학생 감지
            if($member["access"] == "user") {
                echo '<script>location.href="../coinpage.php"</script>';
            }
		}else{
            if($member["access"] == "teacher") {
                echo '<script>location.href="../make.php"</script>';
            }else{
                echo '<script>location.href="../index.php"</script>';
            }
		}
    
    ?>
</head>

<body>

    <div id="coin_first_container">
        <div id="center_card">
            <div id="coin_header">
                <div class="back_btn">
                    <a href="index.php">
                        &#xE000;
                    </a>
                </div>
                <div id="coin_info">
                    지급 내역
                </div>

                <?php 
                                $have = "ㄴ";
                        //DB에서 신청자 정보 가져오기
            $sql_group_load = mysqli_query($db, "select * from group_coin where group_divide='{$group_check_info}' and not status='hold' order by idx desc");
            while($group_list_load = $sql_group_load->fetch_array()) {
                $have = "ㅇㅇ";
                
                //신청한 사람의 이름 가져오기
                $sql_coin_name_load = mysqli_query($db, "select * from member where id='{$group_list_load["id"]}'");
                while($coin_name_load = $sql_coin_name_load->fetch_array()) {
                    $name = htmlentities($coin_name_load["name"]);
                }
        ?>

                <div class="standbyitem">
                    <div class="bold">
                        <span><?php echo $name; ?> | </span>
                        <span><?php echo $group_list_load["coin"]; ?>원 |
                            <?php if($group_list_load["status"] == "active") { echo "승인됨"; }else{ echo "거절됨"; }?></span>
                    </div>
                    <div style="margin-top:7px;">
                        <?php echo htmlentities("$group_list_load[reason]"); ?></div>
                </div>

                <?php } 
                
                if($have == "ㄴㄴ") {
                    echo "지급 내역이 없습니다.";
                }?>


            </div>
        </div>
    </div>

</body>

</html>

<?php } ?>