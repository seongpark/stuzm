<?php   
	include_once "../db.php"; 

  if(isset($_SESSION['userid'])){
  echo "<script>location.href='../'</script>";}else{}

  @$redirectUrl = mysqli_real_escape_string($db, $_GET['redirect']);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STUZM</title>
    <meta name="viewport" content="initial-scale=1.0,user-scalable=no,maximum-scale=1,width=device-width" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../assets/style/style.css">
    <link href='//spoqa.github.io/spoqa-han-sans/css/SpoqaHanSansNeo.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../assets/image/favicon.png" type="image/x-icon">
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


    <div id="first_container">
        <div id="center_card">
            <div>
                <div id="login_box1">
                    <h1 id="login_title">학생들을 위한 최고의 앱<br>STUZM 🤟 </h1>
                    <div id="login_img"><img src="../favicon.png" /></div>
                </div>
                <div id="login_box2">
                    <form method="post"
                        action="member/login_process.php?redirect=<?php echo htmlentities("$redirectUrl");?>"
                        id="login_form">
                        <div class="input">
                            <label for="id_input">아이디</label>
                            <input class="input_tag" type="text" id="id_input" name="userid" autocomplete="off"
                                required>
                        </div>
                        <div class="input">
                            <label for="pw_input">비밀번호</label>
                            <div id="pw">
                                <input class="input_tag" type="password" id="pw_input" name="userpw" required>
                                <i onclick="pw_eye()" id="pw_eye" class="fa-sharp fa-solid fa-eye"></i>
                            </div>
                        </div>
                        <div id="fixed-bottom">
                            <center>
                                <span id="j_p_1"><a href="join/term.php">회원가입</a> · <a href="member/account_find.php">계정
                                        찾기</a></span>
                                <button id="submit_btn" type="submit">로그인</button>
                                <span id="j_p_2"><a href="join/term.php">회원가입</a> · <a href="member/account_find.php">계정
                                        찾기</a></span>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../pw_eye.js"></script>
</body>

</html>