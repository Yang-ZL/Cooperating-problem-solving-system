<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/page.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/class.php";

?>

<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>提交测试</title>

    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
    <link href="/css/normalize.css" rel="stylesheet">
    <link href="/css/general.css" rel="stylesheet">
    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <script src="/bootstrap/js/jquery.cookie.js"></script>
    <script type="text/javascript">  
    function changeuser() {
        $.cookie('user', $("#user option:selected").text(), {
            expires: 7
        });
        ajax_reload();
        $('#key').val('');
        $('#post_result').html('');
    }
    function loaduser() {
        var username = $.cookie('user');
        if (username != undefined) {
            $("#user").val(username);
        } else {
            $.cookie('user', $("#user option:selected").text(), {
                expires: 7
            });
        }
        // alert("ds");
        ajax_reload();
        $('#key').val('');
        $('#post_result').html('');
    }
    function update_data() {
        $('#post_result').html('已是最新！');
        $('#key').val('');
        ajax_reload();
        // alert("TEST");
    }
    function ajax_reload() {
        var aj = $.ajax({
          type: 'post',
          url: 'together.php',
          data: {method: 'get', user: $('#user').val()},
          cache: false,
          dataType: 'text',
          success: function(data) {
            // alert(data);
            $('#content').val(data);
          },
          error: function(data) {
            $('#content').val(data);
          }
        });
    }
    function post_data() {
      var p_contnet = $('#content').val();
      var p_user = $('#user').val();
      var p_key = $('#key').val();
      var aj = $.ajax({
        type: 'post',
        url: 'cooperate.php',
        data: {content: p_contnet, user: p_user, key: p_key, method: 'submit'},
        cache: false,
        dataType: 'text',
        success: function(data) {
          // alert(data);
          $('#post_result').html(data);
        },
        error: function(data) {
          // alert(data);
          $('#post_result').html("<strong class='failure'>" + data + "</strong>");
        }
      });
      $('#key').val('');
      $('#key').focus();
    }
   </script>  
  </head>

  <body onload="loaduser()">

    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">
          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">选择题协作答题系统</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li><a href="/">Home</a></li>
                  <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Inspire <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                     <li><a href="/inspire/get_th.php">获取温度</a></li>
                     <li role="separator" class="divider"></li>
                    </ul>
                  </li>-->
                  <li><a href="/about/">About</a></li>
                </ul>
              </nav>
            </div>
          </div><!-- end of navigation --> 
<div class="cover about page">
<form class="navbar-form" role="search">
  <p>输入要提交的题目：</p><span id="post_result"> </span><br />
	<textarea class="form-control search" id="content" placeholder="输入 ...." ></textarea><br /><br /> <!--readonly="readonly"-->
  <div class="f-box">
    <label>key: </label><input type="text" class="form-control" id="key" />
  </div>
  <div class="f-box">
  	<label>user: </label>
  	<select onchange="changeuser()" class="form-control" id="user">
  		<option selected>user_1</option>
  		<option>user_2</option>
  		<option>user_3</option>
  	</select> 
  </div>
  <button class="btn btn-default" onclick="update_data(); return false;"> 刷新题目 </button><br />
	<button class="btn btn-default" onclick="post_data(); return false;"> 提交 </button>
</form>
<p>题目提交注意事项：</p>
<ol>
  <li>选择队伍后，浏览器会记住选项此后无需再次选择。</li>
  <li>提交完本题后，待同伴在客户端更新后，方可点击 ‘刷新题目’ 按钮。</li>
</ol>
</div>

<?php
show_footer();
?>