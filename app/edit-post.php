<?php
header("Access-Control-Allow-Origin: *");

require_once('config.php');


$userName=$_POST['userName'];
$id=$_POST['id'];


    date_default_timezone_set("Asia/Jerusalem"); 


       $sql="SELECT * FROM posts WHERE userName='".$userName."' AND id='".$id."'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) == 0) {
           echo json_encode("error");
            exit();
        }
        else 
        {
            $row = mysqli_fetch_assoc($result);
            if($row['userName']!=$userName)
            {
                 echo json_encode("error");
            exit();
            }
        }
        
        
 

                $amountA=$_POST['amountA'];
                $amountB=$_POST['amountB'];
                $revenue=(0.3*$amountA)+(1.2*$amountB);
                $sql = "UPDATE posts SET amountA='".$amountA."',amountB='".$amountB."',revenue='".$revenue."' WHERE id='".$id."'";
                if ($conn->query($sql) == TRUE) {
                    echo json_encode("success");
                } else {
                    echo json_encode("error");
            
                }
                
                
           
 

 


?>