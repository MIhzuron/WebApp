<?php
header("Access-Control-Allow-Origin: *");

require_once('config.php');


$userName=$_POST['userName'];



$sql="SELECT * FROM users WHERE userName=?";
       $stmt=mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$sql))
        {
             header('location: login.php?error=sqlerror');
       exit();
            
        }
        else
        {
            
            mysqli_stmt_bind_param($stmt,"s",$userName);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            
            if($row=mysqli_fetch_assoc($result))
            {
                $userName= $row['userName'];
                $email=$row['email'];
                $path=$row['profilePic'];
            }
          
       }
       
       if(isset($_GET))
       {
           if($_GET['delete']=='true' && $_GET['id']!= NULL)
           {
               $sql="UPDATE posts SET isDeleted=1 WHERE id='".$_GET['id']."'";
               if ($conn->query($sql) == TRUE) {
                echo' 
                <script>
                window.location="myPosts.html";
                </script>
                ';
                 } else {
                echo "Error deleting record: " . $conn->error;
                    }
            
                 $conn->close();
           }
       }
     function getDateDiff($dateRecive)
      {
     
       $day=(strtotime(date("Y-m-d"))-strtotime($dateRecive))/(60*60*24);
    
      $yesterday=strtotime((date("Y-m-d", time() - 60 * 60 * 24)));
      if((strtotime($dateRecive)-$yesterday)/(60*60*24)==0)
      {
          $isYesterday=true;
      }
      if($day==0 && $isYesterday!=true )
       {
           return 'היום';
       }
        if($isYesterday==true)
       {
           return 'אתמול';
       }
       else
       {
           
           return $dateRecive;
       }
       

    //echo ((strtotime(date("Y-m-d")))-strtotime((date("Y-m-d", time() - 60 * 60 * 24))))/(60*60*24);
   
     $winWid=false;
         echo'<script type="text/javascript">
       if(window.innerWidth <= 800 && window.innerHeight <= 600) {
        $winWid=true;   
       }
       </script>';
}


                                                        
                                                        $sql="SELECT * from posts WHERE userName='".$userName."' AND isDeleted='0' ORDER BY id LIMIT 250";
                                                       $result=$conn-> query($sql);
                                                       if($result->num_rows>0)
                                                       {
                                                           $i=1;
                                                           
                                                             while($row=$result->fetch_assoc())
                                                           {
                                                               echo '
                                                              <tr>
                                                              <td>'.$row['id'].'
                                                              </td>
                                                              <td>

                                                                <div class="contact-cont">
                                                            <div class="pull-left user-img m-r-10">
                                                                <a href="profile.html" title="John Doe"><img src=
                                                                '.$row['profilePic'].'
                                                                alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                                            </div>
                                                            <div class="contact-info">
                                                                <span class="contact-name text-ellipsis">
                                                                 '  
                                                                 .$row['userName'].'<br>'   .getDateDiff($row['date']).'
                                                                    
                                                                   
                                                                </span>
                                                               
                                                                 <span class="contact-date">
                                                                שווי
                                                               </span>
                                                                <span class="contact-name text-ellipsis">
                                                                <strong>
                                                                 '.
                                                                 $row['revenue'].'</strong>
                                                                 </span>
                                                                  <span class="contact-date">
                                                                  רווח צפוי:
                                                                  </span>
                                                                   <span class="contact-name text-ellipsis">
                                                                  <strong>
                                                                  '.$row['revenue']/2 .'</strong> </span>
                                                                  </td>
                                                                <td>';
                                                                  
                                                                
                                                                if($row['paid']==1)
                                                                {
                                                                  echo'  <span class="badge badge-success-border">
                                                                  נרכש
                                                                  </span>
                                                                  ' ;
                                                                }
                                                                else
                                                                {
                                                                 echo '  
                                                                 <span class="badge badge-info-border">
                                                                 באוויר
                                                                 </span>
                                                                 ';
                                                                }
                                                              
                                                              echo' <br>';
                                                               if($row['paid']==0)
                                                               {
                                                               echo' <a href="edit-post.html?update=true&id='.$row['id'].'" class="btn btn-white btn-sm m-t-10">
                                                              ערוך מיחזור
                                                               </a><br>
                                                               
                                                              
                                                                   <a href="myPosts.php?delete=true&id='.$row['id'].'" class="btn btn-white btn-sm m-t-10" ">
                                                                מחק מיחזור
                                                               </a><br>';
                                                               }
                                                              echo'
                                                               <form action="" method="post">
                                                               <div class="form-group row form-focus">
                                                               <input type="hidden" value="'.$row['id'].'">
                                                               <label class="focus-label">קוד בין 4 ספרות</label>
                                                              <div class="col-xs-2">
                                                               <input class="form-control input-sm" type="text" style="width:120px;height:40px;" name="fourCode" id="fourCode" placeholder="
                                                               הזן קוד בין 4 ספרות לאישור
                                                               ">
                                                               </div>
                                                               <button class="btn btn-primary btn-sm" type="submit" name="fourDigitSubmit">
                                                               אשר
                                                               </button>
                                                               </div>
                                                               </form>
                                                               
                                                              </td>
                                                              </tr>
                                                                  ';

                                                           }
                                                       }
                                                       

                                                       
                                                           ?>
                                                           
                                                           
<!DOCTYPE HTML>
<html>
    <head>
       <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
 
    </head>
    <body>
       <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script> 
    </body>
</html>
                                        