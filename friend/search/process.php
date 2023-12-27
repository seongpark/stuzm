<?php 
    include "../../db.php";
    include "../../include/header_down_down.php";
    
    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }else{
        echo "<script>location.href='login';</script>"; 
        }

        $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
        while($member = $sql3->fetch_array()){
    
        $sch = $member['school'].$member['grade']."g".$member['room'];
    
        }

    $option = mysqli_real_escape_string($db, $_POST["option"]);
    $value = mysqli_real_escape_string($db, $_POST["value"]);
?>

<div id="i_first_container">
    <div id="center_card">
        <div id="i_header">
            <div class="back_btn">
                <a href="index.php">
                    &#xE000;
                </a>
            </div>

            <div id="i_info">
                검색 결과
            </div>

            <?php

            if($option == "id") {
                $sql8 = mysqli_query($db, "select * from member where handle like '%$value%' "); 
            }
            elseif($option == "name") {
                $sql8 = mysqli_query($db, "select * from member where name like '%$value%' "); 
            }
            $friendhave = false;
            while($friend = $sql8->fetch_array())
            {

                $friendhave = true;
        ?>

            <div class="d_flex r_friend">
                <div class="friend_list">
                    <div class="d_flex" OnClick="location.href ='../profile/index.php?idx=<?= $friend["idx"];?>'">
                        <img class="friend_profile"
                            src="../../profile/img/<?= htmlentities($friend["profile_image"]); ?>">
                    </div>
                </div>
                <div>
                    <div><?php echo htmlentities("$friend[name]");?>
                        <span style="color:gray;">@<?php echo htmlentities("$friend[id]");?></span>
                    </div>
                    <div style="margin-top:1.5px;">
                        <?php echo htmlentities("$friend[school]");?>
                        <?php echo htmlentities("$friend[grade]");?>학년
                        <?php echo htmlentities("$friend[room]");?>반</div>
                </div>

            </div>
            <?php } ?>
            <?php 
            if($friendhave == false) {
                echo "<br><center>검색 결과가 없어요.</center><div class='mb-3'></div>";
            }
            ?>
        </div>

        <div id="upload-fixed-bottom">
            <button id="upload_btn" onclick="location.href='index.php'">다시 검색하기</button>
        </div>