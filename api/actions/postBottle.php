<?php

$user = SSO::getUser();
if (!$user) {
    Result::jump(SSO::generateLoginUrl());
}

if (!isset(Request::$body['content'])) {
    Result::error('empty content');
}

$content = addslashes(Request::$body['content']);
$secret = intval(Request::$body['secret']);
$rand = mt_rand(1, 6);
$gender = (Request::$body['gender'] ? 1 : 2);
if ($secret) {
    $avatar = ($gender == 1 ? 'boy' : 'girl') . $rand;
} else {
    $avatar = "/ucenter/avatar.php?uid={$user['uid']}&size=small";
}
$time = time();

$sql = "INSERT INTO `data` (`title`, `content`, `gender`, `secret`, `avatar`, `userId`, `nickname`, `date`)
        VALUES ('{$content}', '{$content}', '{$gender}', '{$secret}', '{$avatar}', {$user['uid']}, '{$user['username']}', '{$time}')";
DB::query($sql) ? Result::success() : Result::error();
