<?php
//in this page- the user will input his mail and will recieve to this email a messagw with a link to create new password

$host="localhost";
$user="eavnicom_eavni";
$pass="jePuc-*qO9";
$db="eavnicom_sadna";

header('Content-type: text/html; charset=UTF-8');


$conn=new mysqli($host,$user,$pass,$db);
$conn->set_charset("utf8");
if ($conn->connect_error){
die("Connection failed: ".$conn->connect_error);} //end-connect to db

               use PHPMailer\PHPMailer;
               use PHPMailer\Exception;
               require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['forgotPasswordSubmit']))
{
    
   $email=$_POST['emailOfForgotten']; 
   $passwordResetKey= null; 
    
     $sql="SELECT * FROM users WHERE email=?;";
        $stmt= mysqli_stmt_init($conn);
        
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
             header('location: login.php?error=sqlerror');
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
               echo '
               <p> there is a row </p>';
               
                $sql = "UPDATE users SET passwordResetKey='".$passwordResetKey."'
      WHERE email='".$email."'
      ";    
      
   if (mysqli_query($conn, $sql))
   {
    echo " record updated successfully";
} 
else 
{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
  echo "Mailer Error: " . $mail->ErrorInfo;
}
else
{
  echo "Message sent!";
}
 

               
               
               
               
               
            }
            else  //there is not a row with this email
            {
                 echo '
               <p> there is not such a row </p>';
                
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
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <title>מיחזורון-שכחתי ססמא</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="account-page">
            <div class="container">
                <h3 class="account-title">שכחתי ססמא</h3>
                <div class="account-box">
                    <div class="account-wrapper">
                        <div class="account-logo">
                            <a href="index.html"><img src="assets/img/logo.png" alt="Preadmin"></a>
                        </div>
                        <form method="post" action="" id="forgotPasswordForm">
                            <div class="form-group form-focus">
                                <label class="focus-label">כתובת האימייל איתה נרשמת</label>
                                <input class="form-control floating" type="text" name="emailOfForgotten">
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary btn-block account-btn" name="forgotPasswordSubmit" type="submit">אפס ססמא</button>
                            </div>
                            <div class="text-center">
                                <a href="login.php">חזרה להתחברות</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="assets/js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
</body>

</html>