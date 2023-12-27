<!DOCTYPE html>
<html lang="ko">

<head>
    <?php
    include "../../db.php";
    include "../../include/header_down_down.php";
    if(isset($_SESSION['userid'])){
    }else{
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../../login/index.php?redirect='.$nowUrl.'"</script>';
        }

        $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while($member = $sql3->fetch_array()){
    
        $sch = $member['school'].$member['grade']."g".$member['room'];
    
        }
        ?>
    <link rel="stylesheet" href="../../profile/style.css">
    <link rel="stylesheet" href="../../login/style.css">
    <script src="../../login/select_process.js"></script>

</head>

<body>

    <body>
        <div id="i_first_container">
            <div id="center_card">
                <div id="i_header">
                    <div class="back_btn">
                        <a href="../">
                            &#xE000;
                        </a>
                    </div>
                    <div id="i_info">
                        친구 검색
                    </div>

                    <form style="margin-top: 20px;" action="process.php" method="POST">

                        <div class="user_info_div">
                            <label class="user_info_label">검색 조건</label>
                            <div class="div">
                                <input class="input_hide type_appear" type="checkbox">
                                <div onclick="g()" class="type_label">
                                    <span class="type_normal">검색 조건 선택</span>
                                    <i class="fa-solid fa-chevron-down down_icon"></i>
                                </div>
                                <div class="type_select">

                                    <div onclick="gender(0)">
                                        <input class="input_hide gender" value="id" type="radio" name="option"
                                            required />
                                        <label class="types">핸들 (@)</label>
                                    </div>

                                    <div onclick="gender(1)">
                                        <input class="input_hide gender" value="name" type="radio" name="option" />
                                        <label class="types">이름</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="user_info_div">
                            <label class="user_info_label">검색 내용</label>
                            <input class="user_info_input" type="text" name="value" autocomplete="off" required
                                onclick="this.select();">
                        </div>

                </div>

                <div id="image-show"></div>
                <div id="upload-fixed-bottom">
                    <button id="upload_btn" type="submit">검색</button>
                </div>
                </form>
            </div>
        </div>
        <script src="../../profile/img_load.js"></script>
    </body>

</html>