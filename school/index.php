<!DOCTYPE html>
<html lang="ko">

<head>
    <?php
    include "../db.php";
    include_once "../include/header_down.php";

    if (isset($_SESSION['userid'])) {
        $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while ($member = $sql3->fetch_array()) {

            $m_school = $member["school"];

            //grpup check용 member 값 가공 (학교이름+학년+g+반)
            $group_check_info = $member["school"] . $member["grade"] . "g" . $member["room"];

            $group_check = mysqli_query($db, "select * from class_group where sch='$group_check_info'");
            $group_check = $group_check->fetch_array();

            $my_coin = $member["coin"];

            $userid = $_SESSION['userid'];
            $sql3 = mysqli_query($db, "select * from member where id='{$userid}'");
            $member = $sql3->fetch_array();
            $sch = $member['school'];
            $name = $member['name'];
            $nickname = $member['nickname'];
            $number = $member['number'];
            $grade = $member['grade'];
            $room = $member['room'];
            $bunho = $member['bunho'];
            $access = $member['access'];
            $idx = $member['idx'];
        }
    } else {
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../login/index.php?redirect='.$nowUrl.'"</script>';
    }

    //학교코드 불러오기
    $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
    while ($member = $sql3->fetch_array()) {

        $xmlfile = 'https://open.neis.go.kr/hub/schoolInfo?ATPT_OFCDC_SC_CODE=K10&SCHUL_KND_SC_NM=고등학교&SCHUL_NM=' . $member['school'];
        $sch_api_load = simplexml_load_file($xmlfile) or die("정보를 불러오지 못했습니다!");

        foreach ($sch_api_load as $sch_api) :
            $sch_page = $sch_api->HMPG_ADRES;
        endforeach;
    }
    ?>

    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="../style.css">

    <style>
    @media screen and (min-width: 1400px) {

        .text {
            display: none;
        }
    }

    @media screen and (max-width: 1400px) {

        .img {
            display: none;
        }
    }
    </style>

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
    <div style="margin-top: 67.56px;">
        <div id="center_card">
            <div id="fixed_right">

                <div id="right_ad_div">
                    <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-wYSvnhpnKjdwjlcl"
                        data-ad-width="300" data-ad-height="250">
                    </ins>
                    <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
                </div>
            </div>
            <div id="header_selection" style="margin-top: 10px;" class="d_flex">
                <a class="header_active">
                    <div>시간표</div>
                </a>
                <a class="header_none_active" href="food.php">
                    <div>급식</div>
                </a>
            </div>


            <?php
            @$targetDay = $_GET["week"];
            if ($targetDay == "") {
                $targetDay = date("w");

                if (date("w") == 6) {
                    $targetDay = 1;
                }
                if (date("w") == 0) {
                    $targetDay = 1;
                }
            }

            //표시용 targetDay
            $echo_targetDay = $_GET["week"];
            if ($echo_targetDay == "") {
                $echo_targetDay = date("w");
                if (date("w") == 6) {
                    $echo_targetDay = 1;
                }
                if (date("w") == 0) {
                    $echo_targetDay = 1;
                }
            }

            ?>

            <div id="header_selection" style="margin-top: 10px;" class="d_flex">
                <a class="
                <?php
                if (@$echo_targetDay == "") {
                    if (date("w") == "1") {
                        echo "header_active";
                    } else {
                        echo "header_none_active";
                    }
                } else {
                    if ($echo_targetDay == "1") {
                        echo "header_active";
                    } else {
                        echo "header_none_active";
                    }
                }
                ?>" href="index.php?week=1">
                    <div>월</div>
                </a>
                <a class="            <?php
                                        if (@$echo_targetDay == "") {
                                            if (date("w") == "2") {
                                                echo "header_active";
                                            } else {
                                                echo "header_none_active";
                                            }
                                        } else {
                                            if ($echo_targetDay == "2") {
                                                echo "header_active";
                                            } else {
                                                echo "header_none_active";
                                            }
                                        }
                                        ?>" href="index.php?week=2">
                    <div>화</div>
                </a>
                <a class="<?php
                            if ($echo_targetDay == "") {
                                if (date("w") == "3") {
                                    echo "header_active";
                                } else {
                                    echo "header_none_active";
                                }
                            } else {
                                if ($echo_targetDay == "3") {
                                    echo "header_active";
                                } else {
                                    echo "header_none_active";
                                }
                            }
                            ?>" href="index.php?week=3">
                    <div>수</div>
                </a>
                <a class="<?php
                            if ($echo_targetDay == "") {
                                if (date("w") == "4") {
                                    echo "header_active";
                                } else {
                                    echo "header_none_active";
                                }
                            } else {
                                if ($echo_targetDay == "4") {
                                    echo "header_active";
                                } else {
                                    echo "header_none_active";
                                }
                            }
                            ?>" href="index.php?week=4">
                    <div>목</div>
                </a>
                <a class="<?php
                            if ($echo_targetDay == "") {
                                if (date("w") == "5") {
                                    echo "header_active";
                                } else {
                                    echo "header_none_active";
                                }
                            } else {
                                if ($echo_targetDay == "5") {
                                    echo "header_active";
                                } else {
                                    echo "header_none_active";
                                }
                            }
                            ?>" href="index.php?week=5">
                    <div>금</div>
                </a>
            </div>

            <?php

$today = strtotime("today");
$currentDayNumber = date("N", $today);
$targetDayNumber = $targetDay;

// If today is Sunday, adjust the current day number for calculations
if ($currentDayNumber == 7) {
    $currentDayNumber = 0;
}

// If today is Saturday or Sunday, move to the next week
if ($currentDayNumber == 6 || $currentDayNumber == 7) {
    $daysToAdd = $targetDayNumber + 7 - $currentDayNumber;
} else {
    $daysToAdd = $targetDayNumber - $currentDayNumber;
}

// Calculate the result date and display date
$resultDate = date("Ymd", strtotime("{$daysToAdd} days", $today));
$display_date = date("m월 d일", strtotime("{$daysToAdd} days", $today));


            ?>

            <?php

            foreach ($sch_api_load as $sch_api) :
                $sch_code = $sch_api->SD_SCHUL_CODE;
            endforeach;

            $date = $resultDate;
            $xmlfile = 'https://open.neis.go.kr/hub/hisTimetable?ATPT_OFCDC_SC_CODE=K10&SD_SCHUL_CODE=' . $sch_code . '&GRADE=' . $grade . '&CLASS_NM=' . $room . '&ALL_TI_YMD=' . $date . '&KEY=7156412fee5c40a3bc48da87298b4cea';
            $schedule_api = simplexml_load_file($xmlfile) or die("시간표를 불러오지 못했습니다");
            $found = false;
            $judge = $schedule_api->MESSAGE;
            if (!$judge) {
                $ymd = date('m월d일');
                echo '<div id="schedule">
                <div>';
                echo "<div id='date'>" . $display_date . "</div>";
                foreach ($schedule_api as $schedule) :
                    $date_api = $schedule->ALL_TI_YMD;
                    $period = $schedule->PERIO;
                    $subject = $schedule->ITRT_CNTNT;
                    if ($date == $date_api) {
                        echo '
                                <div class="d_flex sche">
                                    <div class="period">' . $period . '교시</div>
                                    <div class="subject">' . $subject . '</div>
                                </div>
                                ';
                        $found = true;
                    }
                endforeach;
                echo "</div>
                </div>";
            } else if (!$jubge) {
                echo '<br>
                            <center>불러온 시간표가 없어요.</center>
                        ';
            }
            ?>
            <center class="proper_margin">
                <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-Ei3wetzpHkXPILTR" data-ad-width="320"
                    data-ad-height="100"></ins>
                <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
            </center>

            <div class="fixed-topp top">
                <div class="d_flex">
                    <div id="logo">
                        <span>학교</span>
                    </div>
                </div>
            </div>
        </div>
        <div style="height: 100px;"></div>
        <div class="fixed-bottom">
            <div class="line"></div>
            <div class="menu">
                <div class="d-flex justify-content-around" id="menu_middle" style="font-size: 0px;">
                    <div OnClick="location.href ='../'">
                        <span><i class="fa-solid fa-house" style="margin-bottom: 4px;"></i></span>

                        <center>
                            <span>홈</span>
                        </center>
                    </div>

                    <div OnClick="location.href ='../board'">
                        <span><img class="menu_img" src="../logo.svg" alt="" width="20px" srcset=""></span>

                        <center>
                            <span>커뮤니티</span>
                        </center>
                    </div>
                    <div OnClick="location.href ='../friend'">
                        <span><i class="fa-solid fa-user-group" style="margin-bottom: 4px;"></i></span>
                        <center>
                            <span>친구</span>
                        </center>
                    </div>
                    <div class="active">
                        <span><i class="fa-solid fa-school" style="margin-bottom: 4px;"></i></span>
                        <center>
                            <span>학교</span>
                        </center>
                    </div>
                    <div OnClick="location.href ='../user'">
                        <span><i class="fa-solid fa-bars" style="margin-bottom: 4px;"></i></span>
                        <center>
                            <span>메뉴</span>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <script src="todo.js"></script>
    </div>
</body>

</html>