<?php
    include "../db.php";
    include_once "../include/header_down.php";
    if(isset($_SESSION['userid'])){
    }else{
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../login/index.php?redirect='.$nowUrl.'"</script>';
        }
?>
<!DOCTYPE html>
<link rel="stylesheet" href="assets/write.css">
<style>
.btn {
    padding: 6px !important;
}
</style>
</head>
<style>

</style>
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
    <form action="post/write_process.php" method="post">
        <header>
            <div id="nav" style="display: flex;">
                <div class="nav-item" id="nav-left" onclick="location.href='index.php'">취소</div>
                <div class="nav-item" class="bd" style="color: black;">글쓰기</div>
                <div class="nav-item" id="nav-right">
                    <button id="write_submit">게시</button>
                </div>
            </div>
        </header>
        </div>
        <div class="gray-line"></div>
        <div class="highschool">
            <input type="checkbox" id="hi-sel">
            <label id="flabel" for="hi-sel">카테고리를 선택해주세요</label>
            <div class="emoji">
                <input type="radio" id="highnum1" name="board" value="b_1" />
                <label for="highnum1" class="hi-label" onclick="highschool(0)">💬 수다</label>
                <input type="radio" id="highnum2" value="mysch" name="board" />
                <label for="highnum2" class="hi-label" onclick="highschool(1)">🏫 내 학교</label>
                <input type="radio" id="highnum3" value="b_2" name="board" />
                <label for="highnum3" class="hi-label" onclick="highschool(2)">📚 공부</label>
                <input type="radio" id="highnum4" value="b_3" name="board" />
                <label for="highnum4" class="hi-label" onclick="highschool(3)">🤔 고민</label>
                <input type="radio" id="highnum5" value="b_4" name="board" />
                <label for="highnum5" class="hi-label" onclick="highschool(4)">💕 연애</label>
                <input type="radio" id="highnum6" value="b_5" name="board" />
                <label for="highnum6" class="hi-label" onclick="highschool(5)">🎮 게임</label>
                <input type="radio" id="highnum7" value="b_6" name="board" />
                <label for="highnum7" class="hi-label" onclick="highschool(6)">🎵 음악</label>
                <input type="radio" id="highnum8" value="b_7" name="board" />
                <label for="highnum8" class="hi-label" onclick="highschool(7)">💪 스포츠</label>
                <input type="radio" id="highnum9" value="b_8" name="board" />
                <label for="highnum9" class="hi-label" value="b_8" onclick="highschool(8)"> 🖊️ 드라마</label>
            </div>
        </div>
        <div class="gray-line"></div>
        <div id="title">
            <input type="text" class="frm" placeholder="제목을 입력해주세요" name="title" required>
        </div>
        <div class="mb-3" id="textarea">
            <textarea style="width: 100%;min-height: 100vw;border: none;" name="content" class="frm"
                placeholder="내용을 입력해주세요" required></textarea>
    </form>


    <script>
    function highschool(x) {
        document.getElementById("flabel").innerHTML = document.getElementsByClassName("hi-label")[x].innerHTML
        document.getElementById("hi-sel").checked = false
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="todo.js"></script>
    </div>
</body>

</html>