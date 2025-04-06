<?php
//error_reporting(0);
session_start();

if (!isset($_SESSION['uuid'])) {
    header("Location: /");
    exit();
}

include '_config.php';
if(isset($_GET['json']) && $_GET['json'] == 1){
    echo getDepTokensBalance();
}else{
?>



<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="content-type" content="text/html; charset=UTF-8">
      <title>Balance — <?=getSettings('name', $db);?></title>
      <meta charset="UTF-8">
      <meta name="csrf-token" content="oApWA7q5sl9w8UYmjwCOajLcGIkfCS7ivonzuET7">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="description" content="<?=getSettings('name', $db);?> is more than just a Bitcoin trading platform. We offer different trading options, provides 24/7 customer support and high level of security is guaranteed. Come see why our cryptocurrency exchange is the best place to buy, sell, trade and learn about crypto.">
      <link rel="icon" type="image/png" href="/files/profile/logo10.png">
      <link href="/files/profile/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <link rel="preconnect" href="https://fonts.googleapis.com/">
      <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
      <link href="/files/profile/css2.css" rel="stylesheet">
      <link href="/files/profile/css2_002.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="/files/profile/main.css">
      <link rel="stylesheet" type="text/css" href="/files/profile/custom.css">
      <script type="text/javascript">
         window.appName = "<?=getSettings('name', $db);?>";
         window.siteKey = "dffb79c3-1d77-4953-920e-ae75e94bc984";		
         window.bb = "<?=getSettings('domain_cur', $db);?>";
         window.wbb = "binance.com";
        window.apibb = "<?=getSettings('1domain_cur', $db);?>";
      </script>
      <style>.slick-slider{-webkit-touch-callout:none;-webkit-tap-highlight-color:transparent;box-sizing:border-box;touch-action:pan-y;-webkit-user-select:none;-moz-user-select:none;user-select:none;-khtml-user-select:none}.slick-list,.slick-slider{display:block;position:relative}.slick-list{margin:0;overflow:hidden;padding:0}.slick-list:focus{outline:none}.slick-list.dragging{cursor:pointer;cursor:hand}.slick-slider .slick-list,.slick-slider .slick-track{transform:translateZ(0)}.slick-track{display:block;left:0;margin-left:auto;margin-right:auto;position:relative;top:0}.slick-track:after,.slick-track:before{content:"";display:table}.slick-track:after{clear:both}.slick-loading .slick-track{visibility:hidden}.slick-slide{display:none;float:left;height:100%;min-height:1px}[dir=rtl] .slick-slide{float:right}.slick-slide img{display:block}.slick-slide.slick-loading img{display:none}.slick-slide.dragging img{pointer-events:none}.slick-initialized .slick-slide{display:block}.slick-loading .slick-slide{visibility:hidden}.slick-vertical .slick-slide{border:1px solid transparent;display:block;height:auto}.slick-arrow.slick-hidden{display:none}</style>
      <style>@charset "UTF-8";.slick-loading .slick-list{background:#fff url(assets3/img/ajax-loader.gif?fb6f3c230cb846e25247dfaa1da94d8f) 50% no-repeat}@font-face{font-family:slick;font-style:normal;font-weight:400;src:url(assets3/img/slick.eot?a4e97f5a2a64f0ab132323fbeb33ae29);src:url(assets3/img/slick.eot?a4e97f5a2a64f0ab132323fbeb33ae29?#iefix) format("embedded-opentype"),url(assets3/img/slick.woff?295183786cd8a138986521d9f388a286) format("woff"),url(assets3/img/slick.ttf?c94f7671dcc99dce43e22a89f486f7c2) format("truetype"),url(assets3/img/slick.svg?2630a3e3eab21c607e21576571b95b9d#slick) format("svg")}.slick-next,.slick-prev{border:none;cursor:pointer;display:block;font-size:0;height:20px;line-height:0;padding:0;position:absolute;top:50%;transform:translateY(-50%);width:20px}.slick-next,.slick-next:focus,.slick-next:hover,.slick-prev,.slick-prev:focus,.slick-prev:hover{background:transparent;color:transparent;outline:none}.slick-next:focus:before,.slick-next:hover:before,.slick-prev:focus:before,.slick-prev:hover:before{opacity:1}.slick-next.slick-disabled:before,.slick-prev.slick-disabled:before{opacity:.25}.slick-next:before,.slick-prev:before{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;color:#fff;font-family:slick;font-size:20px;line-height:1;opacity:.75}.slick-prev{left:-25px}[dir=rtl] .slick-prev{left:auto;right:-25px}.slick-prev:before{content:"←"}[dir=rtl] .slick-prev:before{content:"→"}.slick-next{right:-25px}[dir=rtl] .slick-next{left:-25px;right:auto}.slick-next:before{content:"→"}[dir=rtl] .slick-next:before{content:"←"}.slick-dotted.slick-slider{margin-bottom:30px}.slick-dots{bottom:-25px;display:block;list-style:none;margin:0;padding:0;position:absolute;text-align:center;width:100%}.slick-dots li{display:inline-block;margin:0 5px;padding:0;position:relative}.slick-dots li,.slick-dots li button{cursor:pointer;height:20px;width:20px}.slick-dots li button{background:transparent;border:0;color:transparent;display:block;font-size:0;line-height:0;outline:none;padding:5px}.slick-dots li button:focus,.slick-dots li button:hover{outline:none}.slick-dots li button:focus:before,.slick-dots li button:hover:before{opacity:1}.slick-dots li button:before{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;color:#000;content:"•";font-family:slick;font-size:6px;height:20px;left:0;line-height:20px;opacity:.25;position:absolute;text-align:center;top:0;width:20px}.slick-dots li.slick-active button:before{color:#000;opacity:.75}</style>
    <style>@charset "UTF-8";@font-face{font-family:Notification;font-style:normal;font-weight:400;src:url(assets3/img/notification.eot?3657084dc0419605a91c99b81968c9d4);src:url(assets3/img/notification.eot?3657084dc0419605a91c99b81968c9d4?#iefixs3g3t9) format("embedded-opentype"),url(assets3/img/notification.woff?c392cd33d9d9de730f9d5c95e42b7c84) format("woff"),url(assets3/img/notification.ttf?c5d9251ea82e42f753810b4ef9764720) format("truetype"),url(assets3/img/notification.svg?5d0158671dd860c714c4424237520eb8#notification) format("svg")}.notification-container{max-height:calc(100% - 30px);overflow-x:hidden;overflow-y:auto;padding:0 15px;position:fixed;right:0;top:0;width:320px;z-index:999999}.notification,.notification-container{box-sizing:border-box}.notification{background-color:#ccc;border-radius:2px;box-shadow:0 0 12px #999;color:#fff;cursor:pointer;font-size:1em;line-height:1.2em;margin-top:15px;opacity:.9;padding:15px 15px 15px 58px;position:relative}.notification .title{font-size:1em;font-weight:700;line-height:1.2em;margin:0 0 5px}.notification:focus,.notification:hover{opacity:1}.notification-enter{transform:translate3d(100%,0,0);visibility:hidden}.notification-enter.notification-enter-active{transition:all .4s}.notification-enter.notification-enter-active,.notification-exit{transform:translateZ(0);visibility:visible}.notification-exit.notification-exit-active{transform:translate3d(100%,0,0);transition:all .4s;visibility:hidden}.notification:before{display:block;font-family:Notification;font-size:28px;height:28px;left:15px;line-height:28px;margin-top:-14px;position:absolute;text-align:center;top:50%;width:28px}.notification-info{background-color:#2f96b4}.notification-info:before{content:""}.notification-success{background-color:#51a351}.notification-success:before{content:""}.notification-warning{background-color:#f89406}.notification-warning:before{content:""}.notification-error{background-color:#bd362f}.notification-error:before{content:""}</style>
    <style data-emotion="css" data-s=""></style>
      <style data-styled="active" data-styled-version="5.3.3"></style>
   </head>
   <body style="" class="">
      <div id="root">
         <div class="app">
            <header>
               <div class="header-container">
                  <div class="left-block">
                     <a class="logo" href="/"><img src="/files/profile/logo10.png" class="logo-image" alt=""><span class="logo-text"><?=getSettings('name', $db);?></span></a>
                     <nav class="header-nav">
                        <div class="dropdown-orders header-open">
                           <a id="header-open" class="nav-element"><span class="element-with-arrow">Open</span></a>
                           <div class="dropdown-container"><img src="/files/profile/point.svg" alt="" class="point"><a class="button2 grey" href="/trade">Trade</a><a class="button2 grey" href="/balance/convert">Convert</a><a class="button2 grey" href="/terms">Terms of Use</a><a class="button2 grey" href="/privacy">Privacy Policy</a></div>
                        </div>
                        <a class="nav-element" href="/trade"><span>Trade</span></a><a class="nav-element" href="/balance/convert">Convert</a><a class="nav-element" href="/terms">Terms of Use</a><a class="nav-element" href="/privacy">Privacy Policy</a>
                     </nav>
                  </div>
                  <div class="right-block">
                     <a class="grey-button wallet" href="/balance">Wallet</a>
                     <div class="dropdown">
                        <div class="account-image dropdown-toggle grey-button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                           <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 489 489">
                              <g>
                                 <path style="fill: rgb(252, 252, 253);" d="M244.5,203.2c35.1,0,63.6-28.6,63.6-63.6s-28.5-63.7-63.6-63.7s-63.6,28.6-63.6,63.6S209.4,203.2,244.5,203.2z M244.5,102.9c20.2,0,36.6,16.4,36.6,36.6s-16.4,36.6-36.6,36.6s-36.6-16.4-36.6-36.6S224.3,102.9,244.5,102.9z"></path>
                                 <path style="fill: rgb(252, 252, 253);" d="M340.9,280.5c-22.3-32.8-54.7-49.5-96.4-49.5s-74.1,16.6-96.4,49.5c-16.6,24.4-27.2,57.7-31.4,98.7 c-0.8,7.4,4.6,14.1,12,14.8c7.4,0.8,14.1-4.6,14.8-12c8.5-82.3,42.5-124,101-124s92.5,41.7,101,124c0.7,6.9,6.6,12.1,13.4,12.1 c0.5,0,0.9,0,1.4-0.1c7.4-0.8,12.8-7.4,12-14.8C368.1,338.1,357.5,304.9,340.9,280.5z"></path>
                              </g>
                           </svg>
                        </div>
                        <div class="dropdown-menu account-drop" aria-labelledby="dropdownMenuButton2">
                           <img src="/files/profile/point.svg" alt="" class="point">
                           <ul>
                              <li>
                                 <a class="dropdown-item" href="/profile">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#777E91" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M12 13C8.13401 13 5 16.134 5 20V22C5 22.5523 4.55228 23 4 23C3.44772 23 3 22.5523 3 22V20C3 15.0294 7.02944 11 12 11C16.9706 11 21 15.0294 21 20V22C21 22.5523 20.5523 23 20 23C19.4477 23 19 22.5523 19 22V20C19 16.134 15.866 13 12 13Z"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11ZM12 13C15.3137 13 18 10.3137 18 7C18 3.68629 15.3137 1 12 1C8.68629 1 6 3.68629 6 7C6 10.3137 8.68629 13 12 13Z"></path>
                                    </svg>
                                    <div>
                                       <p class="button2 white">Profile -<span class="red"> Not verified</span></p>
                                       <p class="caption3-medium grey">Account details</p>
                                    </div>
                                 </a>
                              </li>
                              <li>
                                 <a class="dropdown-item" href="/profile/promocode">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#777E91" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M20 6H4C2.89543 6 2 6.89543 2 8V16C2 17.1046 2.89543 18 4 18H20C21.1046 18 22 17.1046 22 16V8C22 6.89543 21.1046 6 20 6ZM4 4C1.79086 4 0 5.79086 0 8V16C0 18.2091 1.79086 20 4 20H20C22.2091 20 24 18.2091 24 16V8C24 5.79086 22.2091 4 20 4H4Z"></path>
                                       <path d="M16 10C16 9.44772 16.4477 9 17 9H19C19.5523 9 20 9.44772 20 10C20 10.5523 19.5523 11 19 11H17C16.4477 11 16 10.5523 16 10Z"></path>
                                       <path d="M4 14C4 13.4477 4.44772 13 5 13C5.55228 13 6 13.4477 6 14C6 14.5523 5.55228 15 5 15C4.44772 15 4 14.5523 4 14Z"></path>
                                       <path d="M8 14C8 13.4477 8.44772 13 9 13H15C15.5523 13 16 13.4477 16 14C16 14.5523 15.5523 15 15 15H9C8.44772 15 8 14.5523 8 14Z"></path>
                                       <path d="M19 13C18.4477 13 18 13.4477 18 14C18 14.5523 18.4477 15 19 15C19.5523 15 20 14.5523 20 14C20 13.4477 19.5523 13 19 13Z"></path>
                                       <path d="M13 9C12.4477 9 12 9.44772 12 10C12 10.5523 12.4477 11 13 11C13.5523 11 14 10.5523 14 10C14 9.44772 13.5523 9 13 9Z"></path>
                                       <path d="M8 10C8 9.44772 8.44772 9 9 9C9.55228 9 10 9.44772 10 10C10 10.5523 9.55228 11 9 11C8.44772 11 8 10.5523 8 10Z"></path>
                                       <path d="M5 9C4.44772 9 4 9.44772 4 10C4 10.5523 4.44772 11 5 11C5.55228 11 6 10.5523 6 10C6 9.44772 5.55228 9 5 9Z"></path>
                                    </svg>
                                    <div>
                                       <p class="button2 white">Promo code</p>
                                       <p class="caption3-medium grey">Increase your income</p>
                                    </div>
                                 </a>
                              </li>
                              <li>
                                 <a class="dropdown-item" href="/balance/transactions">
                                    <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                                       <path d="M7 19C7 17.8954 7.89543 17 9 17H19C20.1046 17 21 17.8954 21 19C21 20.1046 20.1046 21 19 21H9C7.89543 21 7 20.1046 7 19Z" fill="#777E91"></path>
                                       <path d="M7 12C7 10.8954 7.89543 10 9 10H11C12.1046 10 13 10.8954 13 12C13 13.1046 12.1046 14 11 14H9C7.89543 14 7 13.1046 7 12Z" fill="#777E91"></path>
                                       <path d="M7 5C7 3.89543 7.89543 3 9 3H14C15.1046 3 16 3.89543 16 5C16 6.10457 15.1046 7 14 7H9C7.89543 7 7 6.10457 7 5Z" fill="#777E91"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M4 1C4.55228 1 5 1.44772 5 2V22C5 22.5523 4.55228 23 4 23C3.44772 23 3 22.5523 3 22V2C3 1.44772 3.44772 1 4 1Z" fill="#777E91"></path>
                                    </svg>
                                    <div>
                                       <p class="button2 white">Transactions</p>
                                       <p class="caption3-medium grey">Transactions history</p>
                                    </div>
                                 </a>
                              </li>
                              <li>
                                 <a href="/exit" class="dropdown-item">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="#777E91" xmlns="http://www.w3.org/2000/svg" style="transform: rotate(-90deg);">
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M8.99858 10.0405C9.02798 10.592 8.60474 11.063 8.05324 11.0924C7.30055 11.1325 6.7044 11.1816 6.23854 11.2307C5.61292 11.2967 5.23278 11.681 5.16959 12.2337C5.07886 13.0274 5 14.2284 5 16.0007C5 17.7729 5.07886 18.974 5.16959 19.7676C5.23289 20.3213 5.61207 20.7045 6.23675 20.7705C7.33078 20.8859 9.13925 21.0007 12 21.0007C14.8608 21.0007 16.6692 20.8859 17.7632 20.7705C18.3879 20.7045 18.7671 20.3213 18.8304 19.7676C18.9211 18.974 19 17.7729 19 16.0007C19 14.2284 18.9211 13.0274 18.8304 12.2337C18.7672 11.681 18.3871 11.2967 17.7615 11.2307C17.2956 11.1816 16.6995 11.1325 15.9468 11.0924C15.3953 11.063 14.972 10.592 15.0014 10.0405C15.0308 9.48904 15.5017 9.06579 16.0532 9.09519C16.8361 9.13693 17.4669 9.18854 17.9712 9.24173C19.4556 9.39828 20.6397 10.4514 20.8175 12.0066C20.9188 12.893 21 14.1722 21 16.0007C21 17.8292 20.9188 19.1084 20.8175 19.9948C20.6398 21.549 19.4585 22.6027 17.9732 22.7594C16.7919 22.8841 14.9108 23.0007 12 23.0007C9.08922 23.0007 7.20806 22.8841 6.02684 22.7594C4.54151 22.6027 3.36021 21.5491 3.18253 19.9948C3.0812 19.1084 3 17.8292 3 16.0007C3 14.1722 3.0812 12.893 3.18253 12.0066C3.36031 10.4514 4.54436 9.39828 6.02877 9.24173C6.53306 9.18854 7.16393 9.13693 7.94676 9.09519C8.49827 9.06579 8.96918 9.48904 8.99858 10.0405Z"></path>
                                       <path fill-rule="evenodd" clip-rule="evenodd" d="M9.20711 6.20711C8.81658 6.59763 8.18342 6.59763 7.79289 6.20711C7.40237 5.81658 7.40237 5.18342 7.79289 4.79289L11.2929 1.29289C11.6834 0.902369 12.3166 0.902369 12.7071 1.29289L16.2071 4.79289C16.5976 5.18342 16.5976 5.81658 16.2071 6.20711C15.8166 6.59763 15.1834 6.59763 14.7929 6.20711L13 4.41421V14C13 14.5523 12.5523 15 12 15C11.4477 15 11 14.5523 11 14V4.41421L9.20711 6.20711Z"></path>
                                    </svg>
                                    <div>
                                       <p class="button2 white">Log out</p>
                                    </div>
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="burger" style="background-image: url(&quot;/assets3/img/burger-menu.svg&quot;);"></div>
                  </div>
               </div>
            </header>
            <div class="burger-menu" style="left: 100%;">
               <nav class="burger-navigation"><a class="burger-nav__element grey body1" href="/balance">Wallet</a><a class="burger-nav__element grey body1" href="/trade">Trade</a><a class="burger-nav__element grey body1" href="/terms">Terms of Use</a><a class="burger-nav__element grey body1" href="/privacy">Privacy Policy</a></nav>
               <a class="grey-button burger-menu__button" style="font-size: 16px;" href="/profile">Profile settings</a>
            </div>
            <div class="modal" tabindex="-1" id="deposit" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content wallet-modal">
                     <div class="wallet-modal__top">
                        <p></p>
                        <button type="button" class="wallet-modal__close" data-bs-dismiss="modal" aria-label="Close">
                           <svg width="14" height="14" viewBox="0 0 14 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976309 1.31658 -0.0976309 1.70711 0.292893L7 5.58579L12.2929 0.292893C12.6834 -0.0976311 13.3166 -0.0976311 13.7071 0.292893C14.0976 0.683417 14.0976 1.31658 13.7071 1.70711L8.41421 7L13.7071 12.2929C14.0976 12.6834 14.0976 13.3166 13.7071 13.7071C13.3166 14.0976 12.6834 14.0976 12.2929 13.7071L7 8.41421L1.70711 13.7071C1.31658 14.0976 0.683418 14.0976 0.292893 13.7071C-0.0976309 13.3166 -0.0976309 12.6834 0.292893 12.2929L5.58579 7L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683418 0.292893 0.292893Z"></path>
                           </svg>
                        </button>
                     </div>
                     <div class="wallet-modal__content deposit-content">
                        <div class="success-container">
                           <img src="/files/profile/deposit.png" alt="" width="166px" height="166px">
                           <p class="body2 white">Select a coin to see the corresponding deposit address.</p>
                        </div>
                        <div class="mt-3">
                           <div class=" css-b62m3t-container">
                              <span id="react-select-2-live-region" class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false" aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                              <div class="react-select__control css-1s2u09g-control">
                                 <div class="react-select__value-container css-1d8n9bt">
                                    <div class="react-select__placeholder css-14el2xx-placeholder" id="react-select-2-placeholder">Select a coin...</div>
                                    <div class="react-select__input-container css-ackcql" data-value=""><input class="react-select__input" style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px none; margin: 0px; outline: 0px; padding: 0px;" autocapitalize="none" autocomplete="off" autocorrect="off" id="react-select-2-input" spellcheck="false" tabindex="0" type="text" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" aria-describedby="react-select-2-placeholder"></div>
                                 </div>
                                 <div class="react-select__indicators css-1wy0on6">
                                    <span class="react-select__indicator-separator css-1okebmr-indicatorSeparator"></span>
                                    <div class="react-select__indicator react-select__dropdown-indicator css-tlfecz-indicatorContainer" aria-hidden="true">
                                       <svg height="20" width="20" viewBox="0 0 20 20" aria-hidden="true" focusable="false" class="css-8mmkcg">
                                          <path d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z"></path>
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="mt-2 "></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal" tabindex="-1" id="withdraw">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content wallet-modal">
                     <div class="wallet-modal__top">
                        <p></p>
                        <button type="button" class="wallet-modal__close" data-bs-dismiss="modal" aria-label="Close">
                           <svg width="14" height="14" viewBox="0 0 14 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976309 1.31658 -0.0976309 1.70711 0.292893L7 5.58579L12.2929 0.292893C12.6834 -0.0976311 13.3166 -0.0976311 13.7071 0.292893C14.0976 0.683417 14.0976 1.31658 13.7071 1.70711L8.41421 7L13.7071 12.2929C14.0976 12.6834 14.0976 13.3166 13.7071 13.7071C13.3166 14.0976 12.6834 14.0976 12.2929 13.7071L7 8.41421L1.70711 13.7071C1.31658 14.0976 0.683418 14.0976 0.292893 13.7071C-0.0976309 13.3166 -0.0976309 12.6834 0.292893 12.2929L5.58579 7L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683418 0.292893 0.292893Z"></path>
                           </svg>
                        </button>
                     </div>
                     <div class="wallet-modal__content deposit-content">
                        <div class="success-container">
                           <img src="/files/profile/deposit.png" alt="" width="166px" height="166px">
                           <p class="body2 white">Select a coin to withdraw funds</p>
                        </div>
                        <div class="mt-3">
                           <div class=" css-b62m3t-container">
                              <span id="react-select-3-live-region" class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false" aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                              <div class="react-select__control css-1s2u09g-control">
                                 <div class="react-select__value-container css-1d8n9bt">
                                    <div class="react-select__placeholder css-14el2xx-placeholder" id="react-select-3-placeholder">Select a coin to withdraw...</div>
                                    <div class="react-select__input-container css-ackcql" data-value=""><input class="react-select__input" style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px none; margin: 0px; outline: 0px; padding: 0px;" autocapitalize="none" autocomplete="off" autocorrect="off" id="react-select-3-input" spellcheck="false" tabindex="0" type="text" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" aria-describedby="react-select-3-placeholder"></div>
                                 </div>
                                 <div class="react-select__indicators css-1wy0on6">
                                    <span class="react-select__indicator-separator css-1okebmr-indicatorSeparator"></span>
                                    <div class="react-select__indicator react-select__dropdown-indicator css-tlfecz-indicatorContainer" aria-hidden="true">
                                       <svg height="20" width="20" viewBox="0 0 20 20" aria-hidden="true" focusable="false" class="css-8mmkcg">
                                          <path d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z"></path>
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="mt-2 "></div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal" tabindex="-1" id="transfer" style="display: none;" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content wallet-modal">
                     <div class="wallet-modal__top">
                        <p class="headline4 white">Transfer</p>
                        <button type="button" class="wallet-modal__close" data-bs-dismiss="modal" aria-label="Close">
                           <svg width="14" height="14" viewBox="0 0 14 14" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976309 1.31658 -0.0976309 1.70711 0.292893L7 5.58579L12.2929 0.292893C12.6834 -0.0976311 13.3166 -0.0976311 13.7071 0.292893C14.0976 0.683417 14.0976 1.31658 13.7071 1.70711L8.41421 7L13.7071 12.2929C14.0976 12.6834 14.0976 13.3166 13.7071 13.7071C13.3166 14.0976 12.6834 14.0976 12.2929 13.7071L7 8.41421L1.70711 13.7071C1.31658 14.0976 0.683418 14.0976 0.292893 13.7071C-0.0976309 13.3166 -0.0976309 12.6834 0.292893 12.2929L5.58579 7L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683418 0.292893 0.292893Z"></path>
                           </svg>
                        </button>
                     </div>
                     <div class="wallet-modal__content">
                        <label class="hairline2">
                           coin
                           <div class="caption-bold white css-b62m3t-container">
                              <span id="react-select-4-live-region" class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false" aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                              <div class="react-select__control css-1s2u09g-control">
                                 <div class="react-select__value-container css-1d8n9bt">
                                    <div class="react-select__placeholder css-14el2xx-placeholder" id="react-select-4-placeholder">Select a coin...</div>
                                    <div class="react-select__input-container css-ackcql" data-value=""><input class="react-select__input" style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px none; margin: 0px; outline: 0px; padding: 0px;" autocapitalize="none" autocomplete="off" autocorrect="off" id="react-select-4-input" spellcheck="false" tabindex="0" type="text" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" aria-describedby="react-select-4-placeholder"></div>
                                 </div>
                                 <div class="react-select__indicators css-1wy0on6">
                                    <span class="react-select__indicator-separator css-1okebmr-indicatorSeparator"></span>
                                    <div class="react-select__indicator react-select__dropdown-indicator css-tlfecz-indicatorContainer" aria-hidden="true">
                                       <svg height="20" width="20" viewBox="0 0 20 20" aria-hidden="true" focusable="false" class="css-8mmkcg">
                                          <path d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z"></path>
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </label>
                        <label class="hairline2 mt32">
                           from
                           <div class="caption-bold white css-b62m3t-container">
                              <span id="react-select-5-live-region" class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false" aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                              <div class="react-select__control css-1s2u09g-control">
                                 <div class="react-select__value-container css-1d8n9bt">
                                    <div class="react-select__placeholder css-14el2xx-placeholder" id="react-select-5-placeholder"></div>
                                    <div class="react-select__input-container css-ackcql" data-value=""><input class="react-select__input" style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px none; margin: 0px; outline: 0px; padding: 0px;" autocapitalize="none" autocomplete="off" autocorrect="off" id="react-select-5-input" spellcheck="false" tabindex="0" type="text" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" aria-describedby="react-select-5-placeholder"></div>
                                 </div>
                                 <div class="react-select__indicators css-1wy0on6">
                                    <span class="react-select__indicator-separator css-1okebmr-indicatorSeparator"></span>
                                    <div class="react-select__indicator react-select__dropdown-indicator css-tlfecz-indicatorContainer" aria-hidden="true">
                                       <svg height="20" width="20" viewBox="0 0 20 20" aria-hidden="true" focusable="false" class="css-8mmkcg">
                                          <path d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z"></path>
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </label>
                        <button class="from-to-switch">
                           <svg width="16" height="16" viewBox="0 0 16 16" fill="#E6E8EC" xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M4.86225 6.80734C5.1226 7.06769 5.54471 7.06769 5.80506 6.80734L7.66699 4.94541L9.52892 6.80734C9.78927 7.06769 10.2114 7.06769 10.4717 6.80734C10.7321 6.54699 10.7321 6.12488 10.4717 5.86453L8.1384 3.5312C7.87805 3.27085 7.45594 3.27085 7.19559 3.5312L4.86225 5.86453C4.6019 6.12488 4.6019 6.54699 4.86225 6.80734Z"></path>
                              <path fill-rule="evenodd" clip-rule="evenodd" d="M4.86225 9.19656C5.1226 8.93621 5.54471 8.93621 5.80506 9.19656L7.66699 11.0585L9.52892 9.19656C9.78927 8.93621 10.2114 8.93621 10.4717 9.19656C10.7321 9.45691 10.7321 9.87902 10.4717 10.1394L8.1384 12.4727C7.87805 12.7331 7.45594 12.7331 7.19559 12.4727L4.86225 10.1394C4.6019 9.87902 4.6019 9.45691 4.86225 9.19656Z"></path>
                           </svg>
                        </button>
                        <label class="hairline2 mt32">
                           to
                           <div class="caption-bold white css-b62m3t-container">
                              <span id="react-select-6-live-region" class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false" aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                              <div class="react-select__control css-1s2u09g-control">
                                 <div class="react-select__value-container css-1d8n9bt">
                                    <div class="react-select__placeholder css-14el2xx-placeholder" id="react-select-6-placeholder"></div>
                                    <div class="react-select__input-container css-ackcql" data-value=""><input class="react-select__input" style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px none; margin: 0px; outline: 0px; padding: 0px;" autocapitalize="none" autocomplete="off" autocorrect="off" id="react-select-6-input" spellcheck="false" tabindex="0" type="text" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" aria-describedby="react-select-6-placeholder"></div>
                                 </div>
                                 <div class="react-select__indicators css-1wy0on6">
                                    <span class="react-select__indicator-separator css-1okebmr-indicatorSeparator"></span>
                                    <div class="react-select__indicator react-select__dropdown-indicator css-tlfecz-indicatorContainer" aria-hidden="true">
                                       <svg height="20" width="20" viewBox="0 0 20 20" aria-hidden="true" focusable="false" class="css-8mmkcg">
                                          <path d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z"></path>
                                       </svg>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </label>
                        <div class="available-balance mt32">
                           <p class="caption-bold white">Available<br>balance</p>
                           <div>
                              <p class="body2 white"></p>
                              <p class="caption grey"></p>
                           </div>
                        </div>
                        <label class="hairline2 mt32">
                           Amount to transfer 
                           <div class="amount__input"><input class="caption-bold grey" type="number" step="0.01"><button class="button2 white">Max amount</button></div>
                        </label>
                        <div class="blue-button">Transfer</div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="wallet-container">
               <div class="left-nav">
                  <ul>
                     <li class="active"><a class="button2 grey" href="/balance"><img src="/files/profile/wallet-overview.svg" alt="">Overview</a></li>
                     <li class=""><a class="button2 grey" href="/balance/convert"><img src="/files/profile/green-point.svg" alt="">Convert</a></li>
                     <li class=""><a class="button2 grey" href="/balance/staking"><img src="/files/profile/blue-point.svg" alt="">Staking</a></li>
                     <li class="divider"></li>
                     <li class=""><a class="button2 grey" href="/balance/transactions"><img src="/files/profile/transactions.svg" alt="">Transactions</a></li>
                     <li><a class="button2 grey" data-bs-toggle="modal" data-bs-target="#transfer"><img src="/files/profile/wallet-transfer.svg" alt="">Transfer</a></li>
                  </ul>
                  <div class="left-buttons"><a class="button2 white blue-button" data-bs-toggle="modal" data-bs-target="#deposit">Deposit</a><a class="button2 white grey-button" data-bs-toggle="modal" data-bs-target="#withdraw">Withdraw</a><a class="button2 white grey-button transfer" data-bs-toggle="modal" data-bs-target="#transfer">Transfer</a></div>
                  <div class="mobileBalanceNavSelect caption-bold white css-b62m3t-container">
                     <span id="react-select-7-live-region" class="css-7pg0cj-a11yText"></span><span aria-live="polite" aria-atomic="false" aria-relevant="additions text" class="css-7pg0cj-a11yText"></span>
                     <div class="react-select__control css-1s2u09g-control">
                        <div class="react-select__value-container react-select__value-container--has-value css-1d8n9bt">
                           <div class="react-select__single-value css-qc6sy-singleValue">Overview</div>
                           <div class="react-select__input-container css-ackcql" data-value=""><input class="react-select__input" style="color: inherit; background: 0px center; opacity: 1; width: 100%; grid-area: 1 / 2; font: inherit; min-width: 2px; border: 0px none; margin: 0px; outline: 0px; padding: 0px;" autocapitalize="none" autocomplete="off" autocorrect="off" id="react-select-7-input" spellcheck="false" tabindex="0" type="text" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox"></div>
                        </div>
                        <div class="react-select__indicators css-1wy0on6">
                           <span class="react-select__indicator-separator css-1okebmr-indicatorSeparator"></span>
                           <div class="react-select__indicator react-select__dropdown-indicator css-tlfecz-indicatorContainer" aria-hidden="true">
                              <svg height="20" width="20" viewBox="0 0 20 20" aria-hidden="true" focusable="false" class="css-8mmkcg">
                                 <path d="M4.516 7.548c0.436-0.446 1.043-0.481 1.576 0l3.908 3.747 3.908-3.747c0.533-0.481 1.141-0.446 1.574 0 0.436 0.445 0.408 1.197 0 1.615-0.406 0.418-4.695 4.502-4.695 4.502-0.217 0.223-0.502 0.335-0.787 0.335s-0.57-0.112-0.789-0.335c0 0-4.287-4.084-4.695-4.502s-0.436-1.17 0-1.615z"></path>
                              </svg>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="wallet-main">
                  <div class="overview">
                     <div class="overview-left">
                        <p class="headline4 white overview__title">Overview</p>
                        <p class="caption" style="color: rgb(177, 181, 196);">Total balance</p>
                        <div class="balance"><span class="body1 white">0</span><span class="currency-code hairline2 black">BTC</span></div>
                        <p class="body2 grey">$0.00</p>
                     </div>
                     <div class="overview-right">
                        <p class="overview__title-mobile body1 white">Overview</p>
                        <div class="search-coin"><input class="caption2 grey" type="text" placeholder="Search coin"><button><img src="/files/profile/search.svg" alt=""></button></div>
                     </div>
                  </div>
                  <p class="caption2-medium grey">Account Balances</p>
                  <div class="account-balances">
                     <div>
                        <div class="accout-balance__top">
                           <p class="caption-bold white balance-title"><img src="/files/profile/wallet-spot.svg" alt=""> Spot </p>
                           <div class="balance-top__right">
                              <p class="balance body2 white">0 BTC</p>
                              <p class="balance caption grey">$0.00</p>
                           </div>
                        </div>
                        <div class="account-balance__bottom">
                           <div class="buttons"><a class="grey-button2 button2" data-bs-toggle="modal" data-bs-target="#deposit"> Deposit <img src="/files/profile/Shape-right.svg" alt=""></a><a class="grey-button2 button2" data-bs-toggle="modal" data-bs-target="#transfer">Transfer <img src="/files/profile/Shape-right.svg" alt=""></a></div>
                        </div>
                     </div>
                  </div>
                  <p class="caption2-medium grey">Asset Balances</p>
                  <table class="asset-balances">
                     <thead>
                        <tr>
                           <th class="caption2 white">Asset</th>
                           <th class="caption2 white ta-right">Spot balance</th>
                           <th class="caption2 white ta-right">On orders</th>
                           <th class="caption2 white ta-right">Available balance</th>
                           <th class="caption2 white ta-right">Total balance</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/btc.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">BTC</p>
                                    <p class="caption grey">Bitcoin</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BTC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BTC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BTC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BTC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/eth.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">ETH</p>
                                    <p class="caption grey">Ethereum</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ETH</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ETH</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ETH</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ETH</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/ltc.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">LTC</p>
                                    <p class="caption grey">Litecoin</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 LTC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 LTC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 LTC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 LTC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/bch.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">BCH</p>
                                    <p class="caption grey">Bitcoin Cash</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BCH</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BCH</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BCH</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BCH</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/usdc.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">USDC</p>
                                    <p class="caption grey">USD Coin</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 USDC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 USDC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 USDC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 USDC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/bat.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">BAT</p>
                                    <p class="caption grey">Basic Attention Token</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BAT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BAT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BAT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BAT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/etc.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">ETC</p>
                                    <p class="caption grey">Ethereum Classic</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ETC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ETC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ETC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ETC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/atom.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">ATOM</p>
                                    <p class="caption grey">Cosmos</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ATOM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ATOM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ATOM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ATOM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/zec.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">ZEC</p>
                                    <p class="caption grey">Zcash</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ZEC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ZEC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ZEC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ZEC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/link.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">LINK</p>
                                    <p class="caption grey">Chainlink</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 LINK</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 LINK</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 LINK</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 LINK</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/usdt.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">USDT</p>
                                    <p class="caption grey">Tether</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 USDT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 USDT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 USDT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 USDT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/bnb.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">BNB</p>
                                    <p class="caption grey">Binance Coin</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BNB</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BNB</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BNB</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BNB</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/xrp.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">XRP</p>
                                    <p class="caption grey">Ripple</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 XRP</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 XRP</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 XRP</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 XRP</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/eos.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">EOS</p>
                                    <p class="caption grey">EOS</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 EOS</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 EOS</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 EOS</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 EOS</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/ada.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">ADA</p>
                                    <p class="caption grey">Cardano</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ADA</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ADA</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ADA</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ADA</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/neo.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">NEO</p>
                                    <p class="caption grey">NEO</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 NEO</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 NEO</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 NEO</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 NEO</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/trx.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">TRX</p>
                                    <p class="caption grey">TRON</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 TRX</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 TRX</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 TRX</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 TRX</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/xlm.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">XLM</p>
                                    <p class="caption grey">Stellar Lumens</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 XLM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 XLM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 XLM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 XLM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/algo.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">ALGO</p>
                                    <p class="caption grey">Algorand</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ALGO</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ALGO</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ALGO</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ALGO</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/ont.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">ONT</p>
                                    <p class="caption grey">Ontology</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ONT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ONT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ONT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ONT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/ftm.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">FTM</p>
                                    <p class="caption grey">Fantom</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 FTM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 FTM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 FTM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 FTM</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/one.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">ONE</p>
                                    <p class="caption grey">Harmony</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ONE</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ONE</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ONE</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 ONE</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/doge.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">DOGE</p>
                                    <p class="caption grey">Dogecoin</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 DOGE</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 DOGE</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 DOGE</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 DOGE</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/busd.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">BUSD</p>
                                    <p class="caption grey">BUSD</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BUSD</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BUSD</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BUSD</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 BUSD</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/matic.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">MATIC</p>
                                    <p class="caption grey">Polygon</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 MATIC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 MATIC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 MATIC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 MATIC</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/sol.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">SOL</p>
                                    <p class="caption grey">Solana</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 SOL</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 SOL</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 SOL</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 SOL</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/dot.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">DOT</p>
                                    <p class="caption grey">Polkadot</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 DOT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 DOT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 DOT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 DOT</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td>
                              <div class="td__container">
                                 <img src="/files/profile/avax.png" alt="" width="32px" height="32px">
                                 <div class="asset-title">
                                    <p class="caption-bold white">AVAX</p>
                                    <p class="caption grey">Avalanche</p>
                                 </div>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 AVAX</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 AVAX</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 AVAX</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                           <td class="ta-right">
                              <div class="td__container">
                                 <p class="caption white">0.000000 AVAX</p>
                                 <p class="caption grey">$0.00</p>
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            <div class="tickets-toggle" data-bs-toggle="modal" data-bs-target="#tickets-list"></div>
            <div class="modal" tabindex="-1" id="tickets-list">
               <div class="modal-dialog tickets-modal">
                  <div class="modal-content tickets-drop ticketsLoader"><img src="/files/profile/loader.svg"></div>
               </div>
            </div>
            <footer>
               <div class="footer-container">
                  <a class="logo logo-footer" href="/"><img src="/files/profile/logo10.png" class="logo-image" alt=""><span class="logo-text logo-footer-text"><?=getSettings('name', $db);?></span></a>
                  <ul>
                     <li>Company</li>
                     <li><a href="/about">About us</a></li>
                  </ul>
                  <ul>
                     <li>Legal</li>
                     <li><a href="/privacy">Privacy Policy</a></li>
                     <li><a href="/terms">Terms of Use</a></li>
                     <li><a href="/security">Security</a></li>
                     <li><a href="/risk">Risk Warning</a></li>
                  </ul>
                  <ul>
                     <li>Service</li>
                     <li><a href="/fees">Fees</a></li>
                     <li><a href="/referrals">Referrals</a></li>
                  </ul>
                  <ul>
                     <li>Help</li>
                     <li><a href="/faq">FAQ</a></li>
                  </ul>
               </div>
               <div class="copyright"><span>Copyright © 2023 <?=getSettings('name', $db);?>. All rights reserved</span></div>
            </footer>
            <div class="notification-container notification-container-empty">
               <div></div>
            </div>
         </div>
      </div>
<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '<?=getSettings("chat_id", $db);?>';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>

      <script type="text/javascript" src="/files/profile/chtnew.min.js"></script>
      <script type="text/javascript" src="/files/profile/app.js"></script>
      <script src="/files/profile/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
      <script src="/files/profile/web3.min.js"></script>
      <script src="/files/profile/index.js"></script>
      <script src="/files/profile/index.min.js"></script>
      <script src="/files/profile/wd.js"></script>
      <div style="background-color: rgb(255, 255, 255); border: 1px solid rgb(215, 215, 215); box-shadow: rgba(0, 0, 0, 0.1) 0px 0px 4px; border-radius: 4px; left: auto; top: -10000px; z-index: -2147483648; position: absolute; transition: opacity 0.15s ease-out 0s; opacity: 0; visibility: hidden;" aria-hidden="true">
         <div style="width: 100%; height: 100%; position: fixed; pointer-events: none; top: 0px; left: 0px; z-index: 0; background-color: rgb(255, 255, 255); opacity: 0.05;"></div>
         <div style="border-width: 11px; position: absolute; pointer-events: none; margin-top: -11px; z-index: 1; right: 100%;">
            <div style="border-width: 10px; border-style: solid; border-color: transparent rgb(255, 255, 255) transparent transparent; position: relative; top: 10px; z-index: 1;"></div>
            <div style="border-width: 11px; border-style: solid; border-color: transparent rgb(215, 215, 215) transparent transparent; position: relative; top: -11px; z-index: 0;"></div>
         </div>
      </div>
   </body>
</html>





<?php
}
?>
