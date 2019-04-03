<?php
$host="localhost";
$user="eavnicom_eavni";
$pass="jePuc-*qO9";
$db="eavnicom_sadna";

session_start();
if(!isset($_SESSION['userName']))
{
header("Location:login.php");
    exit();
}

$conn=new mysqli($host,$user,$pass,$db);
$conn->set_charset("utf8");
if ($conn->connect_error){
die("Connection failed: ".$conn->connect_error);}

$sql="SELECT * FROM users WHERE userName=?";
       $stmt=mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$sql))
        {
             header('location: login.php?error=sqlerror');
       exit();
            
        }
        else
        {
            
            mysqli_stmt_bind_param($stmt,"s",$_SESSION['userName']);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            
            if($row=mysqli_fetch_assoc($result))
            {
                $userName= $row['userName'];
                $email=$row['email'];
                $path=$row['profilePic'];
            }
       }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <title>Preadmin - Bootstrap Admin Template</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/morris/morris.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="index.php" class="logo">
                    <img src="assets/img/logo.png" width="40" height="40" alt="">
                </a>
            </div>
            <div class="page-title-box pull-left">
                <h3>מיחזורון</h3>
            </div>
            <a id="mobile_btn" class="mobile_btn pull-left" href="#sidebar"><i class="fa fa-bars" aria-hidden="true"></i></a>
            <ul class="nav user-menu pull-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-bell-o"></i> <span class="badge badge-pill bg-primary pull-right">3</span></a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">
												<img alt="John Doe" src="assets/img/user.jpg" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">John Doe</span> added new task <span class="noti-title">Patient appointment booking</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">V</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Tarah Shropshire</span> changed the task name <span class="noti-title">Appointment booking with payment gateway</span></p>
												<p class="noti-time"><span class="notification-time">6 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">L</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Misty Tison</span> added <span class="noti-title">Domenic Houston</span> and <span class="noti-title">Claire Mapes</span> to project <span class="noti-title">Doctor available module</span></p>
												<p class="noti-time"><span class="notification-time">8 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">G</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Rolland Webber</span> completed task <span class="noti-title">Patient and Doctor video conferencing</span></p>
												<p class="noti-time"><span class="notification-time">12 mins ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="activities.html">
                                        <div class="media">
											<span class="avatar">V</span>
											<div class="media-body">
												<p class="noti-details"><span class="noti-title">Bernardo Galaviz</span> added new task <span class="noti-title">Private chat module</span></p>
												<p class="noti-time"><span class="notification-time">2 days ago</span></p>
											</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="activities.html">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i class="fa fa-comment-o"></i> <span class="badge badge-pill bg-primary pull-right">8</span></a>
                </li>
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src=
							        <?php
                                    if($path !=NULL)
                                    {
                                        echo "$path";
                                    }
                                    else
                                    {
                                        echo  "assets/img/user.jpg" ;
                                    }
                                    ?>
                        width="40" alt="Admin">
							<span class="status online"></span></span>
						</span>
						<span><?php
          echo $userName;
          ?></span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile.php">הפרופיל שלי</a>
						<a class="dropdown-item" href="edit-profile.php">ערוך פרופיל</a>
						<a class="dropdown-item" href="settings.php">הגדרות</a>
						<a class="dropdown-item" href="login.php">התנתק</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu pull-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">הפרופיל שלי</a>
                    <a class="dropdown-item" href="edit-profile.php">ערוך פרופיל</a>
                    <a class="dropdown-item" href="settings.php">הגדרות</a>
                    <a class="dropdown-item" href="login.php">התנתק</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <a href="index.php"><i class="fa fa-dashboard"></i> דשבורד</a>
                        </li>
                        <li>
                            <a href="chat.html"><i class="fa fa-comments" aria-hidden="true"></i> Chat <span class="badge badge-pill bg-primary pull-right">5</span></a>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-video-camera camera" aria-hidden="true"></i> <span> Calls</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="voice-call.html">Voice Call</a></li>
                                <li><a href="video-call.html">Video Call</a></li>
                                <li><a href="incoming-call.html">Incoming Call</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> <span> Email</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="compose.html">Compose Mail</a></li>
                                <li><a href="inbox.html">Inbox</a></li>
                                <li><a href="mail-view.html">Mail View</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="feed.php"><i class="fa fa-recycle" aria-hidden="true"></i>פיד</a>
                        </li>
                        <li>
                            <a href="tasks.html"><i class="fa fa-tasks" aria-hidden="true"></i> Tasks</a>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i> <span> Blog</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="blog.html">Blog</a></li>
                                <li><a href="blog-details.html">Blog View</a></li>
                                <li><a href="add-blog.html">Add Blog</a></li>
                                <li><a href="edit-blog.html">Edit Blog</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="tickets.php"><i class="fa fa-ticket" aria-hidden="true"></i> Tickets</a>
                        </li>
                        <li>
                            <a href="settings.html"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
                        </li>
                        <li class="menu-title">UI Elements</li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-laptop" aria-hidden="true"></i> <span> Components</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="uikit.html">UI Kit</a></li>
                                <li><a href="typography.html">Typography</a></li>
                                <li><a href="tabs.html">Tabs</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="widgets.html"><i class="fa fa-th" aria-hidden="true"></i> Widgets</a>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-edit" aria-hidden="true"></i> <span> Forms</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="form-basic-inputs.html">Basic Inputs</a></li>
                                <li><a href="form-input-groups.html">Input Groups</a></li>
                                <li><a href="form-horizontal.html">Horizontal Form</a></li>
                                <li><a href="form-vertical.html">Vertical Form</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-table" aria-hidden="true"></i> <span> Tables</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="tables-basic.html">Basic Tables</a></li>
                                <li><a href="tables-datatables.html">Data Table</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="calendar.html"><i class="fa fa-calendar" aria-hidden="true"></i> Calendar</a>
                        </li>
                        <li class="menu-title">Extras</li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-columns" aria-hidden="true"></i> <span>Pages</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="login.html"> Login </a></li>
                                <li><a href="register.html"> Register </a></li>
                                <li><a href="forgot-password.html"> Forgot Password </a></li>
                                <li><a href="change-password2.html"> Change Password </a></li>
                                <li><a href="lock-screen.html"> Lock Screen </a></li>
                                <li><a href="profile.php"> Profile </a></li>
                                <li><a href="gallery.html"> Gallery </a></li>
                                <li> <a href="pricing.html">Pricing</a></li>
                                <li><a href="error-404.html">404 Error </a></li>
                                <li><a href="error-500.html">500 Error </a></li>
                                <li><a href="coming-soon.html">Coming Soon </a></li>
                                <li><a href="blank-page.html"> Blank Page </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);" class="noti-dot"><i class="fa fa-rocket" aria-hidden="true"></i> <span>CRM </span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li class="submenu">
                                    <a href="#" class="noti-dot"><span> Employees</span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled" style="display: none;">
                                        <li><a href="employees.html">All Employees</a></li>
                                        <li><a href="holidays.html">Holidays</a></li>
                                        <li><a href="leaves.html"><span>Leave Requests</span> <span class="badge badge-pill bg-primary pull-right">1</span></a></li>
                                        <li><a href="attendance.html">Attendance</a></li>
                                        <li><a href="departments.html">Departments</a></li>
                                        <li><a href="designations.html">Designations</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="clients.html">Clients</a>
                                </li>
                                <li>
                                    <a href="projects.html">Projects</a>
                                </li>
                                <li>
                                    <a href="tasks.html">Tasks</a>
                                </li>
                                <li>
                                    <a href="leads.html">Leads</a>
                                </li>
                                <li class="submenu">
                                    <a href="#"><span> Accounts </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled" style="display: none;">
                                        <li><a href="estimates.html">Estimates</a></li>
                                        <li><a href="invoices.html">Invoices</a></li>
                                        <li><a href="payments.html">Payments</a></li>
                                        <li><a href="expenses.html">Expenses</a></li>
                                        <li><a href="provident-fund.html">Provident Fund</a></li>
                                        <li><a href="taxes.html">Taxes</a></li>
                                    </ul>
                                </li>
                                <li class="submenu">
                                    <a href="#"><span> Payroll </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled" style="display: none;">
                                        <li><a href="salary.html"> Employee Salary </a></li>
                                        <li><a href="salary-view.html"> Payslip </a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="worksheet.html">Timing Sheet</a>
                                </li>
                                <li>
                                    <a href="assets.html">Assets</a>
                                </li>
                                <li>
                                    <a href="activities.html">Activities</a>
                                </li>
                                <li>
                                    <a href="users.html">Users</a>
                                </li>
                                <li class="submenu">
                                    <a href="#"><span> Reports </span> <span class="menu-arrow"></span></a>
                                    <ul class="list-unstyled" style="display: none;">
                                        <li><a href="expense-reports.html"> Expense Report </a></li>
                                        <li><a href="invoice-reports.html"> Invoice Report </a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span> Ecommerce </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="products.html"> Products </a></li>
                                <li><a href="products-list.html"> Products List </a></li>
                                <li><a href="product-details.html"> Product Details </a></li>
                                <li><a href="add-product.html"> Add Product </a></li>
                                <li><a href="edit-product.html"> Edit Product </a></li>
                                <li><a href="orders.html"> Orders </a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="javascript:void(0);"><i class="fa fa-share-alt" aria-hidden="true"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li class="submenu">
                                    <a href="javascript:void(0);"><span>Level 1</span> <span class="menu-arrow"></span></a>
                                    <ul style="display: none;">
                                        <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                        <li class="submenu">
                                            <a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
                                            <ul class="list-unstyled" style="display: none;">
                                                <li><a href="javascript:void(0);">Level 3</a></li>
                                                <li><a href="javascript:void(0);">Level 3</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="javascript:void(0);"><span>Level 1</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-success"><i class="fa fa-money" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3>$998</h3>
                                <span>רווחים</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3>1072</h3>
                                <span>מיחזורים</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-warning"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3>72</h3>
                                <span>יום</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-danger"><i class="fa fa-tasks" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3>618</h3>
                                <span>Tasks</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div id="bar-example"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xl-4">
                        <div class="card">
                            <div class="card-body">
								<h4 class="card-title text-center">Project Status</h4>
                                <div id="donutChart" class="rad-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Product Status</h4>
                                <div id="areaChart" class="rad-chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title text-center">Task Status</h4>
                                <div id="area-chart" class="rad-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card activity-panel">
                            <div class="card-body">
                                <h4 class="card-title">Activities</h4>
                                <div class="activity-box">
                                    <ul class="activity-list">
                                        <li>
                                            <div class="activity-user">
                                                <a href="profile.html" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                                    <img alt="Lesley Grauer" src="assets/img/user.jpg" class="img-fluid rounded-circle">
                                                </a>
                                            </div>
                                            <div class="activity-content">
                                                <div class="timeline-content">
                                                    <a href="profile.html" class="name">Lesley Grauer</a> added new task <a href="#">Hospital Administration</a>
                                                    <span class="time">4 mins ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="activity-user">
                                                <a href="profile.html" class="avatar" title="Jeffery Lalor" data-toggle="tooltip">L</a>
                                            </div>
                                            <div class="activity-content">
                                                <div class="timeline-content">
                                                    <a href="profile.html" class="name">Jeffery Lalor</a> added <a href="profile.html" class="name">Loren Gatlin</a> and <a href="profile.html" class="name">Tarah Shropshire</a> to project <a href="#">Patient appointment booking</a>
                                                    <span class="time">6 mins ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="activity-user">
                                                <a href="profile.html" title="Catherine Manseau" data-toggle="tooltip" class="avatar">
                                                    <img alt="Catherine Manseau" src="assets/img/user.jpg" class="img-fluid rounded-circle">
                                                </a>
                                            </div>
                                            <div class="activity-content">
                                                <div class="timeline-content">
                                                    <a href="profile.html" class="name">Catherine Manseau</a> completed task <a href="#">Appointment booking with payment gateway</a>
                                                    <span class="time">12 mins ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="activity-user">
                                                <a href="#" title="Bernardo Galaviz" data-toggle="tooltip" class="avatar">
                                                    <img alt="Bernardo Galaviz" src="assets/img/user.jpg" class="img-fluid rounded-circle">
                                                </a>
                                            </div>
                                            <div class="activity-content">
                                                <div class="timeline-content">
                                                    <a href="profile.html" class="name">Bernardo Galaviz</a> changed the task name <a href="#">Doctor available module</a>
                                                    <span class="time">1 day ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="activity-user">
                                                <a href="profile.html" title="Mike Litorus" data-toggle="tooltip" class="avatar">
                                                    <img alt="Mike Litorus" src="assets/img/user.jpg" class="img-fluid rounded-circle">
                                                </a>
                                            </div>
                                            <div class="activity-content">
                                                <div class="timeline-content">
                                                    <a href="profile.html" class="name">Mike Litorus</a> added new task <a href="#">Patient and Doctor video conferencing</a>
                                                    <span class="time">2 days ago</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="activity-user">
                                                <a href="profile.html" title="Jeffery Lalor" data-toggle="tooltip" class="avatar">
                                                    <img alt="Jeffery Lalor" src="assets/img/user.jpg" class="img-fluid rounded-circle">
                                                </a>
                                            </div>
                                            <div class="activity-content">
                                                <div class="timeline-content">
                                                    <a href="profile.html" class="name">Jeffery Lalor</a> added <a href="profile.html" class="name">Jeffrey Warden</a> and <a href="profile.html" class="name">Bernardo Galaviz</a> to the task of <a href="#">Private chat module</a>
                                                    <span class="time">7 days ago</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-footer text-center bg-white">
                                <a href="activities.html" class="text-muted">View all activities</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card chat-panel">
                            <div class="card-header bg-white">
								<div class="user-details">
									<div class="pull-left user-img m-r-10">
										<a href="profile.html" title="Mike Litorus"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
									</div>
									<div class="user-info pull-left">
										<a href="profile.html" title="Mike Litorus"><span class="font-bold">Mike Litorus</span> <i class="typing-text">Typing...</i></a>
										<span class="last-seen">Last seen today at 7:50 AM</span>
									</div>
								</div>
								<ul class="nav pull-right custom-menu d-none d-lg-flex">
									<li class="nav-item">
										<a class="nav-link" href="voice-call.html"><i class="fa fa-phone" aria-hidden="true"></i></a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="video-call.html"><i class="fa fa-video-camera" aria-hidden="true"></i></a>
									</li>
									<li class="nav-item dropdown dropdown-action">
										<a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0)">Delete Conversations</a>
											<a class="dropdown-item" href="javascript:void(0)">Settings</a>
										</div>
									</li>
								</ul>
                            </div>
                            <div class="card-body">
                                <div class="chats">
                                    <div class="chat chat-right">
                                        <div class="chat-body">
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <p>Hello. What can I do for you?</p>
                                                    <span class="chat-time">8:30 am</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat-line">
                                        <span class="chat-date">October 8th, 2015</span>
                                    </div>
                                    <div class="chat chat-left">
                                        <div class="chat-avatar">
                                            <a href="profile.html" class="avatar">
                                                <img alt="John Doe" src="assets/img/user.jpg" class="img-fluid rounded-circle">
                                            </a>
                                        </div>
                                        <div class="chat-body">
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <p>I'm just looking around.</p>
                                                    <p>Will you tell me something about yourself? </p>
                                                    <span class="chat-time">8:35 am</span>
                                                </div>
                                            </div>
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <p>Are you there? That time!</p>
                                                    <span class="chat-time">8:40 am</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat chat-right">
                                        <div class="chat-body">
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <p>Where?</p>
                                                    <span class="chat-time">8:35 am</span>
                                                </div>
                                            </div>
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <p>OK, my name is Limingqiang. I like singing, playing basketballand so on.</p>
                                                    <span class="chat-time">8:42 am</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat chat-right">
                                        <div class="chat-body">
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <p>OK!</p>
                                                    <span class="chat-time">9:00 am</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat chat-left">
                                        <div class="chat-avatar">
                                            <a href="profile.html" class="avatar">
                                                <img alt="John Doe" src="assets/img/user.jpg" class="img-fluid rounded-circle">
                                            </a>
                                        </div>
                                        <div class="chat-body">
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <p>Uploaded 3 files</p>
                                                    <ul class="attach-list">
                                                        <li><i class="fa fa-file"></i> <a href="#">example.avi</a></li>
                                                        <li><i class="fa fa-file"></i> <a href="#">activity.psd</a></li>
                                                        <li><i class="fa fa-file"></i> <a href="#">example.psd</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <p>Consectetuorem ipsum dolor sit?</p>
                                                    <span class="chat-time">8:50 am</span>
                                                </div>
                                            </div>
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <p>OK?</p>
                                                    <span class="chat-time">8:55 am</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat chat-left">
                                        <div class="chat-avatar">
                                            <a href="profile.html" class="avatar">
                                                <img alt="John Doe" src="assets/img/user.jpg" class="img-fluid rounded-circle">
                                            </a>
                                        </div>
                                        <div class="chat-body">
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <ul class="attach-list">
                                                        <li class="pdf-file"><i class="fa fa-file-pdf-o"></i> <a href="#">Document_2016.pdf</a></li>
                                                    </ul>
                                                    <span class="chat-time">9:00 am</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat chat-right">
                                        <div class="chat-body">
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <ul class="attach-list">
                                                        <li class="pdf-file"><i class="fa fa-file-pdf-o"></i> <a href="#">Document_2016.pdf</a></li>
                                                    </ul>
                                                    <span class="chat-time">9:00 am</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chat chat-left">
                                        <div class="chat-avatar">
                                            <a href="profile.html" class="avatar">
                                                <img alt="John Doe" src="assets/img/user.jpg" class="img-fluid rounded-circle">
                                            </a>
                                        </div>
                                        <div class="chat-body">
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <p>Typing ...</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="message-bar">
                                    <div class="message-inner">
                                        <a class="link attach-icon" href="#"><img src="assets/img/attachment.png" alt=""></a>
                                        <div class="message-area">
											<div class="input-group">
												<textarea class="form-control" placeholder="Type message..."></textarea>
												<div class="input-group-append">
													<button class="btn btn-primary" type="button"><i class="fa fa-send"></i></button>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card task-panel">
                            <div class="card-header bg-white">
								<div class="pull-left">
									<div class="add-task-btn-wrapper">
										<span class="add-task-btn btn btn-white btn-sm">Add Task</span>
									</div>
								</div>
								<ul class="nav pull-right custom-menu">
									<li class="nav-item dropdown dropdown-action">
										<a href="" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-cog"></i></a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="javascript:void(0)">Pending Tasks</a>
											<a class="dropdown-item" href="javascript:void(0)">Completed Tasks</a>
											<a class="dropdown-item" href="javascript:void(0)">All Tasks</a>
										</div>
									</li>
								</ul>
                            </div>
                            <div class="card-body">
                                <div class="task-wrapper">
                                    <div class="task-list-container">
                                        <div class="task-list-body">
                                            <ul id="task-list">
                                                <li class="task">
                                                    <div class="task-container">
                                                        <span class="task-action-btn task-check">
															<span class="action-circle large complete-btn" title="Mark Complete">
																<i class="material-icons">check</i>
															</span>
                                                        </span>
                                                        <span class="task-label" contenteditable="true">Patient appointment booking</span>
                                                        <span class="task-action-btn task-btn-right">
																<span class="action-circle large" title="Assign">
																	<i class="material-icons">person_add</i>
																</span>
                                                        <span class="action-circle large delete-btn" title="Delete Task">
																	<i class="material-icons">delete</i>
																</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li class="task">
                                                    <div class="task-container">
                                                        <span class="task-action-btn task-check">
															<span class="action-circle large complete-btn" title="Mark Complete">
																<i class="material-icons">check</i>
															</span>
                                                        </span>
                                                        <span class="task-label" contenteditable="true">Appointment booking with payment gateway</span>
                                                        <span class="task-action-btn task-btn-right">
															<span class="action-circle large" title="Assign">
																<i class="material-icons">person_add</i>
															</span>
															<span class="action-circle large delete-btn" title="Delete Task">
																<i class="material-icons">delete</i>
															</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li class="completed task">
                                                    <div class="task-container">
                                                        <span class="task-action-btn task-check">
															<span class="action-circle large complete-btn" title="Mark Complete">
																<i class="material-icons">check</i>
															</span>
                                                        </span>
                                                        <span class="task-label">Doctor available module</span>
                                                        <span class="task-action-btn task-btn-right">
															<span class="action-circle large" title="Assign">
																<i class="material-icons">person_add</i>
															</span>
															<span class="action-circle large delete-btn" title="Delete Task">
																<i class="material-icons">delete</i>
															</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li class="task">
                                                    <div class="task-container">
                                                        <span class="task-action-btn task-check">
															<span class="action-circle large complete-btn" title="Mark Complete">
																<i class="material-icons">check</i>
															</span>
                                                        </span>
                                                        <span class="task-label" contenteditable="true">Patient and Doctor video conferencing</span>
                                                        <span class="task-action-btn task-btn-right">
															<span class="action-circle large" title="Assign">
																<i class="material-icons">person_add</i>
															</span>
															<span class="action-circle large delete-btn" title="Delete Task">
																<i class="material-icons">delete</i>
															</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li class="task">
                                                    <div class="task-container">
                                                        <span class="task-action-btn task-check">
															<span class="action-circle large complete-btn" title="Mark Complete">
																<i class="material-icons">check</i>
															</span>
                                                        </span>
                                                        <span class="task-label" contenteditable="true">Private chat module</span>
                                                        <span class="task-action-btn task-btn-right">
															<span class="action-circle large" title="Assign">
																<i class="material-icons">person_add</i>
															</span>
															<span class="action-circle large delete-btn" title="Delete Task">
																<i class="material-icons">delete</i>
															</span>
                                                        </span>
                                                    </div>
                                                </li>
                                                <li class="task">
                                                    <div class="task-container">
                                                        <span class="task-action-btn task-check">
															<span class="action-circle large complete-btn" title="Mark Complete">
																<i class="material-icons">check</i>
															</span>
                                                        </span>
                                                        <span class="task-label" contenteditable="true">Patient Profile add</span>
                                                        <span class="task-action-btn task-btn-right">
															<span class="action-circle large" title="Assign">
																<i class="material-icons">person_add</i>
															</span>
															<span class="action-circle large delete-btn" title="Delete Task">
																<i class="material-icons">delete</i>
															</span>
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="task-list-footer">
                                            <div class="new-task-wrapper">
                                                <textarea id="new-task" placeholder="Enter new task here. . ."></textarea>
                                                <span class="error-message hidden">You need to enter a task first</span>
                                                <span class="add-new-task-btn btn" id="add-task">Add Task</span>
                                                <span class="cancel-btn btn" id="close-task-panel">Close</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card member-panel">
							<div class="card-header bg-white">
								<h4 class="card-title m-b-0">Contacts</h4>
							</div>
                            <div class="card-body">
                                <ul class="contact-list">
                                    <li>
                                        <div class="contact-cont">
                                            <div class="pull-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">John Doe</span>
                                                <span class="contact-date">Web Developer</span>
                                            </div>
                                            <div class="contact-action">
                                                <div class="dropdown dropdown-action">
                                                    <a href="" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="pull-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                                <span class="contact-date">Web Developer</span>
                                            </div>
                                            <div class="contact-action">
                                                <div class="dropdown dropdown-action">
                                                    <a href="" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="pull-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">John Doe</span>
                                                <span class="contact-date">Web Developer</span>
                                            </div>
                                            <div class="contact-action">
                                                <div class="dropdown dropdown-action">
                                                    <a href="" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="pull-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                                <span class="contact-date">Web Developer</span>
                                            </div>
                                            <div class="contact-action">
                                                <div class="dropdown dropdown-action">
                                                    <a href="" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="pull-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">John Doe</span>
                                                <span class="contact-date">Web Developer</span>
                                            </div>
                                            <div class="contact-action">
                                                <div class="dropdown dropdown-action">
                                                    <a href="" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="pull-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                                <span class="contact-date">Web Developer</span>
                                            </div>
                                            <div class="contact-action">
                                                <div class="dropdown dropdown-action">
                                                    <a href="" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer text-center bg-white">
                                <a href="users.html" class="text-muted">View all members</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-table card-table-top">
                            <div class="card-header bg-white">
                                <h4 class="card-title m-b-0">Invoices</h4>
                            </div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table table-striped custom-table m-b-0">
										<thead>
											<tr>
												<th>Invoice ID</th>
												<th>Client</th>
												<th>Due Date</th>
												<th>Total</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><a href="invoice-view.html">#INV-0001</a></td>
												<td>
													<h2><a href="#">Hazel Nutt</a></h2>
												</td>
												<td>8 Aug 2017</td>
												<td>$380</td>
												<td>
													<span class="badge badge-warning-border">Partially Paid</span>
												</td>
											</tr>
											<tr>
												<td><a href="invoice-view.html">#INV-0002</a></td>
												<td>
													<h2><a href="#">Paige Turner</a></h2>
												</td>
												<td>17 Sep 2017</td>
												<td>$500</td>
												<td>
													<span class="badge badge-success-border">Paid</span>
												</td>
											</tr>
											<tr>
												<td><a href="invoice-view.html">#INV-0003</a></td>
												<td>
													<h2><a href="#">Ben Dover</a></h2>
												</td>
												<td>30 Nov 2017</td>
												<td>$60</td>
												<td>
													<span class="badge badge-danger-border">Unpaid</span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
                            <div class="card-footer text-center bg-white">
                                <a href="invoices.html" class="text-muted">View all invoices</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-table card-table-top">
                            <div class="card-header bg-white">
                                <h4 class="card-title m-b-0">Payments</h4>
                            </div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table table-striped custom-table m-b-0">
										<thead>
											<tr>
												<th>Invoice ID</th>
												<th>Client</th>
												<th>Payment Type</th>
												<th>Paid Date</th>
												<th>Paid Amount</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><a href="invoice-view.html">#INV-0004</a></td>
												<td>
													<h2><a href="#">Barry Cuda</a></h2>
												</td>
												<td>Paypal</td>
												<td>11 Jun 2017</td>
												<td>$380</td>
											</tr>
											<tr>
												<td><a href="invoice-view.html">#INV-0005</a></td>
												<td>
													<h2><a href="#">Tressa Wexler</a></h2>
												</td>
												<td>Paypal</td>
												<td>21 Jul 2017</td>
												<td>$500</td>
											</tr>
											<tr>
												<td><a href="invoice-view.html">#INV-0006</a></td>
												<td>
													<h2><a href="#">Ruby Bartlett</a></h2>
												</td>
												<td>Paypal</td>
												<td>28 Aug 2017</td>
												<td>$60</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
                            <div class="card-footer text-center bg-white">
                                <a href="payments.html" class="text-muted">View all payments</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-table">
                            <div class="card-header bg-white">
                                <h4 class="card-title m-b-0">Clients</h4>
                            </div>
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0">
									<thead>
										<tr>
											<th style="min-width:200px;">Name</th>
											<th>Email</th>
											<th>Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="min-width:200px;">
												<a href="#" class="avatar">B</a>
												<h2><a href="client-profile.html">Barry Cuda <span>CEO</span></a></h2>
											</td>
											<td>barrycuda@example.com</td>
											<td>
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-success"></i> Active
														</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="javascript:void(0)" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<a href="#" class="avatar">T</a>
												<h2><a href="client-profile.html">Tressa Wexler <span>Manager</span></a></h2>
											</td>
											<td>tressawexler@example.com</td>
											<td>
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-danger"></i> Inactive
														</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="javascript:void(0)" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<a href="client-profile.html" class="avatar">R</a>
												<h2><a href="client-profile.html">Ruby Bartlett <span>CEO</span></a></h2>
											</td>
											<td>rubybartlett@example.com</td>
											<td>
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-danger"></i> Inactive
														</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="javascript:void(0)" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<a href="client-profile.html" class="avatar">M</a>
												<h2><a href="client-profile.html"> Misty Tison <span>CEO</span></a></h2>
											</td>
											<td>mistytison@example.com</td>
											<td>
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-success"></i> Active
														</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="javascript:void(0)" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<a href="client-profile.html" class="avatar">D</a>
												<h2><a href="client-profile.html"> Daniel Deacon <span>CEO</span></a></h2>
											</td>
											<td>danieldeacon@example.com</td>
											<td>
												<div class="dropdown action-label">
													<a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-danger"></i> Inactive
														</a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Active</a>
														<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Inactive</a>
													</div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="javascript:void(0)" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
                            <div class="card-footer text-center bg-white">
                                <a href="clients.html" class="text-muted">View all clients</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-table">
                            <div class="card-header bg-white">
                                <h4 class="card-title m-b-0">Recent Projects</h4>
                            </div>
							<div class="table-responsive">
								<table class="table table-striped custom-table m-b-0">
									<thead>
										<tr>
											<th class="col-md-3">Project Name </th>
											<th class="col-md-3">Progress</th>
											<th class="text-right col-md-1">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<h2><a href="project-view.html">Office Management</a></h2>
												<small class="block text-ellipsis">
													<span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
													<span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
												</small>
											</td>
											<td>
												<div class="progress progress-xs progress-striped">
													<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="65%" style="width: 65%"></div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="javascript:void(0)" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<h2><a href="project-view.html">Project Management</a></h2>
												<small class="block text-ellipsis">
													<span class="text-xs">2</span> <span class="text-muted">open tasks, </span>
													<span class="text-xs">5</span> <span class="text-muted">tasks completed</span>
												</small>
											</td>
											<td>
												<div class="progress progress-xs progress-striped">
													<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="15%" style="width: 15%"></div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="javascript:void(0)" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<h2><a href="project-view.html">Video Calling App</a></h2>
												<small class="block text-ellipsis">
													<span class="text-xs">3</span> <span class="text-muted">open tasks, </span>
													<span class="text-xs">3</span> <span class="text-muted">tasks completed</span>
												</small>
											</td>
											<td>
												<div class="progress progress-xs progress-striped">
													<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="49%" style="width: 49%"></div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="javascript:void(0)" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<h2><a href="project-view.html">Hospital Administration</a></h2>
												<small class="block text-ellipsis">
													<span class="text-xs">12</span> <span class="text-muted">open tasks, </span>
													<span class="text-xs">4</span> <span class="text-muted">tasks completed</span>
												</small>
											</td>
											<td>
												<div class="progress progress-xs progress-striped">
													<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="88%" style="width: 88%"></div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="javascript:void(0)" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<h2><a href="project-view.html">Digital Marketplace</a></h2>
												<small class="block text-ellipsis">
													<span class="text-xs">7</span> <span class="text-muted">open tasks, </span>
													<span class="text-xs">14</span> <span class="text-muted">tasks completed</span>
												</small>
											</td>
											<td>
												<div class="progress progress-xs progress-striped">
													<div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="100%" style="width: 100%"></div>
												</div>
											</td>
											<td class="text-right">
												<div class="dropdown dropdown-action">
													<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
													<div class="dropdown-menu dropdown-menu-right">
														<a class="dropdown-item" href="javascript:void(0)" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a>
														<a class="dropdown-item" href="javascript:void(0)" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
													</div>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
                            <div class="card-footer bg-white text-center">
                                <a href="projects.html" class="text-muted">View all projects</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll">
                        <ul class="list-box">
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Richard Miles </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item new-message">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">John Doe</span>
                                            <span class="message-time">1 Aug</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Tarah Shropshire </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Mike Litorus</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Catherine Manseau </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">D</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Domenic Houston </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">B</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Buster Wigton </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Rolland Webber </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Claire Mapes </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Melita Faucher</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Jeffery Lalor</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">L</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Loren Gatlin</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Tarah Shropshire</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.html">See all messages</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="assets/js/select2.min.js"></script>
    <script type="text/javascript" src="assets/js/moment.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="assets/plugins/morris/morris.min.js"></script>
    <script type="text/javascript" src="assets/plugins/raphael/raphael-min.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
</body>

</html>