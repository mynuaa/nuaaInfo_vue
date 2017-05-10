<?php

if (!SSO::getUser()) {
    Result::jump(SSO::generateLoginUrl("http://my.nuaa.edu.cn/bottle/#/"));
}

if (!isset($_GET['id'])) {
	Result::error();
}

$id = intval($_GET['id']);
$time = time();
$user = SSO::getUser();

$sql = "INSERT INTO `like` (`userId`, `postId`, `date`) VALUES ({$user['uid']}, {$id}, {$time})";

if(DB::query($sql)){
    Result::success();
    $sql = "UPDATE `data` SET `likeCount` = `likeCount` + 1 WHERE `id` = {$id}";
    DB::query($sql);
}else{
    Result::error();
}
