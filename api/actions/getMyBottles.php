<?php

$user = SSO::getUser();
if (!$user) {
    Result::jump(SSO::generateLoginUrl("http://my.nuaa.edu.cn/bottle/#/"));
}

$THE_LARGEST_ID = 9999999;
$PAGE_SIZE = 15;

$id = isset($_GET['id']) ? intval($_GET['id']) : $THE_LARGEST_ID;

$user = SSO::getUser();
$userId = ($user && isset($user['uid'])) ? $user['uid'] : 0;
$sql = "SELECT
            d.id, d.content, d.gender, d.secret, d.avatar,
            d.nickname, d.commentCount, d.userId, d.likeCount, d.date,
            l.userId `isLiked`
        FROM `data` `d`
        LEFT JOIN `like` `l`
        ON l.postId = d.id
        AND l.userId = {$userId}
        WHERE d.id < {$id}
        AND d.userId = {$userId}
        ORDER BY d.id DESC
        LIMIT {$PAGE_SIZE}";
$result = DB::getAll($sql);

// prevent xss
foreach ($result as &$value) {
    $value['avatar'] = "/ucenter/avatar.php?uid={$value['userId']}&size=small";
}

Result::success($result);
