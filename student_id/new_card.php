<?php 
    include "../db.php";
    include "../include/header_down.php";
?>
</head>
<body>
    <div id="first_container">
        <div class="back_btn">
            <a href="index.php">&#xE000;</a>
        </div>
        <h3>새로운 학생증을 등록합니다.</h3>
        <img src="card_new_exam.png" alt="" srcset="" width="100%">
        <br><br>
        <label class="user_info_label">바코드값을 입력해주세요. <br>(대부분의 학생증에서 바코드 아래 있습니다.)</label>

        <form action="process.php" method="post">
            <input class="user_info_input" type="text" name="code" placeholder="" required>
            <button type="submit" class="coin_appl" style="border:0;">완료</button>
        </form>
    </div>
</body>
</html>