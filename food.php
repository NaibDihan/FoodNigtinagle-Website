
<?php include('partial-front/menu.php');
// session_start();
// session_destroy();

?>

 <?php
 if(isset($_GET['username']))
 {
     $username=$_GET['username'];
     $sql="SELECT res_name FROM tbl_restaurant_info WHERE username='$username'";
     $res = mysqli_query($conn,$sql);
     $row = mysqli_fetch_assoc($res);
     $res_name = $row['res_name'];

 }
 else{
     header('location:'.SITEURL);
 }
 ?> 

<section class="food-search text-center">
        <div class="container">
            <div class="text">
            <h1><?php echo $res_name;?></h1>
            </div>
        </div>
    </section>


    <section class="food">
        <div class="container">
        <h1>Menu</h1>
        <?php
                     $sql1 = "SELECT DISTINCT(category) as category FROM tbl_food WHERE username = '$username'";
                     $res1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
                     if($res1)
                     {
                         $count1 = mysqli_num_rows($res);
                 
                         if($count1>0)
                         { 
                             //we have data in database
                             while($rows1=mysqli_fetch_assoc($res1)) 
                          {
                              //using while loop to get all the from database
                              //while loop will run as long as we have data in database
                 
                              //get individual data
                              $category = $rows1['category'];
                             
                 
                             
                
                
                ?>
         
                 <h3><?php echo $category;?></h3>
            <div class="food-container">

        <?php
        $sql2="SELECT * FROM tbl_food WHERE username='$username' AND category='$category'";
        $res2=mysqli_query($conn,$sql2);
        $count2=mysqli_num_rows($res2);
        if($count2>0){
            ?>
            <?php

            while($row2=mysqli_fetch_assoc($res2)){
                $food_name=$row2['food_name'];
                $category=$row2['category'];
                $price=$row2['price'];
                $description = $row2['Description'];
                ?>
    
       <?php         
        echo "     
        <div class='food-box'>
        <form action='cart.php?username=$username' method='POST'>
                <h3>$row2[food_name]</h3>
                <h4>$row2[price]</h4>
                <p>$row2[Description]</p>
                <button type='submit' name='Add_To_Cart' class='btn btn-primary'>Add to cart</button>
                <input type='hidden' name='Food_Name' value='$row2[food_name]'>
                <input type='hidden' name='Price' value='$row2[price]'>
                

        </form>   
            
        </div>
        ";
        ?>
        
       
        
       
           
            
              <?php  
            
           
            } 
            ?>
            </div>
            <?php
        }
    }
}
                     }
        ?>
        
                   

            <div class="clearfix"></div>
        </div>
        
    
    </section>


    <?php include('partial-front/footer.php');?>