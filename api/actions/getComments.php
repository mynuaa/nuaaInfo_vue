<?php

if (!isset($_GET['id'])) {
    Result::error();
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM `comment` WHERE `postId` = {$id} ORDER BY `id` DESC";
$result = DB::getAll($sql);

// prevent xss
foreach ($result as &$value) {
    $value['nickname'] = '某童鞋';
    unset($value['userId']);
}

Result::success($result);
