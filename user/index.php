<?php
    include "../db.php";
    include "../include/header_down.php";
    
    if(isset($_COOKIE['userid'])){
        $userid = $_COOKIE['userid'];
        
        $sql = mysqli_query($db, "select * from member where id='{$userid}' and pw='{$_COOKIE['userpw']}'");
        $member = $sql->fetch_array();
    }
    else{
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../login/index.php?redirect='.$nowUrl.'"</script>';
    }
?>

<!DOCTYPE html>

<style>
    hr {
        width: 87%;
        height: 0.1px;
    }
</style>

<link rel="stylesheet" href="style.css">
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"/>
</head>

<body>
<div id="user_first_container">
    <div id="center_card">
        <div id="profile">

            <div id="top">
            <a id="user_img" onclick="location.href='../profile'"><img
    src="../profile/img/<?php echo htmlentities($member["profile_image"]); ?>"
    alt="profile_image" /></a>
<div id="user_profile_div">
    <a id="profile_a" href="../friend/profile/index.php?idx=<?php echo $member["idx"];?>">
        <div id="name"><?php echo htmlentities($member["name"]); ?></div>
    </a>
</div>
                    <?php

                        ?>
                </div>
            </div>

            <div id="email" style="color: rgb(192 192 192);">
                <?php echo htmlentities($member["number"]);?>
            </div>

            <a id="school" href='../login/member/mypage.php'>
                <span>
                    <div><?php echo htmlentities($member["school"]);?></div>
                    <div id="class"><?php echo htmlentities($member["grade"]);?>학년
                        <?php echo htmlentities($member["room"]);?>반
                        <?php echo htmlentities($member["bunho"]);?>번</div>
                </span>
                <span>
                    <i class="fa-solid fa-chevron-right"></i>
                </span>
            </a>

        </div>

        <!-- 애드핏 -->
        <center class="center_tag">
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
        </center>

        <div id="menu-list">

            <a href="../board/write_me.php" style="text-decoration: none;">
                <div class="menus">
                    <span class="menus_icons">
                        <i class="fa-solid fa-pen"></i>
                    </span><span style="margin-left: 5px;">&nbsp;내가 쓴 글</span>
                </div>
            </a>

            <a href="block.php" style="text-decoration: none;">
                <div class="menus">
                    <span class="menus_icons">
                        <i class="fa-solid fa-user-minus"></i>
                    </span><span style="margin-left: 5px;">&nbsp;차단 관리</span>
                </div>
            </a>

            <a href="../board" style="color: black;text-decoration: none;">
                <div class="menus">
                    <span class="menus_icons">
                        <img src="../assets/image/menu.svg" width="19px" alt="">
                    </span>
                    <span style="margin-left: 5px;">
                        &nbsp;커뮤니티
                    </span>
                </div>
            </a>

            <a href="../noti" style="color: black;text-decoration: none;">
                <div class="menus">
                    <span class="menus_icons">
                        <i class="fa-solid fa-bell"></i>
                    </span><span style="margin-left: 5px;">&nbsp;알림</span>
                </div>
            </a>

            <a
                href="../friend/index.php"
                class="new_a"
                style="color: black;text-decoration: none;">
                <div class="menus">
                    <span class="new_to">
                        <span class="menus_icons">
                            <i class="fa-solid fa-user-group"></i>
                        </span><span style="margin-left: 5px;">&nbsp;친구</span>
                    </span>
                </div>
            </a>

            <a href="../school" style="color: black;text-decoration: none;">
                <div class="menus">
                    <span class="menus_icons">
                        <i class="fa-solid fa-school"></i>
                    </span><span style="margin-left: 5px;">&nbsp;학교</span>
                </div>
            </a>

            <a
                href="../school/coinpage.php"
                class="new_a"
                style="color: black;text-decoration: none;">
                <div class="menus">
                    <span class="new_to">
                        <span class="menus_icons">
                            <i class="fa-brands fa-bitcoin"></i>
                        </span><span style="margin-left: 5px;">&nbsp;우리반 화폐</span>
                    </span>
                </div>
            </a>

            <a href="../student_id" style="color: black;text-decoration: none;">
                <div class="menus">
                    <span class="menus_icons">
                        <i class="fa-solid fa-id-card"></i>
                    </span><span style="margin-left: 5px;">&nbsp;모바일 학생증</span>
                </div>
            </a>

            <center>
                <hr>
            </center>

            <a href="../about/privacy.html" style="color: black;text-decoration: none;">
                <div class="menus">
                    <span class="menus_icons">
                        <i class="fa-solid fa-shield-halved"></i>
                    </span><span style="margin-left: 5px;">&nbsp; 개인정보처리방침</span>
                </div>
            </a>

            <a href="../about/term.html" style="color: black;text-decoration: none;">
                <div class="menus">
                    <span class="menus_icons">
                        <i class="fa-solid fa-user-tie"></i>
                    </span><span style="margin-left: 5px;">&nbsp; 이용약관</span>
                </div>
            </a>

            <a
                href="../about/term_community.html"
                style="color: black;text-decoration: none;">
                <div class="menus">
                    <span class="menus_icons">
                        <i class="fa-solid fa-comment"></i>
                    </span><span style="margin-left: 5px;">&nbsp; 커뮤니티 약관</span>
                </div>
            </a>

            <a
                href="https://pf.kakao.com/_lDFGG/chat"
                style="color: black;text-decoration: none;">
                <div class="menus">
                    <span class="menus_icons">
                        <i class="fa-solid fa-headset"></i>
                    </span><span style="margin-left: 5px;">&nbsp; STUZM 고객센터</span>
                </div>
            </a>

            <center>
                <hr>
            </center>

            <a
                href="../login/member/logout.php"
                style="color: black;text-decoration: none;">
                <div class="menus">
                    <span class="menus_icons">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </span><span style="margin-left: 5px;">&nbsp; 로그아웃</span>
                </div>
            </a>

        </div>
        <center class="center_tag">
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
        </center>
    </div>

</div>

<div class="fixed-topp top">
    <div class="d_flex">
        <div id="logo">
            <span>메뉴</span>
        </div>
    </div>
</div>
</div>

<div style="height: 100px;"></div>
<div class="fixed-bottom">
<div class="line"></div>
<div class="menu">
    <div
        class="d-flex justify-content-around"
        id="menu_middle"
        style="font-size: 0px;">
        <div onclick="location.href ='../'">
            <span>
                <i class="fa-solid fa-house" style="margin-bottom: 4px;"></i>
            </span>

            <center>
                <span>홈</span>
            </center>
        </div>
        <div onclick="location.href ='../board'">
            <span><img class="menu_img" src="../logo.svg" alt="" width="20px" srcset=""></span>

            <center>
                <span>커뮤니티</span>
            </center>
        </div>
        <div onclick="location.href ='../friend'">
            <span>
                <i class="fa-solid fa-user-group" style="margin-bottom: 4px;"></i>
            </span>
            <center>
                <span>친구</span>
            </center>
        </div>
        <div onclick="location.href ='../school'">
            <span>
                <i class="fa-solid fa-school" style="margin-bottom: 4px;"></i>
            </span>
            <center>
                <span>학교</span>
            </center>
        </div>
        <div class="active">
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
<script src="../modal.js"></script>
</div>
</body>

</html>