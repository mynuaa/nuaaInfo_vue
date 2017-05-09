<?php

$THE_LARGEST_ID = 9999999;
$PAGE_SIZE = 15;

$id = isset($_GET['id']) ? intval($_GET['id']) : $THE_LARGEST_ID;

if (!isset($_GET['topic'])) {
    Result::error('empty topic');
}
$topic = addslashes($_GET['topic']);

/*
$topicList = ['你有我没有', '我最想对你说', '我对南航说', '对学弟学妹们的忠告'];

if (!in_array($topic, $topicList)) {
    Result::error('no topic');
}
*/

$sql = "SELECT * FROM `topic` inner join `data` on `topic`.`postId` = `data`.`id` WHERE `topicName` = '{$topic}' AND `data`.`id` < {$id} ORDER BY `data`.`id` DESC LIMIT {$PAGE_SIZE}";

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
