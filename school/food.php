<!DOCTYPE html>

<head>
    <?php
    include "../db.php";
    include_once "../include/header_down.php";
    if (isset($_SESSION['userid'])) {
        $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while ($member = $sql3->fetch_array()) {

            $group_check_info = $member["school"] . $member["grade"] . "g" . $member["room"];

            $group_check = mysqli_query($db, "select * from class_group where sch='$group_check_info'");
            $group_check = $group_check->fetch_array();

            $my_coin = $member["coin"];

            $xmlfile = 'https://open.neis.go.kr/hub/schoolInfo?ATPT_OFCDC_SC_CODE=K10&SCHUL_KND_SC_NM=고등학교&SCHUL_NM=' . $member['school'];
            $sch_api_load = simplexml_load_file($xmlfile) or die("급식 정보를 불러오지 못했습니다!");

            foreach ($sch_api_load as $sch_api):
                $sch_code = $sch_api->SD_SCHUL_CODE;
            endforeach;
        }
    } else {
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../login/index.php?redirect='.$nowUrl.'"</script>';
    }
    ?>

    <link rel="stylesheet" href="assets/style.css">

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
                <a class="header_none_active" href="../school">
                    <div>시간표</div>
                </a>
                <a class="header_active">
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
                ?>" href="food.php?week=1">
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
                ?>" href="food.php?week=2">
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
                ?>" href="food.php?week=3">
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
                ?>" href="food.php?week=4">
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
                ?>" href="food.php?week=5">
                    <div>금</div>
                </a>
            </div>

            <div>
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
                <div class="food_box">
                    <div>
                        <div class="food_info">
                            <?php
                        echo "<div id='date'>".$display_date."</div>";
                        $date = $resultDate;
                        $xmlfile = 'https://open.neis.go.kr/hub/mealServiceDietInfo?ATPT_OFCDC_SC_CODE=K10&SD_SCHUL_CODE=' . $sch_code . '&MLSV_YMD=' . $date . '&KEY=7156412fee5c40a3bc48da87298b4cea';
                        $food_api = simplexml_load_file($xmlfile) or die("급식 정보를 불러오지 못했습니다!");
                        $found = false;
                        foreach ($food_api as $food):
                            $date_api = $food->MLSV_YMD;
                            $menu = $food->DDISH_NM;
                            $cal = $food->CAL_INFO;
                            if ($date == $date_api) {
                                echo $menu;
                                $found = true;
                                echo '<div style="margin-top: 10px;font-size:12px;color:gray;">' . $cal . '</div>';
                            }
                        endforeach;
                        if (!$found) {
                            echo "급식 정보를 불러오지 못했습니다.";
                        }
                        ?>
                        </div>
                    </div>
                </div>
            </div>

            <center class="proper_margin">
                <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-Ei3wetzpHkXPILTR" data-ad-width="320"
                    data-ad-height="100"></ins>
                <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
            </center>
        </div>
    </div>

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
                <div class="active" OnClick="location.href ='../school'">
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
    <?php include("../include/include.php"); ?>
</body>

</html>