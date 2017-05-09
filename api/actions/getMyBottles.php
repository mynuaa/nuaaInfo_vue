<?php

$user = SSO::getUser();
if (!$user) {
    Result::jump(SSO::generateLoginUrl("http://my.nuaa.edu.cn/bottle/#/"));
}

$THE_LARGEST_ID = 9999999;
$PAGE_SIZE = 15;

$id = isset($_GET['id']) ? intval($_GET['id']) : $THE_LARGEST_ID;

$sql = "SELECT * FROM `data` WHERE `id` < {$id} AND `userId` = {$user['uid']} ORDER BY `id` DESC LIMIT {$PAGE_SIZE}";
$result = DB::getAll($sql);

// prevent xss
foreach ($result as &$value) {
    $value['title'] = htmlspecialchars($value['title']);
    $value['content'] = htmlspecialchars($value['content']);
    $value['avatar'] = "/ucenter/avatar.php?uid={$value['userId']}&size=small";
}

Result::success($result);
