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
$userName=$_SESSION['userName'];
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
               $city=$row['city'];
            }
          
       }
  $newFeedCount=$_POST['newFeedCount'];
  $sql="SELECT * from posts WHERE city='$city'  ORDER BY id DESC LIMIT $newFeedCount";
                                                        $result=$conn-> query($sql);
                                                       if($result->num_rows>0)
                                                       {
                                                           $i=1;
                                                           while($row=$result->fetch_assoc())
                                                           {
                                                               echo '
                                                              <li>

                                                                <div class="contact-cont">
                                                            <div class="pull-left user-img m-r-10">
                                                                <a href="profile.html" title="John Doe"><img src=
                                                                '.$row['profilePic'].'
                                                                alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                                            </div>
                                                            <div class="contact-info">
                                                                <span class="contact-name text-ellipsis">
                                                                 '  .
                                                                      $row['userName'].'<br>'.getDateDiff($row['date']) 
                                                                    
                                                                   .'
                                                                </span>
                                                                <span class="contact-date">
                                                                 עיר:   
                                                             <strong>
                                                             '.  
                                                             $row['city'].'</strong>.'
                                                             .' '.
                                                            ' רחוב: '.
                                                             '<strong>'
                                                             . $row['street'].'</strong>'.
                                                             '
                                                                    
                                                                </span><br>
                                                                 <span class="contact-date">
                                                                 
                                                                שווי
                                                               
                                                                <strong>
                                                                 '.
                                                                 $row['revenue'].'</strong>
                                                                 </span>
                                                                  <span class="contact-date">
                                                                  רווח צפוי:
                                                                  <strong>
                                                                  '.$row['revenue']/2 .'</strong>
                                                                  </span>

                                                                  ';
                                                                   if($row['userName']!=$userName)
                                                                        {
                                                                            echo '
                                                                     <span class="contact-date">

                                                                            <button style="float:left;" class="btn btn-primary" type="submit" name="pay" id="pay">שלם
                                                                                <i class="fas fa-wine-bottle"></i>

                                                                            </button> </span>
                                                                            ';
                                                                        }
                                                                  
                                                          echo'  </div>';
                                                            if($row['userName']==$userName)
                                                            {
                                                              echo '
                                                              <ul class="contact-action">
                                                                <li class="dropdown dropdown-action">
                                                                    <a href="" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                                    <div class="dropdown-menu dropdown-menu-right">
                                                                        <a class="dropdown-item" href="javascript:void(0)">Edit</a>
                                                                        <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                                                        
                                                                        
                                                                    </div>
                                                                    
                                                                </li>
                                                            </ul>
                                                              
                                                              
                                                              
                                                              
                                                              '   ;
                                                            }
                                                           
                                                            echo ' <br>
                                                        </div> ';
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
      }
    ?>
            