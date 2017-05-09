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
        $value['nickname'] = '某同学';
        $value['userId'] = '0';
    }
}

Result::success($result);
