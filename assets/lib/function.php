<?php

include "../../db.php";

function getIdAccount($db, $targetWhere, $target, $targetInfo) {
    $escapeTarget = mysqli_real_escape_string($db, $target);
    $escapeInfo = mysqli_real_escape_string($db, $targetInfo);
    $escapeWhere = mysqli_real_escape_string($db, $targetWhere);

    $sql = mysqli_query($db, "SELECT * FROM member WHERE {$escapeWhere}='{$escapeTarget}'");
    $row = mysqli_fetch_array($sql);

    return $row[$escapeInfo];
}