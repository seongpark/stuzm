<?php
include "db.php";
include "include/header.php";

if (!isset($_COOKIE['userid'])) {
    echo '<script>location.href="login/index.php"</script>';
}

$sql = mysqli_query($db, "select * from member where id='{$_COOKIE['userid']}' and pw='{$_COOKIE['userpw']}'");

while ($member = $sql->fetch_array()) {
    $userid = $_COOKIE['userid'];
    $sch = $member['school'] . $member['grade'] . "g" . $member['room'];

    //나이스 API로 학교 코드 불러오기
    $xmlfile = 'https://open.neis.go.kr/hub/schoolInfo?ATPT_OFCDC_SC_CODE=K10&SCHUL_KND_SC_NM=고등학교&SCHUL_NM=' . $member['school'];
    $sch_api_load = simplexml_load_file($xmlfile) or die("급식 정보를 불러오지 못했습니다!");

    //$sch_code 변수에 SD_SCHUL_CODE 값을 넣음
    $sch_code = "";
    foreach ($sch_api_load as $sch_api) {
        $sch_code = $sch_api->SD_SCHUL_CODE;
    }
?>

<!DOCTYPE html>

<head>
    <style>
        body {
            background-color: #F5F6FA;
        }

        .lin_board {
            width: 100%;
            height: 1px;
            background-color: #D8D8D8;
            margin-top: 4px;
            margin-bottom: 4px;
        }

        .btn-outline-primary {
            border-radius: 50px;
        }

        .btn-outline-danger {
            border-radius: 50px;
        }

        #bell {
            position: relative;
            right: 0;
        }

        #bell > div {
            position: absolute;
            left: 54%;
            top: 4%;
            width: 12.3px;
            height: 12.3px;
            border-radius: 50px;
            background-color: white;
        }

        #bell > div > div {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: red;
            width: 8px;
            height: 8px;
            border-radius: 50px;
        }

        .ad_img_background {
            border-radius: 20px !important;
        }
    </style>
</head>

<body>
    <div id="first_container" style="margin-top: 77.56px;">
        <div id="center_card">

        <!-- 급식 BOX -->
            <div class="box" style="margin-bottom:11px;">
                <a class="title" href="school/food.php">
                    <span>
                        급식
                    </span>
                    <i class="fa-solid fa-angle-right"></i>
                </a>

                <div id="lunch_div">
                    <?php
                        //금욜
                        $week = date('w') + 1;
                        if ($week == 6) {
                            for ($date_plus = 0; $date_plus < 4; $date_plus++) {
                                $yoil = date('w') + $date_plus;
                                if ($yoil == 8) {
                                    $yoil = 1;
                                }
                                if ($yoil == 1 or $yoil == 2 or $yoil == 3 or $yoil == 4 or $yoil == 5) {
                                    ?>
                    <div class="lunch">
                        <?php
                                        $l_date = date('m월 d일', strtotime("+$date_plus day"));
                                        if ($yoil == 1) {
                                            $w = " (월)";
                                        }
                                        if ($yoil == 2) {
                                            $w = " (화)";
                                        }
                                        if ($yoil == 3) {
                                            $w = " (수)";
                                        }
                                        if ($yoil == 4) {
                                            $w = " (목)";
                                        }
                                        if ($yoil == 5) {
                                            $w = " (금)";
                                        }
                                        echo "<div style='margin-bottom: 5px;'>" . $l_date . $w . "</div>";
                                        $date = date('Ymd', strtotime("+$date_plus day"));
                                        $xmlfile = 'https://open.neis.go.kr/hub/mealServiceDietInfo?ATPT_OFCDC_SC_CODE=K10&SD_SCHUL_CODE=' . $sch_code . '&MLSV_YMD=' . $date . '&KEY=7156412fee5c40a3bc48da87298b4cea';
                                        $food_api = simplexml_load_file($xmlfile) or die("급식정보를 불러오지 못했습니다");
                                        $serial = 1;
                                        $found = false;
                                        foreach ($food_api as $food):
                                            $date_api = $food->MLSV_YMD;
                                            $menu = $food->DDISH_NM;
                                            $cal = $food->CAL_INFO;
                                            if ($date == $date_api) {
                                                echo $menu;
                                                $found = true;
                                                echo '<br><span style="font-size:12px;color:gray;">' . $cal . '</span>';
                                            }
                                            $serial++;
                                        endforeach;
                                        // 값을 찾지 못한 경우 "값이 없습니다" 출력
                                        if (!$found) {
                                            echo "급식정보를 불러오지 못했습니다";
                                        }
                                        ?>
                    </div>
                    <?php }
                            }
                        } ?>
                    <?php
                        //평일
                        $week = date('w') + 1;
                        if ($week <= 5 and $week > 1) {
                            for ($date_plus = 0; $date_plus < 2; $date_plus++) {
                                $yoil = date('w') + $date_plus;
                                if ($yoil == 6) {
                                    $yoil = 1;
                                }
                                if ($yoil == 1 or $yoil == 2 or $yoil == 3 or $yoil == 4 or $yoil == 5) {
                                    ?>
                    <div class="lunch">
                        <?php
                                        $l_date = date('m월 d일', strtotime("+$date_plus day"));
                                        if ($yoil == 1) {
                                            $w = " (월)";
                                        }
                                        if ($yoil == 2) {
                                            $w = " (화)";
                                        }
                                        if ($yoil == 3) {
                                            $w = " (수)";
                                        }
                                        if ($yoil == 4) {
                                            $w = " (목)";
                                        }
                                        if ($yoil == 5) {
                                            $w = " (금)";
                                        }


                                        echo "<div style='margin-bottom: 5px;'>" . $l_date . $w . "</div>";
                                        $date = date('Ymd', strtotime("+$date_plus day"));
                                        $xmlfile = 'https://open.neis.go.kr/hub/mealServiceDietInfo?ATPT_OFCDC_SC_CODE=K10&SD_SCHUL_CODE=' . $sch_code . '&MLSV_YMD=' . $date . '&KEY=7156412fee5c40a3bc48da87298b4cea';
                                        $food_api = simplexml_load_file($xmlfile) or die("급식정보를 불러오지 못했습니다");
                                        $serial = 1;
                                        $found = false;
                                        foreach ($food_api as $food):
                                            $date_api = $food->MLSV_YMD;
                                            $menu = $food->DDISH_NM;
                                            $cal = $food->CAL_INFO;
                                            if ($date == $date_api) {
                                                echo $menu;
                                                $found = true;
                                                echo '<br><span style="font-size:12px;color:gray;">' . $cal . '</span>';
                                            }
                                            $serial++;
                                        endforeach;
                                        // 값을 찾지 못한 경우 "값이 없습니다" 출력
                                        if (!$found) {
                                            echo "급식정보를 불러오지 못했습니다";
                                        }
                                        ?>
                    </div>
                    <?php }
                            }
                        } ?>
                    <?php
                        //토욜
                        $week = date('w') + 1;
                        if ($week == 7) {
                            for ($date_plus = 2; $date_plus < 4; $date_plus++) {
                                $yoil = date('w') + $date_plus;
                                if ($yoil <= 9) {
                                    $yoil = $yoil - 7;
                                }
                                if ($yoil == 1 or $yoil == 2 or $yoil == 3 or $yoil == 4 or $yoil == 5) {
                                    ?>
                    <div class="lunch">
                        <?php
                                        $l_date = date('m월 d일', strtotime("+$date_plus day"));
                                        if ($yoil == 1) {
                                            $w = " (월)";
                                        }
                                        if ($yoil == 2) {
                                            $w = " (화)";
                                        }
                                        if ($yoil == 3) {
                                            $w = " (수)";
                                        }
                                        if ($yoil == 4) {
                                            $w = " (목)";
                                        }
                                        if ($yoil == 5) {
                                            $w = " (금)";
                                        }
                                        echo "<div style='margin-bottom: 5px;'>" . $l_date . $w . "</div>";
                                        $date = date('Ymd', strtotime("+$date_plus day"));
                                        $xmlfile = 'https://open.neis.go.kr/hub/mealServiceDietInfo?ATPT_OFCDC_SC_CODE=K10&SD_SCHUL_CODE=' . $sch_code . '&MLSV_YMD=' . $date . '&KEY=7156412fee5c40a3bc48da87298b4cea';
                                        $food_api = simplexml_load_file($xmlfile) or die("급식정보를 불러오지 못했습니다");
                                        $serial = 1;
                                        $found = false;
                                        foreach ($food_api as $food):
                                            $date_api = $food->MLSV_YMD;
                                            $menu = $food->DDISH_NM;
                                            $cal = $food->CAL_INFO;
                                            if ($date == $date_api) {
                                                echo $menu;
                                                $found = true;
                                                echo '<br><span style="font-size:12px;color:gray;">' . $cal . '</span>';
                                            }
                                            $serial++;
                                        endforeach;
                                        // 값을 찾지 못한 경우 "값이 없습니다" 출력
                                        if (!$found) {
                                            echo "급식정보를 불러오지 못했습니다";
                                        }
                                        ?>
                    </div>

                    <?php }
                            }
                        } ?>
                    <?php
                        //일욜
                        $week = date('w') + 1;
                        if ($week == 1) {
                            for ($date_plus = 1; $date_plus < 3; $date_plus++) {
                                $yoil = date('w') + $date_plus;
                                if ($yoil == 1 or $yoil == 2 or $yoil == 3 or $yoil == 4 or $yoil == 5) {
                                    ?>
                    <div class="lunch">
                        <?php
                                        $l_date = date('m월 d일', strtotime("+$date_plus day"));
                                        if ($yoil == 1) {
                                            $w = " (월)";
                                        }
                                        if ($yoil == 2) {
                                            $w = " (화)";
                                        }
                                        if ($yoil == 3) {
                                            $w = " (수)";
                                        }
                                        if ($yoil == 4) {
                                            $w = " (목)";
                                        }
                                        if ($yoil == 5) {
                                            $w = " (금)";
                                        }
                                        echo "<div style='margin-bottom: 5px;'>" . $l_date . $w . "</div>";
                                        $date = date('Ymd', strtotime("+$date_plus day"));
                                        $xmlfile = 'https://open.neis.go.kr/hub/mealServiceDietInfo?ATPT_OFCDC_SC_CODE=K10&SD_SCHUL_CODE=' . $sch_code . '&MLSV_YMD=' . $date . '&KEY=7156412fee5c40a3bc48da87298b4cea';
                                        $food_api = simplexml_load_file($xmlfile) or die("급식정보를 불러오지 못했습니다");
                                        $serial = 1;
                                        $found = false;
                                        foreach ($food_api as $food):
                                            $date_api = $food->MLSV_YMD;
                                            $menu = $food->DDISH_NM;
                                            $cal = $food->CAL_INFO;
                                            if ($date == $date_api) {
                                                echo $menu;
                                                $found = true;
                                                echo '<br><span style="font-size:12px;color:gray;">' . $cal . '</span>';
                                            }
                                            $serial++;
                                        endforeach;
                                        // 값을 찾지 못한 경우 "값이 없습니다" 출력
                                        if (!$found) {
                                            echo "급식정보를 불러오지 못했습니다";
                                        }
                                        ?>
                    </div>
                    <?php }
                            }
                        } ?>
                </div>
            </div>

            <!--
         
            <div class="box">
                <div class="title">
                    <span>
                        학급 일정
                    </span>
                    <i class="fa-solid fa-plus" onclick="modal('sch_add_plus')"></i>
                </div>

                <div>
                    <div>
                        <?php
                            $sql = mysqli_query($db, "select * from sch_cal where sch='{$sch}' order by idx desc ");
                            if ($sql->num_rows > 0) {
                                while ($cal = $sql->fetch_array()) {
                                    ?>
                        <div class="schedule" onclick='modal(<?php echo htmlentities("$cal[idx]"); ?>)'>
                            <div>
                                <div>
                                    <?php echo htmlentities("$cal[title]"); ?>
                                </div>
                                <div>
                                    <?php echo htmlentities("$cal[date]"); ?>
                                </div>
                            </div>
                            <div>
                                <?php echo htmlentities("$cal[time]"); ?>교시
                            </div>
                        </div>

                     
                        <div id="modal<?php echo htmlentities($cal[" idx"]); ?>">
                            <div
                                class="modal"
                                id="modal_child<?php echo htmlentities($cal["idx"]); ?>">
                                <div class="modal_interface">
                                    <div class="modal_header">
                                        <div class="modal_title">
                                            <?php echo htmlentities("$cal[title]"); ?>
                                        </div>
                                        <div
                                            onclick='modal(<?php echo htmlentities("$cal[idx]") ?>);'
                                            class="modal_close">
                                            <img style="width: 20px;" src="icon_img/x_mark.jpg">
                                        </div>
                                    </div>
                                    <div>
                                        <?php echo htmlentities("$cal[detail]"); ?>
                                    </div>
                                </div>
                                <div class="modal_btn_right">
                                    <button
                                        onclick="delete_sch_<?php echo htmlentities($cal['idx']); ?>()"
                                        class="modal_btn_right_item">삭제</button>

                                    <script>
                                        function delete_sch_ <?php echo htmlentities($cal['idx']); ?>() {
                                            if(!confirm("정말 삭제하시겠습니까?")) {} else {
                                                location.href = 'sch/delete.php?idx=<?php echo htmlentities($cal['idx']); ?>';
                                            }
                                        }
                                    </script>

                                </div>
                            </div>
                            <div class="modal_back"></div>
                        </div>

                    <?php
                                }
                            } else {
                                echo "추가한 일정이 없습니다.";
                            }
                            ?>
                    </div>
                </div>

                <div id="modalsch_add_plus">
                    <div class="modal" id="modal_childsch_add_plus">
                        <div class="modal_interface">
                            <div class="modal_header">
                                <div class="modal_title">새 학급 일정 추가</div>
                                <div onclick="modal('sch_add_plus')" class="modal_close">
                                    <img style="width: 20px;" src="icon_img/x_mark.jpg">
                                </div>
                            </div>
                            <div>

                                <form action="cal_add.php" method="post">
                                    <div>
                                        <div class="form-label">일정 이름</div>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="title"
                                            placeholder="영어 수행평가"
                                            required="required">
                                    </div>
                                    <div>
                                        <div class="form-label">일정 내용</div>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="detail"
                                            placeholder="단어 테스트"
                                            required="required">
                                    </div>
                                    <div>
                                        <div class="form-label">날짜</div>
                                        <input type="date" class="form-control" name="date" required="required">
                                    </div>
                                    <div>
                                        <div class="form-label">교시</div>
                                        <input
                                            type="number"
                                            class="form-control"
                                            name="period"
                                            placeholder="숫자만 입력"
                                            required="required">
                                    </div>

                                </div>
                                <div class="d_flex modal_btn">
                                    <button type="submit" class="modal_btn_item">등록</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal_back"></div>
                </div>
            </div>

                        -->


           <!-- 최신 글 BOX -->
<div class="box">
    <a class="title" href="board">
        <span>최신 글</span>
        <i class="fa-solid fa-angle-right"></i>
    </a>
    <?php
    $result = mysqli_query($db, "SELECT * FROM `board` ORDER BY idx DESC LIMIT 0,5 ");

    while ($board = $result->fetch_array()) {
        
        // 댓글 수 카운트
        $comment_query = mysqli_query($db, "SELECT * FROM reply WHERE con_num='" . $board['idx'] . "'");
        $rep_count = mysqli_num_rows($comment_query);

        $title = $board["title"];

        // 제목 30글자 넘으면 ...으로 표시
        $date = str_replace("-", ".", "$board[date]");
        if (strlen($title) > 30) {
            $title = str_replace($board["title"], mb_substr($board["title"], 0, 11, "utf-8") . "...", $board["title"]);
        }
        ?>
        <div class="best_post" onclick="location.href ='board/read.php?idx=<?php echo htmlentities($board['idx']); ?>'">
            <div>
                <?php echo htmlentities("$title"); ?>
            </div>
            <div class="post_detail" style="color:#bdbdbd;">
                <span>
                    <i class="fa-regular fa-comment lin"></i>
                    <?php echo $rep_count; ?>
                </span>
                <span>
                    <i class="fa-regular fa-eye"></i>
                    <?php echo htmlentities($board["hit"]); ?>
                </span>
            </div>
        </div>
    <?php } ?>
</div>

                <!-- 애드핏 광고 -->
                <div class="ad">
                    <ins
                        class="kakao_ad_area"
                        style="display:none;"
                        data-ad-unit="DAN-Ei3wetzpHkXPILTR"
                        data-ad-width="320"
                        data-ad-height="100"></ins>
                    <script
                        type="text/javascript"
                        src="//t1.daumcdn.net/kas/static/ba.min.js"
                        async="async"></script>
                </div>
                <div id="right_ad">
                    <ins
                        class="kakao_ad_area"
                        style="display:none;"
                        data-ad-unit="DAN-99Mi2HhsUS5zmSMW"
                        data-ad-width="160"
                        data-ad-height="600"></ins>
                    <script
                        type="text/javascript"
                        src="//t1.daumcdn.net/kas/static/ba.min.js"
                        async="async"></script>
                </div>
            <!-- 추천 친구 BOX -->
            <div id="fixed_right">
                <div class="box" style="margin-bottom: 13px;">
                    <a class="title" href="friend/friend_recommend.php">
                        <span>추천 친구</span>
                        <i class="fa-solid fa-angle-right"></i>
                    </a>
                    <?php

                        $sql = mysqli_query($db, "SELECT * FROM member WHERE status='active'
                    AND access!='teacher' 
                    AND access!='official' 
                    AND id!='" . $userid . "' 
                    AND id NOT IN (SELECT friend_id FROM friend 
                    WHERE userid='" . $userid . "') 
                    ORDER BY RAND() LIMIT 0,5");

                        while ($friend = $sql->fetch_array()) {

                            $friend_id = $friend['id'];
                            $fidx = htmlentities($friend["idx"]);

                            ?>
                    <div class="d_flex r_friend">
                        <div class="friend_list">
                            <div
                                class="d_flex"
                                onclick="location.href='friend/profile/index.php?idx=<?= $fidx ?>'">
                                <img
                                    class="friend_profile"
                                    src='profile/img/<?php echo htmlentities($friend["profile_image"]); ?>'>
                            </div>
                        </div>
                        <div>
                            <div>
                                <?php echo htmlentities($friend["name"]); ?>
                            </div>
                            <div>
                                <?php echo htmlentities($friend["school"]); ?>
                                <?php echo htmlentities($friend["grade"]); ?>학년
                                <?php echo htmlentities($friend["room"]); ?>반
                            </div>
                        </div>
                        <div class="friend_add">
                            <a class="add_icon" type="button" href="friend/new_friend.php?idx='<?php echo $friend["idx"] ?>'"><i class="fa-solid fa-user-plus"></i></a>
                        </div>
                    </div>
                    <?php } ?>
                </div>



            </div>


        </div>
    </div>

    <!-- 하단 메뉴바 -->
    <div id="header_tap_parant">

    <div class="header_tap" onclick="location.href='student_id'">
            <i
                class="fa-solid fa-id-card"
                style="color:#2E9AFE;font-size:25px;margin-bottom:10px;"></i>
            <span>모바일 학생증</span>
        </div>

        <div class="header_tap" onclick="location.href='school/coinpage.php'">
            <i
                class="fa-brands fa-bitcoin"
                style="color:rgb(251 188 5);font-size:25px;margin-bottom:10px;"></i>
            <span>우리반 화폐</span>
        </div>

    </div>

    <!-- 애드핏 광고 -->
    <center class="proper_margin">
        <ins
            class="kakao_ad_area"
            style="display:none;"
            data-ad-unit="DAN-Xe6eKAO9lbNdTQkk"
            data-ad-width="250"
            data-ad-height="250"></ins>
        <script
            type="text/javascript"
            src="//t1.daumcdn.net/kas/static/ba.min.js"
            async="async"></script>
    </center>

    <!-- 상단바 -->
    <div class="fixed-topp top" style="box-shadow:6px 4px 16px -8px rgba(0, 0, 0, 0.06);">
        <div class="d_flex">

            <div id="logo">
                <img src="assets/image/jiguem_gray.png" id="stuzm_logo" height="20">
            </div>
            
            <!-- 알림 아이콘 부분 -->
            <div class="top-sch v_middle" id="noti">
                <?php
                // 새로운 알림이 있으면 (1)
                    if ($member["alert_read"] == "1") {
                        ?>
                <a href="noti">
                    <div class="d-flex flex-row" id="bell" style="margin-top:2px">
                        <i class="fa-solid fa-bell" style="font-size: 23.6px; color:#4d4d4d;"></i>&nbsp;
                        <div>
                            <div></div>
                        </div>
                    </div>
                </a>
            <?php 
            } 
            else{
                        ?>
                <a href="noti">
                    <div class="d-flex flex-row" id="bell" style="margin-top:2px">
                        <i class="fa-solid fa-bell" style="font-size: 23.6px; color:#4d4d4d;"></i>&nbsp;
                    </div>
                </a>
                <?php } ?>
            </div>
        </div>
    </div>

    <div style="height: 100px;"></div>

    <!-- 메뉴 -->
    <div class="fixed-bottom">
        <div class="line"></div>
        <div class="menu">
            <div
                class="d-flex justify-content-around"
                id="menu_middle"
                style="font-size: 0px;">

                <div class="active">
                    <span>
                        <i class="fa-solid fa-house" style="margin-bottom: 4px;"></i>
                    </span>
                    <center>
                        <span>홈</span>
                    </center>
                </div>

                <div onclick="location.href ='board'">
                    <span><img class="menu_img" src="assets/image/logo.svg" alt="" width="20px" srcset=""></span>
                    <center>
                        <span>커뮤니티</span>
                    </center>
                </div>
                
                <div onclick="location.href ='friend'">
                    <span>
                        <i class="fa-solid fa-user-group" style="margin-bottom: 4px;"></i>
                    </span>
                    <center>
                        <span>친구</span>
                    </center>
                </div>

                <div onclick="location.href ='school'">
                    <span>
                        <i class="fa-solid fa-school" style="margin-bottom: 4px;"></i>
                    </span>
                    <center>
                        <span>학교</span>
                    </center>
                </div>

                <div onclick="location.href ='user'">
                    <span>
                        <i class="fa-solid fa-bars" style="margin-bottom: 4px;"></i>
                    </span>
                    <center>
                        <span>메뉴</span>
                    </center>
                </div>

            </div>
        </div>
    </div>

</script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"
    integrity="sha256-eVNjHw5UeU0jUqPPpZHAkU1z4U+QFBBY488WvueTm88="
    crossorigin="anonymous"></script>
</body>

</html>

<?php } ?>