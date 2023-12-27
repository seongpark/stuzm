<?php
    include "../../db.php";

    //비로그인 방지 및 세션 ID 변수 저장
    $_SESSION["userid"] = $_COOKIE['userid'];
    $_SESSION["userpw"] = $_COOKIE['userpw'];

    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }
    else{
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../../login/index.php?redirect='.$nowUrl.'"</script>';
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, 
    user-scalable=0" />
    <title>STUZM</title>
    <link rel="stylesheet" href="../../style.css?ver=5">
    <link rel="stylesheet" href="../assets/style.css?ver=5">
    <link rel="shortcut icon" href="../../favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php       
        $sql3 = mq("select * from member where id='{$_SESSION['userid']}'");
        while($member = $sql3->fetch_array()){
            if($member["status"] == "hold") {
                echo'<script>alert("학생 인증을 해주세요.");location.href="auth"</script>';
            }
        }
        ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T9BERKPGHP"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-T9BERKPGHP');
    </script>

</head>
<div class="top">
    <div class="container">
        <a href="../" class="link">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
    </div>
</div>

<div class="container">
    <h3>공부 기록</h3>


    <div class="dropdown">
        <div data-bs-toggle="dropdown" aria-expanded="false">
            <h5 style="font-size:18px;"><?php echo date("Y"); ?>년 <a href="" class="black"><i
                        class="fa-solid fa-angle-right"></i></a></h5>
        </div>
        <ul class="dropdown-menu">
            <?php
                    $sql_load_year = mq("select year from study_log where userid='{$_SESSION['userid']}'");
                    $unique_years = array();

                    while ($have_year = $sql_load_year->fetch_array()) {
                        $year = $have_year["year"];

                    if (!in_array($year, $unique_years)) {
                        $unique_years[] = $year;
                    ?>
            <li><a class="dropdown-item" href="daily.php?year=<?php echo $year; ?>&month=1"><?php echo $year; ?>년</a>
                <?php
                        }
                    }
                    ?>
        </ul>
    </div>

    <div class="scroll-list nav nav-underline mb-4">
        <div class="nav-item">
            <a class="nav-link black" aria-current="page" href="daily.php?year=<?php echo date("Y"); ?>&month=1">1월</a>
        </div>
        <div class=" nav-item">
            <a class="nav-link black" aria-current="page" href="daily.php?year=<?php echo  date("Y"); ?>&month=2">2월</a>
        </div>
        <div class="nav-item">
            <a class="nav-link black" aria-current="page"
                href="daily.php?year=<?php echo  date("Y");; ?>&month=3">3월</a>
        </div>
        <div class="nav-item">
            <a class="nav-link black" aria-current="page"
                href="daily.php?year=<?php echo  date("Y");; ?>&month=4">4월</a>
        </div>
        <div class="nav-item">
            <a class="nav-link black" aria-current="page"
                href="daily.php?year=<?php echo  date("Y");; ?>&month=5">5월</a>
        </div>
        <div class="nav-item">
            <a class="nav-link black" aria-current="page"
                href="daily.php?year=<?php echo  date("Y");; ?>&month=6">6월</a>
        </div>
        <div class="nav-item">
            <a class="nav-link black" aria-current="page"
                href="daily.php?year=<?php echo  date("Y");; ?>&month=7">7월</a>
        </div>
        <div class="nav-item">
            <a class="nav-link black" aria-current="page"
                href="daily.php?year=<?php echo date("Y");; ?>>&month=8">8월</a>
        </div>
        <div class="nav-item">
            <a class="nav-link black" aria-current="page" href="daily.php?year=<?php echo date("Y");; ?>&month=9">9월</a>
        </div>
        <div class="nav-item">
            <a class="nav-link black" aria-current="page"
                href="daily.php?year=<?php echo  date("Y");; ?>&month=10">10월</a>
        </div>
        <div class=" nav-item">
            <a class="nav-link black" aria-current="page"
                href="daily.php?year=<?php echo  date("Y");; ?>&month=11">11월</a>
        </div>
        <div class=" nav-item">
            <a class="nav-link black" aria-current="page"
                href="daily.php?year=<?php echo  date("Y");; ?>&month=12">12월</a>
        </div>
    </div>

    <span style="font-size:15px;">오늘의 공부(<?php echo date("Y-m-d"); ?>)</span>

    <?php  $sql_load_1 = mq("select * from study_log where year='".date("Y")."' and month='".date("m")."' and day='".date("d")."' and userid='{$_SESSION['userid']}'"); 
 $today_log_have = false;
    while($today_log = $sql_load_1->fetch_array()) { 
        $today_log_have = true;?>

    <div class="container mt-2 text-center mb-3">
        <div class="row">
            <div class="col">
                <span style="color:gray;font-size:13px;">공부 한 것</span>
                <br>
                <?php echo $today_log["what"] ?>
            </div>
            <div class="col">
                <span style="color:gray;font-size:13px;">공부 시간</span>
                <br>
                <?php echo $today_log["time"] ?>시간 <?php echo $today_log["hour"] ?>분
            </div>
        </div>
    </div>

    <?php } ?>
    <?php 
    if($today_log_have == false) {
        echo "<br><center style='font-size:13px; margin-top:5px;'>입력한 공부 기록이 없어요.</center><div class='mb-3'></div>";
    }
    ?>



</div>

<div style="height: 100px;"></div>
<div class="fixed-bottom">
    <a class="btn btn-primary btn-lg fix" href="new.php">새 기록 추가</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
</script>
<script src="todo.js"></script>
</body>

</html>