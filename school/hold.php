<!DOCTYPE html>

<head>
    <?php
    include "../db.php";
    include_once "../include/header_down.php";
    if(isset($_SESSION['userid'])){
    }else{
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../login/index.php?redirect='.$nowUrl.'"</script>';
        }

        $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while($member = $sql3->fetch_array()){
    
        $sch = $member['school'];

        
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
            <div id="i_header">
                <div class="back_btn">
                    <a href="../">
                        &#xE000;
                    </a>
                </div>
                <div id="i_info">
                    우리반만의 화폐을 만들어보세요!
                </div>
            </div>
            <div id="container">
                <div class="user_info_div text">
                    화폐 생성은 선생님이 할 수 있어요. 초대 문자 보내기
                    <br>기능을 통해 선생님에게 요청해보세요.
                </div>
                <div>
                    <!-- <i class="fa-brands fa-bitcoin" style="color: rgb(251 188 5);font-size: 60px;margin-top: 30px;"></i> -->
                </div>
            </div>

            <div id="fixed_bottom">
                <a id="a_submit_btn"
                    href="sms:&body=학생들이 선생님을 초대했어요! 가입해서 우리 반 그룹을 생성하면 우리 반끼리 사용할 수 있는 여러 기능을 사용할 수 있어요:) 사용하기 : https://stuzm.com">초대
                    문자 보내기</a>
            </div>
        </div>
    </div>
</body>

</html>
<?php } ?>