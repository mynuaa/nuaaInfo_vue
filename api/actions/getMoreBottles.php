<?php

$THE_LARGEST_ID = 9999999;
$PAGE_SIZE = 15;

$id = isset($_GET['id']) ? intval($_GET['id']) : $THE_LARGEST_ID;
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
        WHERE d.id < {$id}
        ORDER BY d.id DESC
        LIMIT {$PAGE_SIZE}";
$result = DB::getAll($sql);

// prevent xss
foreach ($result as &$value) {
    if ($value['secret'] == 0) {
        $value['avatar'] = "/ucenter/avatar.php?uid={$value['userId']}&size=small";
    } else {
        genderProcess($value);
    }
}


Result::success($result);
