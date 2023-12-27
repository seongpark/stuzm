<?php
include "../../db.php";
$_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];
if (isset($_SESSION['userid'])) {
    $my_id = $_SESSION['userid'];
} else {
    echo "<script>alert('비정상적인 접근입니다.');location.href='../../login';</script>";
}

$bno = $_GET["idx"];
$sql_load_member = mq("select * from member where idx='{$bno}'");
while ($member = $sql_load_member->fetch_array()) {
    $send_id = $member["id"];
    $profile_idx = $member["idx"];
    $profile_name = $member["name"];
    $profile_school = $member["school"];
    $profile_grade = $member["grade"];
    $profile_room = $member["room"];
    $profile_access = $member["access"];
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <link rel="stylesheet" href="style.css">
    <?php include "../../include/header_down_down.php"; ?>
    <style>
    body {
        background-color: #fafafa;
    }

    .btn-outline-primary {
        border-radius: 50px;
    }

    .btn-outline-danger {
        border-radius: 50px;
    }
    </style>
</head>

<body>

    <div id="profile_first_container">
        <div id="center_card">
            <div id="profile_header">
                <div class="back_btn" style="padding-top:18px;">
                    <a onclick='history.back();'>
                        &#xE000;
                    </a>
                </div>
                <div id="profile_info">
                    <div id="profile_img"><img src="../../profile/img/<?php echo htmlentities("$profile_img"); ?>" />
                    </div>
                    <div id="profile_class" style="  margin-top: 6px;">
                        <div id="friend_name">
                            <?php echo htmlentities("$profile_name"); ?>
                        </div>
                        <div id="intro">
                            <?php
                            echo htmlentities("$profile_school") . " " . htmlentities("$profile_grade") . "학년 " . htmlentities("$profile_room") . "반";
                            if ($profile_access == "teacher") {
                                echo " (선생님)";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="container">
                <div id="ask">
                    <form action="new_ask.php?member=<?php echo $bno; ?>" method="post">
                        <div id="askk">
                            <div id="a_name"><input class="frm2" id="asker_name" name="name"
                                    placeholder="이름 (미입력시 익명)" /></div>
                            <textarea id="asker_content" class="frm2" name="content" placeholder="물어보고 싶은 질문을 적어보세요!"
                                required></textarea>
                            <div id="a_submit"><input id="asker_submit" type="submit" value="질문하기"></div>
                        </div>
                    </form>
                    <?php
                    $ask_load = mq("select * from ask where send_id='{$send_id}' order by idx desc");
                    while ($ask = $ask_load->fetch_array()) {

                        $ask_idx = $ask["idx"];
                    ?>

                    <div class="question">
                        <div class="question_top">
                            <div class="q_asker">
                                <div class="q_mark"><span>Q</span></div>
                                <div class="q_asker_name" style="margin-top:2px;">
                                    <?php echo htmlentities("$ask[name]"); ?>
                                </div>
                            </div>
                            <div class="q_date" style="margin-top:4px;">
                                <?php echo htmlentities("$ask[date]"); ?>
                            </div>
                        </div>
                        <div class="question_middle1">
                            <?php echo htmlentities("$ask[content]"); ?>
                        </div>
                        <?php if ($ask["send_id"] == $my_id) { ?>
                        <div class="d-flex flex-row-reverse" style="margin-right:18px;">
                            <div class="post_btn" style="font-size:8px;">
                                <a data-bs-toggle="modal" data-bs-target="#answer_<?php echo $ask["idx"] ?>"
                                    style="color:gray;"><i class="fa-solid fa-reply"></i></a>&nbsp;&nbsp;
                                <a href="delete.php?idx=<?php echo $ask["idx"]; ?>&profile=<?php echo $profile_idx; ?>"
                                    style="color:gray;"><i class="fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                        <?php } ?>


                        <!-- Modal -->

                        <div id="modalnew_answer_<?= $ask['idx']; ?>">
                            <div class="modal" id="modal_childnew_answer_<?= $ask['idx']; ?>">
                                <form action="reply_ask.php?idx=<?php echo $ask["idx"]; ?>" method="POST">
                                    <div class="modal_interface">
                                        <div class="modal_header">
                                            <div class="modal_title">
                                                답변하기
                                            </div>
                                            <div onclick="modal('new_answer_<?= $ask['idx']; ?>')" class="modal_close">
                                                <i class="fa-solid fa-xmark"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <?php echo htmlentities("$ask[content]"); ?>
                                            <div style="margin-top: 13px;">
                                                <input id="modal_reply_input<?= $ask['idx']; ?>" type="text"
                                                    class="form-control" name="content" placeholder="답변할 내용을 입력해주세요"
                                                    autocomplete="off" autofocus required>
                                            </div>
                                        </div>
                                        <div class="d_flex modal_btn">
                                            <button type="submit" class="modal_btn_item">답변하기</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal_back"></div>
                        </div>

                    </div>

                    <?php
                        if ($ask["answer"] == "1") {
                        ?>

                    <div class="question_middle2">
                        <div class="answer_1">
                            <div class="answer_img_div"><img class="answer_img"
                                    src="../../profile/img/<?php echo htmlentities("$profile_img"); ?>" /></div>
                            <div class="answer" style="margin-top:2px;">
                                <div class="answer_name">
                                    <?php echo htmlentities("$profile_name"); ?>
                                </div>
                                <div class="answer_content">
                                    <?php echo htmlentities($answer_content); ?>
                                </div>
                            </div>
                        </div>

                        <div class="answer_2">
                            <div class="vm_m_m downdrop_div">
                                <input class="downdrop_p" id="downdrop<?php echo $ask_idx; ?>" type="checkbox" />
                                <label for="downdrop<?php echo $ask_idx; ?>"><i id="top_dots"
                                        class="fa-solid fa-ellipsis-vertical"></i></label>
                                <div>
                                    <div
                                        onclick="delete_reply(<?= $answer_idx; ?>, <?= $profile_idx; ?>, <?= $ask_idx; ?>)">
                                        답변 삭제하기
                                    </div>
                                    <!--   <div onclick="location.href='report/index.php?idx=<?php echo $ask_load; ?>'">질문 신고하기</div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div style="height:15px;"></div>
                <?php
                    }
            ?>

            </div>
        </div>
    </div>

    <div style="height: 100px;"></div>
    <div style="height: 100px;"></div>
    <script src="../../downdrop.js"></script>
    <script src="../../modal.js"></script>
</body>

</html>