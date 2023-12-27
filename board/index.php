<!DOCTYPE html>
<html lang="ko">

<head>
    <?php
    include "../db.php";
    include_once "../include/header_down.php";

    @$category = $_GET["category"];

    $date = date("YYYY-mm-dd");

    if (isset($_SESSION['userid'])) {
        $id = $_SESSION['userid'];
        $userid = $_SESSION['userid'];
    } else {
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../login/index.php?redirect='.$nowUrl.'"</script>';
    }

    $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
    while ($member = $sql3->fetch_array()) {

        $sch = $member['school'];
        $sch_board = $member['school'] . "b_1";
    }
    ?><script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/style.css?ver=2">
</head>

<body>

    <div class="scroll-list" style="margin-top: 70px;">
        <div>
            <div class="list_board_s list_board<?php if ($category == "") {
                                                    echo "_select";
                                                } ?>" OnClick="location.href ='../board'" style="cursor:pointer;">
                📄 전체
            </div>
            <div class="list_board_s list_board<?php if ($category == "hot") {
                                                    echo "_select";
                                                } ?>" OnClick="location.href ='index.php?category=hot'"
                style="cursor:pointer;">
                🔥 인기글
            </div>

            <div class="list_board_s list_board<?php if ($category == "mysch") {
                                                    echo "_select";
                                                } ?>" OnClick="location.href ='index.php?category=mysch'"
                style="cursor:pointer;">
                🏫 내 학교
            </div>
            <div class="list_board_s list_board<?php if ($category == "b_1") {
                                                    echo "_select";
                                                } ?>" OnClick="location.href ='index.php?category=b_1'"
                style="cursor:pointer;">
                💬 수다
            </div>
            <div class="list_board_s list_board<?php if ($category == "b_2") {
                                                    echo "_select";
                                                } ?>" OnClick="location.href ='index.php?category=b_2'"
                style="cursor:pointer;">
                📚 공부
            </div>
            <div class="list_board_s list_board<?php if ($category == "b_3") {
                                                    echo "_select";
                                                } ?>" OnClick="location.href ='index.php?category=b_3'"
                style="cursor:pointer;">
                🤔 고민
            </div>
            <div class="list_board_s list_board<?php if ($category == "b_4") {
                                                    echo "_select";
                                                } ?>" OnClick="location.href ='index.php?category=b_4'"
                style="cursor:pointer;">
                💕 연애
            </div>
            <div class="list_board_s list_board<?php if ($category == "b_5") {
                                                    echo "_select";
                                                } ?>" OnClick="location.href ='index.php?category=b_5'"
                style="cursor:pointer;">
                🎮 게임
            </div>
            <div class="list_board_s list_board<?php if ($category == "b_6") {
                                                    echo "_select";
                                                } ?>" OnClick="location.href ='index.php?category=b_6'"
                style="cursor:pointer;">
                🎵 음악
            </div>
            <div class="list_board_s list_board<?php if ($category == "b_7") {
                                                    echo "_select";
                                                } ?>" OnClick="location.href ='index.php?category=b_7'"
                style="cursor:pointer;">
                💪 스포츠
            </div>
            <div class="list_board_s list_board<?php if ($category == "b_8") {
                                                    echo "_select";
                                                } ?>" OnClick="location.href ='index.php?category=b_8'"
                style="cursor:pointer;">
                🖊️ 드라마
            </div>
        </div>
        <div class="max_width_appear">
            <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-99Mi2HhsUS5zmSMW" data-ad-width="160"
                data-ad-height="600">
            </ins>
            <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
        </div>
    </div>
    <div id="first_container">
        <div id="center_card">


            <?php

$i = 0; 
            
            $block_query = "SELECT blockid FROM block WHERE userid = '$id'";
            $block_result = mysqli_query($db, $block_query);

            if (!$block_result) {
                die("데이터를 가져오는 중 오류 발생: " . mysqli_error($conn));
            }

            $blocked_users = array();
            while ($row = mysqli_fetch_assoc($block_result)) {
                $blocked_users[] = $row['blockid'];
            }

            if ($category == "") {
                $board_query = "SELECT * FROM board WHERE userid NOT IN ('" . implode("', '", $blocked_users) . "') order by idx desc ";
            } elseif ($category == "hot") {
           
                $currentDate = date("Y-m-d"); 
                $board_query = "SELECT * FROM board WHERE DATE(date) = '$currentDate' AND userid NOT IN ('" . implode("', '", $blocked_users) . "') ORDER BY hit DESC";                

            } elseif ($category == "mysch") {
                $board_query = "SELECT * FROM board_sch WHERE userid NOT IN ('" . implode("', '", $blocked_users) . "') and board='$sch_board'  order by idx desc ";
            } else {
                $board_query = "SELECT * FROM board WHERE userid NOT IN ('" . implode("', '", $blocked_users) . "') and board='$category' order by idx desc";
            }

            $board_result = mysqli_query($db, $board_query);

            if (!$board_result) {
                die("데이터를 가져오는 중 오류 발생: " . mysqli_error($db));
            }

            while ($board = mysqli_fetch_assoc($board_result)) {

                $i++;

                $title = $board["title"];
                if (strlen($title) > 30) {
                    $title = str_replace($board["title"], mb_substr($board["title"], 0, 30, "utf-8") . "...", $board["title"]);
                }

                $content = $board["content"];
                if (strlen($content) > 30) {
                    $content = str_replace($board["content"], mb_substr($board["content"], 0, 30, "utf-8") . "...", $board["content"]);
                }

                $sql2 = mysqli_query($db, "select * from reply where con_num='" . $board['idx'] . "'");
                $rep_count = mysqli_num_rows($sql2);

                if ($i % 6 == 0) {
                    echo '<center class="center_tag " style="margin-top:17px;">
                    <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-Ei3wetzpHkXPILTR" data-ad-width="320"
                        data-ad-height="100"></ins>
                    <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
                </center>';
                }
            ?>

            <div id="community-list">
                <div class="write">

                    <a href="read.php?idx=<?php echo $board['idx']; ?><?php if ($category == "mysch") {
                                                                                echo "&sch=1";
                                                                            } ?>"
                        style="text-decoration: none;color: black;">
                        <div class="school-name"> <?php
                                                        $sql5 = mysqli_query($db, "select * from member where id='{$board['userid']}'");
                                                        while ($bo_mem = $sql5->fetch_array()) {
                                                            echo $bo_mem['school'];
                                                        }
                                                        ?> · <?php echo ("$board[name]"); ?> </div>
                        <div class="write-title"><?php echo htmlentities("$title"); ?></div>
                        <div class="write-discription"><?php echo htmlentities("$content"); ?></div>
                    </a>
                    <div class="write-tools">
                        <div class="tools-left">
                            <!-- 댓글 카테고리 -->
                            <div class="text_type" style="cursor:pointer;">

                                <?php    
                        if($board["board"] == "b_1"){
                            echo '💬 수다';
                        }
                        elseif($board["board"] == "b_2"){
                            echo '📚 공부';
                        }
                        elseif($board["board"] == "b_3"){
                            echo "🤔 고민";
                        }
                        elseif($board["board"] == "b_4"){
                            echo "💕 연애";
                        }
                        elseif($board["board"] == "b_5"){
                            echo "🎮 게임";
                        }
                        elseif($board["board"] == "b_6"){
                            echo "🎵 음악";
                        }
                        elseif($board["board"] == "b_7"){
                            echo "💪 스포츠";
                        }
                        elseif($board["board"] == "b_8"){
                            echo "🖊️ 드라마";
                        }
                        else {
                            echo "🏫 내 학교";
                        }
                    ?>

                            </div>
                            <div class="like-btn"><i class="fa-regular fa-comment mr-3"></i><?php echo $rep_count; ?>
                            </div>
                        </div>

                        <div class="tools-right">
                            <div class="text_date">
                                <?php

                                $storedDate =  $board['date'];
                                $currentDate = new DateTime();

                                $storedDateTime = new DateTime($storedDate);
                                $interval = $currentDate->diff($storedDateTime);

                                if ($interval->days == 0) {
                                    if ($interval->h > 0) {
                                        echo $interval->format('%h시간 전');
                                    } elseif ($interval->i > 0) {
                                        echo $interval->format('%i분 전');
                                    } else {
                                        echo '방금 전';
                                    }
                                } else {
                                    echo $storedDateTime->format('Y년 m월 d일');
                                }
                                ?>
                            </div>
                            <div class="text_view">
                                <i class="fa-solid fa-eye li"></i>
                                <span><?php echo $board['hit']; ?></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <?php } ?>


            <center class="proper_margin">
                <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-Ei3wetzpHkXPILTR" data-ad-width="320"
                    data-ad-height="100"></ins>
                <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
            </center>
        </div>
        <div class="fixed-topp top">
            <div class="d_flex">
                <div id="logo">
                    <span>커뮤니티</span>

                </div>


                <div>
                    <a href="write.php"><i class="top_right fa-solid fa-pen"></i></a>
                </div>



            </div>
        </div>

        <div style="height: 100px;"></div>
        <div class="fixed-bottom">
            <div class="line"></div>
            <div class="menu">
                <div class="d-flex justify-content-around" id="menu_middle" style="font-size: 0px;">
                    <div OnClick="location.href ='../../'">
                        <span><i class="fa-solid fa-house" style="margin-bottom: 4px;"></i></span>

                        <center>
                            <span>홈</span>
                        </center>
                    </div>

                    <div class="active">
                        <span><img class="menu_img" src="../../assets/image/logo_active.svg" alt="" width="20px" srcset=""></span>

                        <center>
                            <span>커뮤니티</span>
                        </center>
                    </div>
                    <div OnClick="location.href ='../../friend'">
                        <span><i class="fa-solid fa-user-group" style="margin-bottom: 4px;"></i></span>
                        <center>
                            <span>친구</span>
                        </center>
                    </div>
                    <div OnClick="location.href ='../../school'">
                        <span><i class="fa-solid fa-school" style="margin-bottom: 4px;"></i></span>
                        <center>
                            <span>학교</span>
                        </center>
                    </div>
                    <div OnClick="location.href ='../../user'">
                        <span><i class="fa-solid fa-bars" style="margin-bottom: 4px;"></i></span>
                        <center>
                            <span>메뉴</span>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>



</html>