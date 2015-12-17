<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/page.php";

show_header("关于-SJUTEAM");
?>

<div class="cover about">
<div class="a-box">
	<h2>关于 SJU-TEAM</h2>
	<p>都知道</p>
</div>
<div class="a-box">
	<h2>关于协作答题系统</h2>
	<p>队友合作开发，下面是使用说明：</p>
		<p>[ 注 ]：每个队有约 6 名队员， 两两协作，每两个人(队员1和队员2)分一个用户，即提交页面里 user 字段选项[user_1, user_2, user_3]</p>
		<pre>
	<span>分配示例：</span>
                    ---- user_1 (队员1 + 队员2)
	            |
                    ---- user_2 (队员1 + 队员2)
	            |
	            ---- user_3 (队员1 + 队员2)</pre>
	<p>具体步骤：</p>
	<ol>
		<li>[ 队员1 ] 拿到题目索搜是否有其他队友回答过。有答过填写答案，下一题。</li>
		<li>没有答过，[ 队员1 ] 将题目复制到桌面客户端(下面有下载链接)，选择右下角的 ‘user’(比如选择 user_1 )，点击提交。</li>
		<li>同伴 [ 队员2 ] 在其他电脑打开本协作答题系统，进入 ‘提交’ 页面，并在 ‘user’ 字段后面的 list 里选择与 队员1 相同的选项(同样选择 user_1) </li>
		<li>得出答案后，由 [ 队员2 ] 在 ‘key’ 字段里填写答案，点击提交按钮。这样其它队友如若再次碰可快速搜到答案。</li>
		<li>此时，[ 队员1 ] 在考试系统提交答案，进入下一题，依此类推。</li>
	</ol>
</div>
<div class="a-box">
	<h2>其它</h2>
	<ul>
		<li><a href="/resource/选择题协同客户端v1.5.rar"> 下载 </a>桌面客户端</li>
		<li><a href="/resource/bg.png"> 下载 </a>主题壁纸</li>
	</ul>
</div>
</div>

<?php
show_footer();
?>