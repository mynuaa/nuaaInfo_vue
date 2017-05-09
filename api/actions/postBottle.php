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
DB::query($sql);

$sql = "SELECT `id` FROM `data` where `userId` = {$user['uid']} and `date` = {$time}";
$postedId = DB::getOne($sql,'id');
//添加话题功能
// todo 测试！！！！！！！！！！！！！！！！！！！！！
$arrTopic = [];
preg_match_all("/#(.*?)#/",$content,$arrTopic);

$arrTopic = $arrTopic[1];
$arrTopic = array_map(function ($arr){
    global $postedId;
    global $time;
    return "('{$arr}', {$postedId}, {$time})";
},$arrTopic);

$arrTopic = implode(" , ",$arrTopic);

$sql = "INSERT INTO `topic` (`topicName`, `postId`, `date`) VALUES {$arrTopic}";

//2017.5.5 善良单纯的小阿板和猥琐粗俗的达达达曾经在这里进行了艰苦卓绝的前后端联调debug

DB::query($sql) ? Result::success() : Result::error();
