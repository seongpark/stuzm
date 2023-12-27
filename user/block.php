<!DOCTYPE html>

<head>
    <?php
    include "../db.php";
    @$_SESSION["userid"] = $_COOKIE['userid'];

    if (isset($_SESSION['userid'])) {
        $userid = $_COOKIE['userid'];
        $sql = mysqli_query($db, "select * from member where id='{$userid}' and pw='{$_COOKIE['userpw']}''");
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
    } else {
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../login/index.php?redirect='.$nowUrl.'"</script>';
    }
    ?>

    <?php include "../include/header_down.php"; ?>

    <style>
    hr {
        width: 90%;
    }

    @media (prefers-color-scheme: dark) {
        #menus span {
            color: white !important;
        }

        .menus .fa-solid {
            color: white !important;
        }

        a>.menus>span {
            color: white !important;
        }

        #menu-list img {
            filter: invert(100%) sepia(0%) saturate(7500%) hue-rotate(85deg) brightness(110%) contrast(110%);
        }
    }
    </style>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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


    <div id="first_container" style="margin-top: 70px;">

        <div id="center_card">

            <h2>차단 관리</h2>
            <div>차단한 사용자</div>
            <?php
            $have = false;
            $sql4 = mysqli_query($db, "SELECT * FROM `block` where userid='$userid' ");
            while ($block = $sql4->fetch_array()) {
$have = true;
                $blockid = $block["blockid"];

                //nickname load
                $sql5 = mysqli_query($db, "SELECT * FROM `member` where id='$blockid' ");
                while ($block_member = $sql5->fetch_array()) {
                    $nick_block = $block_member["nickname"];
                }

                ?>
            <div class="block_user">
                <div class="block_user_name"><?php echo $nick_block; ?></div>
                <a class="unblock_btn" href="unblock.php?idx=<?=$block["idx"]; ?>">
                    <div>해제하기</div>
                </a>
            </div>
            <?php } ?>
            <?php 
            if($have == false) {
                echo "<br>차단한 사용자가 없습니다.";
            }
            ?>
            <div class="fixed-topp top">
                <div class="d-flex justify-content-between">
                    <div>
                        <img src="../jiguem_gray.png" height="20" style="margin-bottom: 4px;">
                    </div>
                </div>
            </div>

            <div style="height: 100px;"></div>
           
        </div>
</body>

</html>