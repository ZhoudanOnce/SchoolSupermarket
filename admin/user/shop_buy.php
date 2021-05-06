<?php 
    include_once "./../../config.php";
    $con=mysqli_connect($CONFIG["host"],$CONFIG["username"],$CONFIG["password"],$CONFIG["database"]);
    $sql = "update content1 set nums = nums - ".$_POST['shop_number']." where id = ".$_POST['shop_id'];
    mysqli_query($con,$sql);
    mysqli_close($con);
    die;
?>