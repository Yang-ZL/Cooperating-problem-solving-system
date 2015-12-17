<?php

function show_header($title) {
$header = <<<STR
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{$title}</title>

    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
    <link href="/css/normalize.css" rel="stylesheet">
    <link href="/css/general.css" rel="stylesheet">
    <script src="/bootstrap/js/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
  </head>

  <body>

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
STR;
echo $header;
}
          
function show_footer() {
	$footer = <<<STR
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
STR;
echo $footer;
}

// function commentSystem($page_flag, $title, $url) {
//   $comment = <<<STR
// <!-- 多说评论框 start -->
//   <div class="ds-thread" data-thread-key="{$page_flag}" data-title="{$title}" data-url="http://pi.tunnel.hooowl.com{$url}"></div>
// <!-- 多说评论框 end -->
// <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
// <script type="text/javascript">
// var duoshuoQuery = {short_name:"rpihooowl"};
//   (function() {
//     var ds = document.createElement('script');
//     ds.type = 'text/javascript';ds.async = true;
//     ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
//     ds.charset = 'UTF-8';
//     (document.getElementsByTagName('head')[0] 
//      || document.getElementsByTagName('body')[0]).appendChild(ds);
//   })();
//   </script>
// <!-- 多说公共JS代码 end -->
// STR;
//   echo $comment;
// }