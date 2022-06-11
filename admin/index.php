<?php include('partials/menu.php'); ?>

<!-- Main content Section Starts-->
    <div class="main-content">
    <div class="wrapper">
       <h1 style="font-weight:700;">DASHBOARD</h1>
       <div style="text-align:center;">
       <div class="col-4 text-center">
       <?php
       $count1=0;
            $sql1 = "SELECT * FROM tbl_admin";
            $res1 = mysqli_query($conn,$sql1) or mysqli_error($conn);
            $count1 = mysqli_num_rows($res1);
            if($res1)
            {?>
                <h1><?php echo $count1?> Admins</h1>
                <?php
                    
                 }
            

                 ?>
           
       </div>

       <div class="col-4 text-center">
       <?php
       $count=0;
            $sql = "SELECT * FROM tbl_restaurant_info";
            $res = mysqli_query($conn,$sql) or mysqli_error($conn);
            $count = mysqli_num_rows($res);
            if($res)
            {?>
                <h1><?php echo $count?> Restaurants</h1>
                <?php
                    
                 }
            

                 ?>
           
       </div>
       </div>

   

       <div class="clearfix"></div>
        </div>
    </div>
    <!-- Main Content Section ends-->
    <?php include('partials/footer.php'); ?>