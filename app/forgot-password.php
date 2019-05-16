<?php
$host="localhost";
$user="eavnicom_eavni";
$pass="jePuc-*qO9";
$db="eavnicom_sadna";

$conn=new mysqli($host,$user,$pass,$db);
$conn->set_charset("utf8");
if ($conn->connect_error){
die("Connection failed: ".$conn->connect_error);}

header("Access-Control-Allow-Origin: *");
//session_start();
//header('Content-type: text/html; charset=UTF-8');


               use PHPMailer\PHPMailer;
               use PHPMailer\Exception;
               require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_POST)
{
    
   $email=$_POST['emailOfForgotten']; 
   $passwordResetKey= null; 
    
     $sql="SELECT * FROM users WHERE email=?;";
        $stmt= mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            echo json_encode("sqlError");
       exit();
            
        }
        else
        {
            
            mysqli_stmt_bind_param($stmt,"s",$email);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            
            if($row=mysqli_fetch_assoc($result)) //there is a row with this email
            {
                //start-generate a token for resetting password once
                
               $passwordResetKey=generateRandomString();
              
               
                $sql = "UPDATE users SET passwordResetKey='".$passwordResetKey."'
      WHERE email='".$email."'
      ";    
      
   if (mysqli_query($conn, $sql))
   {
    
} 
else 
{
    echo json_encode("errorUpdate");
}

                        // end-generate a token for resetting password once
               
$mail=new PHPMailer\PHPMailer();

$mail->IsSMTP();
$mail->CharSet="UTF-8";
$mail->SMTPSecure = 'tls';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = 'eavnitayze@gmail.com';
$mail->Password = 'jePuc-*qO9';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true;   
$mail->Mailer = “smtp”; // don't change the quotes!

$mail->From = 'support@recycle.co.il';
$mail->FromName = 'מחזורון';
$mail->AddAddress(''.$email.'');
$mail->AddReplyTo('support@recycle.co.il', '');

$mail->IsHTML(true);
$mail->Subject    ="reset your password";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!";
$mail->Body    ='

<p>hey, here is your password reset</p>
<p>
<a href="http://eavni93.com/itay/change-password2.php?token='.$passwordResetKey.'&email='.$email.'">click here</a> to reset your password </p>

';

if(!$mail->Send())
{
echo json_encode("messageNotSent");
}
else
{

echo json_encode("messageSent");
    
}
 

               
               
               
               
               
            }
            else  //there is not a row with this email
            {
               echo json_encode("notFound");
                
            }
                
    
    
    
    
    
}


}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


?>