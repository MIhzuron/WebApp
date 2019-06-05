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
                                                                    $sql="SELECT * from users where userName='".$row['user_involved']."'";
                                                                   $result2=$conn-> query($sql);
                                                       if($result2->num_rows>0)
                                                       {
                                                         $row2=$result2->fetch_assoc();
                                                         $path=$row2['profilePic'];
                                                         if($path==NULL)
                                                         {
                                                             $path="http://eavni93.com/itay/assets/img/user.jpg";
                                                         }
                                                       }  
                                                         echo '
                                                                    <li class="notification-message">
                                    
                                        <div class="media" style="line-height:2;">
											<span class="avatar">
												<img alt="" src="'.$path.'" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details">
												<span class="noti-title">
												'.$row['user_involved'].'
												</span>
												קנה את המיחזור שלך
											<br>
												<span class="noti-title">
												היכנס עכשיו ל<a href="http://eavni93.com/itay/myPosts.php"  style="padding:0; display:inline;">
												מיחזורים שלי
												</a>
												</span></p>
												<br>
												<p class="noti-time"><span class="notification-time">'.$row['fullDate'].'</span></p>
											</div>
                                        </div>
                                   
                                </li>
                                                               
                                                               ';
                                                                   
                                                               }
                                                               else if($row['sort']==2) //i bought someone else's Mihzur
                                                               {
                                                                
                                                                $sql="SELECT * from users where userName='".$row['user_involved']."'";
                                                                   $result2=$conn-> query($sql);
                                                       if($result2->num_rows>0)
                                                       {
                                                         $row2=$result2->fetch_assoc();
                                                         $path=$row2['profilePic'];
                                                         if($path==NULL)
                                                         {
                                                             $path="http://eavni93.com/itay/assets/img/user.jpg";
                                                         }
                                                       }  
                                                                     echo '
                                                                    <li class="notification-message">
                                    
                                        <div class="media" style="line-height:2;">
											<span class="avatar">
												<img alt="" src="'.$path.'" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details" style="padding:0; display:inline;">
											
											קנית את המיחזור של
									        	<span class="noti-title">
												'.$row['user_involved'].'
												</span>
												<br>
												<span class="noti-title">
												היכנס עכשיו ל	<a href="http://eavni93.com/itay/paidRec.php"  style="padding:0; display:inline;">
											מחזורים שקניתי
												</a>
												</span></p>
												<br>
												<p class="noti-time"><span class="notification-time">
												'.$row['fullDate'].'
												</span></p>
											</div>
                                        </div>
                                   
                                </li>
                                                               
                                                               ';     
                                                                   
                                                                   
                                                               }
                                                               else if ($row['sort']==4)//someome else has aprroved his Mihzur from me
                                                               {
                                                                   $sql="SELECT * from users where userName='".$row['user_involved']."'";
                                                                   $result2=$conn-> query($sql);
                                                       if($result2->num_rows>0)
                                                       {
                                                         $row2=$result2->fetch_assoc();
                                                         $path=$row2['profilePic'];
                                                         if($path==NULL)
                                                         {
                                                             $path="http://eavni93.com/itay/assets/img/user.jpg";
                                                         }
                                                       }   
                                                                    
                                                                    
                                                                    echo '
                                                                    <li class="notification-message">
                                    
                                        <div class="media" style="line-height:1;">
											<span class="avatar">
												<img alt="" src="'.$path.'" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details">
												<span class="noti-title">
												'.$row['user_involved'].'	</span>
												אישר את המיחזור
											</p>
											<br>	<p class="noti-time"><span class="notification-time">'.$row['fullDate'].'</span></p>
											</div>
                                        </div>
                                   
                                </li>
                                                               
                                                               ';
                                                                   
                                                                   
                                                               }
                                                                   else if ($row['sort']==3)//i approved someone else's Mihzur   not working (eliran) check in yaniv
                                                               {
                                                                   $sql="SELECT * from users where userName='".$row['user_involved']."'";
                                                                   $result2=$conn-> query($sql);
                                                       if($result2->num_rows>0)
                                                       {
                                                         $row2=$result2->fetch_assoc();
                                                         $path=$row2['profilePic'];
                                                         if($path==NULL)
                                                         {
                                                             $path="http://eavni93.com/itay/assets/img/user.jpg";
                                                         }
                                                       }  
                                                                       echo '
                                                                    <li class="notification-message">
                                    
                                        <div class="media" style="line-height:2;">
											<span class="avatar">
												<img alt="" src="'.$path.'" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details">
										            אישרת את המיחזור מול		
												<span class="noti-title">
												'.$row['user_involved'].'
												</span>
												<br>
												<span class="noti-title">
												היכנס עכשיו ל<a href="http://eavni93.com/itay/myPosts.php"  style="padding:0; display:inline;">
												מיחזורים שלי
												</a>
												</span>
												</p>
												
												<p class="noti-time"><span class="notification-time">'.$row['fullDate'].'</span></p>
											</div>
                                        </div>
                                   
                                </li>
                                                               
                                                               ';   
                                                                   
                                                               }
                                                               else if($row['sort']==5)//i just uploaded a new Mihzur
                                                               {
                                                                 $path=$row['profilePic'];
                                                                 if($path==NULL)
                                                         {
                                                             $path="http://eavni93.com/itay/assets/img/user.jpg";
                                                         }
                                                                 echo '
                                                                    <li class="notification-message">
                                    
                                        <div class="media" style="line-height:2;">
											<span class="avatar">
												<img alt="" src="'.$path.'" class="img-fluid">
											</span>
											<div class="media-body">
												<p class="noti-details">
												<span class="noti-title">
												'.$row['user_involved'].'
												</span>
											הוספת מיחזור חדש!
											<br>
												<span class="noti-title">
												היכנס עכשיו ל	<a href="http://eavni93.com/itay/myPosts.php" style="padding:0; display:inline;">
												מיחזורים שלי
												</a><br>
												</span></p>
												<p class="noti-time"><span class="notification-time">'.$row['fullDate'].'</span></p>
											</div>
                                        </div>
                                   
                                </li>
                                                               
                                                               ';   
                                                                   
                                                               }
                                                               
                                                               
                                                               
                                                              
                                                               
                                                               
                                                               
                                                           }
                                                       }
    
 
    
}
if($_POST['action']=="clearNotifications") 
{
    $userName=$_POST['userName'];

    $sql="update notifications set isSeen=1 where owner='".$userName."' ";
     if (mysqli_query($conn, $sql))
   {


    }    
    
    
    
    
}




if($_POST['action']=="countNotifications") 
{
    
$userName=$_POST['userName'];
          $i=0;


        $sql="SELECT * from notifications where owner='".$userName."' and isSeen=0 ";//TO ADD- and isSeen=0
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
