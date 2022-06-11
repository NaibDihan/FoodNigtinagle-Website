<?php include('partial-front/menu.php');
// session_start();
// session_destroy();
$username=$_SESSION['username'];
?>

<section class="food-search text-center">
        <div class="container">
            <div class="text">
            <h1>Previous Orders</h1>
            
            </div>
        </div>
    </section>

    <section class="food1">
        <div class="container">
        <p  style="margin-top:25px;font-size:25px;font-weight:700;text-align:center;">You can Reorder from your previous orders</p>
            
         
          
            
    <div class="food-container1">
    <?php

        $query="SELECT * FROM `tbl_order` WHERE username='$username'";
        $user_result=mysqli_query($conn,$query);
        while($user_fetch=mysqli_fetch_assoc($user_result)){
            $order_id=$user_fetch['order_id'];

    $order_query="SELECT * FROM `tbl_order_item` WHERE `order_id`='$user_fetch[order_id]'";
   $order_result=mysqli_query($conn,$order_query);
       while($order_fetch=mysqli_fetch_assoc($order_result))
           {
               $food_name=$order_fetch['food_name'];
               $price=$order_fetch['price'];
           


?>
      <div class='food-box1' style='text-align:center;'>         
      <?php echo "     
      
        <form action='cart.php?username=$username' method='POST'>
                <h3 style='margin-bottom:10px;'>$food_name</h3>
                <h4 style='font-size:16px;background-color:grey;padding:8px;border-radius:7px; color:white; width:50px;display:inline;text-align:center;'>Tk $price</h4>
                
                <button type='submit' name='Add_To_Cart' class='btn btn-primary' style='margin-top:10px; padding:8px;'>Add to cart</button>
                <input type='hidden' name='Food_Name' value='$food_name'>
                <input type='hidden' name='Price' value='$price'>
                

        </form> ";
        ?>  
            
        </div>
      
        
        
       
        
       
           
            
              <?php  
            
                                }
            } 
            ?>
            </div>
            <?php
        
    

                     
        ?>

    
    </section>


    <?php include('partial-front/footer.php');?>
    
