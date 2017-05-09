<?php

if (!isset($_GET['id'])) {
    Result::error();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM `comment` WHERE `postId` = {$id} ORDER BY `id` DESC";
$result = DB::getAll($sql);

// prevent xss
foreach ($result as &$value) {
    $value['content'] = htmlspecialchars($value['content']);
    if ($value['secret'] == 0) {
        $value['avatar'] = "/ucenter/avatar.php?uid={$value['userId']}&size=small";
    } else {
        require_once('gender.inc.php');
    }
}

Result::success($result);
