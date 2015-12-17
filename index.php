<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>选择题协作答题系统-SJUTEAM</title>

    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
    <link href="/css/normalize.css" rel="stylesheet">
    <link href="/css/general.css" rel="stylesheet">
    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		function load() {
			$('#search').focus();
		}
	    function p_search(event) {
	    	var content = $('#search').val();
	        var aj = $.ajax({
	          type: 'post',
	          url: 'cooperate.php',
	          data: {method: 'search', s_content: content, client: 0},
	          cache: false,
	          dataType: 'text',
	          beforeSend: function() {
	          	$('#loading').html("<img src='/img/loading.gif' height='12px'/>");
	          },
	          success: function(data) {
	            // alert(data);
	            $('#search_result').html(data);
	          	$('#loading').html('');
	          },
	          error: function(data) {
	            $('#search_result').html(data);
	          	$('#loading').html('');
	          },
	          complete: function() {
	          	$('#loading').html('');
	          }
	        });
		}
	</script>
  </head>

  <body onload="load()">

    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">
          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">选择题协作答题系统</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li><a href="/">Home</a></li>
                  <li><a href="/about/">About</a></li>
                </ul>
              </nav>
            </div>
          </div><!-- end of navigation --> 

		<div class="cover page">
			<form class="navbar-form" role="search">
				<p><strong>输入检索内容：</strong></p>
				<textarea class="form-control search" id="search" placeholder="复制题目部分内容即可..." oninput="p_search(event);"></textarea><br />
				<span style="color: #868686;" />Status: </span><span id="loading"> &nbsp; </span>
				<!-- <button class="btn btn-default" name="submit" onclick=""> 搜索 </button> -->
			</form>
			<p>搜索注意事项：</p>
			<ol>
				<li>搜索题目的第一句话即可。</li>
				<li><a target="_blank" href="/show_all.php"> 查看 </a>所有已提交的题目。</li>
				<li>题目<a target="_blank" href="/post.php"> 提交 </a>测试。</li>
				<li><a target="_blank" href="/main_post.php"> main_post </a>临时提交</li>
			</ol>
		</div>
		<div class="cover result">
			<p><strong>检索结果：</strong></p>
			<div class="search_result" id="search_result">
				NULL
			</div>
			
		</div>

          <div class="mastfoot">
            <div class="inner">
              &copy; SJU-TEAM 2015. Designed by N1L</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>