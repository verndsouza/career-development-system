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

$erole = $level = $comp = $spanStart = $spanEnd = $location = "";
$eroleErr = $levelErr = $compErr = $spanErr = $locationErr = "";

$smonth = $sday = $syear = $emonth = $eday = $eyear= 0;
$span = 1.1;

if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["prevEdu"]) || isset($_POST["nextSkill"]) || isset($_POST["ExRole"]) || isset($_POST["ExEdu"]) || isset($_POST["ExSkill"])))
{
  //Validate Experience Form
  if (empty($_POST["erole"]))
    {
      $eroleErr = "Please select one";
      $i=1;
    }
    else
    {
      $erole = test_input($_POST["erole"]);

      if($erole == "")
      {
        $eroleErr = "Select a valid option."; 
        $i=1;
      }
    }

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

    if (empty($_POST["company"])) 
    {
      $compErr = "Company Name is required.";
      $i=1;
    } 
    else 
    {
      $comp = test_input($_POST["company"]);
    }

    if(empty($_POST["start_date"]) || empty($_POST["end_date"]))
    {
      $spanErr = "Start and/or End date cannot be empty";
    }
    else
    {
      $spanStart = test_input($_POST["start_date"]);
      $spanEnd = test_input($_POST["end_date"]);
      $smonth = (((int)$spanStart[0])*10) +((int)$spanStart[1]);
      $sday = (((int)$spanStart[3])*10) +((int)$spanStart[4]);
      $syear= (((int)$spanStart[6])*1000) +(((int)$spanStart[7])*100) + (((int)$spanStart[8])*10) + ((int)$spanStart[9]);
      $emonth = (((int)$spanEnd[0])*10) +((int)$spanEnd[1]);
      $eday = (((int)$spanEnd[3])*10) +((int)$spanEnd[4]);
      $eyear= (((int)$spanEnd[6])*1000) +(((int)$spanEnd[7])*100) + (((int)$spanEnd[8])*10) + ((int)$spanEnd[9]);
      $span = ((($eyear-1) - $syear)*12 + (12-$smonth) + $emonth)/12;
    }
  
    if (empty($_POST["location"]))
    {
      $locationErr = "Please select one";
      $i=1;
    }
    else
    {
      $location = test_input($_POST["location"]);

      if($location == "")
      {
        $locationErr = "Select a valid option."; 
        $i=1;
      }
    }

  if($i == 0)
  {
    $sql = "DELETE FROM experience_temp WHERE user_id = '$a'";
    $conn->query($sql);
    $sql = "SELECT role_tag FROM all_roles WHERE role = '$erole'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0)
    {
      while($row = $result->fetch_assoc())
      {
        $role_tag = $row["role_tag"];
      }
    }
    $sql = "INSERT INTO experience_temp (user_id, level, role_2, role_2_tag, start_date, end_date, years, company, location) VALUES ('$a','$level','$erole', '$role_tag', '$spanStart', '$spanEnd', '$span', '$comp', '$location')";
    $conn->query($sql);

    if(isset($_POST["prevEdu"]) || isset($_POST["ExEdu"]))
    {
      header('Location: education.php');
    }

    if(isset($_POST["nextSkill"]) || isset($_POST["ExSkill"]))
    {
      header('Location: skills.php');
    }

    if(isset($_POST["ExRole"]))
    {
      header('Location: role.php');
    }
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
  echo'<section>
    <div style = "margin: auto; width: 50%; padding: 10px;" class="container">
    <form action = "'.$_SERVER['PHP_SELF'].'" method="post" action="">
    <button class="btn btn-defaul " name="ExRole" value="ExRole" type="submit">Desired Role</button>&nbsp&nbsp&nbsp
    <button class="btn btn-defaul " type="submit" name="ExEdu" value="ExEdu" />Education</button>&nbsp&nbsp&nbsp
    <button style="background-color: #00ffcc;" class="btn btn-defaul " type="button" name="Edu" value="Edu"/>Experience</button>
    &nbsp&nbsp&nbsp
    <button class="btn btn-defaul " type="submit" name="ExSkill" value="ExSkill"/>&nbsp&nbsp&nbsp&nbsp&nbspSkills&nbsp&nbsp&nbsp&nbsp&nbsp</button>
    <br/><br/>
    <div class="yo" id = "dynamicInput">
    <br/>
    <h3>Experience<span style="color: red;"">* - required field.</span></h3>
    ';

    $sql = "SELECT * FROM experience_temp";
      $result1 = $conn->query($sql);
      
      if ($result1->num_rows > 0)
      {
        while($row = $result1->fetch_assoc())
        {
          $elevel = $row['level'];
          $erole = $row['role_2'];
          $start_date = $row['start_date'];
          $end_date = $row['end_date'];
          $company = $row['company'];
          $location = $row['location'];
        }
      }

    echo'<div class="form-group">
    <label for="erole">Role: </label> <span class="error" style="color: red;">*'.$eroleErr.'</span>
    <select class="form-control" id="erole" name="erole">
    <option value="">Select One</option>';
    $sql = "SELECT DISTINCT role FROM all_roles
    WHERE (re_tag = 111111 AND role_tag LIKE '54%') OR major_tag
    IN (SELECT major_tag FROM education_temp WHERE user_id = '$a')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) 
    {
      while($row = $result->fetch_assoc()) 
      {
        if((string)$erole == $row["role"])
          echo'<option value="'.$row["role"].'" selected="selected">'.$row["role"].'</option>';
        else
          echo'<option value="'.$row["role"].'">'.$row["role"].'</option>';
      }
    }
    echo'</select>
    </div>
    <div class="form-group">
    <label for="level">Level: </label> <span class="error" style="color: red;">*'.$levelErr.'</span>
    <select class="form-control" id="level" name="level">
    <option value="">Select One</option>
    <option value="Intern"';
    if($elevel == 'Intern')
      echo'selected ="selected"';
    echo'>Intern</option>
    <option value="Jr"';
    if($elevel == 'Jr')
      echo'selected ="selected"';
    echo'>Jr.</option>
    <option value="Sr"';
    if($elevel == 'Sr')
      echo'selected ="selected"';
    echo'>Sr.</option>
    <option value="Lead"';
    if($elevel == 'Lead')
      echo'selected ="selected"';
    echo'>Lead</option>
    <option value="Manager"';
    if($elevel == 'Manager')
      echo'selected ="selected"';
    echo'>Manager</option>
    </select>
    </div>
    <div class="form-group">
    <label for="company">Company: </label><span class="error" style="color: red;">*'.$compErr.'</span>
    <br/><input class="form-control" type="text" name="company" value="'.$company.'" placeholder = "Ex. Apple"</input>
    </div>
    <div class="form-group">
    <label for="span">Span: </label> <span class="error" style="color: red;">*'.$spanErr.'</span>
    <br/>
    <input class="form-control" type="text" name="start_date" value="'.$start_date.'" placeholder="Start Date"> &nbsp to &nbsp 
    <input class="form-control" type="text" name="end_date" value="'.$end_date.'" placeholder="End Date"> 
    </div>
    <div class="form-group">
    <label for="location">Location: </label> <span class="error" style="color: red;">*'.$locationErr.'</span>
    <select class="form-control" id="location" name="location">
    <option value="" selected>Select one</option>
    <option value="CA"';
    if($location == 'CA')
      echo'selected ="selected"';
    echo'>CA</option>
    <option value="CO"';
    if($location == 'CO')
      echo'selected ="selected"';
    echo'>CO</option>
    <option value="DC"';
    if($location == 'DC')
      echo'selected ="selected"';
    echo'>DC</option>
    <option value="FL"';
    if($location == 'FL')
      echo'selected ="selected"';
    echo'>FL</option>
    <option value="IL"';
    if($location == 'IL')
      echo'selected ="selected"';
    echo'>IL</option>
    <option value="MA"';
    if($location == 'MA')
      echo'selected ="selected"';
    echo'>MA</option>
    <option value="NC"';
    if($location == 'NC')
      echo'selected ="selected"';
    echo'>NC</option>
    <option value="NY"';
    if($location == 'NY')
      echo'selected ="selected"';
    echo'>NY</option>
    <option value="TX"';
    if($location == 'TX')
      echo'selected ="selected"';
    echo'>TX</option>
    <option value="WA"';
    if($location == 'WA')
      echo'selected ="selected"';
    echo'>WA</option>
    </select>
    </div>
    <input type="button" class="btn btn-defaul" onclick="addInput();" value = "Add more">
    <br><br></div>
    <button class="btn btn-defaul" type="submit" name="prevEdu" value="prevEdu"/>&lt&ltPrev</button>
    &nbsp&nbsp&nbsp<button class="btn btn-defaul" type="submit" name="nextSkill" value="nextSkill"/>Next>><br/>
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