<?php
include('config/constants.php');
if (isset($_POST["query"])) {
    $output='';
     
   $query = "SELECT * FROM tbl_restaurant_info WHERE res_name LIKE'%".$_POST["query"]."%'";
    $result = mysqli_query($conn, $query);
    $output='<ul>';
 
    if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {
      $output .='<li>'.$user["country_name"].'<li>';
     }

    } else {
      $output .='<li>Country not found<li>';
    }
    $output .='<ul>';
    //return json res
    echo $output;
}
?>