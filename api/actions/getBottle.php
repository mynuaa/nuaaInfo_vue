<?php

if (!isset($_GET['id'])) {
    Result::error();
}

$id = intval($_GET['id']);

if (!$user) {
    $user['id'] = 0;
}else{
    $user = SSO::getUser();
}

$sql = "SELECT `data`.`id` , `data`.`title` , `data`.`content` , `data`.`gender` , 
`data`.`secret` , `data`.`avatar` , `data`.`nickname`, `data`.`commentCount` ,
`data`.`userId` , `data`.`likeCount` , `like`.`userId` AS `isLiked` 
FROM `data` left join `like` on `like`.`postId` = `data`.`id` AND `like`.`userId` = {$user['uid']}
WHERE `data`.`id` < {$id} ORDER BY `data`.`id` DESC LIMIT {$PAGE_SIZE}";
$result = DB::getAll($sql);


// prevent xss
$result['title'] = htmlspecialchars($result['title']);
$result['content'] = htmlspecialchars($result['content']);

if ($result['secret'] == 0) {
    $result['avatar'] = "/ucenter/avatar.php?uid={$result['userId']}&size=small";
} else {
    genderProcess($result);
}

Result::success($result);
