<?php 
    $server='localhost';$user='root';$userPassword='12345';$db='secretdiary';
    $link = mysqli_connect($server, $user, $userPassword, $db);

    if (mysqli_connect_error()) {
        die("Waddaw ! Terjadi kesalahan..");
    }

    // Cara lain pesan error
    // $link = mysqli_connect($server, $user, $userPassword, $db))or die ("Waddaw ! Terjadi kesalahan..";
?>