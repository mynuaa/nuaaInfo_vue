<?php

if (!isset($_GET['id'])) {
    Result::error();
}

$id = intval($_GET['id']);

$user = SSO::getUser();
$userId = ($user && isset($user['uid'])) ? $user['uid'] : 0;
$sql = "SELECT
            d.id, d.content, d.gender, d.secret, d.avatar, d.userId,
            d.nickname, d.commentCount, d.likeCount, d.date,
            l.userId `isLiked`
        FROM `data` `d`
        LEFT JOIN `like` `l`
        ON l.postId = d.id
        AND l.userId = {$userId}
        WHERE d.id = {$id}";
$result = DB::getOne($sql);

if ($result['secret'] == 0) {
    $result['avatar'] = "/ucenter/avatar.php?uid={$result['userId']}&size=small";
} else {
    genderProcess($result);
}

Result::success($result);
