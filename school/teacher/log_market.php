<!DOCTYPE html>
<html lang="ko">

<head>

    <?php 

    include "../../db.php";
    include "../../include/header_down_down.php"; 

    //비로그인 방지 및 세션 ID 변수 저장
    $_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

    if(isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
    }else{
        $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        echo '<script>location.href="../../login/index.php?redirect='.$nowUrl.'"</script>';
    }

    $sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
    while($member = $sql3->fetch_array()){
        //그룹 생성 감지
        $group_check_info = $member["school"].$member["grade"]."g".$member["room"];
        
        $group_check = mysqli_query($db, "select * from class_group where sch='$group_check_info'");
		$group_check = $group_check->fetch_array();
        
		if($group_check >= 1){
            //학생 감지
            if($member["access"] == "user") {
                echo '<script>location.href="../coinpage.php"</script>';
            }
		}else{
            if($member["access"] == "teacher") {
                echo '<script>location.href="../make.php"</script>';
            }else{
                echo '<script>location.href="../index.php"</script>';
            }
		}
    
    ?>
</head>

<body>

    <div id="coin_first_container">
        <div id="center_card">
            <div id="coin_header">
                <div class="back_btn">
                    <a href="market.php">
                        &#xE000;
                    </a>
                </div>
                <div id="coin_info">
                    구매 내역
                </div>

                <?php 
                                $have = "ㄴ";
                        //DB에서 정보 가져오기
            $sql_group_load = mysqli_query($db, "select * from market_buy where sch='{$group_check_info}' order by idx desc");
            while($group_list_load = $sql_group_load->fetch_array()) {
                $have = "ㅇㅇ";
                
                
                //이름 가져오기
                $sql_coin_name_load = mysqli_query($db, "select * from member where id='{$group_list_load["buyer"]}'");
                while($coin_name_load = $sql_coin_name_load->fetch_array()) {
                    $name = htmlentities($coin_name_load["name"]);

   //상품이름 가져오기
                            $sql_item_name_load = mysqli_query($db, "select * from group_maket where idx='{$group_list_load["market_idx"]}'");
                         while($item_name_load = $sql_item_name_load->fetch_array()) {
                                       $item_name = $item_name_load["title"];
                                       $item_deatil = $item_name_load["detail"];
                                          }
                }
        ?>

                <div class="standbyitem">
                    <div class="bold">
                        <span><?php echo htmlentities("$name"); ?> |
                            <?php if($item_name == "") { echo "삭제된 상품"; }else {echo htmlentities("$item_name"); }?></span>

                    </div>
                    <div style="margin-top:7px;">

                        <?php if($item_deatil == "") { echo "삭제된 상품"; }else {echo htmlentities("$item_deatil"); }?>

                    </div>

                    <div class="d_flex coin_btn">
                        <div class="accept" onclick='end_<?php echo $group_list_load["idx"];?>()'>
                            사용 완료</div>


                        <script>
                        function end_<?php echo $group_list_load['idx'];?>() {
                            if (!confirm("사용 완료 처리를 하시겠습니까?")) {

                            } else {
                                location.href = '../process/end.php?idx=<?php echo $group_list_load['idx'];?>'
                            }
                        }
                        </script>
                    </div>
                </div>

                <?php } 
                
                if($have == "ㄴㄴ") {
                    echo "구매 내역이 없습니다.";
                }
                ?>


            </div>
        </div>
    </div>

</body>

</html>

<?php } ?>