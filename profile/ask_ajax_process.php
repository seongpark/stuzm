<?php
include "../../db.php";
$_SESSION["userid"] = $_COOKIE['userid'];
$_SESSION["userpw"] = $_COOKIE['userpw'];
if (isset($_SESSION['userid'])) {
    $my_id = $_SESSION['userid'];
} else {
    echo "<script>alert('비정상적인 접근입니다.');location.href='../../login';</script>";
}
$bno = htmlentities($_GET["idx"]);


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

if($_COOKIE["userid"] == $send_id) {
    if(@$_GET ["type"] == "waiting") {
        $ask_load = mysqli_query($db, "select * from ask where send_id='{$send_id}' and answer='0' order by idx desc");
    }else {
        $ask_load = mysqli_query($db, "select * from ask where send_id='{$send_id}' and answer='1' order by idx desc");
    }
}else {
    $ask_load = mysqli_query($db, "select * from ask where send_id='{$send_id}' order by idx desc");
}

while ($ask = $ask_load->fetch_array()) {

    $ask_idx = $ask["idx"];

    $view_ok = true;
    
    if ($ask["answer"] == 0) {
        if ($ask["send_id"] == $my_id) {
            $view_ok = true;
        } else {
            $view_ok = false;
        }
    }
    if ($ask["userid"] == $my_id) {
        $view_ok = true;
    }   

    if ($view_ok == true) {
?>

<!-- 여기부터 질문 하나 -->
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
    <?php
            if ($ask["answer"] == "1") {
                $sql_ask_answer = mysqli_query($db, "select * from ask_answer where original_ask='{$ask_idx}'");
                while ($ask_answer = $sql_ask_answer->fetch_array()) {
                    $answer_idx = $ask_answer["idx"];
                    $answer_content = $ask_answer["content"];
                }
             ?>
    <div class="question_middle2">
        <div class="answer_1">
            <div class="answer_img_div"><img class="answer_img"
                    src="../../profile/img/<?php echo htmlentities("$profile_img"); ?>" /></div>
            <div class="answer" style="margin-top:2px;">
                <div class="answer_name">
                    <?php echo htmlentities($profile_name); ?>
                </div>
                <div class="answer_content">
                    <?php echo htmlentities($answer_content); ?>
                </div>
            </div>
        </div>

        <?php if ($ask["send_id"] == $my_id) { ?>
        <div class="answer_2">
            <div class="vm_m_m downdrop_div">
                <input class="downdrop_p" id="downdrop<?=$ask_idx; ?>" type="checkbox" />
                <label for="downdrop<?=$ask_idx; ?>"><i id="top_dots" class="fa-solid fa-ellipsis-vertical"></i></label>
                <div>
                    <div onclick="delete_reply(<?= $answer_idx; ?>, <?= $profile_idx; ?>, <?= $ask_idx; ?>)">답변 삭제하기
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php 
            } else { ?>


    <?php if ($ask["send_id"] == $my_id) { ?>

    <div class="question_bottom">
        <div class="answer_btn share_btn" onclick="modal('new_answer_<?= $ask['idx']; ?>')">답변하기</div>
        <div class="answer_btn_between"></div>
        <div class="answer_btn delete_btn"
            onclick="delete_ask('delete.php?idx=<?= $ask['idx']; ?>&profile=<?= $profile_idx ?>')">
            삭제하기</div>
    </div>



    <!-- ask 답변 Modal -->

    <div id="modalnew_answer_<?= $ask['idx']; ?>">
        <div class="modal" id="modal_childnew_answer_<?= $ask['idx']; ?>">
            <div class="modal_interface">
                <div class="modal_header">
                    <div class="modal_title">
                        답변하기
                    </div>
                    <div onclick="modal('new_answer_<?= $ask['idx']; ?>')" class="modal_close"><i
                            class="fa-solid fa-xmark"></i>
                    </div>
                </div>
                <div>
                    <?php echo htmlentities("$ask[content]"); ?>
                    <div style="margin-top: 13px;">
                        <input id="modal_reply_input<?= $ask['idx']; ?>" type="text" class="form-control" name="content"
                            placeholder="답변할 내용을 입력해주세요" autocomplete="off" autofocus required>
                    </div>
                </div>
                <div class="d_flex modal_btn">
                    <button onclick="reply_ask(<?= $ask['idx']; ?>)" class="modal_btn_item">답변하기</button>
                </div>
            </div>
        </div>
        <div class="modal_back"></div>
    </div>
</div>


<?php
                }
            }
        }
    }
?>