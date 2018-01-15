<?php 
    session_start();
    include("koneksi.php");

   

    if(array_key_exists('content',$_POST)){


    $query = "UPDATE `users` SET `story` = '".mysqli_real_escape_string($link,$_POST['content'])."' WHERE `id` =".$_SESSION['id']." Limit 1 ";
        $result = mysqli_query($link,$query);
        echo "Ok";
       
    };
   

    

?>