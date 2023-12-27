<!DOCTYPE html>
<html lang="ko">

<head>
    <?php
    include "../db.php";
    include "../include/header_down.php";
    if (isset($_SESSION['userid'])) {
    } else {
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../login/index.php?redirect=' . $nowUrl . '"</script>';
    }

    $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
    while ($member = $sql3->fetch_array()) {

        $sch = $member['school'] . $member['grade'] . "g" . $member['room'];

    }
    ?>
    <link rel="stylesheet" href="style.css">

    <style>
        .btn-outline-primary {
            border-radius: 50px;
        }

        .btn-outline-danger {
            border-radius: 50px;
        }

        body {
            /*background-color: #FAFAFA !important; */
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
    <div id="fixed_right">
        <div class="max_width_appear">
            <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-99Mi2HhsUS5zmSMW" data-ad-width="160"
                data-ad-height="600">
            </ins>
            <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
        </div>
    </div>


    <div id="center_card">
        <div id="header_selection" style="margin-top: 67.56px;margin-bottom: 20px;" class="d_flex">
            <a class="header_active">
                <div>추천 친구</div>
            </a>
            <a class="header_none_active" href="../friend">
                <div>내가 추가한 친구</div>
            </a>
            <a class="header_none_active" href="friend_me.php">
                <div>나를 추가한 친구</div>
            </a>
        </div>
        <div style="padding: 0px 21px;">

            <?php
            $sql = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
            while ($member = $sql->fetch_array()) {

                ?>
                <div class="d_flex r_friend" OnClick="location.href ='profile/index.php?idx=<?= $member["idx"]; ?>'">
                    <div class="friend_list">
                        <div class="d_flex">
                            <img class=" friend_profile"
                                src="../profile/img/<?= htmlentities($member["profile_image"]); ?>">
                        </div>
                    </div>
                    <div>
                        <div>
                            <?php echo htmlentities("$member[name]"); ?>
                            <span style=" color:gray;">
                                <?php echo "@" . htmlentities("$member[handle]"); ?>
                            </span>
                        </div>
                        <div style="margin-top:1.5px;">
                            <?php echo htmlentities("$member[school]"); ?>
                            <?php echo htmlentities("$member[grade]"); ?>학년
                            <?php echo htmlentities("$member[room]"); ?>반
                        </div>
                    </div>
                </div>
            <?php } ?>

            <hr>
            <p>공식</p>

            <?php
            $sql8 = mysqli_query($db, "SELECT * FROM member WHERE status='active' 
        AND access='official' 
        AND NOT id='" . $_SESSION["userid"] . "' 
        ORDER BY RAND() LIMIT 0,50");

            while ($friend = $sql8->fetch_array()) {
                $friend_id = $friend["id"];
                $friend_idx = $friend["idx"];
                ?>

                <div class="d_flex r_friend" OnClick="location.href ='profile/index.php?idx=<?= $friend["idx"]; ?>'">
                    <div class="friend_list">
                        <div class="d_flex">
                            <img class="friend_profile" src="../profile/img/<?= htmlentities($friend["profile_image"]); ?>">
                        </div>
                    </div>
                    <div>


                        <div>
                            <?php echo htmlentities("$friend[name]"); ?>
                            <span style="color:gray;">@<?php echo htmlentities("$friend[handle]"); ?>
                        <i class="fa-solid fa-circle-check" style="font-size:14px; color:#5539FB;
"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <?php
            }
            ?>

            <hr>
            <p>추천</p>

            <?php
            $sql8 = mysqli_query($db, "SELECT * FROM member WHERE status='active' 
        AND access!='teacher' 
        AND access!='official' 
        AND id!='" . $_SESSION["userid"] . "' 
        AND id NOT IN (SELECT friend_id FROM friend 
        WHERE userid='" . $_SESSION["userid"] . "') 
        ORDER BY RAND() LIMIT 0,50");

            $friendhave = false;

            while ($friend = $sql8->fetch_array()) {
                $friendhave = true;
                $friend_id = $friend["id"];
                $friend_idx = $friend["idx"];
                ?>

                <div class="d_flex r_friend" OnClick="location.href ='profile/index.php?idx=<?= $friend["idx"]; ?>'">
                    <div class="friend_list">
                        <div class="d_flex">
                            <img class="friend_profile" src="../profile/img/<?= htmlentities($friend["profile_image"]); ?>">
                        </div>
                    </div>
                    <div>


                        <div>
                            <?php echo htmlentities("$friend[name]"); ?>
                            <span style="color:gray;">@<?php echo htmlentities("$friend[handle]"); ?>
                            
                            </span>
                        </div>

                        <div style="margin-top:1.5px;">

                            <?= htmlentities($friend["school"]); ?>
                            <?= htmlentities($friend["grade"]); ?>학년
                            <?= htmlentities($friend["room"]); ?>반
                        </div>
                    </div>
                    <div class="friend_add">
                        <a class="add_icon" type="button" href="new_friend.php?idx=<?= $friend_idx ?>"><i
                                class="fa-solid fa-user-plus"></i></a>
                    </div>
                </div>

                <?php
            }

            if ($friendhave == false) {
                echo "<br><center>추가한 친구가 없어요. <br>새 친구를 추가해보세요.</center><div class='mb-3'></div>";
            }
            ?>

        </div>
        <div class="fixed-topp top">
            <div class="d_flex">
                <div id="logo">
                    <span>친구</span>
                </div>

                <div>
                    <a href="search"><i class="top_right fa-solid fa-search"></i></a>
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
                    <div class="active">
                        <span><i class="fa-solid fa-user-group" style="margin-bottom: 4px;"></i></span>
                        <center>
                            <span>친구</span>
                        </center>
                    </div>
                    <div OnClick="location.href ='../school'">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
            </script>
        <script src="todo.js"></script>
    </div>
</body>

</html>