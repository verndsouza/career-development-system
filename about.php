<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Capstone - Start building your career here!</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <link href="css/landing-page.css" rel="stylesheet">

  </head>

  <body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
<div class="container">
<a class="navbar-brand" href="index.php">Livelihood</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>

<?php
error_reporting(E_ALL ^ E_NOTICE);
$a="";

session_start();

$a = $_SESSION["username"];
echo'
<div class="collapse navbar-collapse" id="navbarResponsive">
<ul class="navbar-nav ml-auto">';
if($a == ""){
     echo'<li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>';
   }
   else{
     echo'<li class="nav-item">
              <a class="nav-link" href="front_page.php">Home</a>
            </li>';
   }
   echo'
<li class="nav-item">
<a class="nav-link" href="pricing.php">Pricing</a>
</li>';


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
    <br><div style="width:800px; margin:0 auto;" align="center">
    <h4>About Us</h4>
Synergy Incorporated is a small size IT firm that is highly involved in designing and developing tailor-made application systems. Synergy Inc. focuses on harnessing technology to favor its business goals and creating products and services that are favorable to business conditions, user-friendly, and meet a business need. This company was founded in August 2017 by a team of four IT professionals in the Master of Science in Information Systems and Technology program at The George Washington University. 
<br/><br/>
Synergy Inc. understands that there is a business need to match applicants to the right opportunities while ensuring these opportunities are rightfully harnessed. The founders came up with the idea of professional skill-ranking visualization platform for job applicants in their final semester of graduate school when most of their colleagues found it difficult to secure befitting jobs and were unsure of the right job market based on their skills and qualifications. For this reason, Synergy Incorporated was established to develop and design the best technology solution tools (such as products, systems, and web applications) to address this need. 
<br/>
<br/>
Founded: August 2017<br/>
Location: Washington, D.C.</div><br/>';
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
