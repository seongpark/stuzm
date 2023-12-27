
$(document).keyup(function(event) {
    if (event.which === 13) {
        ajaxtest()
    }
});

function ajaxtest() {
    if ($("#reply_input").val() !== "") {
        $.ajax({
            type: "post",
            url: "reply<?php if($_GET["sch"] == "1") { echo "_sch"; } ?>/reply_process.php?idx=<?php echo $board['idx']; ?>&writer=<?php echo $board['userid']; ?>&title=<?php echo $board['title']?>",
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
                url: "comment_pro.php?idx=<?=$board['idx'];?><?php if($_GET['sch']) {echo '&sch=1';} ?>",
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
    if ($("#edit_input"+i).val() !== $("#check_value"+i).val()) {
        $.ajax({
            type: "post",
            url: "reply/reply_edit_process.php?idx=" + i + "&read=" + r,
            data: {
                content: $("#edit_input"+i).val()
            },
            success: function() {
                refreshAskContainer();
                alert('댓글 수정을 완료했습니다!')
            },
            error: function() {
                alert('댓글을 수정하는 데에 오류가 생겼습니다');
            }
        })
    }
    else {
        alert("댓글을 수정해주세요");
    }
}



setTimeout(() => {
    refreshAskContainer()
}, 0);

function refreshAskContainer() {
    $.ajax({
        url: "comment_pro.php?idx=<?=$board['idx'];?><?php if($_GET['sch']) {echo '&sch=1';} ?>",
    }).done(function(data) {
        $("#user_comment").html(data);
    })
}