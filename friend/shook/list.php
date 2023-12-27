<?php
    include "../../db.php";
    $_SESSION["userid"] = $_COOKIE['userid'];
    $_SESSION["userpw"] = $_COOKIE['userpw'];
    if(isset($_SESSION['userid'])){
        $my_id = $_SESSION['userid'];
	}else{
        echo "<script>alert('비정상적인 접근입니다.');location.href='../../login';</script>";
    }

?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include "../../include/header_down_down.php"; ?>
    <style>
    .btn-outline-primary {
        border-radius: 50px;
    }

    .btn-outline-danger {
        border-radius: 50px;
    }
    </style>
</head>

<body>

    <div class="fixed-top">
        <div class="top_back">
            <div class="container">
                <div class="d-flex justify-content-between">
                    <a href="../">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>

                    <a href="index.php" class="link" style="color: #02AAB0 !important;">
                        <i class="fa-solid fa-plus"></i>
                    </a>

                </div>

            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 75px;">
        <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-vkViNKtGgPASKHu1" data-ad-width="320"
            data-ad-height="50"></ins>
        <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
        <div class="mt-2"></div>
        <?php 
                            $sql_load_shook = mq("select * from shook order by idx desc ");
                            while($shook = $sql_load_shook->fetch_array()) {
                                
                                $sql_shook_member = mq("select * from member where id='{$shook["userid"]}'");
                                while($member_shook = $sql_shook_member->fetch_array()){
                                    $name = $member_shook["name"];
                                }
                        ?>
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row">
                        <div class="post_description">
                            &nbsp;&nbsp;<?php echo $name; ?>
                        </div>
                    </div>
                    <?php if($_SESSION["userid"] == $shook["userid"]) {
                        ?>
                    <div class="post_description">
                        <a href="delete.php?idx=<?php echo $shook["idx"];?>">
                            <i class="fa-solid fa-trash" style="font-size: 12px;margin-top: 5px;color:gray;"></i>
                        </a>
                    </div>
                    <?php
                } ?>
                </div>

                <hr style="margin: 0px;">
                <p class="content"><?php echo $shook["content"]; ?></p>
            </div>
        </div>


        <?php } ?>
    </div>
    </div>

    <div style="height: 100px;"></div>
    <div class="fixed-bottom">
        <div class="line"></div>
        <div class="menu">
            <div class="d-flex justify-content-around">
                <div OnClick="location.href ='../../index.php'">
                    <i class="fa-solid fa-house" style="margin-bottom: 4px;"></i>

                    <center>
                        <span style="font-size:12px;">홈</span>
                    </center>
                </div>

                <div OnClick="location.href ='../../board'">
                    <img src="../../logo.svg" alt="" width="20px" style="margin-left:11.5px;margin-bottom: 5.5px;"
                        srcset="">

                    <center>
                        <span style="font-size:12px;">커뮤니티</span>
                    </center>
                </div>
                <div class="active" OnClick="location.href ='../../friend'">
                    <i class=" fa-solid fa-user-group" style="margin-bottom: 4px;"></i>
                    <center>
                        <span style="font-size:12px;">친구</span>
                    </center>
                </div>
                <div OnClick="location.href ='../../school'">
                    <i class=" fa-solid fa-school" style="margin-bottom: 4px;"></i>
                    <center>
                        <span style="font-size:12px;">학교</span>
                    </center>
                </div>
                <div OnClick="location.href ='../../user'">
                    <i class="fa-solid fa-bars" style="margin-bottom: 4px;"></i>
                    <center>
                        <span style="font-size:12px;">메뉴</span>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>