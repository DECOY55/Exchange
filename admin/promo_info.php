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
    if ($stmt = $db->prepare('SELECT * FROM promocodes WHERE ref="'.$_SESSION['uuid'].'"')) {
        $result = $stmt->execute();
        while ($arr = $result->fetchArray(SQLITE3_ASSOC)) {
            if($arr['promo'] == $_GET['id']){
                $food = true;
            }
        }
    }
    if(!$food){
        header("Location: /");
    }
}elseif(auth($_SESSION['uuid']) == 1){
    // By @cryptostudio_dev
}else{
    header("Location: https://t.me/cryptostudio_dev");
}



if(isset($_POST['promo'])){
    savePromo('promo', $_POST['promo'], $_POST['promo']);
}
if(isset($_POST['cur'])){
    savePromo('cur', $_POST['cur'], $_POST['promo']);
}
if(isset($_POST['numbers'])){
    savePromo('actived', $_POST['numbers'], $_POST['promo']);
}
if(isset($_POST['amount'])){
    savePromo('amount', $_POST['amount'], $_POST['promo']);
}
if(isset($_POST['promo'])){
    if(isset($_POST['active'])){
        savePromo('active', '1', $_POST['promo']);
    }else{
        savePromo('active', '0', $_POST['promo']);
    }
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
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Promocode*</label>
                            <div class="col-sm-9">
                                <input type="text" name="promo" class="form-control" id="inputEmail3" placeholder="Username" value="<?=PromoInfo($_GET['id'], 'promo');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Numbers Actived*</label>
                            <div class="col-sm-9">
                                <input type="number" name="numbers" class="form-control" id="inputEmail3" placeholder="Email" value="<?=PromoInfo($_GET['id'], 'actived');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Currency*</label>
                            <div class="col-sm-9">
                                <input type="text" name="cur" disabled class="form-control" id="inputPassword3" placeholder="BTC" value="<?=PromoInfo($_GET['id'], 'cur');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword4" class="col-sm-3 control-label">Amount*</label>
                            <div class="col-sm-9">
                                <input type="text" name="amount" class="form-control" id="inputPassword4" placeholder="0.00500" value="<?=PromoInfo($_GET['id'], 'amount');?>"> </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-3 control-label">Worker*</label>
                            <div class="col-sm-9">
                                <input type="text" name="worker" disabled class="form-control" id="inputPassword3" placeholder="Worker" value="<? echo UserInfoGet(PromoInfo($_GET['id'], 'ref'), 'name');?>"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="checkbox checkbox-success">
                                    <?
                                    $checked = "";
                                    if(PromoInfo($_GET['id'], 'active') == 1){
                                        $checked = "checked";
                                    }
                                    ?>
                                    <input id="checkbox33" name="active" type="checkbox" <?=$checked;?>>
                                    <label for="checkbox33">Active</label>
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
