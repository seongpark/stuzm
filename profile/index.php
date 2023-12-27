<?php
include "../../db.php";
$_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];

if (isset($_SESSION['userid'])) {
    $my_id = $_SESSION['userid'];
} else {
    $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo '<script>location.href="../../login/index.php?redirect='.$nowUrl.'"</script>';
}

$bno = htmlentities($_GET["idx"]);

$postcheecksql = mysqli_query($db, "select * from member where idx='{$bno}'");
$num_rows = mysqli_num_rows($postcheecksql);
if ($num_rows >= 1) {
} else {
    echo "<script>alert('존재하지 않는 페이지입니다.');history.back();</script>";
    exit;
}

$sql_load_member = mysqli_query($db, "select * from member where idx='{$bno}'");
while ($member = $sql_load_member->fetch_array()) {
    $send_id = $member["id"];
    $profile_idx = $member["idx"];
    $profile_name = $member["name"];
    $profile_school = $member["school"];
    $profile_grade = $member["grade"];
    $profile_room = $member["room"];
    $profile_access = $member["access"];
    $profile_img = $member["profile_image"];
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <link rel="stylesheet" href="style.css">
    <?php include "../../include/header_down_down.php"; ?>
    <style>
    .btn-outline-primary {
        border-radius: 50px;
    }

    .btn-outline-danger {
        border-radius: 50px;
    }

    .back_btn>a {
        color: #fff;
    }
    </style>
</head>

<body>
    <div id="profile_first_container">
        <div id="center_card">
            <div id="profile_header">
                <div class="back_btn" style="padding-top:18px;">
                    <a onclick='location.href="../";'>
                        &#xE000;
                    </a>
                </div>
                <div id="profile_info">
                    <div id="profile_img"><img src="../../profile/img/<?php echo htmlentities("$profile_img"); ?>" />
                    </div>
                    <div id="profile_class" style="margin-top:5px;">
                        <div id="friend_name">
                            <?php echo htmlentities("$profile_name"); ?> &nbsp;

                            
                        </div>
                        <div id="intro">
                            <?php
                            if($profile_grade == "") {
                                echo htmlentities("$profile_school");
                            }else{
                            echo htmlentities("$profile_school") . " " . htmlentities("$profile_grade") . "학년 " . htmlentities("$profile_room") . "반";
                            if ($profile_access == "teacher") {
                                echo " (선생님)";
                            }
                        }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="container">
                <div id="ask">
                    <div id="askk">
                        <div id="a_name"><input autocomplete="off" class="frm2" id="asker_name" name="name"
                                placeholder="이름 (미입력시 익명)" />
                        </div>
                        <textarea id="asker_content" class="frm2" name="content" placeholder="새 질문을 등록해 보세요!"
                            required></textarea>
                        <div id="a_submit"><button id="asker_submit" onclick="ask_function()">등록하기</button></div>
                    </div>
                </div>


                <?php 
                if($send_id == $my_id) {
                ?>

                <!-- 여기부터 계정 주인 인터페이스 -->
                <div id="header_selection" style="margin: 23px 0px 22px;" class="d_flex">
                    <a class="<?php if(@$_GET["type"] == "waiting") { echo "header_none_active"; } else { echo "header_active"; } ?>" href="index.php?idx=<?= $bno; ?>">
                        <div>답변된 질문</div>
                    </a>
                    <a class="<?php if(@$_GET["type"] == "waiting") { echo "header_active"; } else { echo "header_none_active"; } ?>" href="index.php?idx=<?= $bno; ?>&type=waiting">
                        <div>대기중 질문</div>
                    </a>
                </div>

            <?php } ?>
                <!-- 여기부터 사용자 인터페이스 -->
                <div id="ask_count">
                    <div>
                        <div class="count_text">답변된 질문</div>
                        <div class="count">
                            <?php 
                                $sql = "SELECT COUNT(*) AS count FROM ask where send_id='$my_id' and answer='1'";
                                $result = $db->query($sql);     
                                
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $recordCount = $row["count"];
                                    echo $recordCount;
                                } else {
                                    echo "0";
                                }
                            ?>
                        </div>
                    </div>
                    <div id="vertical_line"></div>
                    <div>
                        <div class="count_text">대기중 질문</div>
                        <div class="count">
                            <?php 
                                $sql = "SELECT COUNT(*) AS count FROM ask where send_id='$my_id' and answer='0'";
                                $result = $db->query($sql);     
                                
                                if ($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                                    $recordCount = $row["count"];
                                    echo $recordCount;
                                } else {
                                    echo "0";
                                }
                            ?>
                        </div>
                    </div>
                </div>


                <div id="ask_container"></div>
            </div>
        </div>
    </div>
    <div style="height: 100px;"></div>
    <script src="../../downdrop.js"></script>
    <script src="../../modal.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script>
    function ask_function() {
        if ($("#asker_content").val() !== "") {
            $.ajax({
                type: "post",
                url: "new_ask.php?member=<?= $bno; ?>",
                data: {
                    name: $("#asker_name").val(),
                    content: $("#asker_content").val()
                },
                success: function() {
                    $("#asker_name").val('');
                    $("#asker_content").val('');
                    alert('질문이 등록 되었습니다!');
                    refreshAskContainer();
                },
                error: function() {
                    alert('질문 등록에 실패했습니다!');
                }
            });
        } else {
            alert('질문을 입력해 주세요!');
        }
    }

    function reply_ask(x) {
        if ($("#modal_reply_input" + x).val() !== "") {
            $.ajax({
                type: "post",
                url: "reply_ask.php?idx=" + x,
                data: {
                    content: $("#modal_reply_input" + x).val()
                },
                success: function(data) {
                    $("#modal_reply_input" + x).val('');
                    alert('답변이 등록 되었습니다!');
                    console.log(data); // 서버에서 받은 응답을 콘솔에 출력
                    refreshAskContainer();
                    document.body.style.overflow = "visible";
                    document.body.style.touchAction = "auto";
                },
                error: function(xhr, status, error) {
                    alert('답변을 등록하는 도중 오류가 발생했습니다.');
                    console.log(xhr.responseText); // 오류 응답을 콘솔에 출력
                    console.log(status);
                    console.log(error);
                }
            });
        } else {
            alert('답변을 입력해 주세요!');
        }
    }


    function delete_ask(p) {
        if (confirm("정말 삭제하시겠습니까?")) {
            $.ajax({
                type: "post",
                url: p,
                success: function() {
                    refreshAskContainer();
                },
                error: function() {
                    alert('삭제에 실패했습니다.');
                }
            });
        }
    }

    function delete_reply(x, y, z) {
        if (confirm("정말 삭제하시겠습니까?")) {
            $.ajax({
                type: "get",
                url: "answer_delete.php",
                data: {
                    idx: x,
                    profile: y,
                    original: z
                },
                success: function() {
                    refreshAskContainer();
                },
                error: function() {
                    alert('답변 삭제에 실패했습니다!');
                }
            });
        }
    }

    <?php
        if(@$_GET["type"] == "waiting") {
    ?>
    function refreshAskContainer() {
        $.ajax({
            url: "ask_ajax_process.php?idx=<?= $bno ?>&type=waiting"
        }).done(function(data) {
            $("#ask_container").html(data);
        });
    }
    <?php }else { ?>
        function refreshAskContainer() {
        $.ajax({
            url: "ask_ajax_process.php?idx=<?= $bno ?>"
        }).done(function(data) {
            $("#ask_container").html(data);
        });
    }
    <?php } ?>

    setTimeout(() => {
        refreshAskContainer();
    }, 0);
    </script>
</body>

</html>