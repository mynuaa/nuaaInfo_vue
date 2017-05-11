<?php

$user = SSO::getUser();
if (!$user) {
    Result::jump(SSO::generateLoginUrl("http://my.nuaa.edu.cn/bottle/#/"));
}

$sql = "SELECT Count(*) AS `likeNum` FROM `like` INNER JOIN `data` ON `like`.`postId` = `data`.`id` WHERE `isRead` = 0 AND `like`.`userId` = {$user['id']}";

$return['likeNum'] = DB::getOne($sql,'likeNum');

$sql = "SELECT data.* , `comment`.`content` AS `cContent` , `comment`.`date` AS `cData` FROM `comment` INNER JOIN `data` ON `comment`.`postId` = `data`.`id` WHERE `isRead` = 0 AND `comment`.`userId` =  {$user['id']} AND `data`.`softDelete` = 0 AND `comment`.`softDelete` = 0";

$result = DB::getAll($sql);

foreach ($result as &$value) {
    $value['nickname'] = '某童鞋';
    unset($value['userId'], $value['softDelete'], $value['more']);
}

$return['comment'] = $result;

Result::success($return);
