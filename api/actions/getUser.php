<?php

$user = SSO::getUser();

if (!$user) {
	Result::error('not login');
}

Result::success($user);
