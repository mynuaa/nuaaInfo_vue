<?php

$user = SSO::getUser();
if (!$user) {
    Result::jump(SSO::generateLoginUrl("http://my.nuaa.edu.cn/bottle/#/"));
}

$user['id'] = 482698;
$sql = "SELECT Count(*) as `likeNum` FROM `like` inner join `data` on `like`.`postId` = `data`.`id` WHERE `isRead` = 0 AND `like`.`userId` = {$user['id']}";

$result = DB::getOne($sql);
$return['likeNum'] = $result['likeNum'];


$sql = "SELECT data.* , `comment`.`content` as `cContent` , `comment`.`date` as `cData` FROM `comment` inner join `data` on `comment`.`postId` = `data`.`id` WHERE `isRead` = 0 AND `comment`.`userId` =  {$user['id']} AND `data`.`softDelete` = 0 AND `comment`.`softDelete` = 0";

$result = DB::getAll($sql);

foreach ($result as &$value) {
    $value['nickname'] = '某童鞋';
    unset($value['userId'], $value['softDelete'], $value['more']);
}

$return['comment'] = $result;

Result::success($return);
