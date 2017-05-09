<?php

$user = SSO::getUser();
if (!$user) {
    Result::jump(SSO::generateLoginUrl());
}

if (!isset(Request::$body['postId']) || !isset(Request::$body['content']) || !isset(Request::$body['secret'])) {
    Result::error();
} else if (Request::$body['content'] == '') {
    Result::error('empty content');
}

$id = intval(Request::$body['postId']);
$content = addslashes(Request::$body['content']);
$secret = intval(Request::$body['secret']);
$time = time();
$rand = mt_rand(1, 6);
$gender = (Request::$body['gender'] ? 1 : 2);
if ($secret) {
    $avatar = ($gender == 1 ? 'boy' : 'girl') . $rand;
} else {
    $avatar = "/ucenter/avatar.php?uid={$user['uid']}&size=small";
}

$sql = "INSERT INTO `comment` (`postid`, `gender`, `secret`, `nickname`, `userId`, `content`, `date`, `avatar`)
        VALUES ('{$id}', {$gender}, '{$secret}', '{$user['username']}', {$user['uid']}, '{$content}', '{$time}', '{$avatar}')";
if (!DB::query($sql)) {
    Result::error();
}

$sql = "UPDATE `data` SET `commentCount` = `commentCount` + 1 WHERE `id` = {$id}";
DB::query($sql);

$sql = "SELECT COUNT(*) AS `cnt` FROM `comment` WHERE postid = {$id}";
$count = DB::getOne($sql, 'cnt');

Result::success([
    'id' => $id,
    'commentCount' => $count,
    'avatar' => $avatar,
]);
