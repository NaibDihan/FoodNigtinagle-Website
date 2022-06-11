<?php include('partial-front/menu.php');?>

    <section class="food-forget text-center">
        <div class="container">
        <h1 class="login-h1">Validation</h1>
            <div class="loginbox">
            <div class = "loginbhitore forget">
                <form action="" method="POST">
                <p>Username</p>
                <input type="text" name="username" placeholder="Enter Your Username" required>
                <p>New Password</p>
                <input type="password" name="newpassword" placeholder="New Password" required>
                <p>Confirm Password</p>
                <input type="password" name="confirmpass" placeholder="Confirm Password" required>
                <p class="userp">User Type</p>
                <select name="usertype">
                    <option value="Customer">Customer</option>
                    <option value="Restaurant-Owner">Restaurant Owner</option>
                </select>
                <input type="submit" name="Submit" value="Submit"/>
            </form>

            </div>
        </div>
</div>
    </section>

    <?php include('partial-front/footer.php');?>

<?php

if(isset($_POST['Submit'])){
    $username = $_POST['username'];
    $usertype = $_POST['usertype'];
    $pass_check=$_POST['newpassword'];
    $newpass = md5($_POST['newpassword']);
    $confirmpass = md5($_POST['confirmpass']);

    if(strlen($pass_check)<8)
    {
        echo "
        <script>
        alert('Your password should have atleast 8 characters!');
         window.location.href='forgetpass.php';
         </script>
         ";
    }
    else{
    if($newpass == $confirmpass )
    {
        if($usertype == "Customer"){
            $sql = "SELECT * FROM tbl_customer WHERE username='$username'";
            $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            if($res){
                if(mysqli_num_rows($res)>0){
                    $sql1 = "UPDATE tbl_customer SET password='$newpass' 
                    WHERE username='$username'";
                     $res1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
                     if($res1){
                        $_SESSION['username']=$username;
                         echo "
                         <script>
                         alert('Password Changed Successfully');
                         window.location.href = 'index.php';
                         </script>
                         
                         ";
                     }
                     else{
                        echo "
                        <script>
                        alert('Database Error');
                        window.location.href = 'forgetpass.php';
                        </script>
                        
                        ";
                     }

                }
                else{
                    echo "
                    <script>
                    alert('Username is not valid');
                    window.location.href = 'forgetpass.php';
                    </script>
                    
                    ";
                }

            }
            else{
                echo "
                <script>
                alert('Database Error');
                window.location.href = 'forgetpass.php';
                </script>
                
                ";
             }
        }

        if($usertype == "Restaurant-Owner"){
            $sql = "SELECT * FROM tbl_owner WHERE username='$username'";
            $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));
            if($res){
                if(mysqli_num_rows($res)>0){
                    $sql1 = "UPDATE tbl_owner SET password='$newpass' 
                    WHERE username='$username'";
                     $res1 = mysqli_query($conn,$sql1) or die(mysqli_error($conn));
                     if($res1){
                        $_SESSION['username']=$username;
                        $_SESSION['restaurant-name']=$res_name;
                         echo "
                         <script>
                         alert('Password Changed Successfully');
                         window.location.href = 'ownerfood_add.php';
                         </script>
                         
                         ";
                     }
                     else{
                        echo "
                        <script>
                        alert('Database Error');
                        window.location.href = 'forgetpass.php';
                        </script>
                        
                        ";
                     }

                }
                else{
                    echo "
                    <script>
                    alert('Username is not valid');
                    window.location.href = 'forgetpass.php';
                    </script>
                    
                    ";
                }

            }
            else{
                echo "
                <script>
                alert('Database Error');
                window.location.href = 'forgetpass.php';
                </script>
                
                ";
             }
        }

    }
   
    
    else{
        echo "
        <script>
        alert('New and Confirm Password did not match');
        window.location.href = 'forgetpass.php';
        </script>
        
        ";
     }
}
}


?>


