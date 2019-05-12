<?php
require_once('config.php');

session_start();
if(!isset($_SESSION['userName']))
{
header("Location:login.php");
    exit();
}

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <title>תשלום</title>
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
                     <img src="assets/img/logo2.jpg" width="60" height="50" alt="">
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
						
						<a class="dropdown-item" href="login.php">התנתק</a>
						
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu pull-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.php">הפרופיל שלי</a>
                    <a class="dropdown-item" href="edit-profile.php">ערוך פרופיל</a>
                 
                    <a class="dropdown-item" href="login.php">התנתק</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                         <ul>
                        <li class="menu-title">
                            ניווט
                        </li>
                        <li >
                            <a href="index.php"><i class="fas fa-home"></i> דף הבית</a>
                        </li>
                        <li>
                            <a href="feed.php"><i class="fa fa-recycle" aria-hidden="true"></i><b>פיד </b></a>
                        </li>
                        <li>
                             <a href="myPosts.php"><i class="fas fa-comment-dollar"></i>
                             מיחזורים שפרסמתי
                             </a>
                        </li>
                        <li>
                             <a href="paidRec.php"><i class="fas fa-file-invoice-dollar"></i>
                                מחזורים שקניתי
                             </a>
                        </li>
                        <li>
                             <a href="profile.php"><i class="fas fa-user"></i>
                            הפרופיל שלי            
                             </a>
                        </li>
                         <li >
                             <a href="help.php"><i class="fa fa-info"></i>
                            עזרה            
                             </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">פרטי הקנייה שלך</h4>
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
