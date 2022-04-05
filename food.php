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

     $query="SELECT round(avg(rating),1) as avg_rating FROM rating WHERE owner_name='$username'";
     $avg_result=mysqli_query($conn,$query) or die(mysqli_error($conn));
     $fetch_avg=mysqli_fetch_array($avg_result);
     $avg_rating=$fetch_avg['avg_rating'];
     if($avg_rating-5==0){
         $avg_rating=5;
     }
     else if($avg_rating-4==0){
        $avg_rating=4;
    }
    else if($avg_rating-3==0){
        $avg_rating=3;
    }
    else if($avg_rating-2==0){
        $avg_rating=2;
    }
    else if($avg_rating-1==0){
        $avg_rating=1;
    }

     if($avg_rating>4){
         $rate='Excellent';
     }
     else if($avg_rating>3){
        $rate='Very Good';
     }
     else if($avg_rating>2){
        $rate='Good';
     }
     else if($avg_rating>1){
        $rate='Bad';
     }
     else{
        $rate='Very Bad';
     }


 }
 else{
     header('location:'.SITEURL);
 }
 ?> 

<section class="food-search text-center">
        <div class="container">
            <div class="text">
            <h1><?php echo $res_name;?></h1>
            <p><span><i class='fa fa-star' style='color:#637dca;margin:0 5px;font-size:20px'></i></span><?php echo $avg_rating;?>/5</p>
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

    <div class='review'>
        <form action='' method='POST'>
            <h3>Review this restaurant</h3>
        <textarea name="Description" id="" required></textarea>
    <div class='form-check'>
        <input class='form-check-input' type='radio' name='rating' id='exampleRadios1' value='5' checked >
        <label class='form-check-label' for='exampleRadios1'>
          Excellent
        </label>
        <div class="clearfix"></div>
        <br>
        <input class='form-check-input' type='radio' name='rating' id='exampleRadios1' value='4'>
        <label class='form-check-label' for='exampleRadios1'>
            Very Good
        </label>
        <div class="clearfix"></div>
        <br>
        <input class='form-check-input' type='radio' name='rating' id='exampleRadios1' value='3' >
        <label class='form-check-label' for='exampleRadios1'>
            Good
        </label>
        <div class="clearfix"></div>
        <br>
        <input class='form-check-input' type='radio' name='rating' id='exampleRadios1' value='2'>
        <label class='form-check-label' for='exampleRadios1'>
            Bad
        </label>
        <div class="clearfix"></div>
        <br>
        <input class='form-check-input' type='radio' name='rating' id='exampleRadios1' value='1'>
        <label class='form-check-label' for='exampleRadios1'>
            Very bad
        </label>
        <div class="clearfix"></div>
    </div>
        <br>
        <button class='btn btn-primary btn-block' name='submit_review' style="margin:0 0 20px 0">Submit</button>
    </form>
    <a href="#ft-demo-modal" style="font-size:25px;color:#276FBF;"onMouseOver="this.style.color='coral'" onMouseOut="this.style.color='#276FBF'">See others reviews</a> 
    </div>      

            <div class="clearfix"></div>
        </div>
        
    
    </section>
<?php
if(isset($_POST['submit_review']))
{
    if(!isset($_SESSION['username'])){
        echo"
        <script>
        alert('You have to log in first.');
        window.location.href='login.php'
        </script>
        ";
    }
    else{
        $username_customer=$_SESSION['username'];
        $description=$_POST['Description'];
        if($_POST['rating']=="1")
                 {
                     $rating = 1;
                 }

         else if($_POST['rating']=="2")
                 {
                     $rating = 2;
                 }
        else if($_POST['rating']=="3")
                 {
                     $rating = 3;
                 }
        else if($_POST['rating']=="4")
                 {
                     $rating = 4;
                 }
        else if($_POST['rating']=="5")
                 {
                     $rating = 5;
                 }
                 
        $sql = "INSERT INTO rating SET
                 review='$description',
                 customer_name='$username_customer',
                 res_name='$res_name',
                 owner_name='$username',
                 rating='$rating'
             ";
               $res=mysqli_query($conn,$sql) or die(mysqli_error($conn)); 
               if($res)
           {
               echo "
                <script>
                     alert('Thanks for your review');
         
                </script>
               
               ";
               
           }


    }

}

?>
 

    <?php include('partial-front/footer.php');?>

   
<div class="ft-modal" id="ft-demo-modal">
    
        <div class="ft-modal-content">
        <div class="ft-modal-footer">
            <a class="ft-modal-close" href="#" style="font-size:19px; background-color:whitesmoke;padding:5px;border:0 solid red;border-radius:100%">&#10006;</a>
        </div>
        <?php
        $sql_review="SELECT * FROM rating WHERE owner_name='$username'";
        $result=mysqli_query($conn,$sql_review);
        $counts=mysqli_num_rows($result);
     
        if($counts>0){
            ?>
            <p style="font-size:20px"><?php echo $counts;?> Reviews</p>
            <?php

            while($rows2=mysqli_fetch_assoc($result)){
                $customer=$rows2['customer_name'];
                $review=$rows2['review'];
                $rating=$rows2['rating'];
                ?>
                <hr>
        <div class="ft-modal-header">
            <div class="header" style="margin:20px">
            <h4 style="font-size:21px;text-transform: capitalize"><?php echo $customer;?></h4>
            <span><i class='fa fa-star' style='color:#637dca;font-size:14px'></i><?php echo $rating?>/5</span>
            </div>
        </div>	
        <div class="ft-modal-body">
        <span style="margin-left:15px">"<?php echo $review;?>"</span>	
        </div>
        <?php
        }
        }?>
        <hr>

     
    </div>
</div>
