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

$skill = $prof = $cert = "";
$skillErr = $profErr = $certErr = "";

$level = $stream = $major = $gpa = "";
$levelErr = $streamErr = $majorErr = $gpaErr = "";


$erole = $level = $comp = $spanStart = $spanEnd = $location = "";
$eroleErr = $levelErr = $compErr = $spanErr = $locationErr = "";

$role = $dream = $rel = "";
$roleErr = $dreamErr = $relErr = "";

$role_tag = $major_tag = $b ="";

$span=0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["prevExp"]) || isset($_POST["submit"]) || isset($_POST["SkRole"]) || isset($_POST["SkEdu"]) || isset($_POST["SkExp"])))
{
	//Validate Skill Form
	if (empty($_POST["skill"]))
    {
      $skillErr = "Please select one";
      $i=1;
    }
    else
    {
      $skill = test_input($_POST["skill"]);

      if($skill == "")
      {
        $skillErr = "Select a valid option."; 
        $i=1;
      }
    }

    if (empty($_POST["prof"]))
    {
      $profErr = "Please select one";
      $i=1;
    }
    else
    {
      $prof = test_input($_POST["prof"]);

      if($prof == "")
      {
        $profErr = "Select a valid option."; 
        $i=1;
      }
    }

    if (empty($_POST["cert"]))
    {
      $certErr = "Please select one";
      $i=1;
    }
    else
    {
      $cert = test_input($_POST["cert"]);

      if($cert == "")
      {
        $certErr = "Select a valid option."; 
        $i=1;
      }
    }
	if($i == 0)
	{
		$sql = "DELETE FROM skill_set_temp WHERE user_id = '$a'";
		$conn->query($sql);

		$sql = "INSERT INTO skill_set_temp (user_id, skill, prof, certi) VALUES ('$a','$skill','$prof', '$cert')";
    $conn->query($sql);

		if(isset($_POST["prevExp"]) || isset($_POST["SkExp"]))
	    {
	      header('Location: experience.php');
	    }

	    if(isset($_POST["SkRole"]))
	    {
	      header('Location: role.php');
	    }

	    if(isset($_POST["SkEdu"]))
	    {
	      header('Location: education.php');
	    }

	    if(isset($_POST["submit"]))
	    {
	    	$sql = "SELECT * FROM skill_set_temp WHERE user_id = '$a'";
        $result1 = $conn->query($sql);
        
        if ($result1->num_rows > 0)
        {
          while($row = $result1->fetch_assoc())
          {
            $skill = $row['skill'];
            $prof = $row['prof'];
            $cert = $row['certi'];
          }
        }
        $sql = "INSERT INTO skill_set (user_id, skill, prof, certi) VALUES ('$a','$skill','$prof', '$cert')";
        $conn->query($sql);


        $sql = "SELECT * FROM experience_temp WHERE user_id = '$a'";
        $result1 = $conn->query($sql);
        
        if ($result1->num_rows > 0)
        {
          while($row = $result1->fetch_assoc())
          {
            $level = $row['level'];
            $erole = $row['role_2'];
            $spanStart = $row['start_date'];
            $spanEnd = $row['end_date'];
            $span = $row['years'];
            $comp = $row['company'];
            $location = $row['location'];
            $role_tag = $row['role_2_tag'];
          }
        }
        $sql = "INSERT INTO experience (user_id, level, role_2, role_2_tag, start_date, end_date, years, company, location) VALUES ('$a','$level','$erole', '$role_tag', '$spanStart', '$spanEnd', '$span', '$comp', '$location')";
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

        $sql = "INSERT INTO education (user_id, level, stream, major, major_tag, gpa) VALUES ('$a','$level','$stream', '$major', '$major_tag', '$gpa')";
        $conn->query($sql);

        $sql = "SELECT * FROM desired_role_temp WHERE user_id = '$a'";
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

        $sql = "INSERT INTO desired_role (user_id, role_1, role_1_tag, dream_job, relocate) VALUES ('$a','$role','$b', '$dream', '$rel')";
        $conn->query($sql);

        $sql = "DELETE FROM desired_role_temp WHERE user_id = '$a'";
        $conn->query($sql);

        $sql = "DELETE FROM education_temp WHERE user_id = '$a'";
        $conn->query($sql);

        $sql = "DELETE FROM experience_temp WHERE user_id = '$a'";
        $conn->query($sql);

        $sql = "DELETE FROM skill_set_temp WHERE user_id = '$a'";
        $conn->query($sql);

        header('Location: front_page.php');
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
		<button class="btn btn-defaul " name="SkRole" value="SkRole" type="submit">Desired Role</button>&nbsp&nbsp&nbsp
		<button class="btn btn-defaul " type="submit" name="SkEdu" value="SkEdu"/>Education</button>&nbsp&nbsp&nbsp
		<button class="btn btn-defaul " type="submit" name="SkExp" value="SkExp"/>Experience</button>
		&nbsp&nbsp&nbsp
		<button style="background-color: #00ffcc;" class="btn btn-defaul " type="button" name="Skill" value="Skill"/>&nbsp&nbsp&nbsp&nbsp&nbspSkills&nbsp&nbsp&nbsp&nbsp&nbsp</button>
		<br/>
		<br/>
		<br/>
		<h3>Skills<span style="color: red;"">* - required field.</span></h3>
		';

		$sql = "SELECT * FROM skill_set_temp";
	    $result1 = $conn->query($sql);
	    
	    if ($result1->num_rows > 0)
	    {
	      while($row = $result1->fetch_assoc())
	      {
	        $skill = $row['skill'];
	        $prof = $row['prof'];
	        $cert = $row['certi'];
	      }
	    }
		echo'<div class="yo" id = "dynamicInput">
		<div class="form-group">
		<label for="skill">Skill: </label><span class="error" style="color: red;">*'.$skillErr.'</span>
		<select name="skill" class="form-control" id="skill">
		<option value="">Select One</option>';
		$sql = "SELECT skill FROM all_skills
		  WHERE role_tag =
		  (SELECT role_1_tag FROM desired_role_temp
		    WHERE user_id = '$a')";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc())
			{
				if($skill==$row['skill'])
					echo'<option value="'.$row['skill'].'" selected="selected">'.$row['skill'].'</option>';
				else
					echo'<option value="'.$row['skill'].'">'.$row['skill'].'</option>';
			}
		}
		echo'</select>
		</div>
		<div class="form-group">
		<label for="prof">Proficiency: </label><span class="error" style="color: red;">*'.$profErr.'</span>
		<select name="prof" class="form-control" id="prof">
		<option value="">Select One</option>
		<option value="Fundamental"';
		if($prof == 'Fundamental')
			echo'selected ="selected"';
		echo'>Fundamental Awareness</option>
		<option value="Novice"';
		if($prof == 'Novice')
			echo'selected ="selected"';
		echo'>Novice</option>
		<option value="Intermediate"';
		if($prof == 'Intermediate')
			echo'selected ="selected"';
		echo'>Intermediate</option>
		<option value="Advanced"';
		if($prof == 'Advanced')
			echo'selected ="selected"';
		echo'>Advanced</option>
		<option value="Expert"';
		if($prof == 'Expert')
			echo'selected ="selected"';
		echo'>Expert</option>
		</select></div>
		<div class="radio">
		<label for="cert">Certification: </label><span class="error" style="color: red;">*'.$certErr.'</span>&nbsp&nbsp&nbsp&nbsp
		<input type="radio" name="cert" value="Yes"';
		if($cert == 'Yes')
			echo'checked';
		echo'>Yes</input>&nbsp
		<input type="radio" name="cert" value="No"';
		if($cert == 'No')
			echo'checked';
		echo'>No
		</div>

		<div>
		<input type="button" class="btn btn-defaul" onclick="addInput();" value = "Add more">
		<br><br>
		<button class="btn btn-defaul" type="submit" name="prevExp" value="prevExp"/>&lt&ltPrev</button>
		&nbsp&nbsp&nbsp <button class="btn btn-defaul" type="submit" name="submit" value="submit"/>Sumbit<br/></div></form>
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
