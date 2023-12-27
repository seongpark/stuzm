<?php
    include "../../db.php";

    //비로그인 방지 및 세션 ID 변수 저장
    $_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }else{
    echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, 
    user-scalable=0" />
    <title>STUZM</title>
    <link rel="stylesheet" href="../../style.css?ver=5">
    <link rel="stylesheet" href="../assets/style.css?ver=5">
    <link rel="shortcut icon" href="../../favicon.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="../../icon_re.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="지금">
    <link rel="apple-touch-icon" href="../../icon_re.php">
    <link rel="manifest" href="manifest.json">
    <?php       
        $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while($member = $sql3->fetch_array()){
            if($member["status"] == "hold") {
                echo'<script>alert("학생 인증을 해주세요.");location.href="auth"</script>';
            }
        }
        ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T9BERKPGHP"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-T9BERKPGHP');
    </script>

</head>

<!--
<nav class="navbar fixed-top">
    <div class="top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../jiguem_gray.png" alt="Logo" width="100" class="d-inline-block align-text-top">
            </a>
        </div>
    </div>
</nav>
-->

<body>

    <div class="top">
        <div class="container">
            <a href="index.php" class="link">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
        </div>
    </div>
    <div class="container">
        <h3>공부 기록 추가하기</h3>

        <div class="mb-4 mt-4">
            <label class="form-label">날짜</label>
            <form action="new_study_log.php" method="post">
                <div class="row">
                    <div class="col">
                        <input type="number" class="form-control input_exam" required name="year" placeholder="년"
                            value="<?php echo date("Y"); ?>">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control input_exam" required name="month" placeholder="월"
                            value="<?php echo date("m"); ?>">
                    </div>
                    <div class="col">
                        <input type="number" class="form-control input_exam" required name="day" placeholder="일"
                            value="<?php echo date("d"); ?>">
                    </div>
                </div>
        </div>

        <div class="mb-4">
            <label class="form-label">공부한 시간</label>
            <div class="row">
                <div class="col">
                    <input type="number" class="form-control input_exam" required name="time" placeholder="시간">
                </div>
                <div class="col">
                    <input type="number" class="form-control input_exam" required name="minit" placeholder="분">
                </div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">공부한 범위</label>
            <input type="text" class="form-control input_exam" name="what">
        </div>
    </div>

    <div style="height: 100px;"></div>
    <div class="fixed-bottom">
        <button class="btn btn-primary btn-lg fix" type="submit">추가하기</button>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="todo.js"></script>
</body>

</html>