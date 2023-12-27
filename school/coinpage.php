<!DOCTYPE html>

<head>
    <?php

    include "../db.php";
    include_once "../include/header_down.php";
    if (isset($_SESSION['userid'])) {
        $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while ($member = $sql3->fetch_array()) {

            $userid = $_SESSION['userid'];

            $my_coin = $member["coin"];

            //그룹 생성 감지
            $group_check_info = $member["school"] . $member["grade"] . "g" . $member["room"];

            $group_check = mysqli_query($db, "select * from class_group where sch='$group_check_info'");
            $group_check = $group_check->fetch_array();

            if ($group_check >= 1) {
                //선생님 감지
                if ($member["access"] == "teacher") {
                    echo '<script>location.href="teacher"</script>';
                }
            } else {
                if ($member["access"] == "teacher") {
                    echo '<script>location.href="make.php"</script>';
                } else {
                    echo '<script>location.href="hold.php"</script>';
                }
            }
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
    <div id="coin_first_container">
        <div id="center_card">
            <div id="coin_header">
                <div class="back_btn">
                    <a href="../">
                        &#xE000;
                    </a>
                </div>
                <div id="coin_info">
                    우리반 화폐
                </div>
            </div>

            <div id="center_card">
                <div id="header_selection" style="margin-top: 10px;" class="d_flex">
                    <a class="header_active">
                        <div>코인 내역</div>
                    </a>
                    <a class="header_none_active" href="market">
                        <div>마켓</div>
                    </a>
                </div>
                <div id="container">

                    <!-- 화폐 표시 부분 시작 !-->
                    <?php if ($group_check >= 1) { ?>
                    <div>
                        <div class="d_flex space_between coin_total">
                            <div class="va_m_m">
                                <i class="fa-brands fa-bitcoin va_m total_icon"></i>
                            </div>
                            <div class="va_m">
                                <span>
                                    <?php


                                        if (preg_match('/^(.+?)(\d+)g(\d+)$/', $group_check_info, $matches)) {
                                            $school = $matches[1];
                                            $grade = (int)$matches[2];
                                            $room = (int)$matches[3];

                                            $sql_coin_plus = "SELECT SUM(coin) as total FROM member WHERE status='active' AND school='$school' AND grade='$grade' AND room='$room'";

                                            $result = $db->query($sql_coin_plus);

                                            if ($result->num_rows > 0) {
                                                $row = $result->fetch_assoc();
                                                $totalCoins = $row["total"];

                                                echo $totalCoins;
                                            } else {
                                                echo "0";
                                            }
                                        } else {
                                            echo "문자열 형식이 올바르지 않습니다.";
                                        }

                                        ?>원

                                </span>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div OnClick="location.href ='hold.php'">
                        <div>
                            <div>
                                <img src="coin.png" width="25px" alt="" srcset="">
                            </div>
                            <div>
                                <span style="font-size:18px;">
                                    우리반만의 화폐를 만들어보자!
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <div></div>
                    <?php if ($group_check >= 1) { ?>
                    <!-- 화폐 표시 부분 끝 !-->

                    <?php
                    }
                    $sql_group_load = mysqli_query($db, "select * from class_group where sch='{$group_check_info}'");
                    while ($group_list_load = $sql_group_load->fetch_array()) {
                    ?>
                    <div>
                        <!--
                            <div class="card mb-3 mt-3">
                                <div class="card-body">
                                    <h5>순위 </h5>
                                    <?php
                                    $sql_member_load_2 = mysqli_query($db, "select * from member");
                                    while ($member3 = $sql_member_load_2->fetch_array()) {
                                        $sch3 = $member3["school"] . $member3["grade"] . "g" . $member3["room"];
                                        if ($group_list_load["sch"] == $sch3) {
                                            echo htmlentities($member3["name"]);
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        -->
                        <div>
                            <div>
                                <table>

                                    <?php
                                        $sql_member_load = mysqli_query($db, "select * from member");
                                        while ($member2 = $sql_member_load->fetch_array()) {
                                            $sch2 = $member2["school"] . $member2["grade"] . "g" . $member2["room"];
                                            if ($group_list_load["sch"] == $sch2) {

                                        ?>
                                    <!-- 1 -->
                                    <div class="coin_member">
                                        <div class="coin_name">
                                            <?php echo htmlentities($member2["name"]); ?>
                                        </div>
                                        <div class="coin">
                                            <span class="coin_number">
                                                <?php echo htmlentities($member2["coin"]); ?>원
                                            </span>
                                            <span class="coin_history"
                                                onclick="modal(<?php echo htmlentities($member2['idx']); ?>)">내역</span>
                                        </div>
                                    </div>

                                    <div id="modal<?php echo htmlentities($member2['idx']); ?>">
                                        <div class="modal" id="modal_child<?php echo htmlentities($member2['idx']); ?>"">
                                            <div class=" modal_interface">
                                            <div class="modal_header">
                                                <div class="modal_title">상세 내역</div>
                                                <div onclick="modal(<?php echo htmlentities($member2['idx']); ?>)"
                                                    class="modal_close"><i class="fa-solid fa-xmark"></i>
                                                </div>
                                            </div>
                                            <div>

                                                <?php
                                                            $sql_load_detail = mysqli_query($db, "select * from group_coin where id='{$member2["id"]}' and status='active'");
                                                            $load_detail_ok = false;
                                                            while ($load_detail = $sql_load_detail->fetch_array()) {
                                                                $load_detail_ok = true;
                                                            ?>

                                                지급 받은 화폐 :
                                                <?php echo htmlentities($load_detail['coin']); ?>원<br>
                                                사유 :
                                                <?php echo htmlentities($load_detail['reason']); ?>원
                                                <hr>

                                                <?php } ?>
                                                <?php if ($load_detail_ok == false) {
                                                                echo "지급 받은 내역이 없습니다.";
                                                            }
                                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal_back"></div>
                            </div>

                            <!-- 1 -->
                            <?php
                                            }
                                        }
                        ?>




                            </table>
                        </div>
                    </div>
                </div>



                <?php } ?>



                <center class="proper_margin">
                    <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-Ei3wetzpHkXPILTR"
                        data-ad-width="320" data-ad-height="100"></ins>
                    <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
                </center>
            </div>

            <div style="height: 100px;"></div>
            <div class="coin_appl" onclick="modal('new_coin')">지급 신청</div>

            <div id="modalnew_coin">
                <div class="modal">
                    <div class="modal_interface" id="modal_childnew_coin">
                        <div class="modal_header">
                            <div class="modal_title">화폐 지급 신청</div>
                            <div onclick="modal('new_coin')" class="modal_close">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                        </div>
                        <div>
                            <div>
                                <div class="form-label">신청할 화폐 수</div>
                                <input type="number" name="number" id="coin_number" class="form-control"
                                    placeholder="숫자만 입력" required>
                            </div>
                            <div>
                                <div class="form-label">신청 사유</div>
                                <input class="form-control" id="reason" type="text" name="reason" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="d_flex modal_btn">
                            <button class="modal_btn_item" onclick="ajaxtest()">신청하기</button>
                        </div>
                    </div>
                </div>
                <div class="modal_back"></div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
    $(document).keyup(function(event) {
        if (event.which === 13) {
            ajaxtest()
        }
    });

    function ajaxtest() {
        if ($("#coin_number").val() !== "") {
            $.ajax({
                type: "post",
                url: "process/coin_process.php",
                data: {
                    number: $("#coin_number").val(),
                    reason: $("#reason").val()
                },
                success: function() {
                    modal('new_coin');
                    alert('신청을 완료 했습니다!');
                    $("#coin_number").val("");
                    $("#reason").val("");
                },
                error: function() {
                    alert('신청하는 데에 문제가 생겼습니다');
                }
            })
        } else {
            alert('댓글을 입력해주세요!');
        }
    }
    </script>
    <script src="../modal.js"></script>
</body>

</html>