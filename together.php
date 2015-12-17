<?php

require_once "class.php";

if (!isset($_POST['method']) || !isset($_POST['user']))
	return Receive::send_ms("nothing...");

if (empty($_POST['method']) || empty($_POST['user']))
	return Receive::send_ms("the variable cannot be blank.");

$user   = addcslashes(trim($_POST['user']), specialcharacter);
$method = addcslashes(trim($_POST['method']), specialcharacter);

switch ($method) {
	case 'get':
		$receive = new Receive('', '', $user, true);
		return stripcslashes($receive->rec_challenge());
		break;
	case 'post':
		if(!isset($_POST['content']))
			return Receive::send_ms("no post content.");
		if (empty($content = addcslashes(trim($_POST['content']), specialcharacter)))
			return Receive::send_ms("the variable cannot be blank.");
		$receive = new Receive($content, '', $user, true);
		// echo $content;
		if ($receive->new_challenge())
			return Receive::send_ms("提交成功。");
		else
			return Receive::send_ms("提交失败。");
		break;
	default:
		return Receive::send_ms("unknown method.");
		break;
}