<?php

$THE_LARGEST_ID = 9999999;
$PAGE_SIZE = 15;

$id = isset($_GET['id']) ? intval($_GET['id']) : $THE_LARGEST_ID;
$user = SSO::getUser();
$sql = "SELECT `data`.`id` , `data`.`title` , `data`.`content` , `data`.`gender` , 
`data`.`secret` , `data`.`avatar` , `data`.`nickname`, `data`.`commentCount` ,
`data`.`userId` , `data`.`likeCount` , `like`.`userId` AS `isLiked` 
FROM `data` left join `like` on `like`.`postId` = `data`.`id` AND `like`.`userId` = {$user['uid']}
WHERE `data`.`id` < {$id} ORDER BY `data`.`id` DESC LIMIT {$PAGE_SIZE}";
$result = DB::getAll($sql);

// prevent xss
foreach ($result as &$value) {
    $value['title'] = htmlspecialchars($value['title']);
    $value['content'] = htmlspecialchars($value['content']);
    if($value['isLiked'] == NULL){
        $value['isLiked'] = 1;
    }else{
        $value['isLiked'] = 0;
    }
    if ($value['secret'] == 0) {
        $value['avatar'] = "/ucenter/avatar.php?uid={$value['userId']}&size=small";
    } else {
        genderProcess($value);
    }
}


Result::success($result);
