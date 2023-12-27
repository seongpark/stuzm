<html lang="ko">
<meta charset="UTF-8">

<title>STUZM</title>

<!-- 검색 엔진 인증용 !-->
<meta name="google-site-verification" content="9YIIJMMxuETigC_iffGolBj0zn1_4LCj6K2hF-3V4y4" />
<meta name="naver-site-verification" content="6810830ae977a0d75569675929271f68083f95e5" />

<!-- meta 태그 !-->
<meta name="description" content="STUZM 스터즘 고등학생을 위한 SNS">
<meta property="og:type" content="website">
<meta property="og:title" content="STUZM">
<meta property="og:description" content="고등학생을 위한 SNS">
<meta property="og:image" content="https://stuzm.com/assets/imgddddd.png">
<meta property="og:url" content="https://stuzm.com/">
<meta property="og:site_name" content="STUZM">
<meta property="og:locale" content="ko_KR">
<meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1, user-scalable=0">
    <meta name="viewport"
    content="width=device-width, initial-scale=1, maximum-scale=1.0, minimum-scale=1, user-scalable=0">

<!-- 스타일 CSS !-->
<link rel="stylesheet" href="../../assets/style/style.css?ver=7">

<!-- 파비콘 !-->
<link rel="shortcut icon" href="../../assets/image/favicon.png" type="image/x-icon">

<!-- 프레임워크 !-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>

<!-- 웹폰트 !-->
<link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>

<!-- 필수 스크립트 로드 -->
<script src="../../assets/script/dropdown.js"></script>
<script src="../../assets/script/modal.js"></script>

<!-- 필수 함수 로드 -->
<?php 
    include("../../assets/lib/function.php");
?>

<?php

date_default_timezone_set('Asia/Seoul');

$_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

$sql = mysqli_query($db, "select * from member where id='{$_COOKIE['userid']}' and pw='{$_COOKIE['userpw']}'");
$load_account = false;

while ($member = $sql->fetch_array()) {
    $load_account = true;
    //본인 인증 확인
    if ($member["status"] == "hold") {
        echo "<script>location.href='../../auth'</script>";
    }
    if ($member["status"] == "holding") {
        ?>
<style>
body {
    overflow: hidden;
}

.d-flex {
    visibility: hidden !important;
}

.top {
    visibility: hidden !important;
}

.menu {
    visibility: hidden !important;
}
</style>
<div class="auth_alert">
    <div id="auth_confirm">
        <!-- 선생님/학생에 따라 멘트 다르게 표시 -->

        <?php 
            if ($member["access"] == "teacher") 
            { 
        ?>

        <h2><span class="backg">본인 확인 자료 제출</span>이<br>완료되었습니다.</h2>

        <?php 
            } 
            else { 
        ?>

        <h2><span class="backg">학생증 제출</span>이<br>완료되었습니다.</h2>

        <?php 
            } 
        ?>

        <p style="margin-bottom:0;">현재 검토중이니 조금만 기다려주세요.<br>(약 12시간 ~ 1일 가량 소요됩니다.)</p>

        <div id="auth_confirm_btn">
            <div>
                <a href='auth' class="btn btn-primary" type="button">다시 제출하기</a>
            </div>
            <div>
                <a onclick='location.reload();' class="btn btn-primary" type="button">검토 여부 확인</a>
            </div>
        </div>

        <div id="auth_confirm_logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <a href="../login/member/logout.php" class="btn btn-primary" type="button">로그아웃</a>
        </div>

    </div>
</div>

<?php
    }
}

//웹페이지로 접속했을때만 팝업 표시
if ($_SERVER["HTTP_HOST"] == "stuzm.com") {

    //popup 쿠키가 비어있으면 표시
    if (@$_COOKIE['popup'] == "") {
        ?>

<div id="popup">
    <img id="popup_img" src="../assets/image/favicon.png">
    <div id="popup_title">더 빠르고 편리한<br>앱으로 사용해보세요</div>
    
    <a href="">
        <span id="popup_download">
            앱 설치
        </span>
    </a>

    <div id="popup_close">
        <a href="../close_cookie.php" class="a_web_link">24시간 동안 닫기</a>
        <a href="../close_cookie_1hr.php" class="a_web_link">닫기</a>
    </div>
</div>

<div class="modal_back"></div>

<?php 
        }
} 

if($load_account == false) {
    echo "<script>alert('비정상적 접근입니다.');location.href='../../login/member/logout.php';</script>";
}
?>

<!-- 구글 애널리틱스 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T9BERKPGHP"></script>
<script>
window.dataLayer = window.dataLayer || [];

function gtag() {
    dataLayer.push(arguments);
}
gtag('js', new Date());

gtag('config', 'G-T9BERKPGHP');
</script>

<!-- 로딩 페이지  -->
<div id="load">
    <img src="../../assets/image/Half circle.gif" alt="loading">
</div>

<script>
const loading_page = document.getElementById("load");
window.onload = function() {
    loading_page.style.display = 'none';
}
</script>
