<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type');

/*
ini_set("display_errors", "On");

error_reporting(E_ALL | E_STRICT);
*/

require_once '../include/config.php';
require_once '../include/db.class.php';
require_once '../include/request.class.php';
require_once '../include/result.class.php';
require_once '../include/libsso/libsso.class.php';
require_once '../include/gender.inc.php';

// database setting
DB::connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DB, MYSQL_PORT);

// initialize request
Request::initialize();

// white list

$actionList = ['getBottle', 'getComments', 'getLike', 'getMoreBottles', 'getMyBottles', 'getUser', 'postBottle', 'postComment',"getTopic"];


if (!isset($_GET['_action'])) {
    Result::error('missing _action');
} else if (!in_array($_GET['_action'], $actionList)) {
    Result::error('_action error');
} else {
    require_once "actions/{$_GET['_action']}.php";
}
