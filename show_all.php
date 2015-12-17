<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/page.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/class.php";

show_header("提交测试");
$response = " ";
$sqlhandler = new Sql();
$sql = "SELECT * FROM choice WHERE 1";
if ($result = $sqlhandler->excute_query($sql)) {
	$p_total = $result->num_rows;
	if ($p_total == 0)
		$response = "暂时还没有队友碰到这题。";

	while ($row = $result->fetch_assoc()) {
		$key = htmlspecialchars(strtoupper($row['c_key']));
		$time = date('g:i A d / M / Y D', $row['c_time']);
		$content = htmlspecialchars(stripcslashes($row['content']));
		$response .= "<div class=\"search_result\"><p><strong>题目{$row['id']}：</strong><span><pre>{$content}</pre></span></p><p><strong>答案：</strong><span class=\"answer\">{$key}</span></p><p class=\"post_info\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span> {$row['c_user']} &nbsp;&nbsp;&nbsp;&nbsp; <span class=\"glyphicon glyphicon-time\" aria-hidden=\"true\"></span> {$time}</p></div>";
	}
}
?>

<div class="cover result">
	<p>已提交<strong> <?php echo $p_total; ?> </strong>题，题目编号为提交次序。</p>
	<?php echo $response; ?>
</div>

<?php
show_footer();
?>