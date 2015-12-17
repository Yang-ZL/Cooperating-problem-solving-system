<?php

// file_get_contents("php://input");

require_once "class.php";

if (!isset($_POST['method']))
	return Receive::send_ms("nothing...");

switch ($method = $_POST['method']) {
	case 'search':
		search();
		break;
	case 'submit':
		submit();
		break;
	default:
		return Receive::send_ms("unknown method.");
		break;
}

function submit() {
	if(!isset($_POST['content']) || !isset($_POST['key']) || !isset($_POST['user']))
		return Receive::send_ms("lack the post variables.");

	if (empty($_POST['content']) || empty($_POST['key']) || empty($_POST['user']))
		return Receive::send_ms("<strong class='failure'>-_-!! 提交内容不能为空。</strong>");

	$content = addcslashes(trim($_POST['content']), specialcharacter);
	$key	 = addcslashes(trim($_POST['key']), specialcharacter);
	$user 	 = addcslashes(trim($_POST['user']), specialcharacter);

	$receive = new Receive($content, $key, $user);

	// if (!$receive->check($receive->content, $receive->key, $receive->user))
	// 	return Receive::send_ms("the post content cannot be blank.");

	if ($receive->insert_post())
		return Receive::send_ms("<strong class='success'>^-^ 提交成功！</strong>");
	else
		return Receive::send_ms("-_-!! 提交失败！");
 }

 function search() {
 	if (!isset($_POST['s_content']))
		return Receive::send_ms("lack the post variables.");
	if (empty($_POST['s_content']))
		return Receive::send_ms("输入内容后再搜搜。");

	$content = addcslashes(trim($_POST['s_content']), specialcharacter);
	if ($_POST['client'] == '1')
		$receive = new Receive($content, '', '', false, true);
	else
		$receive = new Receive($content, '', '', false);

	return Receive::send_ms($receive->search());
 }