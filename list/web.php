***REMOVED***

require '../includes/config.php';

    if(base64_decode($_COOKIE['loggedin']) == 'true') {***REMOVED***
      else { header('Location: ../login.php'); ***REMOVED***

    $postvars = array(
      array('user' => $vst_username,'password' => $vst_password,'cmd' => 'v-list-user','arg1' => $username,'arg2' => 'json'),
      array('user' => $vst_username,'password' => $vst_password,'cmd' => 'v-list-web-domains','arg1' => $username,'arg2' => 'json'));

    $curl0 = curl_init();
    $curl1 = curl_init();
    $curlstart = 0; 

    while($curlstart <= 1) {
        curl_setopt(${'curl' . $curlstart***REMOVED***, CURLOPT_URL, $vst_url);
        curl_setopt(${'curl' . $curlstart***REMOVED***, CURLOPT_RETURNTRANSFER,true);
        curl_setopt(${'curl' . $curlstart***REMOVED***, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt(${'curl' . $curlstart***REMOVED***, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt(${'curl' . $curlstart***REMOVED***, CURLOPT_POST, true);
        curl_setopt(${'curl' . $curlstart***REMOVED***, CURLOPT_POSTFIELDS, http_build_query($postvars[$curlstart]));
        $curlstart++;
    ***REMOVED*** 

    $admindata = json_decode(curl_exec($curl0), true)[$username];
    $useremail = $admindata[CONTACT];
    $domainname = array_keys(json_decode(curl_exec($curl1), true));
    $domaindata = array_values(json_decode(curl_exec($curl1), true));
***REMOVED***

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/ico" href="../plugins/images/favicon.ico">
    <title>***REMOVED*** echo $sitetitle; ***REMOVED*** - Web</title>
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/footable/css/footable.bootstrap.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/colors/blue.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.min.css" />
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
                        <!--This is dark logo icon--><img src="../plugins/images/admin-logo.png" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="../plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
                     </b>
                        <!-- Logo text image you can use text also --><span class="hidden-xs">
                        <!--This is dark logo text--><img src="../plugins/images/admin-text.png" alt="home" class="dark-logo" /><!--This is light logo text--><img src="../plugins/images/admin-text-dark.png" alt="home" class="light-logo" />
                     </span> </a>
                </div>
                <!-- /Logo -->
                <!-- Search input and Toggle icon -->
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>      
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">

                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"><b class="hidden-xs">***REMOVED*** print_r($uname); ***REMOVED***</b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-text">
                                        <h4>***REMOVED*** print_r($uname); ***REMOVED***</h4>
                                        <p class="text-muted">***REMOVED*** print_r($useremail); ***REMOVED***</p></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../profile.php"><i class="ti-home"></i> My Account</a></li>
                            <li><a href="../profile.php?settings=open"><i class="ti-settings"></i> Account Setting</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../process/logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <ul class="nav" id="side-menu">
                    <li> <a href="../index.php" class="waves-effect"><i class="mdi mdi-home fa-fw"></i> <span class="hide-menu">Dashboard</span></a> </li>
                    <li class="devider"></li>
                    <li>
                        <a active href="#" class="waves-effect"><i  class="ti-user fa-fw"></i> </i> <span class="hide-menu"> ***REMOVED*** print_r($uname); ***REMOVED***<span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level collapse" aria-expanded="true">
                            <li> <a href="../profile.php"><i class="ti-home fa-fw"></i> <span class="hide-menu"> My Account</span></a></li>
                            <li> <a active href="../profile.php?settings=open" class="active"><i class="ti-settings fa-fw"></i> <span class="hide-menu"> Account Setting</span></a></li>
                        </ul>
                    </li>
                    <li class="devider"></li>
                    <li> <a href="#" class="awaves-effect"><i class="mdi mdi-av-timer fa-fw" data-icon="v"></i> <span class="hide-menu">Management <span class="fa arrow"></span> </span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="../list/web.php"><i class="ti-world fa-fw"></i><span class="hide-menu">Web</span></a> </li>
                            <li> <a href="../list/dns.php"><i class="fa fa-sitemap fa-fw"></i><span class="hide-menu">DNS</span></a> </li>
                            <li> <a href="../list/mail.php"><i class="fa fa-envelope fa-fw"></i><span class="hide-menu">Mail</span></a> </li>
                            <li> <a href="../list/db.php"><i class="fa fa-database fa-fw"></i><span class="hide-menu">Database</span></a> </li>
                        </ul>
                    </li>
                    <li> <a href="../list/cron.php" class="waves-effect"><i  class="mdi mdi-settings fa-fw"></i> <span class="hide-menu">Cron Jobs</span></a> </li>
                    <li> <a href="../list/backups.php" class="waves-effect"><i  class="fa fa-cloud-upload fa-fw"></i> <span class="hide-menu">Backups</span></a> </li>   
                    <li class="devider"></li>                
                    <li><a href="#" class="waves-effect"><i class="mdi mdi-apps fa-fw"></i> <span class="hide-menu">Apps<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="https://webftp.cdgtech.one"><i class="fa fa-file-code-o fa-fw"></i><span class="hide-menu">FTP</span></a></li>
                            <li><a href="https://usermail.cdgtech.one"><i class="fa fa-envelope-o fa-fw"></i><span class="hide-menu">Webmail</span></a></li>
                            <li><a href="https://host.cdgtech.one/phpmyadmin"><i class="fa fa-edit fa-fw"></i><span class="hide-menu">phpMyAdmin</span></a></li>
    
                        </ul>
                    </li>
                    <li class="devider"></li>
                    <li><a href="../process/logout.php" class="waves-effect"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Log out</span></a></li>
                    <li class="devider"></li>
                            <li>
                                <a href="https://host.cdgtech.one:8083" class="waves-effect"> <i class="fa fa-tachometer fa-fw"></i> <span class="hide-menu"> Control Panel v1</span></a>
                            </li>
                            <li>
                                <a href="http://cdgsupport.epizy.com" class="waves-effect"> <i class="fa fa-life-ring fa-fw"></i> <span class="hide-menu">Support</span></a>
                            </li>
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
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Manage Web Domains</h4> </div>
                    <!-- /.page title -->
                </div>
                <!-- .row -->

                <!-- ============================================================== -->
                <!-- chats, message & profile widgets -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- .col -->
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="panel">
                            <div class="sk-chat-widgets">
                                <div class="panel panel-themecolor">
                                    <div class="panel-heading">
                                        <center>DOMAINS</center>
                                    </div>
                                    <div class="panel-body">
   <center><h2>***REMOVED*** print_r($admindata[U_WEB_DOMAINS]); ***REMOVED***</h2></center>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <!-- .col -->
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="panel">
                            <div class="sk-chat-widgets">
                                <div class="panel panel-themecolor">
                                    <div class="panel-heading">
                                        <center>ALIASES</center>
                                    </div>
                                    <div class="panel-body">
   <center><h2>***REMOVED*** print_r($admindata[U_WEB_ALIASES]); ***REMOVED***</h2></center>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <!-- .col -->
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="panel">
                            <div class="sk-chat-widgets">
                                <div class="panel panel-themecolor">
                                    <div class="panel-heading">
                                        <center>SUSPENDED</center>
                                    </div>
                                    <div class="panel-body">
   <center><h2>***REMOVED*** print_r($admindata[SUSPENDED_WEB]); ***REMOVED***</h2></center>
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
                                                        <li><a href="../add/omain.php"><span class="circle circle-sm bg-success di"><i class="ti-plus"></i></span><span>Add Domain</span></a></li>
                                                    </ul>
                            <h3 class="box-title m-b-0">Web Domains</h3><br>

                           <table class="table footable m-b-0" data-paging-size="10" data-paging="true" data-sorting="true">
                                <thead>
                                    <tr>
                                        <th data-toggle="true"> Domain Name </th>
                                        <th data-type="numeric"> Disk Usage </th>
                                        <th data-type="numeric"> Bandwidth </th>
                                        <th> Status </th>
                                        <th data-type="date" data-format-string="YYYY-MM-DD"> Created </th>
                                        <th data-sortable="false"> Action </th>
                                        <th data-breakpoints="all"> Aliases </th>
                                        <th data-breakpoints="all"> Web Template </th>
                                        <th data-breakpoints="all"> Proxy Template </th>
                                        <th data-breakpoints="all"> Additional FTP </th>
                                        <th data-breakpoints="all"> Web Statistics </th>
                                        <th data-breakpoints="all"> IP </th>
                                        <th data-breakpoints="all"> SSL </th>
                                    </tr>
                                </thead>
                                <tbody>
***REMOVED***
if($domainname[0] != '') { 
                                                                $x1 = 0; 

                                                                do {
                                                                    echo '<tr>
                                                                    <td>' . $domainname[$x1] . '</td>
                                                                    <td data-sort-value="' . $domaindata[$x1][U_DISK] . '">' . $domaindata[$x1][U_DISK] . ' mb</td>
                                                                    <td data-sort-value="' . $domaindata[$x1][U_BANDWIDTH] . '">' . $domaindata[$x1][U_BANDWIDTH] . ' mb</td><td>';                                                                   
                                                                    if($domaindata[$x1][SUSPENDED] == "no"){ 
                                                                             echo '<span class="label label-table label-success">Active</span>';***REMOVED*** 
                                                                           ***REMOVED*** 
                                                                             echo '<span class="label label-table label-danger">Suspended</span>';***REMOVED*** 
                                                                           echo '</td>
                                                                    <td data-sort-value="' . $domaindata[$x1][DATE] . '">' . $domaindata[$x1][DATE] . '</td><td>
                                            <button type="button" onclick="window.location=\'../edit/domain.php?domain=' . $domainname[$x1] . '\';" data-toggle="tooltip" data-original-title="Edit" class="btn btn-info btn-outline btn-circle btn-md m-r-5"><i class="ti-pencil-alt"></i></button><button onclick="confirmDelete(\'' . $domainname[$x1] . '\')" type="button" data-toggle="tooltip" data-original-title="Delete" class="btn btn-info btn-outline btn-circle btn-md m-r-5"><i class="icon-trash"></i></button>'; if($domaindata[$x1][STATS] != ""){  echo '<button type="button" onclick="window.location=\'http://' . $domainname[$x1] . '/vstats/\';" data-toggle="tooltip" data-original-title="View Stats" class="btn btn-info btn-outline btn-circle btn-md m-r-5"><i class="ti-stats-up"></i></button>';***REMOVED*** echo '
                                        </td>
                                                                    <td>'; if(implode(', ', explode(",", $domaindata[$x1][ALIAS])) == "") { echo "None";***REMOVED*** ***REMOVED*** echo implode(', ', explode(",", $domaindata[$x1][ALIAS]));***REMOVED*** echo '</td>
                                                                    <td>' . ucfirst($domaindata[$x1][TPL]) . '</td>
                                                                    <td>' . ucfirst($domaindata[$x1][PROXY]) . '</td>
                                                                    <td>'; if($domaindata[$x1][FTP_USER] == ""){ 
                                                                             echo 'None';***REMOVED*** 
                                                                           ***REMOVED*** 
                                                                             echo $domaindata[$x1][FTP_USER];***REMOVED*** 
                                                                           echo '</td>
                                                                    <td>'; if($domaindata[$x1][STATS] == ""){ 
                                                                             echo 'None';***REMOVED*** 
                                                                           ***REMOVED*** 
                                                                             echo ucfirst($domaindata[$x1][STATS]);***REMOVED*** 
                                                                           echo '</td><td>' . $domaindata[$x1][IP] . '</td>      
                                                                    <td>'; if($domaindata[$x1][SSL] == "no"){ 
                                                                             echo '<span class="label label-table label-danger">Disabled</span>';***REMOVED*** 
                                                                           ***REMOVED*** 
                                                                             echo '<span class="label label-table label-success">Enabled</span>';***REMOVED*** 
                                                                           echo '</td>
                                                                    </tr>';
                                                                    $x1++;
                                                                ***REMOVED*** while ($domainname[$x1] != ''); ***REMOVED***
                                                            ***REMOVED***
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
           <footer class="footer text-center">&copy; Copyright ***REMOVED*** echo date("Y") . ' ' . $sitetitle; ***REMOVED***. All Rights Reserved. Powered by VestaCP, CDG Web Services, & WrapPixel.</footer>
    </div>

    </div>
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <script src="../js/jquery.slimscroll.js"></script>
    <script src="../js/waves.js"></script>
    <script src="../plugins/bower_components/moment/moment.js"></script>
    <script src="../plugins/bower_components/footable/js/footable.min.js"></script>
    <script src="../plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="../js/footable-init.js"></script>
    <script src="../js/custom.min.js"></script>
    <script src="../js/dashboard1.js"></script>
    <script src="../js/cbpFWTabs.js"></script>
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.5/sweetalert2.all.js"></script>
    <script type="text/javascript">
        (function () {
                [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
                new CBPFWTabs(el);
            ***REMOVED***);
        ***REMOVED***)();
    </script>
<script>
jQuery(function($){
	$('.footable').footable();
***REMOVED***);
function confirmDelete(e){
e1 = String(e)
swal({
  title: 'Delete Web Domain:<br>' + e1 +' ?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
***REMOVED***).then(function () {
swal({
  title: 'Processing',
  text: '',
  timer: 5000,
  onOpen: function () {
    swal.showLoading()
  ***REMOVED***
***REMOVED***).then(
  function () {***REMOVED***,
  // handling the promise rejection
  function (dismiss) {
    if (dismiss === 'timer') {
      console.log('I was closed by the timer')
    ***REMOVED***
  ***REMOVED***
)
$.ajax({  
    type: "GET",  
    url: "../delete/domain.php",  
    data: { 'domain':e1, 'verified':'yes' ***REMOVED***,
success:  function(){ window.location = "web.php?delcode=0"; ***REMOVED***,
error:  function(){ window.location = "web.php?delcode=0"; ***REMOVED***
***REMOVED***)
***REMOVED***)***REMOVED***

***REMOVED*** if($_GET['delcode'] == "0"){ echo "swal({title:'Successfully Deleted!', type:'success'***REMOVED***);";***REMOVED*** ***REMOVED***
</script>
</body>

</html>