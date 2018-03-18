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
        <a class="nav-link" href="about.php">About</a>
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

//echo'<div>';
?>
<div style="width:1000px; margin:0 auto;" align= "center">
<div class="row">
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div style="color: #00ffcc; background-color: gray">
          <h3 class="card-title">Candidate</h3>
              <p class="card-text">$25 / year</p>
        </div>
        <br/>
        <p class="card-text">Personal Statistics</p>
        <p class="card-text">Role-specific &amp location-based opportunities</p>
        <p class="card-text">Skills Recommendation</p>
        <p class="card-text">Earnings vs Expenses</p>
        <p class="card-text"> &nbsp</p>
      </div>
      <div class="card-footer">
        <a href="registration.php" class="btn btn-secondary">Sign up</a>
      </div>
    </div>
  </div>
  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card">
      <div class="card-body">
        <div style="color: #00ffcc; background-color: gray">
          <h3 class="card-title">Premium</h3>
          <p class="card-text">$500 / year</p>
        </div>
        <br/>
          <p class="card-text" style="color:blue">25 User Accounts</p>
          <p class="card-text">Personal Statistics</p>
          <p class="card-text">Role-specific &amp location-based opportunities</p>
          <p class="card-text">Skills Recommendation</p>
          <p class="card-text">Earnings vs Expenses</p>
      </div>
      <div class="card-footer">
        <a href="registration.php" class="btn btn-secondary">Sign up</a>
      </div>
    </div>
  </div>
</div>
<div>
</div>
</div>

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