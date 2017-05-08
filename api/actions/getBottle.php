<?php

if (!isset($_GET['id'])) {
    Result::error();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM `data` WHERE `id` = {$id}";
$result = DB::getOne($sql);

// prevent xss
$result['title'] = htmlspecialchars($result['title']);
$result['content'] = htmlspecialchars($result['content']);

if ($result['secret'] == 0) {
    $result['avatar'] = "/ucenter/avatar.php?uid={$result['userId']}&size=small";
} else {
    $result['nickname'] = '某同学';
}

Result::success($result);
