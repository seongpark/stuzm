<?php

include "db.php";

function getIdAccount($db, $targetId, $targetInfo) {
    $escapeTarget = mysqli_real_escape_string($db, $targetId);
    $escapeInfo = mysqli_real_escape_string($db, $targetInfo);

    $sql = mysqli_query($db, "SELECT * FROM member WHERE id='{$escapeTarget}'");
    $row = mysqli_fetch_array($sql);

    return $row[$escapeInfo];
}

echo getIdAccount($db, "seongpark", "name");