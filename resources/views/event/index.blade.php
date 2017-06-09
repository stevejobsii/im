<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>活动订单</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <meta name="app-mobile-web-app-capable" content="yes">
    <meta id="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" href="{{asset('favicon.png')}}" mce_href="{{asset('favicon.png')}}" type="image/png">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}" mce_href="{{asset('favicon.ico')}}" type=”image/x-icon”>
<meta http-equiv="pragma" content="no-cache" /> 
<meta http-equiv="Cache-Control" content="no-cache,must-revalidate" /> 
    <!--[if lte IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <![endif]-->

    <!-- Styles -->
    <link href="//cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet">
    <link href="{{asset('js/lib/mint-ui/mint-ui.css')}}" rel="stylesheet">
    <!-- <link href="//cdn.bootcss.com/Swiper/3.4.0/css/swiper.min.css" rel="stylesheet"> -->
    <link href="{{asset('css/malltest.css')}}" rel="stylesheet">
    <style>
        input,i, select, textarea, button:focus {
            outline: 0 none !important;
        }
        a,i,button,input,li,span{-webkit-tap-highlight-color:rgba(255,0,0,0);}
    </style>
</head>
<body>
<!-- JavaScripts -->
<script src="{{ asset('js/lib/jquery/jquery-2.1.1.min.js') }}"></script>
<!-- <script src="{{ asset('js/lib/distpicker/distpicker.min.js') }}"></script>
<script src="//cdn.bootcss.com/Swiper/3.4.0/js/swiper.min.js"></script> -->
<script src="{{ asset('js/event/eventapp.js') }}"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js" charset="utf-8"></script>
<script src="/js/lang.js"></script>
<div id="app">
  {{ message }}
</div>
<!-- <script type="text/javascript" charset="utf-8">
    wx.config(<?php echo $js->config(array('chooseWXPay'), true) ?>);
</script> -->
</body>
</html>
