<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
include "../db.php";

$sql3 = mysqli_query($db, "select * from member where id='{$_SESSION['userid']}'");
while ($member = $sql3->fetch_array()) {

    $sch = $member['school'];
    
}

$bno = mysqli_real_escape_string($db, $_GET['idx']);

if (@$_GET["sch"] == "1") {
    $sql = mysqli_query($db, "select * from board_sch where idx='" . $bno . "'");
    $hit = mysqli_fetch_array(mysqli_query($db, "select * from board_sch where idx ='" . $bno . "'"));
} else {
    $sql = mysqli_query($db, "select * from board where idx='" . $bno . "'");
    $hit = mysqli_fetch_array(mysqli_query($db, "select * from board where idx ='" . $bno . "'"));
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
    $postchecksql = mysqli_query($db, "select * from board_sch where idx='" . $bno . "'");
} else {
    $postchecksql = mysqli_query($db, "select * from board where idx='$bno'");
}
$postchecksql = $postchecksql->fetch_array();

?>

<!--댓글-->
<link rel="stylesheet" href="assets/read.css">
<?php
if (@$_GET["sch"] == "1") {
    $cum = $bno;
    $sql3 = mysqli_query($db, "select * from reply_sch where con_num='" . $cum . $sch . "' order by idx desc");
} else {
    $sql3 = mysqli_query($db, "select * from reply where con_num='" . $bno . "' order by idx desc");
}
while ($reply = $sql3->fetch_array()) {
    ?>
<div class="comment">
    <div class="comment-header">
        <span class="name">
            <?php
                $sql6 = mysqli_query($db, "select * from member where id='{$reply['userid']}'");
                if ($sql6) {
                    $re_mem = $sql6->fetch_array();
                    if ($re_mem) {
                        echo $re_mem['school'];
                    }
                }
                ?>·
            <?php echo htmlentities("$reply[name]"); ?>
        </span>
        <span style="margin-left: 8px;">
            <?php echo $reply["date"]; ?>
        </span>
    </div>
    <div class="comment-description">
        <?php echo htmlentities("$reply[content]"); ?>
    </div>
    <?php
        if ($_SESSION['userid'] == $reply['userid']) {
            ?>
    <a onclick="modal('edit_<?= $reply['idx']; ?>')">수정</a> · <span
        onclick='reply_delete(<?= $reply["idx"] ?>, <?= $bno ?>)'>삭제</span>

    <div id="modaledit_<?= $reply['idx'] ?>">
        <div class="modal" id="modal_childedit_<?= $reply['idx'] ?>">
            <div class="modal_interface">
                <div class="modal_header">
                    <div class="modal_title">댓글 수정</div>
                    <div onclick="modal('edit_<?= $reply['idx']; ?>')" class="modal_close">
                        <img style="width: 20px;" src="../icon_img/x_mark.jpg">
                    </div>
                </div>
                <div>
                    <div>
                        <input type="text" class="form-control" id="edit_input<?= $reply["idx"]; ?>" name="content"
                            placeholder="댓글 수정" value="<?php echo htmlentities(" $reply[content]"); ?>" required>
                        <input id="check_value<?= $reply["idx"]; ?>" value="<?php echo htmlentities(" $reply[content]");
                                  ?>" style="display: none;" required>
                    </div>
                </div>
                <div class="d_flex modal_btn">
                    <button class="modal_btn_item" onclick='reply_edit(<?= $reply["idx"]; ?>, <?= $bno; ?>)'>등록</button>
                </div>
                </form>
            </div>
        </div>
        <div class="modal_back"></div>
    </div>

    <?php } ?>
</div>
<?php } ?>

<script src="../modal.js"></script>