<?php
    include "../../db.php";

    //비로그인 방지 및 세션 ID 변수 저장
    $_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }else{
    echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
    }

    $sql3 = mq("select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql3->fetch_array()){
        //그룹 생성 감지
        $group_check_info = $member["school"].$member["grade"]."g".$member["room"];
        
        $group_check = mq("select * from class_group where sch='$group_check_info'");
		$group_check = $group_check->fetch_array();
    }
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <link rel="stylesheet" href="style.css">

    <?php include "../../include/header_down_down.php"; ?>

</head>

<!--
<nav class="navbar fixed-top">
    <div class="top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../jiguem_gray.png" alt="Logo" width="100" class="d-inline-block align-text-top">
            </a>
        </div>
    </div>
</nav>
-->

<body>

    <div id="center_card">
        <div id="i_header">
            <div class="back_btn">
                <a href="../../">
                    &#xE000;
                </a>
            </div>
            <div id="i_info">
                성적 관리
            </div>
        </div>
        <div id="b_header_selection" style="margin-top: 10px;" class="d_flex">
            <a class="b_header_none_active" href="../exam">
                <div>내신</div>
            </a>
            <a class="b_header_active">
                <div>모의고사</div>
            </a>
        </div>
        <div id="first_container">

            <div class="dropdown">
                <div data-bs-toggle="dropdown" aria-expanded="false">
                    <h5 style="font-size:18px;"><?php echo date("Y"); ?>년 모의고사 성적</h5>
                </div>
                <ul class="dropdown-menu">
                    <?php
                    $sql_load_year = mq("select year from exam_mogo where userid='{$_SESSION['userid']}'");
                    $unique_years = array();

                    while ($have_year = $sql_load_year->fetch_array()) {
                        $year = $have_year["year"];

                    if (!in_array($year, $unique_years)) {
                        $unique_years[] = $year;
                    ?>
                    <li><a class="dropdown-item"
                            href="mogo_year.php?year=<?php echo $year; ?>"><?php echo $year; ?>년</a>
                    </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <!--3모-->
            <span style="font-size:15px;">3월 모의고사</span>

            <?php  
         $sql_load_1 = mq("select * from exam_mogo where year='".date("Y")."' and month='3월 모의고사' and userid='{$_SESSION['userid']}'"); 
         $have_data_mogo_3 = false;
            while($mogo_3 = $sql_load_1->fetch_array()) { 
                $have_data_mogo_3 = true;?>

            <div class="container mt-2 text-center mb-3">
                <div class="row">
                    <div class="col">
                        <span style="color:gray;font-size:13px;">과목명</span>
                        <br>
                        <?php echo $mogo_3["subject"] ?> <?php echo $mogo_3["detail_subject"] ?>
                    </div>
                    <div class="col">
                        <span style="color:gray;font-size:13px;">점수</span>
                        <br>
                        <?php echo $mogo_3["number"] ?>
                    </div>
                </div>
            </div>

            <?php } ?>
            <?php 
            if($have_data_mogo_3 == false) {
                echo "<br><center style='font-size:13px;'>입력한 성적이 없어요.</center><div class='mb-3'></div>";
            }
            ?>

            <!--6모-->
            <span style="font-size:15px;">6월 모의고사</span>

            <?php  
         $sql_load_2 = mq("select * from exam_mogo where year='".date("Y")."' and month='6월 모의고사' and userid='{$_SESSION['userid']}'"); 
         $have_data_mogo_6 = false;
            while($mogo_6 = $sql_load_2->fetch_array()) { 
                $have_data_mogo_6 = true;?>

            <div class="container mt-2 text-center mb-3">
                <div class="row">
                    <div class="col">
                        <span style="color:gray;font-size:13px;">과목명</span>
                        <br>
                        <?php echo $mogo_6["subject"] ?> <?php echo $mogo_6["detail_subject"] ?>
                    </div>
                    <div class="col">
                        <span style="color:gray;font-size:13px;">점수</span>
                        <br>
                        <?php echo $mogo_6["number"] ?>
                    </div>
                </div>
            </div>

            <?php } ?>
            <?php 
            if($have_data_mogo_6 == false) {
                echo "<br><center style='font-size:13px;'>입력한 성적이 없어요.</center><div class='mb-3'></div>";
            }
            ?>

            <!--6모-->
            <span style="font-size:15px;">9월 모의고사</span>

            <?php  
 $sql_load_3 = mq("select * from exam_mogo where year='".date("Y")."' and month='9월 모의고사' and userid='{$_SESSION['userid']}'"); 
 $have_data_mogo_9 = false;
    while($mogo_9 = $sql_load_3->fetch_array()) { 
        $have_data_mogo_9 = true;?>

            <div class="container mt-2 text-center mb-3">
                <div class="row">
                    <div class="col">
                        <span style="color:gray;font-size:13px;">과목명</span>
                        <br>
                        <?php echo $mogo_9["subject"] ?> <?php echo $mogo_9["detail_subject"] ?>
                    </div>
                    <div class="col">
                        <span style="color:gray;font-size:13px;">점수</span>
                        <br>
                        <?php echo $mogo_9["number"] ?>
                    </div>
                </div>
            </div>

            <?php } ?>
            <?php 
    if($have_data_mogo_9 == false) {
        echo "<br><center style='font-size:13px;'>입력한 성적이 없어요.</center><div class='mb-3'></div>";
    }
    ?>
        </div>


    </div>

    <div class="coin_appl" onclick="location.href='mogo_new.php'">성적 추가</div>
</body>

</html>