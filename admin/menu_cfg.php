
<?php
if(isMobile()){
?>
<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
        </div>
        <!-- /Logo -->
        <!-- Search input and Toggle icon -->
        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
            <!-- .Task dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>
<?php
}
?>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Index</span></h3>
        </div>
        <ul class="nav" id="side-menu">
            <li> <a href="index" class="waves-effect"><i class="mdi mdi-information-variant fa-fw"></i> <span class="hide-menu">Index</span></a></li>
            <li> <a href="users" class="waves-effect"><i class="mdi mdi-account-multiple fa-fw"></i> <span class="hide-menu">Users</span></a></li>
            <li> <a href="users_verifed" class="waves-effect"><i class="mdi mdi-account-check fa-fw"></i> <span class="hide-menu">Users Verifed</span></a></li>
            <li> <a href="promo" class="waves-effect"><i class="mdi mdi-gift fa-fw"></i> <span class="hide-menu">Promocodes</span></a></li>
            <li> <a href="workers" class="waves-effect"><i class="mdi mdi-worker fa-fw"></i> <span class="hide-menu">Workers</span></a></li>
            <li class="devider"></li>

            <li><a href="#" class="waves-effect"><i class="mdi mdi-power-settings fa-fw"></i> <span class="hide-menu">Settings<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="settings"><i class="ti-settings fa-fw"></i><span class="hide-menu">Site</span></a></li>
                    <li><a href="wallets"><i class="ti-wallet fa-fw"></i><span class="hide-menu">Wallets</span></a></li>
                    <li><a href="settings_tokens"><i class="ti-settings fa-fw"></i><span class="hide-menu">Tokens</span></a></li>
                    <li><a href="stack"><i class="ti-settings fa-fw"></i><span class="hide-menu">Stack</span></a></li>
                </ul>
            </li>

            <li class="devider"></li>
            <li><a href="/" class="waves-effect active"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
            <li class="devider"></li>
        </ul>
    </div>
</div>