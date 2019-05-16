<?php
require_once('config.php');
header("Access-Control-Allow-Origin: *");




     $postId=$_POST['postId'];
   
          $sql="SELECT * from posts WHERE id=$postId ";
          $result=$conn-> query($sql);
          if($result->num_rows>0)
          {
              $row=$result->fetch_assoc();
         echo     $row['userName'];
         
       echo '  
         <h2>
                                
                    '.  $row['userName'].'

                                    
                                </h2>
                                <p>
                                   תאריך:
                                   '.
                                    $row['date'].'
                                  
                                </p>
                                <div class="rating">
                                    <p>
                                        <span><i class="fa fa-star rated"></i></span>
                                     
                                        <span>מומלץ על ידי המערכת</span>
                                    </p>
                                </div>
                                <p class="product_price">
                                    שווי:
                                    
                                     
                                    
                                    <span> '.$row['revenue'].' ₪</span> 
                                
                                </p>
                                <p class="product_price">
                                    רווח:
                                    
                                     
                                    
                                    <span id="price" style="color:green;"> '.($row['revenue']/2) 
                                    
                                    .' </span>
                                    <span>
                                    ₪</span> 

                                </p>
                                <p><b>זמינות המיחזור:</b> ';
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
         
          }






?>
