<?php

if (!SSO::getUser()) {
    Result::jump(SSO::generateLoginUrl());
}

if (!isset($_GET['id'])) {
	Result::error();
}

$id = intval($_GET['id']);
$sql = "UPDATE `data` SET `likeCount` = `likeCount` + 1 WHERE `id` = {$id}";
DB::query($sql);

Result::success(['id' => $id]);
