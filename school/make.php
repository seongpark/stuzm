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

        if($member["access"] == "user") {
            echo '<script>location.href="hold.php"</script>';
        }
        
        //중복 생성 방지
        $group_check_info = $member["school"].$member["grade"]."g".$member["room"];

        $group_check = mysqli_query($db, "select * from class_group where sch='$group_check_info'");
		$group_check = $group_check->fetch_array();
        
		if($group_check >= 1){
            echo '<script>location.href="coin.php"</script>';
		}else{
		}
        
?>
    <link rel="stylesheet" href="../style.css">
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
                <form action="process/make_process.php" method="POST">
                    <div class="user_info_div text">
                        선생님이 가입할때 입력한 학교, 반 정보와 일치하는<br>학생들이 자동으로 불러와져요.
                    </div>
                    <div class="user_info_div text">
                        만약 우리반 학생이 아닌 학생이 불러와진다면<br><a href="http://pf.kakao.com/_lDFGG">STUZM 고객센터</a>로 알려주세요.
                    </div>
                    <div class="user_info_div">
                        <label class="user_info_label">화폐 이름을 입력해주세요</label>
                        <input class="user_info_input" type="text" autocomplete="off" name="name"
                            placeholder="예시 : 냥냥코인" onclick="this.select();" required>
                    </div>
                    <div id="fixed_bottom">
                        <button type="submit" id="submit_btn">생성하기</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php } ?>