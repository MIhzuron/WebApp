<?php
require_once('config.php');

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

if(isset($_POST['pay']))
{
     $postId=$_POST['postId'];
          $sql="SELECT * from posts WHERE id=$postId ";
          $result=$conn-> query($sql);
          if($result->num_rows>0)
          {
              $row=$result->fetch_assoc();
         echo     $row['userName'];
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
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/plugins/light-gallery/css/lightgallery.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
	
	    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
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
                <h3>Preadmin</h3>
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
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
							<span class="status online"></span></span>
                        <span>Admin</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a>
						<a class="dropdown-item" href="login.html">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu pull-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li>
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
                            </ul>
                        </li>
                        <li>
                            <a href="tickets.html"><i class="fa fa-ticket" aria-hidden="true"></i> Tickets</a>
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
                                <li><a href="profile.html"> Profile </a></li>
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
                            <a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Ecommerce</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="products.html"> Products </a></li>
                                <li><a href="products-list.html"> Products List </a></li>
                                <li><a class="active" href="product-details.html"> Product Details </a></li>
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
                    <div class="col-sm-12">
                        <h4 class="page-title">Product Details</h4>
                    </div>
                </div>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="product-view">
                                <div class="proimage-wrap">
                                    <div class="pro-image" id="pro_popup">
                                        <a href="assets/img/product/product-01.jpg">
                                            <img class="img-fluid" src="assets/img/product/product-01.jpg" alt="">
                                        </a>
                                    </div>
                                    <ul class="proimage-thumb">
                                        <li>
                                            <a href="assets/img/product/product-01.jpg"><img src="assets/img/product/product-thumb-01.jpg" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="assets/img/product/product-02.jpg"><img src="assets/img/product/product-thumb-02.jpg" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="assets/img/product/product-03.jpg"><img src="assets/img/product/product-thumb-03.jpg" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="assets/img/product/product-04.jpg"><img src="assets/img/product/product-thumb-04.jpg" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="product-info">
                                <h2>
                                    <?php
                                             echo     $row['userName'];

                                    ?>
                                </h2>
                                <p>
                                   תאריך:
                                   <?php
                                   echo $row['date'];
                                   ?>
                                </p>
                                <div class="rating">
                                    <p>
                                        <span><i class="fa fa-star rated"></i></span>
                                     
                                        <span>מומלץ על ידי המערכת</span>
                                    </p>
                                </div>
                                <p class="product_price">
                                    שווי:
                                    <?php
                                    echo 
                                    
                                    '<span> '.$row['revenue'].' ₪</span> ';
                                    ?>
                                </p>
                                <p class="product_price">
                                    רווח:
                                    <?php
                                    echo 
                                    
                                    '<span id="price" style="color:green;"> '.($row['revenue']/2) 
                                    
                                    .' </span>
                                    <span>
                                    ₪</span> ';
                                    ?>
                                </p>
                                <p><b>זמינות המיחזור:</b> 
                                <?php
                                if ($row[paid]==0)
                                {
                                    echo '<span style="color:green; font-weight:bold;">
                                   זמינות מיידית 
                                </span>';
                                }
                                else
                                {
                                     echo '<span style="color:red; font-weight:bold;">
                                   לא זמין למיחזור 
                                </span>';
                                }
                                ?>
                                
                                </p>
                                <div>
                                    
                                        <div id="paypal-button-container"> </div>

                                    
                                <!--    <button type="button" class="btn btn-primary btn-lg">
                                        <i class="fa fa-shopping-cart"></i> Add to cart
                                    </button> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs nav-tabs-bottom">
                                <li class="nav-item"><a class="nav-link active" href="#product_desc" data-toggle="tab">Description</a></li>
                                <li class="nav-item"><a class="nav-link" href="#product_reviews" data-toggle="tab">Reviews</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show active" id="product_desc">
                                    <div class="product-content">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
                                        <blockquote class="blockquote">
                                            <p class="mb-0">Vestibulum id ligula porta felis euismod semper. Sed posuere consectetur est at lobortis. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper.</p>
                                        </blockquote>
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="product_reviews">
                                    <div class="product-reviews">
                                        <h3>Reviews (3)</h3>
                                        <ul class="review-list">
                                            <li>
                                                <div class="review">
                                                    <div class="review-author">
                                                        <img class="avatar" alt="" src="assets/img/user.jpg">
                                                    </div>
                                                    <div class="review-block">
                                                        <div class="review-by">
                                                            <span class="review-author-name">Diana Bailey</span>
                                                            <div class="rating">
                                                                <i class="fa fa-star rated"></i>
                                                                <i class="fa fa-star rated"></i>
                                                                <i class="fa fa-star rated"></i>
                                                                <i class="fa fa-star rated"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </div>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.</p>
                                                        <span class="review-date">December 6, 2017</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="review">
                                                    <div class="review-author">
                                                        <img class="avatar" alt="" src="assets/img/user.jpg">
                                                    </div>
                                                    <div class="review-block">
                                                        <div class="review-by">
                                                            <span class="review-author-name">Marie Wells</span>
                                                            <div class="rating">
                                                                <i class="fa fa-star rated"></i>
                                                                <i class="fa fa-star rated"></i>
                                                                <i class="fa fa-star rated"></i>
                                                                <i class="fa fa-star rated"></i>
                                                                <i class="fa fa-star rated"></i>
                                                            </div>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <span class="review-date">December 11, 2017</span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="review">
                                                    <div class="review-author">
                                                        <img class="avatar" alt="" src="assets/img/user.jpg">
                                                    </div>
                                                    <div class="review-block">
                                                        <div class="review-by">
                                                            <span class="review-author-name">Pamela Curtis</span>
                                                            <div class="rating">
                                                                <i class="fa fa-star rated"></i>
                                                                <i class="fa fa-star rated"></i>
                                                                <i class="fa fa-star rated"></i>
                                                                <i class="fa fa-star-o"></i>
                                                                <i class="fa fa-star-o"></i>
                                                            </div>
                                                        </div>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                                        <span class="review-date">December 13, 2017</span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="all-reviews">
                                            <button type="button" class="btn btn-primary">View All Reviews</button>
                                        </div>
                                    </div>
                                    <div class="product-write-review">
                                        <h3>Write Review</h3>
                                        <form>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label>Name <span class="text-red">*</span></label>
                                                        <input type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Your email address <span class="text-red">*</span></label>
                                                        <input type="email" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Rating <span class="text-red">*</span></label>
                                                        <div class="rating">
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star rated"></i>
                                                            <i class="fa fa-star-o"></i>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Review Comments</label>
                                                        <textarea rows="4" class="form-control"></textarea>
                                                    </div>
                                                    <div class="review-submit">
                                                        <input type="submit" value="Submit" class="btn">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
    <script type="text/javascript" src="assets/plugins/light-gallery/js/lightgallery-all.min.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
  <script type="text/javascript" src="https://www.paypal.com/sdk/js?client-id=ASEkXsE1NUHmUybQs-1rTJNlutmDERCNBlVl9cT0xTeE7EPkWB2WGhXSthjbSTqhweo7B144hNkchRGO&currency=ILS&locale=he_IL"></script>
 <script>
        // Render the PayPal button into #paypal-button-container
     
              var price=<?php echo $row['revenue']/2; ?>;
           var postId='<?php echo $row['id']; ?>';
           var user='<?php echo $_SESSION['userName']; ?>';


            
        
        paypal.Buttons({
            style:{
                layout:'horizontal',
                color: 'silver',
                shape:'pill',
                label:'paypal',
                size:'responsive'
            },
            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: price
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Show a success message to the buyer
                     window.location.replace("post-thanks.php?payment=success&username="+user+"&postid="+postId);
                });
            }


        }).render('#paypal-button-container');
      
    </script>
   
</body>

</html>