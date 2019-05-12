<?php
//header("Access-Control-Allow-Origin: *");
require_once('config.php');




if($_POST['action']=="showNotifications")
{
$userName=$_POST['userName'];
    
    $sql="SELECT * from notifications where owner='".$userName."' ORDER BY id DESC LIMIT 10";
     $result=$conn-> query($sql);
                                                       if($result->num_rows>0)
                                                       {
                                                           
                                                           while($row=$result->fetch_assoc())
                                                           {
                                                               
                                                               //let's differentiate between different sorts of notification
                                                               
                                                               if($row['sort']==1) //1=someone bought my Mihzur
                                                               {
                                                                    echo '
                                                                    <li class="notification-message">
                                    
                                        <div class="media">
											<span class="avatar">
												<img alt="John Doe" src="assets/img/user.jpg" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details">
												<span class="noti-title">
												'.$row['user_involved'].'
												</span>
												קנה את המיחזור שלך
												<span class="noti-title">
												היכנס עכשיו ל
												<a href="http://eavni93.com/itay/myPosts.php">
												מיחזורים שלי
												</a>
												</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
											</div>
                                        </div>
                                   
                                </li>
                                                               
                                                               ';
                                                                   
                                                               }
                                                               else if($row['sort']==2) //i bought someone else's Mihzur
                                                               {
                                                                   
                                                                   
                                                                   
                                                               }
                                                               else if ($row['sort']==3)//someome else has aprroved his Mihzur from me
                                                               {
                                                                    echo '
                                                                    <li class="notification-message">
                                    
                                        <div class="media">
											<span class="avatar">
												<img alt="John Doe" src="assets/img/user.jpg" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details">
												<span class="noti-title">
												'.$row['user_involved'].'
												</span>
												אישר את המיחזור שלך
												<span class="noti-title">
												היכנס עכשיו ל
												<a href="http://eavni93.com/itay/myPosts.php">
												מיחזורים שלי
												</a>
												</span></p>
												<p class="noti-time"><span class="notification-time">4 mins ago</span></p>
											</div>
                                        </div>
                                   
                                </li>
                                                               
                                                               ';
                                                                   
                                                                   
                                                               }
                                                                   else if ($row['sort']==4)//i approved someone else's Mihzur
                                                               {
                                                                   
                                                                   
                                                                   
                                                               }
                                                               else if($row['sort']==5)//i just uploaded a new Mihzur
                                                               {
                                                                   
                                                                   
                                                               }
                                                               
                                                               
                                                               
                                                              
                                                               
                                                               
                                                               
                                                           }
                                                       }
    
    
    
}
if($_POST['action']=="countNotifications") 
{
    
$userName=$_POST['userName'];
          $i=0;


        $sql="SELECT * from notifications where owner='".$userName."' ";//TO ADD- and isSeen=0
         $result=$conn-> query($sql);
        if($result->num_rows>0)
       {
              while($row=$result->fetch_assoc())
          {
            $i++;
           }
        
                                                           
     }
     if($i!=0) //only show number of notifications if bigger than 0
     {
                 echo $i;                                           

     }
    
}


?>
