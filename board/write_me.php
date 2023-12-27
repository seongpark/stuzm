<?php
    include "../db.php"; include_once "../include/header_down.php"; 

    if(isset($_SESSION['userid'])){
    }else{
        echo "<script>alert('비정상적인 접근입니다.');history.back();</script>"; 
        }

        $sql3 = mq("select * from member where id='{$_SESSION['userid']}'");
        while($member = $sql3->fetch_array()){
    
        $sch = $member['school'].$member['grade']."g".$member['room'];

        }
?>
<!DOCTYPE html>

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

    <div id="first_container" style="margin-top: 70px;">

        <?php
        $sql = mq("select * from board where userid='{$_SESSION['userid']}'  order by idx desc");
            while($board = $sql->fetch_array())
            {
              $title=$board["title"]; 
              if(strlen($title)>30)
              { 
                $title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
              }

              $content=$board["content"]; 
              if(strlen($content)>30)
              { 
                $content=str_replace($board["content"],mb_substr($board["content"],0,30,"utf-8")."...",$board["content"]);
              }
              
              $sql2 = mq("select * from reply where con_num='".$board['idx']."'");
              $rep_count = mysqli_num_rows($sql2);
        ?>

        <div id="community-list">
            <div class="write">
                <a href="read.php?idx=<?php echo $board['idx']; ?>" style="text-decoration: none;color: black;">
                    <div class="school-name"> <?php 
                            $sql5 = mq("select * from member where id='{$board['userid']}'");
                            while($bo_mem = $sql5->fetch_array()){
                                echo $bo_mem['school'];
                            }                
                ?> · <?php echo htmlentities("$board[name]"); ?> </div>
                    <div class="write-title"><?php echo htmlentities("$title"); ?></div>
                    <div class="write-discription"><?php echo htmlentities("$content"); ?></div>
                </a>
                <div class="write-tools">
                    <div class="tools-left"><span class="like-btn"><i class="fa-regular fa-comment lin"></i>
                            <?php echo $rep_count; ?></span>
                    </div>

                    <div class="tools-right"><?php echo $board['date']; ?><i class="fa-solid fa-eye li"></i>
                        <?php echo $board['hit'];?></div>

                </div>
            </div>
        </div>

        <?php } ?>

    </div>

    <div class="fixed-topp top">
        <div class="d_flex">
            <div id="logo">
                <span>내가 쓴 글</span>

            </div>

        </div>
    </div>

    <div style="height: 100px;"></div>
    <div class="fixed-bottom">
        <div class="line"></div>
        <div class="menu">
            <div class="d-flex justify-content-around" id="menu_middle" style="font-size: 0px;">
                <div OnClick="location.href ='../../'">
                    <span><i class="fa-solid fa-house" style="margin-bottom: 4px;"></i></span>

                    <center>
                        <span>홈</span>
                    </center>
                </div>

                <div OnClick="location.href ='../../board'">
                    <span><img class="menu_img" src="../../logo.svg" alt="" width="20px" srcset=""></span>

                    <center>
                        <span>커뮤니티</span>
                    </center>
                </div>
                <div OnClick="location.href ='../../friend'">
                    <span><i class="fa-solid fa-user-group" style="margin-bottom: 4px;"></i></span>
                    <center>
                        <span>친구</span>
                    </center>
                </div>
                <div OnClick="location.href ='../../school'">
                    <span><i class="fa-solid fa-school" style="margin-bottom: 4px;"></i></span>
                    <center>
                        <span>학교</span>
                    </center>
                </div>
                <div OnClick="location.href ='../../user'">
                    <span><i class="fa-solid fa-bars" style="margin-bottom: 4px;"></i></span>
                    <center>
                        <span>메뉴</span>
                    </center>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>



</html>