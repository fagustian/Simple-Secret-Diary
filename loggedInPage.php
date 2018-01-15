<?php 
session_start();
include("koneksi.php");

    if(array_key_exists('id',$_COOKIE)){
        $_SESSION['id']= $_COOKIE['id'];
    }


    if(array_key_exists('id', $_SESSION)){
        $query = "SELECT * from `users` where `id`=".$_SESSION['id']."";
        $result = mysqli_query($link,$query);
        $row = mysqli_fetch_array($result);
    }
    else{
        header("Location: index.php");
    }

    include("header.php");
?>
     
      <nav id="navbarhitam" class="navbar navbar-inverse"> 
        <div class="container-fluid">
              <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" href="#">Secret Diary</a>
              </div>

              <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav navbar-right">
                  <li><a href="#"><span class="glyphicon glyphicon-user"></span>
                      <?php echo $row['name'] ?>
                  </a></li>
                  <li><a href="index.php?logout=1"><span class="glyphicon glyphicon-log-in"></span> Log Out</a></li>
              </ul>
              </div>
        </div>
      </nav>
  

      <div  class="container-fluid">
 

<textarea id="diary" class="form-control" ><?php echo $row['story'];  ?></textarea>

</div>


<?php include('footer.php'); ?>