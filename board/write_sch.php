<?php
    include "../db.php";
    include_once "../include/header_down.php";
    if(isset($_SESSION['userid'])){
    }else{
        echo "<script>location.href='../login';</script>"; 
        }
?>
<!DOCTYPE html>

<link rel="stylesheet" href="assets/write.css">

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
    <form action="post_sch/write_process.php" method="post">
        <header>
            <div id="nav" style="display: flex;">
                <div class="nav-item" id="nav-left" onclick="location.href='index.php'">취소</div>
                <div class="nav-item" style="color: black;">글쓰기</div>
                <div class="nav-item" id="nav-right"><input type="submit" value="게시"
                        style="border: none;padding: 0;background: none;color: rgb(141, 141, 141);font-weight: medium;" />
                </div>
            </div>
        </header>
        </div>
        <div class="gray-line"></div>
        <div id="title">
            <input type="text" class="frm" placeholder="제목을 입력해주세요" name="title" required>
        </div>
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
</body>

</html>