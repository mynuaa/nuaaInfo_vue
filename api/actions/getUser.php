<?php

$user = SSO::getUser();

if (!$user) {
	Result::error(SSO::generateLoginUrl());
}

Result::success($user);
