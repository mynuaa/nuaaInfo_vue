<?php

$THE_LARGEST_ID = 9999999;
$PAGE_SIZE = 15;

$id = isset($_GET['id']) ? intval($_GET['id']) : $THE_LARGEST_ID;

if (!isset($_GET['topic'])) {
    Result::error('empty topic');
}
$topic = addslashes($_GET['topic']);

$user = SSO::getUser();
$userId = ($user && isset($user['uid'])) ? $user['uid'] : 0;
$sql = "SELECT
            a.id, a.content, a.gender, a.secret, a.avatar,
            a.nickname, a.commentCount, a.userId, a.likeCount,
            l.userId `isLiked`
        FROM (
            SELECT d.*, t.topicName
            FROM `data` `d`
            LEFT JOIN `topic` `t`
            ON t.postId = d.id
        ) `a`
        LEFT JOIN `like` `l` ON
            l.userId = {$userId}
        WHERE
            a.topicName = '{$topic}' AND a.id < {$id}
        ORDER BY a.id DESC
        LIMIT {$PAGE_SIZE}";
$result = DB::getAll($sql);

foreach ($result as &$value) {
    $value['title'] = htmlspecialchars($value['title']);
    $value['content'] = htmlspecialchars($value['content']);
    if ($value['secret'] == 0) {
        $value['avatar'] = "/ucenter/avatar.php?uid={$value['userId']}&size=small";
    } else {
        genderProcess($value);
    }
}

Result::success($result);
