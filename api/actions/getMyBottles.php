<?php

$user = SSO::getUser();
if (!$user) {
    Result::jump(SSO::generateLoginUrl("http://my.nuaa.edu.cn/bottle/#/"));
}

$THE_LARGEST_ID = 9999999;
$PAGE_SIZE = 15;

$id = isset($_GET['id']) ? intval($_GET['id']) : $THE_LARGEST_ID;

$user = SSO::getUser();

$sql = "SELECT `data`.`id` , `data`.`title` , `data`.`content` , `data`.`gender` , 
`data`.`secret` , `data`.`avatar` , `data`.`nickname`, `data`.`commentCount` ,
`data`.`userId` , `data`.`likeCount` , `like`.`userId` AS `isLiked` 
FROM `data` left join `like` on `like`.`postId` = `data`.`id` AND `like`.`userId` = {$user['uid']} 
AND `data`.`userId` = {$user['uid']} 
WHERE `data`.`id` < {$id} ORDER BY `data`.`id` DESC LIMIT {$PAGE_SIZE}";

$result = DB::getAll($sql);

// prevent xss
foreach ($result as &$value) {
    $value['title'] = htmlspecialchars($value['title']);
    $value['content'] = htmlspecialchars($value['content']);
    if($value['isLiked'] == NULL){
        $value['isLiked'] = 0;
    }else{
        $value['isLiked'] = 1;
    }
    $value['avatar'] = "/ucenter/avatar.php?uid={$value['userId']}&size=small";
}

Result::success($result);
