<?php
    include "../../db.php";

    //비로그인 방지 및 세션 ID 변수 저장
    $_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

$get_year = mysqli_real_escape_string($db, $_GET["year"]);

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
<html>

<head>
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

    <div class="top">
        <div class="container">
            <a href="../" class="link">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
    </div>
    <div class="container">
        <h3>성적 관리</h3>
        <ul class="nav nav-underline nav-justified mb-4" style="margin-top: 16px;">
            <li class="nav-item">
                <a class="nav-link black" aria-current="page" href="index.php">내신</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="mogo.php">모의고사</a>
            </li>
        </ul>

        <div class="dropdown">
            <div data-bs-toggle="dropdown" aria-expanded="false">
                <h5 style="font-size:18px;"><?php echo $get_year; ?>년 모의고사 성적 <a href="" class="black"><i
                            class="fa-solid fa-angle-right"></i></a></h5>
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
                <li><a class="dropdown-item" href="mogo_year.php?year=<?php echo $year; ?>"><?php echo $year; ?>년</a>
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
         $sql_load_1 = mq("select * from exam_mogo where year='".$get_year."' and month='3월 모의고사' and userid='{$_SESSION['userid']}'"); 
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
         $sql_load_2 = mq("select * from exam_mogo where year='".$get_year."' and month='6월 모의고사' and userid='{$_SESSION['userid']}'"); 
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
 $sql_load_3 = mq("select * from exam_mogo where year='".$get_year."' and month='9월 모의고사' and userid='{$_SESSION['userid']}'"); 
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
    <div style="height: 100px;"></div>
    <div class="fixed-bottom">
        <a href="mogo_new.php" class="btn btn-primary btn-lg fix" type="button">모의고사 성적 추가하기</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="todo.js"></script>
</body>

</html>