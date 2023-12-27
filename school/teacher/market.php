<!DOCTYPE html>
<html lang="ko">

<head>

    <?php 

    

    include "../../db.php";
    include "../../include/header_down_down.php"; 

    // 비로그인 방지 및 세션 ID 변수 저장
    $_SESSION["userid"] = $_COOKIE['userid'];
    $_SESSION["userpw"] = $_COOKIE['userpw'];

    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    } else {
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../../login/index.php?redirect='.$nowUrl.'"</script>';
    }

    $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql3->fetch_array()){
        // 그룹 생성 감지
        $group_check_info = $member["school"].$member["grade"]."g".$member["room"];
        
        $group_check = mysqli_query($db, "select * from class_group where sch='$group_check_info'");
        $group_check = $group_check->fetch_array();
        
        if($group_check >= 1){
            // 학생 감지
            if($member["access"] == "user") {
                echo '<script>location.href="../coinpage.php"</script>';
            }
        } else {
            if($member["access"] == "teacher") {
                echo '<script>location.href="../make.php"</script>';
            } else {
                echo '<script>location.href="../index.php"</script>';
            }
        }
    }
    ?>

    <link rel="stylesheet" href="../assets/style.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('input').on('keydown', function(e) {
            $(this).attr('size', $(this).val().length);
        });
    });
    </script>

    <style>
    #coin_market_fixed_bottom {
        position: fixed;
        width: 100%;
        bottom: 0;
        left: 0;
    }

    .market_btn {
        border-radius: 20px;
        padding: 20px 0px;
        width: 94%;
        max-width: 500px;
        background-color: #5539FB;
        text-align: center;
        color: white;
        margin: 0px auto 15px auto;
    }
    </style>
</head>



<body>
    <div id="coin_first_container">
        <div id="center_card">
            <div id="coin_header">
                <div class="back_btn">
                    <a href="../../">
                        &#xE000;
                    </a>
                </div>
                <div id="coin_info">
                    우리반 화폐 관리
                </div>
            </div>

            <div id="center_card">
                <div id="header_selection" style="margin-top: 10px;" class="d_flex">
                    <a class="header_none_active" href="index.php">
                        <div>우리반 화폐</div>
                    </a>
                    <a class="header_active">
                        <div>마켓</div>
                    </a>
                </div>
                <div id="container">

                    <!-- 화폐 표시 부분 시작 !
                    <?php if($group_check >= 1){ ?>
                    <div>
                        <div class="d_flex space_between coin_total">
                            <div class="va_m_m">
                                <i class="fa-solid fa-coins va_m total_icon"></i>
                            </div>
                            <div class="va_m">
                                <span>
                                    <?php echo $my_coin ; ?>원
                                </span>
                            </div>
                        </div>
                    </div>

                    <?php } ?>-->
                    <div>
                        <h2>마켓 관리</h2>
                        <div id="market_div">

                            <?php 
                            $have = false;
                            $sql_market = mysqli_query($db, "select * from group_maket where group_divide='".$group_check_info."' order by idx desc ");
                            while($market = $sql_market->fetch_array()) {
                                $have = true;
                        ?>

                            <div class="marketitem">
                                <div class="bold">
                                    <span><?php echo htmlentities("$market[title]"); ?></span> |
                                    <?php echo $market["price"]; ?>원
                                </div>

                                <div style="margin-top: 6px;"><?php echo htmlentities("$market[detail]"); ?></div>
                                <div class="d_flex market_btn">

                                    <div class="market_edit" onclick="modal(<?php echo $market['idx'];?>)">수정</div>

                                    <div class="market_delete" onclick="delete_<?php echo $market['idx'];?>()">
                                        삭제</div>

                                    <script>
                                    function delete_<?php echo $market['idx'];?>() {
                                        if (!confirm("정말 아이템을 삭제하시겠습니까?")) {} else {
                                            location.href =
                                                '../process/market_delete.php?idx=<?php echo $market['idx']; ?>'
                                        }
                                    }
                                    </script>


                                </div>
                            </div>

                            <div id="modal<?php echo $market['idx'];?>">
                                <div class="modal" id="modal_child<?php echo $market['idx'];?>">
                                    <div class="modal_interface">
                                        <div class="modal_header">
                                            <div class="modal_title">아이템 수정</div>
                                            <div onclick="modal(<?php echo $market['idx'];?>)" class="modal_close">
                                                <i class="fa-solid fa-xmark"></i>
                                            </div>
                                        </div>
                                        <div>

                                            <form action="../process/edit.php?idx=<?php echo $market['idx'];?>"
                                                method="POST">
                                                <div>
                                                    <div class="form-label">아이템 제목</div>
                                                    <input type="text" name="title" class="form-control"
                                                        value="<?php echo htmlentities("$market[title]"); ?>" required>
                                                </div>

                                                <div>
                                                    <div class="form-label">아이템 설명</div>
                                                    <input type="text" name="detail" class="form-control" required
                                                        value="<?php echo htmlentities("$market[detail]"); ?>">
                                                </div>

                                                <div>
                                                    <div class="form-label">아이템 가격</div>
                                                    <input type="text" name="price" class="form-control"
                                                        value="<?php echo htmlentities("$market[price]"); ?>"
                                                        placeholder="숫자만 입력" required>
                                                </div>

                                        </div>
                                        <div class="d_flex modal_btn">
                                            <button type="submit" class="modal_btn_item">확인</button>
                                        </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="modal_back"></div>
                            </div>

                            <?php } ?>

                            <center class="proper_margin">
                                <?php if($have == false) { echo "등록된 아이템이 없습니다."; } ?>
                            </center>

                            <div id="coin_market_fixed_bottom">
                                <div class="market_btn" onclick="location.href='log_market.php'">구매 내역</div>
                                <div class="market_btn" onclick="modal('new_coin');">새 아이템 등록</div>
                            </div>

                        </div>

                        <center class="proper_margin">
                            <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-Ei3wetzpHkXPILTR"
                                data-ad-width="320" data-ad-height="100"></ins>
                            <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
                        </center>
                    </div>

                    <div id="modalnew_coin">
                        <div class="modal" id="modal_childnew_coin">
                            <div class="modal_interface">
                                <div class="modal_header">
                                    <div class="modal_title">새 아이템 등록</div>
                                    <div onclick="modal('new_coin')" class="modal_close">
                                        <i class="fa-solid fa-xmark"></i>
                                    </div>
                                </div>
                                <div>

                                    <form action="../process/new_market.php" method="POST">
                                        <div>
                                            <div class="form-label">아이템 제목</div>
                                            <input type="text" name="title" class="form-control" required>
                                        </div>

                                        <div>
                                            <div class="form-label">아이템 설명</div>
                                            <input type="text" name="detail" class="form-control" required>
                                        </div>

                                        <div>
                                            <div class="form-label">아이템 가격</div>
                                            <input type="text" name="price" class="form-control" placeholder="숫자만 입력"
                                                required>
                                        </div>

                                </div>
                                <div class="d_flex modal_btn">
                                    <button type="submit" class="modal_btn_item">등록하기</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal_back"></div>
                    </div>


                    <script src="../../modal.js"></script>
                    <div style="height: 100px;"></div>
                    <script src="../modal.js"></script>
                </div>
            </div>
        </div>
</body>

</html>