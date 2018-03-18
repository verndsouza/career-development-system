
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

$role = $dream = $rel = "";
$roleErr = $dreamErr = $relErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"]))
{
  //validate Role Form

  if (empty($_POST["role"]))
    {
      $roleErr = "Please select one";
      $i=1;
    }
    else
    {
      $role = test_input($_POST["role"]);

      if($role == "")
      {
        $roleErr = "Select a valid option."; 
        $i=1;
      }
    }

    if (empty($_POST["dream"]))
    {
      $dreamErr = "Please select one";
      $i=1;
    }
    else
    {
      $dream = test_input($_POST["dream"]);
      if($dream == "")
      {
        $dreamErr = "Select a valid option."; 
        $i=1;
      }
    }

    if (empty($_POST["rel"]))
    {
      $relErr = "Select one";
      $i=1;
    } 
    else 
    {
      $rel = test_input($_POST["rel"]);
    }

  if($i == 0)
  {
    $sql = "DELETE FROM desired_role_temp WHERE user_id = '$a'";
    $conn->query($sql);
    $sql = "SELECT role_tag FROM all_roles WHERE role = '$role'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
    while($row = $result->fetch_assoc())
    {
      $b = $row["role_tag"];
    }
    }
    $sql = "INSERT INTO desired_role_temp (user_id, role_1, role_1_tag, dream_job, relocate) VALUES ('$a','$role','$b', '$dream', '$rel')";
    $conn->query($sql);

    $sql = "SELECT * FROM desired_role_temp";
    $result1 = $conn->query($sql);
    

    if ($result1->num_rows > 0)
    {
      while($row = $result1->fetch_assoc())
      {
        $role=$row['role_1'];
        $dream=$row['dream_job'];
        $rel=$row['relocate'];
        $b = $row['role_1_tag'];
      }
    }

    $sql = "UPDATE desired_role SET role_1 = '$role', role_1_tag = '$b', dream_job = '$dream' , relocate = '$rel' WHERE user_id = '$a'";
    $conn->query($sql);

    $sql = "DELETE * FROM desired_role_temp WHERE user_id='$a'";
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
      <br/><br/>
      <h3>Job Role<span style="color: red;"">* - required field.</span></h3>
    

    <div class="form-group">
    <label for="role">Desired Role:&nbsp&nbsp&nbsp</label><span style="color: red;">*'.$roleErr.'</span>
    <select class="form-control" id="role" name="role">
    <option value="">Select One</option>';

    $sql = "SELECT * FROM desired_role";
    $result1 = $conn->query($sql);
    

    if ($result1->num_rows > 0)
    {
      while($row = $result1->fetch_assoc())
      {
        $role=$row['role_1'];
        $dream=$row['dream_job'];
        $rel=$row['relocate'];
      }
    }

    $sql = "SELECT DISTINCT role FROM all_roles
  WHERE re_tag = '111111' AND role_tag LIKE '54%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
        if($row["role"] == (string)$role)
          echo'<option value="'.$row["role"].'" selected="selected">'.$row["role"].'</option>';
        else
          echo'<option value="'.$row["role"].'">'.$row["role"].'</option>';
      }
    }
    echo'</select>
    </div>
    <div class="form-group">
    <label for="dream">Dream Role:&nbsp&nbsp&nbsp</label><span style="color: red;">*'.$dreamErr.'</span>
    <select class="form-control" id="dream" name="dream" >
    <option value="">Select One</option>';
    $sql = "SELECT * FROM dream_role";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc()){
        if($row["dream"] == (string)$dream)
        {
          echo'<option value="'.$row["dream"].'" selected="selected">'.$row["dream"].'</option>';
        }
        else
          echo'<option value="'.$row["dream"].'">'.$row["dream"].'</option>';


      }
    }
    echo'</select>
    </div>
    <div class="form-group">
    Willing to rellocate?&nbsp&nbsp&nbsp
    <input class="radio" id="rel"type="radio" name="rel" value="Yes"';
    if($rel=="Yes"){
      echo 'checked';
  }
  echo'>Yes &nbsp&nbsp
  <input class="radio" id="rel" type="radio" name="rel" value="No"';
  if($rel=="No"){
    echo 'checked';
  }
  echo'> No&nbsp&nbsp&nbsp<span style="color: red;">*'.$relErr.'</span>
  </div>
  <br/>
  <button class="btn btn-defaul" type="submit" name="submit" value="submit"/>Update<br/>
  </form>
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