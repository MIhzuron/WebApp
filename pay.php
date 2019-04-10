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

include 'PayPalExpress.php';

$payment=new PayPalExpress();

if(isset($_SESSION['userName']))
{
    if($_POST['tid']!=NULL && $_POST['state']!=NULL)
    {
        $amount=100;
        $tid=$_POST['tid'];
        $state=$_POST['state'];
        $userName=$_SESSION['userName'];
        
        if($payment->pay($userName,$tid,$amount,$state)==TRUE)
        {
            echo "payment success";
        }
        else
        {
                        echo "payment fail";

            
        }
        
        
    }
    
}else
    { 
        header("Location:login.php");
        
    }

