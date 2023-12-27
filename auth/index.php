<?php
include_once "../db.php";

$_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

$sql = mysqli_query($db, "select * from member where id='{$_COOKIE['userid']}'");
$member = $sql->fetch_array();
?>

<head>
    <meta charset="UTF-8">
    <title>STUZM</title>
    <link rel="stylesheet" href="../login/style.css?ver=2">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="../favicon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .container {
        width: 95%;
    }
    </style>
</head>
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

<body>
    <div class="container">
        <?php if ($member["access"] == "teacher") {
            ?>
        <div class="title_auth">선생님 인증</div>
        <div class="description_auth">재직증명서, 채용증명서, 학교장 확인서 등 선생님을 확인할 수 있는 어떤 자료든 가능합니다.</div>
        <?php
        } else { ?>
        <div class="title_auth">학생증 인증</div>
        <div class="description_auth">본인 확인을 위해 인증이 필요합니다.</div>
        <?php } ?>
        <br>
        <span style="color:gray; font-size:14px;"> · 제출 서류에는 학교, 이름이 나와있어야 하고 가입 시 입력한 정보와 일치해야 해요.<br>
            · 꼭 주민등록번호 뒷자리 등 민감한 정보는 꼭 가리고 올려주세요!<br>
            · 만약 부적절한 방법(도용 등)을 사용한 것이 적발되면 인증이 취소돼요.<br>
            · 만약 인증이 어려우시다면 고객센터로 문의해주세요. 인증을 도와드릴께요. <br>
            · 증명 서류 제출 메일은 <b>auth@stuzm.com</b>입니다.</span>
        <div id="auth_confirm_logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <a href="../login/member/logout.php" class="btn btn-primary" type="button">로그아웃</a>
        </div>
        <div id="upload-fixed-bottom">
            <button id="upload_btn" onclick="location.href='mailto:auth@stuzm.com'">이메일로 증명 서류 제출</button>
        </div>
    </div>

</body>

</html>