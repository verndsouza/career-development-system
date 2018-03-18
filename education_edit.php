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
//error_reporting(E_ALL ^ E_NOTICE);
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
    <br>';

echo'<div>';
$i=0;
$server = "localhost";
$username = "root";
$dbname = "Capstone";
$password = "";
$conn = new mysqli($server, $username, $password, $dbname);
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

$level = $stream = $major = $gpa = "";
$levelErr = $streamErr = $majorErr = $gpaErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]))
{
  //Validate Education Form
  if (empty($_POST["level"]))
    {
      $levelErr = "Please select one";
      $i=1;
    }
    else
    {
      $level = test_input($_POST["level"]);

      if($level == "")
      {
        $levelErr = "Select a valid option."; 
        $i=1;
      }
    }

    if (empty($_POST["stream"]))
    {
      $streamErr = "Please select one";
      $i=1;
    }
    else
    {
      $stream = test_input($_POST["stream"]);

      if($stream == "")
      {
        $streamErr = "Select a valid option."; 
        $i=1;
      }
    }

    if (empty($_POST["major"]))
    {
      $majorErr = "Please select one";
      $i=1;
    }
    else
    {
      $major = test_input($_POST["major"]);

      if($major == "")
      {
        $majorErr = "Select a valid option."; 
        $i=1;
      }
    }

    if (empty($_POST["gpa"]))
    {
      $gpaErr = "Please select one";
      $i=1;
    }
    else
    {
      $gpa = test_input($_POST["gpa"]);

      if($gpa == "")
      {
        $gpaErr = "Select a valid option."; 
        $i=1;
      }
    }

  if($i == 0)
  {
    $sql = "DELETE FROM education_temp WHERE user_id = '$a'";
    $conn->query($sql);
    $sql = "SELECT major_tag FROM major WHERE major = '$major'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
        $major_tag = $row["major_tag"];
      }
    }
    $sql = "INSERT INTO education_temp (user_id, level, stream, major, major_tag, gpa) VALUES ('$a','$level','$stream', '$major', '$major_tag', '$gpa')";
    $conn->query($sql);

    $sql = "SELECT * FROM education_temp WHERE user_id = '$a'";
    $result1 = $conn->query($sql);

    if ($result1->num_rows > 0)
    {
      while($row = $result1->fetch_assoc())
      {
        $level = $row['level'];
        $stream = $row['stream'];
        $major = $row['major'];
        $gpa = $row['gpa'];
        $major_tag = $row["major_tag"];
      }
    }

    $sql = "UPDATE education SET level = '$level', stream = '$stream', major = '$major', major_tag = '$major_tag', gpa = '$gpa'";
    $conn->query($sql);
    $sql = "DELETE * FROM education_temp WHERE user_id='$a'";
    $conn->query($sql);
    header('Location: view.php');
  }
}
    function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "GET" || $i == 1)
{
  //Role form
  echo'<section>
    <div style = "margin: auto; width: 50%; padding: 10px;" class="container">
    <form action = "'.$_SERVER['PHP_SELF'].'" method="post" action="">
    <div class="yo" id = "dynamicInput">
    <br/><br/>
    <h3>Education<span style="color: red;">* - required field.</span></h3>
    
    <script type="text/javascript" src="education.js"></script>';
    $sql = "SELECT * FROM education WHERE user_id='$a'";
      $result1 = $conn->query($sql);
      
      if ($result1->num_rows > 0)
      {
        while($row = $result1->fetch_assoc())
        {
          $level = $row['level'];
          $stream = $row['stream'];
          $major = $row['major'];
          $gpa = $row['gpa'];
        }
      }
    echo'<div class="form-group">
    <label for="level">Level:</label> <span class="error" style="color: red;">*'.$levelErr.'</span>
    <select class="form-control" id="level" name=level>
    <option value="">Select One</option>
    <option value="Masters"';
    if($level == 'Masters')
      echo'selected ="selected"';
    echo'>Masters</option>
    <option value="Bachelors"';
    if($level == 'Bachelors')
      echo'selected ="selected"';
    echo'>Bachelors</option><
    </select>
    </div>';

    
    echo'<div class="form-group">
    <label for="stream">Stream:</label><span class="error" style="color: red;">*'.$streamErr.'</span>
    <select class="form-control" onchange="set_major(this,major)" id=stream name=stream>
    <option value="">Select One</option>';


    $sql = "SELECT * FROM stream";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
        if($stream == $row['stream'])
          echo'<option value="'.$row['stream'].'" selected="selected">'.$row['stream'].'</option>';
        else
          echo'<option value="'.$row['stream'].'">'.$row['stream'].'</option>';
      }
    }


    echo'</select></div>
    <div class="form-group">
    <label for="major">Majors:</label><span class="error" style="color: red;">*'.$majorErr.'</span>';
    if($major =="")
    {
      echo'<select class="form-control" id=major name="major" disabled="disabled">';
    }
    else
    {
      $sql = "SELECT major FROM major WHERE stream_id = (SELECT stream_id FROM stream WHERE stream = '$stream')";
      $result = $conn->query($sql);
      echo'<select class="form-control" id=major name="major">';
      if ($result->num_rows > 0)
      {
        while($row = $result->fetch_assoc())
        {
          if($major == $row['major'])
            echo'<option value="'.$row['major'].'" selected="selected">'.$row['major'].'</option>';
          else
            echo'<option value="'.$row['major'].'">'.$row['major'].'</option>';
        }
      }
    }
    
    echo'</select>
    </div>
    <div class="form-group">
    <label for="gpa">GPA:</label><span class="error" style="color: red;">*'.$gpaErr.'</span>
    <select class="form-control" id=gpa name=gpa>
    <option value="">Select One</option>
    <option value="4"';
    if($gpa == 4)
      echo'selected ="selected"';
    echo'>3.5 - 4.0</option>
    <option value="3"';
    if($gpa == 3)
      echo'selected ="selected"';
    echo'>3.0 - 3.49</option>
    <option value="2"';
    if($gpa == 2)
      echo'selected ="selected"';
    echo'>2.0 - 2.99</option>
    <option value="1"';
    if($gpa == 1)
      echo'selected ="selected"';
    echo'>less than 2.0</option>
    </select>
    </div>
    </div>
    <button class="btn btn-defaul" type="submit" name="submit" value="submit"/>Update<br/>
    </div>
    </form>
    </div>
    </section>';
}

$conn->close();

?>
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

    </aside>

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