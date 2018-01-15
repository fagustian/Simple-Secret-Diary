<?php 

session_start();

$pesanError = "";

include("koneksi.php");

if (array_key_exists('logout', $_GET)) {

    if ($_GET['logout'] == '1') {
        unset($_SESSION['id']);
        setcookie('id', '', time() - 60 * 60);
        $_COOKIE['id'] = '';
    }

} else if (array_key_exists('id', $_SESSION) or array_key_exists('id', $_COOKIE)) {
    header("Location: loggedInPage.php");
}




if (array_key_exists('submit', $_POST)) {

    if (!$_POST['email']) {
        $pesanError .= "<p>Email address is required !</p>";
    }

    if (!$_POST['password']) {
        $pesanError .= "<p>Password is required</p>";
    }


    if ($_POST['signup'] == '1') {

        if (!$_POST['nama']) {
            $pesanError .= "<p>What is your name ?</p>";
        }

        if ($pesanError == '') {
            $emailAddress = mysqli_real_escape_string($link, $_POST['email']);
            $password = mysqli_real_escape_string($link, $_POST['password']);
            $username = mysqli_real_escape_string($link, $_POST['nama']);

            $query = "SELECT * FROM `users` WHERE `email`='" . $emailAddress . "'";
            $result = mysqli_query($link, $query);
            if (mysqli_num_rows($result) > 0) {
                $pesanError .= "Email has already been taken !";
            } else {
                $query2 = "INSERT INTO `users`(`email`,`password`,`name`) VALUES ('" . $emailAddress . "','" . $password . "','" . $username . "')";
                if (mysqli_query($link, $query2)) {
                    $userID = mysqli_insert_id($link);
                    $hashedPassword = md5(md5($userID) . $password);
                    $queryUpdate = "UPDATE `users` set `password`='" . $hashedPassword . "' WHERE `id` =" . $userID . "";
                    mysqli_query($link, $queryUpdate);

                    $_SESSION['id'] = $userID;

                    if ($_POST['stayLoggedIn'] == '1') {
                        setcookie("id", $userID, time() + 60 * 60 * 24 * 365);

                    }
                    header("Location: loggedInPage.php");

                } else {
                    $pesanError .= "<strong>Syntax Error<strong>";
                }
            }
        }

    } else if ($_POST['signup'] == '0') {
        $emailAddress2 = mysqli_real_escape_string($link, $_POST['email']);
        $password2 = mysqli_real_escape_string($link, $_POST['password']);

        $queryLogIn = "SELECT * FROM `users` WHERE `email`= '" . $emailAddress2 . "' ";
        if ($result = mysqli_query($link, $queryLogIn)) {
            $row = mysqli_fetch_array($result);
            if (isset($row['id'])) {
                $hashedPassword2 = md5(md5($row['id']) . $password2);

                if ($hashedPassword2 == $row['password']) {
                    $_SESSION['id'] = $row['id'];
                    if ($_POST['stayLoggedIn'] == '1') {
                        setcookie('id', $row['id'], time() + 60 * 60 * 24 * 365);
                    }

                    header("Location: loggedInPage.php");
                } else  if ($hashedPassword2 != $row['password']) {
                    $pesanError .= "Account not found";
                } 
            }else{
                $pesanError .= "Account not found ! Please Sign Up";
            }
        }

    }

    if ($pesanError != '') {
        $pesanError = "<p><strong>Waddaw ! error(s):</strong></p>" . $pesanError;
    }

}


?>

<?php include("header.php"); ?>

    <div id="indexContainer" class="container">
        <h1>Secret Diary</h1>
        <h4>Simpan Cerita Rahasiamu Dengan Aman</h4>
        <br>
        <?php if($pesanError!=''){
            echo ('
            <div class="alert alert-danger" role="alert">
            '.$pesanError.'
            </div>            
            ');
        }; ?></p>
            <div id="signUpForm">
                <p>Tertarik ? Ayo daftar sekarang.</p>
                <form action="" method="post">
                    <fieldset class="form-group">   
                        <input class="form-control mb-2 mr-sm-2 mb-sm-0" type="email" name="email" placeholder="Your Email">
                    </fieldset>

                    <fieldset class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password">
                    </fieldset>
                
                    <fieldset class="form-group">
                        <input class="form-control" type="text" name="nama"  placeholder="Your Name">
                    </fieldset>
                    

                    <div class="form-check" >
                        <label for="" class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="stayLoggedIn" value=1>Stay login
                        </label>
                    </div>

                    <fieldset class="form-group">

                        <input type="hidden" name="signup"  value="1">

                        <input class="btn btn-success" type="submit" name="submit" value="Sign Up">
                        
                    </fieldset>
                   
                </form>
                
            </div>
           

            <div id="logInForm">
                <p>Silahkan Log In dengan Email dan Password anda.</p>
                <form action="" method="post" >
                    <fieldset class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Your Email">
                    </fieldset>
                    
                    <fieldset class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password">
                    </fieldset>
                    <div class="form-check">
                        <label for="" class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="stayLoggedIn" value=1>Stay login
                        </label>
                    </div>
                    
                    <fieldset class="form-group">      
                        <input type="hidden" name="signup"  value="0">

                        <input class="btn btn-success" type="submit" name="submit" value="Log In">
                    </fieldset>

                </form>
            </div>
            <strong><a id="showLogInForm">Log in</a></strong>
           
    </div>
  
      
<?php include("footer.php"); ?>