<?php 
    $server='localhost';$user='root';$userPassword='12345';$db='webcourse';
    $link = mysqli_connect($server, $user, $userPassword, $db)or die ("Waddaw ! Terjadi kesalahan..");

    // if (mysqli_connect_error()) {
    //     die("Waddaw ! Terjadi kesalahan..");
    // }
?>