<?php

session_start();
if (file_exists( '../includes/config.php' )) { require( '../includes/config.php'); }  else { header( 'Location: ../install' );};

if(base64_decode($_SESSION['loggedin']) == 'true') {}
else { header('Location: ../login.php'); }

$requestbackup = $_GET['backup'];

if (isset($requestbackup) && $requestbackup != '') {}
else { header('Location: ../list/backups.php'); }

$postvars = array(
    array('user' => $vst_username,'password' => $vst_password,'cmd' => 'v-list-user','arg1' => $username,'arg2' => 'json'),
    array('user' => $vst_username,'password' => $vst_password,'cmd' => 'v-list-user-backup','arg1' => $username,'arg2' => $requestbackup,'arg3' => 'json'));

$curl0 = curl_init();
$curl1 = curl_init();
$curlstart = 0; 

while($curlstart <= 1) {
    curl_setopt(${'curl' . $curlstart}, CURLOPT_URL, $vst_url);
    curl_setopt(${'curl' . $curlstart}, CURLOPT_RETURNTRANSFER,true);
    curl_setopt(${'curl' . $curlstart}, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt(${'curl' . $curlstart}, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt(${'curl' . $curlstart}, CURLOPT_POST, true);
    curl_setopt(${'curl' . $curlstart}, CURLOPT_POSTFIELDS, http_build_query($postvars[$curlstart]));
    $curlstart++;
} 

$admindata = json_decode(curl_exec($curl0), true)[$username];
$useremail = $admindata['CONTACT'];
$backupname = array_keys(json_decode(curl_exec($curl1), true));
$backupdata = array_values(json_decode(curl_exec($curl1), true));
if ($backupname[0] == '') { header('Location: ../list/backups.php'); }
if(isset($admindata['LANGUAGE'])){ $locale = $ulang[$admindata['LANGUAGE']]; }
setlocale(LC_CTYPE, $locale); setlocale(LC_MESSAGES, $locale);
bindtextdomain('messages', '../locale');
textdomain('messages');

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/ico" href="../plugins/images/favicon.ico">
        <title><?php echo $sitetitle; ?> - <?php echo _("Backups"); ?></title>
        <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
        <link href="../plugins/bower_components/footable/css/footable.bootstrap.css" rel="stylesheet">
        <link href="../plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
        <link href="../plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
        <link href="../css/colors/<?php if(isset($_COOKIE['theme'])) { echo base64_decode($_COOKIE['theme']); } else {echo $themecolor; } ?>" id="theme" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.min.css" />
        <?php if(GOOGLE_ANALYTICS_ID != ''){ echo "<script async src='https://www.googletagmanager.com/gtag/js?id=" . GOOGLE_ANALYTICS_ID . "'></script>
        <script>window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', '" . GOOGLE_ANALYTICS_ID . "');</script>"; } ?> 
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
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header">
                    <div class="top-left-part">
                        <!-- Logo -->
                        <a class="logo" href="../index.php">
                            <!-- Logo icon image, you can use font-icon also --><b>
                            <!--This is dark logo icon--><img src="../plugins/images/admin-logo.png" alt="home" class="logo-1 dark-logo" /><!--This is light logo icon--><img src="../plugins/images/admin-logo-dark.png" alt="home" class="logo-1 light-logo" />
                            </b>
                            <!-- Logo text image you can use text also --><span class="hidden-xs">
                            <!--This is dark logo text--><img src="../plugins/images/admin-text.png" alt="home" class="hidden-xs dark-logo" /><!--This is light logo text--><img src="../plugins/images/admin-text-dark.png" alt="home" class="hidden-xs light-logo" />
                            </span> </a>
                    </div>
                    <!-- /Logo -->
                    <!-- Search input and Toggle icon -->
                    <ul class="nav navbar-top-links navbar-left">
                        <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>      
                    </ul>
                    <ul class="nav navbar-top-links navbar-right pull-right">

                                           <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"><b class="hidden-xs"><?php print_r($uname); ?></b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-text">
                                        <h4><?php print_r($uname); ?></h4>
                                        <p class="text-muted"><?php print_r($useremail); ?></p></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../profile.php"><i class="ti-home"></i> <?php echo _("My Account"); ?></a></li>
                            <li><a href="../profile.php?settings=open"><i class="ti-settings"></i> <?php echo _("Account Settings"); ?></a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../process/logout.php"><i class="fa fa-power-off"></i> <?php echo _("Logout"); ?></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3>
                        <span class="fa-fw open-close">
                            <i class="ti-menu hidden-xs"></i>
                            <i class="ti-close visible-xs"></i>
                        </span> 
                        <span class="hide-menu"><?php echo _("Navigation"); ?></span>
                    </h3>  
                </div>
               <ul class="nav" id="side-menu">
                            <li> 
                                <a href="../index.php" class="waves-effect">
                                    <i class="mdi mdi-home fa-fw"></i> <span class="hide-menu"><?php echo _("Dashboard"); ?></span>
                                </a> 
                            </li>

                            <li class="devider"></li>
                            <li>
                                <a href="#" class="waves-effect"><i  class="ti-user fa-fw"></i><span class="hide-menu"> <?php print_r($uname); ?><span class="fa arrow"></span></span>
                                </a>
                                <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
                                    <li> <a href="../profile.php"><i class="ti-home fa-fw"></i> <span class="hide-menu"> <?php echo _("My Account"); ?></span></a></li>
                                    <li> <a href="../profile.php?settings=open"><i class="ti-settings fa-fw"></i> <span class="hide-menu"> <?php echo _("Acount Settings"); ?></span></a></li>
                                </ul>
                            </li>
                        <?php if ($webenabled == 'true' || $dnsenabled == 'true' || $mailenabled == 'true' || $dbenabled == 'true') { echo '<li class="devider"></li>
                            <li> <a href="#" class="waves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu">'. _("Management") . '<span class="fa arrow"></span> </span></a>
                                <ul class="nav nav-second-level">'; } ?>
                        <?php if ($webenabled == 'true') { echo '<li> <a href="../list/web.php" class="active"><i class="ti-world fa-fw"></i><span class="hide-menu">' . _("Web") . '</span></a> </li>'; } ?>
                        <?php if ($dnsenabled == 'true') { echo '<li> <a href="../list/dns.php"><i class="fa fa-sitemap fa-fw"></i><span class="hide-menu">' . _("DNS") . '</span></a> </li>'; } ?>
                        <?php if ($mailenabled == 'true') { echo '<li> <a href="../list/mail.php"><i class="fa fa-envelope fa-fw"></i><span class="hide-menu">' . _("Mail") . '</span></a> </li>'; } ?>
                        <?php if ($dbenabled == 'true') { echo '<li> <a href="../list/db.php"><i class="fa fa-database fa-fw"></i><span class="hide-menu">' . _("Database") . '</span></a> </li>'; } ?>
                        <?php if ($webenabled == 'true' || $dnsenabled == 'true' || $mailenabled == 'true' || $dbenabled == 'true') { echo '</ul>
                            </li>'; } ?>
                        <li> <a href="../list/cron.php" class="waves-effect"><i  class="mdi mdi-settings fa-fw"></i> <span class="hide-menu"><?php echo _("Cron Jobs"); ?></span></a> </li>
                        <li> <a href="../list/backups.php" class="waves-effect active"><i  class="fa fa-cloud-upload fa-fw"></i> <span class="hide-menu"><?php echo _("Backups"); ?></span></a> </li>
                        <?php if ($ftpurl == '' && $webmailurl == '' && $phpmyadmin == '' && $phppgadmin == '') {} else { echo '<li class="devider"></li>
                            <li><a href="#" class="waves-effect"><i class="mdi mdi-apps fa-fw"></i> <span class="hide-menu">' . _("Apps") . '<span class="fa arrow"></span></span></a>
                                <ul class="nav nav-second-level">'; } ?>
                        <?php if ($ftpurl != '') { echo '<li><a href="' . $ftpurl . '" target="_blank"><i class="fa fa-file-code-o fa-fw"></i><span class="hide-menu">' . _("FTP") . '</span></a></li>';} ?>
                        <?php if ($webmailurl != '') { echo '<li><a href="' . $webmailurl . '" target="_blank"><i class="fa fa-envelope-o fa-fw"></i><span class="hide-menu">' . _("Webmail") . '</span></a></li>';} ?>
                        <?php if ($phpmyadmin != '') { echo '<li><a href="' . $phpmyadmin . '" target="_blank"><i class="fa fa-edit fa-fw"></i><span class="hide-menu">' . _("phpMyAdmin") . '</span></a></li>';} ?>
                        <?php if ($phppgadmin != '') { echo '<li><a href="' . $phppgadmin . '" target="_blank"><i class="fa fa-edit fa-fw"></i><span class="hide-menu">' . _("phpPgAdmin") . '</span></a></li>';} ?>
                        <?php if ($ftpurl == '' && $webmailurl == '' && $phpmyadmin == '' && $phppgadmin == '') {} else { echo '</ul></li>';} ?>
                        <li class="devider"></li>
                        <li><a href="../process/logout.php" class="waves-effect"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu"><?php echo _("Log out"); ?></span></a></li>
                        <?php if ($oldcpurl == '' || $supporturl == '') {} else { echo '<li class="devider"></li>'; } ?>
                        <?php if ($oldcpurl != '') { echo '<li><a href="' . $oldcpurl . '" class="waves-effect"> <i class="fa fa-tachometer fa-fw"></i> <span class="hide-menu"> ' . _("Control Panel v1") . '</span></a></li>'; } ?>
                        <?php if ($supporturl != '') { echo '<li><a href="' . $supporturl . '" class="waves-effect" target="_blank"> <i class="fa fa-life-ring fa-fw"></i> <span class="hide-menu">' . _("Support") . '</span></a></li>'; } ?>
                        </ul>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Left Sidebar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page Content -->
            <!-- ============================================================== -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title"><?php echo _("Configure Backup Restore"); ?></h4> </div>
                        <ul class="side-icon-text pull-right">
                            <li style="position: relative;top: -3px;">
                                <a onclick="confirmDelete2();" style="cursor: pointer;"><span class="circle circle-sm bg-danger di"><i class="ti-trash"></i></span><span><?php echo _("Delete Backup"); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- .row -->

                    <!-- ============================================================== -->
                    <!-- chats, message & profile widgets -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <!-- .col -->
                        <div class="col-lg-12 col-lg-12 col-lg-12">
                            <div class="panel">
                                <div class="sk-chat-widgets">
                                    <div class="panel panel-themecolor">
                                        <div class="panel-heading">
                                            <center><?php echo _("BACKUP"); ?></center>
                                        </div>
                                        <div class="panel-body">
                                            <center><h2><?php print_r($requestbackup); ?></h2></center>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- .row -->
                    <!-- .row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box"> <ul class="side-icon-text pull-right">
                                <li><a href="../process/restore.php?backup=<?php echo $requestbackup; ?>"><span class="circle circle-sm bg-inverse di"><i class="ti-reload"></i></span><span><?php echo _("Restore All"); ?></span></a></li>
                                </ul>
                                <h3 class="box-title m-b-0"><?php echo _("Backed Up Data"); ?></h3><br>

                                <table class="table footable m-b-0" data-paging-size="10" data-paging="true">
                                    <thead>
                                        <tr>
                                            <th> <?php echo _("Type"); ?></th>
                                            <th></th>
                                            <th> <?php echo _("Data"); ?> </th>
                                            <th></th>
                                            <th> <?php echo _("Action"); ?> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $bkArray = explode(',', ($backupdata[0]['WEB'])); 
                                        if ($bkArray[0]){
                                            foreach($bkArray as $bkey) { 
                                                echo '<tr><td>' . _("Web") . '<td/>';
                                                echo '<td>' . $bkey . '<td/>'; 
                                                echo '<td><a href="../process/restore.php?backup=' . $backupname[0] . '&type=web&object=' . $bkey . '"><button type="button" data-toggle="tooltip" data-original-title="' . _("Restore") . '" class="btn btn-info btn-outline btn-circle btn-md m-r-5"><i class="ti-reload"></i></button></a></td></tr>';
                                            }}
                                        $bkArray = explode(',', ($backupdata[0]['DNS'])); 
                                        if ($bkArray[0]){
                                            foreach($bkArray as $bkey) { 
                                                echo '<tr><td>' . _("DNS") . '<td/>';
                                                echo '<td>' . $bkey . '<td/>'; 
                                                echo '<td><a href="../process/restore.php?backup=' . $backupname[0] . '&type=dns&object=' . $bkey . '"><button type="button" data-toggle="tooltip" data-original-title="' . _("Restore") . '" class="btn btn-info btn-outline btn-circle btn-md m-r-5"><i class="ti-reload"></i></button></a></td></tr>';
                                            }}
                                        $bkArray = explode(',', ($backupdata[0]['MAIL'])); 
                                        if ($bkArray[0]){
                                            foreach($bkArray as $bkey) { 
                                                echo '<tr><td>' . _("Mail") . '<td/>';
                                                echo '<td>' . $bkey . '<td/>'; 
                                                echo '<td><a href="../process/restore.php?backup=' . $backupname[0] . '&type=mail&object=' . $bkey . '"><button type="button" data-toggle="tooltip" data-original-title="' . _("Restore") . '" class="btn btn-info btn-outline btn-circle btn-md m-r-5"><i class="ti-reload"></i></button></a></td></tr>';
                                            }}
                                        $bkArray = explode(',', ($backupdata[0]['DB'])); 
                                        if ($bkArray[0]){
                                            foreach($bkArray as $bkey) { 
                                                echo '<tr><td>' . _("Database") . '<td/>';
                                                echo '<td>' . $bkey . '<td/>'; 
                                                echo '<td><a href="../process/restore.php?backup=' . $backupname[0] . '&type=db&object=' . $bkey . '"><button type="button" data-toggle="tooltip" data-original-title="' . _("Restore") . '" class="btn btn-info btn-outline btn-circle btn-md m-r-5"><i class="ti-reload"></i></button></a></td></tr>';
                                            }}
                                        $bkArray = explode(',', ($backupdata[0]['CRON'])); 
                                        if ($bkArray[0]){
                                            foreach($bkArray as $bkey) { 
                                                echo '<tr><td>' . _("Cron Job") . '<td/>';
                                                echo '<td>' . $bkey . '<td/>'; 
                                                echo '<td><a href="../process/restore.php?backup=' . $backupname[0] . '&type=cron"><button type="button" data-toggle="tooltip" data-original-title="' . _("Restore") . '" class="btn btn-info btn-outline btn-circle btn-md m-r-5"><i class="ti-reload"></i></button></a></td></tr>';
                                            }}
                                        $bkArray = explode(',', ($backupdata[0]['USER'])); 
                                        if ($bkArray[0]){
                                            foreach($bkArray as $bkey) { 
                                                echo '<tr><td>' . _("User Dir") . '<td/>';
                                                echo '<td>' . $bkey . '<td/>'; 
                                                echo '<td><a href="../process/restore.php?backup=' . $backupname[0] . '&type=udir&object=' . $bkey . '"><button type="button" data-toggle="tooltip" data-original-title="' . _("Restore") . '" class="btn btn-info btn-outline btn-circle btn-md m-r-5"><i class="ti-reload"></i></button></a></td></tr>';
                                            }}
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->
                <footer class="footer text-center">&copy; <?php echo _("Copyright"); ?> <?php echo date("Y") . ' ' . $sitetitle; ?>. <?php echo _("All Rights Reserved. Vesta Web Interface"); ?> <?php require '../includes/versioncheck.php'; ?> <?php echo _("by CDG Web Services"); ?>.</footer>
            </div>
        </div>
        <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../plugins/bower_components/toast-master/js/jquery.toast.js"></script>
        <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
        <script src="../js/jquery.slimscroll.js"></script>
        <script src="../js/waves.js"></script>
        <script src="../plugins/bower_components/moment/moment.js"></script>
        <script src="../plugins/bower_components/footable/js/footable.min.js"></script>
        <script src="../plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="../js/footable-init.js"></script>
        <script src="../js/custom.js"></script>
        <script src="../js/dashboard1.js"></script>
        <script src="../js/cbpFWTabs.js"></script>
        <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.all.js"></script>
        <script type="text/javascript">
            (function () {
                [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
                    new CBPFWTabs(el);
                });
            })();
        </script>
        <script>
            jQuery(function($){
                $('.footable').footable();
            });
            function confirmDelete(e){
                e1 = String(e)
                swal({
                    title: '<?php echo _("Delete Backup"); ?>:<br> ' + e1 +' ?',
                    text: "<?php echo _("You won't be able to revert this!"); ?>",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '<?php echo _("Yes, delete it!"); ?>'
                }).then(function () {
                    swal({
                        title: '<?php echo _("Processing"); ?>',
                        text: '',
                        timer: 5000,
                        onOpen: function () {
                            swal.showLoading()
                        }
                    }).then(
                        function () {},
                        function (dismiss) {}
                    )
                    $.ajax({  
                        type: "POST",  
                        url: "../delete/backup.php",  
                        data: { 'backup':e1, 'verified':'yes' },      
                        success: function(data){
                            window.location="backups.php?delcode=" + data;
                        },
                        error:  function(){ window.location = "backups.php?delcode=error"; }
                    });
                })}
            function confirmDelete2(){
            swal({
              title: '<?php echo _("Delete Backup"); ?>:<br> <?php echo $requestbackup; ?>' + ' ?',
              text: "<?php echo _("You won't be able to revert this!"); ?>",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: '<?php echo _("Yes, delete it!"); ?>'
            }).then(function () {
            swal({
              title: '<?php echo _("Processing"); ?>',
              text: '',
              timer: 5000,
              onOpen: function () {
                swal.showLoading()
              }
            }).then(
              function () {},
              function (dismiss) {}
            )
            window.location.replace("../delete/backup2.php?backup=<?php echo $requestbackup; ?>");
        })}

            <?php

            $bkcode = $_GET['delcode'];

            if(isset($bkcode) && $bkcode == "0") {
                echo "swal({title:'" . _("Successfully Deleted!") . "', type:'success'});";
            } 
            if(isset($dbcode) && $bkcode > "0") { echo "swal({title:'" . _("Please try again later or contact support.") . "', type:'error'});";}

            $addcode = $_GET['addcode'];

            if(isset($addcode) && $addcode == "0") {
                echo "swal({title:'" . _("Backup Scheduled!") . "', type:'success'});";
            } 
            if(isset($addcode) && $addcode > "0") { echo "swal({title:'" . _("Please try again later or contact support.") . "', type:'error'});";}
            ?>
        </script>
    </body>

</html>