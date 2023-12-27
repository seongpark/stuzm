<?php
    include "../../db.php";

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    //비로그인 방지 및 세션 ID 변수 저장
    $_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }else{
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../../login/index.php?redirect='.$nowUrl.'"</script>';
    }


    $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql3->fetch_array()){

        $my_coin = $member["coin"];
        //그룹 생성 감지
        $group_check_info = $member["school"].$member["grade"]."g".$member["room"];
        
        $group_check = mysqli_query($db, "select * from class_group where sch='$group_check_info'");
		$group_check = $group_check->fetch_array();
        
		if($group_check >= 1){
            //선생님 감지
            if($member["access"] == "teacher") {
                echo '<script>location.href="../teacher"</script>';
            }
		}else{
            if($member["access"] == "teacher") {
                echo '<script>location.href="../make.php"</script>';
            }else{
                echo '<script>location.href="../hold.php"</script>';
            }
		}
    }
?>
<!DOCTYPE html>

<head>

    <?php include "../../include/header_down_down.php"; ?>
    <style>
    .row {
        --bs-gutter-x: 0.5rem !important;
    }

    .card {
        padding: 3px !important;
    }
    </style>


</head>

<body>
    <div id="coin_first_container">
        <div id="center_card">
            <div id="coin_header">
                <div class="back_btn">
                    <a href="index.php">
                        &#xE000;
                    </a>
                </div>
                <div id="coin_info">
                    새 아이템 구매
                </div>
            </div>

            <div id="center_card">

                <div id="container">

                    <!-- 화폐 표시 부분 시작 !-->
                    <?php if($group_check >= 1){ ?>
                    <div>
                        <div class="d_flex space_between coin_total">
                            <div class="va_m_m">
                                <i class="fa-brands fa-bitcoin va_m total_icon"></i>
                            </div>
                            <div class="va_m">
                                <span>
                                    <?php echo $my_coin ; ?>원
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="item_list">
                        <?php }else{?>
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
                        <?php
                            }
                            
                                $sql_market_load_2 = mysqli_query($db, "select * from group_maket where group_divide='{$group_check_info}'");
                                while($market = $sql_market_load_2->fetch_array()) {
                        ?>
                        <div class="items">
                            <div class="item_in">
                                <div class="item_title">
                                    <?php echo htmlentities("$market[title]"); ?>
                                </div>
                                <div class="item_detail">
                                    <div class="item_price"><?php echo $market["price"]; ?>원</div>
                                    <div class="item_discription"><?php echo $market["detail"]; ?></div>
                                </div>
                            </div>
                            <a class="buy_btn" href="buy.php?idx=<?php echo $market["idx"]?>">구매하기</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>





                <div style="height: 100px;"></div>

                <script src="../../modal.js"></script>
</body>

</html>