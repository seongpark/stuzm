<!DOCTYPE html>
<?php
include "../db.php";
include_once "../include/header_down.php";
?>
<?php

if (@$_GET['idx'] == "") {
    $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo '<script>location.href="../login/index.php?redirect=' . $nowUrl . '"</script>';
}

$sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
while ($member = $sql3->fetch_array()) {

    $sch = $member['school'];
    $sch_board = $member['school'] . "b_1";

}



if (isset($_SESSION['userid'])) {
} else {
    $nowUrl = "http" . (isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo '<script>location.href="../login/index.php?redirect=' . $nowUrl . '"</script>';
}
$bno = mysqli_real_escape_string($db, $_GET['idx']);
$hit = mysqli_fetch_array(mysqli_query($db, "select * from board where idx ='" . $bno . "'"));
$hit = $hit['hit'] + 0.5;

$fet = mysqli_query($db, "update board set hit = '" . $hit . "' where idx = '" . $bno . "'");

if (@$_GET["sch"] == "1") {
    $sql = mysqli_query($db, "select * from board_sch where idx='" . $bno . "'");
} else {
    $sql = mysqli_query($db, "select * from board where idx='" . $bno . "'");
}
$board = $sql->fetch_array();

$sql2 = mysqli_query($db, "select * from reply where con_num='" . $bno . "'");
$rep_count = mysqli_num_rows($sql2);

if (@$_GET["sch"] == "1") {
    $sql = mysqli_query($db, "select * from board_sch where idx='" . $bno . "'");
} else {
    $sql = mysqli_query($db, "select * from board where idx='" . $bno . "'");
}

if (@$_GET["sch"] == "1") {
    $postcheecksql = mysqli_query($db, "select * from board_sch where idx='$bno'");
} else {
    $postcheecksql = mysqli_query($db, "select * from board where idx='$bno'");
}
$postcheecksql = $postcheecksql->fetch_array();
if ($postcheecksql >= 1) {
} else {
    echo "<script>alert('존재하지 않는 글입니다.');history.back();</script>";
}

?>

<link rel="stylesheet" href="assets/read.css">
<link rel="stylesheet" href="style.css">

</head>

<body>
    <div id="read_first_container">
        <div id="center_card">
            <div class="fixed-topp top d_flex space_between" style="border-bottom: 1px solid #f2f2f2">
                <div class="vm_m_m" id="read_fixed_right">
                    <a href="../board">
                        &#xE000;
                    </a>
                </div>

                <div class="vm_m_m" style="font-size: 1.2rem;vertical-align: middle;">
                    <?php
                    if ($board["board"] == "b_1") {
                        echo '💬 수다';
                    } elseif ($board["board"] == "b_2") {
                        echo '📚 공부';
                    } elseif ($board["board"] == "b_3") {
                        echo "🤔 고민";
                    } elseif ($board["board"] == "b_4") {
                        echo "💕 연애";
                    } elseif ($board["board"] == "b_5") {
                        echo "🎮 게임";
                    } elseif ($board["board"] == "b_6") {
                        echo "🎵 음악";
                    } elseif ($board["board"] == "b_7") {
                        echo "💪 스포츠";
                    } elseif ($board["board"] == "b_8") {
                        echo "🖊️ 드라마";
                    } elseif (@$_GET["sch"] == "1") {
                        echo "🏫 내 학교";
                    }
                    ?>
                </div>
                <div id="read_fixed_left" class="vm_m_m">
                    <input class="downdrop_p" id="downdrop1" type="checkbox" />
                    <label for="downdrop1"><i id="top_dots" class="fa-solid fa-ellipsis"></i></label>
                    <div>
                        <?php
                        if (@$_GET["sch"] == "1") {
                            echo '<div><a href="report_sch/index.php?idx=' . $bno . '">신고하기</a></div>';
                        } else {
                            echo '<div><a href="report/index.php?idx=' . $bno . '">신고하기</a></div>';
                        }
                        ?>

                        <?php if ($board["userid"] == $_SESSION['userid']) {
                        } else { ?>
                        <div><a href=" report/block.php?idx=<?= $board['idx']; ?>">작성자 차단하기</a></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div id="write">
            <div>
                <div id="title">
                    <?php echo htmlentities("$board[title]"); ?>
                </div>
                <div id="subtitle"><span>
                        <?php echo $board['date']; ?>
                    </span><span style="margin-left: 6px;">
                        <?php
                        $sql5 = mysqli_query($db, "select * from member where id='{$board['userid']}'");
                        while ($bo_mem = $sql5->fetch_array()) {
                            echo $bo_mem['school'];
                        }
                        ?>
                        ·
                        <?php echo htmlentities("$board[name]"); ?>
                    </span>
                </div>
            </div>
            <div id="description">
                <?php
                $content = htmlentities("$board[content]");

                $pattern = '/(https?:\/\/[^\s]+)/';
                $content = preg_replace($pattern, '<a href="$1">$1</a>', $content);

                echo nl2br($content);
                ?>

            </div>

            <?php
$userId = mysqli_real_escape_string($db, $_COOKIE['userid']);
$boardIdx = (int)$board["idx"];

$sql = "SELECT * FROM heart_board WHERE board_idx = $boardIdx AND userid='$userId'";
$result = mysqli_query($db, $sql);

$have = false;
if ($result) {
    $have = mysqli_num_rows($result) > 0;
}

$countSql = "SELECT COUNT(*) AS count FROM heart_board WHERE board_idx = $boardIdx";
$countResult = $db->query($countSql);

$count = 0;
if ($countResult && $countResult->num_rows > 0) {
    $row = $countResult->fetch_assoc();
    $count = $row["count"];
}

$heartColor = $have ? 'FA5858' : '848484';
$heartStyle = $have ? 'solid' : 'regular';

$actionUrl = $have ? 'heart_process/delete.php' : 'heart_process/new.php';

?>

<!-- 공감 -->
<center>
    <div class="heart" onclick="location.href='<?php echo $actionUrl; ?>?idx=<?php echo $boardIdx; ?>'">
        <i style="color:#<?php echo $heartColor; ?>;" class="fa-<?php echo $heartStyle; ?> fa-heart"></i>&nbsp;<?php echo $count; ?>
    </div>
</center>
1

            <br>
            <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-Ei3wetzpHkXPILTR" data-ad-width="320"
                data-ad-height="100"></ins>
            <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>

            <div class="write-tools">

                <div class="tools-left">
                    <!--
                    <span class="like-btn" onclick="liked(0)">
                        <i class="fa-regular fa-comment"></i>
                        <?php echo $rep_count; ?>
                    </span>
                     -->
                </div>

                <?php
                if ($board["userid"] == $_SESSION['userid']) {
                    ?>
                <div class="tools-right">
                    <a onclick="test()">
                        <i class="fa-regular fa-trash-can"></i>
                    </a>
                    <a href="post<?php if ($_GET["sch"] == "1") {
                            echo "_sch";
                        } ?>/edit.php?idx=<?php echo $board['idx']; ?>">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                </div>

                <script>
                function test() {
                    if (!confirm("정말로 글을 삭제하시겠습니까?")) {} else {
                        window.location.href =
                            'post<?php if ($_GET["sch"] == "1") {
                                        echo "_sch";
                                    } ?>/delete.php?idx=<?php echo $board['idx']; ?>';
                    }
                }
                </script>

                <?php } ?>
            </div>
        </div>
    </div>

    <!--댓글-->
    <div id="comments">
        <span id="user_comment"></span>
        <div id="kakao_ad">
            <ins class="kakao_ad_area" style="display:none;" data-ad-unit="DAN-HICvnnJ1mkyQPhXg" data-ad-width="160"
                data-ad-height="600"></ins>
            <script type="text/javascript" src="//t1.daumcdn.net/kas/static/ba.min.js" async></script>
        </div>
    </div>
    <div class="fixed_bottom">

        <div class="reply_form">
            <div class="d_flex">
                <input class="reply_input" id="reply_input" type="text" autocomplete="off" placeholder="새 댓글 작성"
                    name="content" required>
                <div id="btn">
                    <button type="submit" onclick="ajaxtest()" class="reply_btn va_m_m">
                        <i class="fa-solid fa-arrow-up" id="up_arrow"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div style="height:100px;"></div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
    $(document).keyup(function(event) {
        if (event.which === 13) {
            ajaxtest()
        }
    });

    function ajaxtest() {
        if ($("#reply_input").val() !== "") {
            $.ajax({
                type: "post",
                url: "reply<?php if ($_GET["sch"] == "1") {
                        echo "_sch";
                    } ?>/reply_process.php?idx=<?php echo $board['idx']; ?>&writer=<?php echo $board['userid']; ?>&title=<?php echo $board['title'] ?>",
                data: {
                    content: $("#reply_input").val()
                },
                success: function() {
                    refreshAskContainer();
                },
                error: function() {
                    alert('댓글을 등록하는 데에 오류가 생겼습니다');
                }
            })
            $("#reply_input").val('');
            setTimeout(() => {
                $.ajax({
                    url: "comment_pro.php?idx=<?= $board['idx']; ?><?php if ($_GET['sch']) {
                              echo '&sch=1';
                          } ?>",
                }).done(function(data) {
                    $("#user_comment").html(data);
                })
            }, 100);
        } else {
            alert('댓글을 입력해주세요!');
        }
    }

    function reply_delete(i, r) {
        if (confirm("정말 삭제하시겠습니까?")) {
            $.ajax({
                type: "get",
                url: "reply/reply_delete.php",
                data: {
                    idx: i,
                    read: r
                },
                success: function() {
                    refreshAskContainer();
                },
                error: function() {
                    alert('댓글을 삭제하는 데에 오류가 생겼습니다');
                }
            })
        }
    }

    function reply_edit(i, r, v) {
        if ($("#edit_input" + i).val() !== $("#check_value" + i).val()) {
            $.ajax({
                type: "post",
                url: "reply/reply_edit_process.php?idx=" + i + "&read=" + r,
                data: {
                    content: $("#edit_input" + i).val()
                },
                success: function() {
                    refreshAskContainer();
                    alert('댓글 수정을 완료했습니다!')
                },
                error: function() {
                    alert('댓글을 수정하는 데에 오류가 생겼습니다');
                }
            })
        } else {
            alert("댓글을 수정해주세요");
        }
    }

    setTimeout(() => {
        refreshAskContainer()
    }, 0);

    function refreshAskContainer() {
        $.ajax({
            url: "comment_pro.php?idx=<?= $board['idx']; ?><?php if ($_GET['sch']) {
                      echo '&sch=1';
                  } ?>",
        }).done(function(data) {
            $("#user_comment").html(data);
        })
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

</body>

</html>