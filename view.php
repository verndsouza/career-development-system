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
        <a class="nav-link" href="front_page.php">Home</a>
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
        <a class="nav-link" href="">Register</a>
      </li>
      <li class="nav-item">
              <a class="nav-link" href="">Sign in</a>
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
    <br>
    <br>
    <div align="left" class="container">';
    $server = "localhost";
$username = "root";
$dbname = "Capstone";
$password = "";
     $conn = new mysqli($server, $username, $password, $dbname);
     if ($conn->connect_error)
        {die("Connection failed: " . $conn->connect_error); }
      $sql = "SELECT * FROM desired_role WHERE user_id = '$a'";
      $result = $conn->query($sql);
      echo'<h4>1. Job Role</h4>';
      if ($result)
      { 
         if ($result->num_rows > 0)
         {
           while($row = $result->fetch_assoc())
            {
              echo'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspDesired Role : '.$row['role_1'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspDream Role : '.$row['dream_job'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspWilling to Relocate? '.$row['relocate'].'<br/>';
            }
          }
        }
      echo'<a class="btn btn-defaul" href="role_edit.php">Edit</a>';
      $sql = "SELECT * FROM education WHERE user_id = '$a'";
      $result = $conn->query($sql);
      echo'<br/><h4>2. Education</h4>';
      if ($result)
      { 
         if ($result->num_rows > 0)
         {
           while($row = $result->fetch_assoc())
            {
              echo'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspLevel : '.$row['level'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspLevel : '.$row['stream'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMajors : '.$row['major'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspGPA : '.$row['gpa'].'<br/>';
            }
          }
        }
      echo'<a class="btn btn-defaul" href="education_edit.php">Edit</a>';
      $sql = "SELECT * FROM experience WHERE user_id = '$a'";
      $result = $conn->query($sql);
      echo'<br/><h4>3. Experience</h4>';
      if ($result)
      { 
         if ($result->num_rows > 0)
         {
           while($row = $result->fetch_assoc())
            {
              echo'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspLevel : '.$row['level'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspRole : '.$row['role_2'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspStart Date : '.$row['start_date'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspEnd Date : '.$row['end_date'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCompany : '.$row['company'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspLocation : '.$row['location'].'<br/>';
            }
          }
        }
        echo'<a class="btn btn-defaul" href="experience_edit.php">Edit</a>';
      $sql = "SELECT * FROM skill_set WHERE user_id = '$a'";
      $result = $conn->query($sql);
        echo'<br/><h4>4. Skills</h4>';
      if ($result)
      { 
         if ($result->num_rows > 0)
         {
           while($row = $result->fetch_assoc())
            {
              echo'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSkill : '.$row['skill'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspProficiency : '.$row['prof'].'<br/>
              &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCertification : '.$row['certi'].'<br/>';
            }
          }
        }
        echo'<a class="btn btn-defaul" href="skills_edit.php">Edit</a>';
    ?>
</div>
<br>

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