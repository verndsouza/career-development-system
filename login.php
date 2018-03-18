<!DOCTYPE html>
<html lang="en">

<head>

 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="description" content="">
 <meta name="author" content="">

 <title>Capstone - Start building your career here!</title>

 <!-- Bootstrap core CSS -->
 <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

 <!-- Custom fonts for this template -->
 <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
 <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

 <!-- Custom styles for this template -->
 <link href="css/landing-page.css" rel="stylesheet">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
<div class="container">
  <a class="navbar-brand" href="index.php">Livelihood</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pricing.php">Pricing</a>
      </li>
      
 <?php
   error_reporting(E_ALL ^ E_NOTICE);
   $a="";
   session_start();

   $a = $_SESSION["username"];

   if($a == ""){
     echo'<li class="nav-item">
        <a class="nav-link" href="registration.php">Register</a>
      </li>
      <li class="nav-item">
              <a class="nav-link" href="login.php">Sign in</a>
            </li>';
   }
   else{
     echo'<li class="nav-item">
              <a class="nav-link" href="logout.php">Sign out</a>
            </li>';
   }

   echo'</ul>
        </div>
      </div>
    </nav>
    <br>
    <br>
    <br>
    <br>';

echo'<div>';
   $i=0;
   $server = "localhost";
    $username = "root";
    $dbname = "Capstone";
    $password = "";
   $conn = new mysqli($server, $username, $password, $dbname);
   if ($conn->connect_error)
      {die("Connection failed: " . $conn->connect_error); }

   $err = "";
   if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) 
   {
      $user = test_input($_POST['username']);
      $sql = "SELECT * FROM login WHERE email = '$user'";

       $result = $conn->query($sql);
       if ($result)
       { 
          if ($result->num_rows > 0)
          {
            while($row = $result->fetch_assoc())
             {
                if ($_POST['password'] == $row['password'])
                {
                   $_SESSION['valid'] = true;
                   $_SESSION['timeout'] = time();
                   $_SESSION['username'] = $row['user_id'];
                   header('Location: front_page.php');
                }
                else 
                {
                   $err= 'Wrong username or password.';
                   $i=1;
                }
             } 
          }
          else 
          {
             $err = 'Wrong username or password.';
             $i=1;
          }
       }
      
   }
   function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
   }


   if ($_SERVER["REQUEST_METHOD"] == "GET" || $i==1)
   {

      echo '<section>
      <div style = "margin: auto; width: 30%; padding: 10px;" class="container">
      <span style="color: red;">'.$err.'</span>
      <h3>Login</h3> 
      <form action = "'.$_SERVER['PHP_SELF'].'" method = "post">
      <div class="form-group">
      <label for="username">Email:</label>
      <input type = "text" class="form-control" id="username" name = "username" placeholder = "Enter Email" required autofocus>
      </div>
      <div class="form-group">
      <label for="password">Password:</label>
      <input type = "password" class = "form-control" id="password" name = "password" placeholder = "Enter Password" required>
       </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>
      <button type = "submit" name = "login" class="btn btn-defaul">Login</button></form></div>
      </section>
    <br>
    <br><br>
      ';
   }

   $conn->close();
   ?>
<aside class="banner">

      <div class="container">

        <div class="row">
          <div class="col-lg-6 my-auto">
            <h2>Analyze</h2>
          </div>
          <div class="col-lg-6 my-auto">
            <ul class="list-inline banner-social-buttons">
              <li class="list-inline-item">
                <a href="#" class="btn btn-secondary btn-lg">
                  <i class="fa fa-twitter fa-fw"></i>
                  <span class="network-name">Twitter</span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="btn btn-secondary btn-lg">
                  <i class="fa fa-facebook fa-fw"></i>
                  <span class="network-name">Facebook</span>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="btn btn-secondary btn-lg">
                  <i class="fa fa-linkedin fa-fw"></i>
                  <span class="network-name">Linkedin</span>
                </a>
              </li>
            </ul>
          </div>
        </div>

      </div>
      <!-- /.container -->

    </aside>
    <!-- /.banner -->

    <!-- Footer -->
    <footer>
      <div class="container">
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="#">Home</a>
          </li>
          <li class="footer-menu-divider list-inline-item">&sdot;</li>
          <li class="list-inline-item">
            <a href="#about">About</a>
          </li>
          <li class="footer-menu-divider list-inline-item">&sdot;</li>
          <li class="list-inline-item">
            <a href="#services">Services</a>
          </li>
          <li class="footer-menu-divider list-inline-item">&sdot;</li>
          <li class="list-inline-item">
            <a href="#contact">Contact</a>
          </li>
        </ul>
        <p class="copyright text-muted small">Copyright &copy; Your Company 2017. All Rights Reserved</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>