<?php include('partial-front/menu.php');?>

<section class="food-search text-center">
        <div class="container">
           <!-- <form action="">
                <input type="search" name="search" placeholder="Search for restaurants">
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form> -->
            <h2 class="text-center" style="color:#178A8A;font-size:3.5rem;">Restaurants</h1>
            

        </div>
    </section>
<section class="restaurant">
        <div class="container">
        <p style="font-size:25px;font-weight:700;text-align:center;">Grab your favourite food from your favourite restaurant! We are here to serve you with our free home delivery service! So stay home and enjoy your meal :)  </p>
            <?php
            $sql = "SELECT * FROM tbl_addedres_front";
            $res = mysqli_query($conn,$sql) or mysqli_error($conn);
            $count = mysqli_num_rows($res);
            if($res)
            {
                 if($count>0)
                 {
                    while($row  = mysqli_fetch_assoc($res))
                    {
                       $username = $row['username'];
                       $res_name = $row['res_name'];
                       $res_img = $row['res_img'];
                       ?>
               <a href="<?php echo SITEURL;?>food.php?username=<?php echo $username;?>">
                <div class="box-3 float-container">
                <?php
                if($res_img=="")
                {

                }
                else
                {
                   ?>
                  <img src="<?php echo SITEURL;?>images/restaurant/<?php echo $res_img;?>" alt="res1" class="img-responsive" height="600px">
                  <?php
                }
                ?>
                 
                 <div class="float-text background">
                    <h3 class="text-white"><?php echo $res_name;?></h3>
                 </div>
            </div> </a>

                       <?php


                    }
                 }
            }


            ?>
           

         

            <div class="clearfix"></div>
        </div>
    </section>


    <?php include('partial-front/footer.php');?>