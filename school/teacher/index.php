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


    <link rel="stylesheet" href="../assets/style.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
    $(input).on('keydown', function(e) {
        $(input).attr('size', $(input).val().length);
    });
    </script>
</head>

<!--
<nav class="navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="jiguem_gray.png" alt="Logo" height="24" class="d-inline-block align-text-top">
        </a>
    </div>
</nav>
-->

<body>
    <div id="coin_first_container">
        <div id="center_card">
            <div id="coin_header">
                <div class="back_btn">
                    <a href="../../">
                        &#xE000;
                    </a>
                </div>
                <div id="coin_info">
                    우리반 화폐 관리
                </div>
            </div>

            <div id="center_card">
                <div id="header_selection" style="margin-top: 10px;" class="d_flex">
                    <a class="header_active">
                        <div>우리반 화폐</div>
                    </a>
                    <a class="header_none_active" href="market.php">
                        <div>마켓</div>
                    </a>
                </div>
                <div id="container">

                    <!-- 화폐 표시 부분 시작 !
                    <?php if($group_check >= 1){ ?>
                    <div>
                        <div class="d_flex space_between coin_total">
                            <div class="va_m_m">
                                <i class="fa-solid fa-coins va_m total_icon"></i>
                            </div>
                            <div class="va_m">
                                <span>
                                    <?php echo $my_coin ; ?>원
                                </span>
                            </div>
                        </div>
                    </div>

                    <?php } ?>
-->
                    <div>
                        <h2>대기중</h2>
                        <div id="standby">

                            <?php 
                                $have = "ㄴ";
                        //DB에서 신청자 정보 가져오기
            $sql_group_load = mysqli_query($db, "select * from group_coin where group_divide='{$group_check_info}' and status='hold' order by idx desc");
            while($group_list_load = $sql_group_load->fetch_array()) {
                $have = "ㅇㅇ";
                
                //신청한 사람의 이름 가져오기
                $sql_coin_name_load = mysqli_query($db, "select * from member where id='{$group_list_load["id"]}'");
                while($coin_name_load = $sql_coin_name_load->fetch_array()) {
                    $name = $coin_name_load["name"];
                }
        ?>


                            <div class="standbyitem">
                                <div class="bold">
                                    <span><?php echo $name; ?> | </span>
                                    <span><?php echo $group_list_load["coin"]; ?>원</span>
                                </div>
                                <div style="margin-top:7px;">
                                    <?php echo htmlentities("$group_list_load[reason]"); ?></div>
                                <div class="d_flex coin_btn">
                                    <div class="accept"
                                        onclick="location.href='../process/coin_active.php?idx=<?php echo $group_list_load['idx'];?>'">
                                        허락</div>
                                    <div class="deny"
                                        onclick="location.href='../process/coin_no.php?idx=<?php echo $group_list_load['idx'];?>'">
                                        거부
                                    </div>
                                </div>
                            </div>



                            <?php } ?>
                            <center class="proper_margin">
                                <?php if($have == "ㄴ") { echo "현재 대기중인 인원이 없습니다."; } ?>
                            </center>
                        </div>
                    </div>

                    <div class="coin_appl" onclick="location.href='log_coin.php'">지급 내역</div>

                    <center class="proper_margin">
                        <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-Ei3wetzpHkXPILTR"
                            data-ad-width="320" data-ad-height="100"></ins>
                        <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
                    </center>
                </div>
                <div style="height: 100px;"></div>
                <script src="../modal.js"></script>
            </div>
        </div>
    </div>
</body>

</html>
<?php } ?>