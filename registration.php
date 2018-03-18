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

  $i = 0;
  $fname = $lname = $email = $pwrd = $cpwrd = $date = $contact = $location = $disc = "";
  $fnameErr = $lnameErr = $emailErr = $pwrdErr = $cpwrdErr = $dateErr = $contactErr = $locationErr = $discErr = "";
  $m=$d=$yr=$cont=0;

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']))
  {
  	if (empty($_POST["fname"])) 
  	{
    	$fnameErr = "First name is required";
    	$i=1;
  	}
  	else 
	{
	    $fname = test_input($_POST["fname"]);
	    if(!preg_match("/^[a-zA-Z ]*$/",$fname)) 
	    {
	    	$fnameErr = "Only letters and white space allowed"; 
	    	$i=1;
	    } 
	}
	if (empty($_POST["lname"])) 
  	{
    	$lnameErr = "Last name is required";
    	$i=1;
  	}
  	else 
	{
	    $lname = test_input($_POST["lname"]);
	    if(!preg_match("/^[a-zA-Z ]*$/",$lname)) 
	    {
	    	$lnameErr = "Only letters and white space allowed"; 
	    	$i=1;
	    } 
	}

	if (empty($_POST["email"])) 
  	{
    	$emailErr = "Email is required";
    	$i=1;
  	}
  	else 
	{
	    $email = test_input($_POST["email"]);
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "Invalid email format"; 
		}
		$sql = "SELECT * FROM user WHERE email='$email'";
  		$result = $conn->query($sql);

  		if ($result->num_rows > 0)
  		{
  			$emailErr="User already exists.";
  			$i=1;
    	}
	}

	if (empty($_POST["pwrd"])) 
  	{
    	$pwrdErr = "Password is required";
    	$i=1;
  	}
  	else 
	{
	    $pwrd = test_input($_POST["pwrd"]);
	}
	if (empty($_POST["cpwrd"])) 
  	{
    	$cpwrdErr = "Please confirm Password";
    	$i=1;
  	}
  	else 
	{
	    $cpwrd = test_input($_POST["cpwrd"]);
	}

	if($pwrd != $cpwrd)
	{
		$cpwrdErr = "Passwords don't match";
		$i=1;
	}


	if (empty($_POST["date"])) 
	  {
	    $dateErr = "Date is required";
	    $i=1;
	  }
	  else 
	  {
	    $date = test_input($_POST["date"]);
	    if(strlen($date)>10||strlen($date)<8)
	    {
	    	$dateErr = "Inavlid Input!";
	    	$i=1;
	    }
	    $y=0;
	    
	    $mon=$day=$year="";
	    for($x=0 ; $x<strlen($date) ; $x++)
	    {
	    	//echo ord($date[$x]).'<br/>';
	    	if(ord($date[$x])<48 || ord($date[$x])>57)
	    	{
	    		$dateErr = "Inavlid Input!";
	    		$i=1;
	    		break;
	    	}
	    	if($y==0)
	    	{
	    		for($z=$x;$z<=2;$z++)
	    		{
	    			if($date[$z]=='/')
	    			{
	    				$mon= substr($date, $x, $z);
	    				$x=$z;
	    				$y++;
	    				//echo 'Mon = '.$mon.'<br/>';
	    				$m=(int)$mon;
	    				break;
	    			}
	    		}
	    		if($y==0)
	    		{
	    			$dateErr = "Inavlid Input!";
	    			$i=1;
	    			break;
	    		}
	        if($m<1 || $m>12)
	        {
	          $dateErr = "Inavlid Month!";
	          $i=1;
	          break;
	        }
	    		continue;
	    	}
	    	$c=0;
	    	if($y==1)
	    	{	
	    		for($z=$x;$z<=5;$z++)
	    		{
	    			if($date[$z]=='/')
	    			{
	    				$day= substr($date, $x, $c);
	    				$x=$z;
	    				$y++;
	    				//echo 'Day = '.$day.'<br/>';
	    				$d=(int)$day;
	    				break;
	    			}
	    			else
	    				{$c++;}
	    		}
	    		if($y==1)
	    		{
	    			$dateErr = "Inavlid Input!";
	    			$i=1;
	    			break;
	    		}
	    		if($d==0 || $d>31)
	    		{
	    			$dateErr = "Inavlid Date!";
	    			$i=1;
	    			break;
	    		}
	    		if($d==31)
	    		{
	    			if($m==4||$m==6||$m==9||$m==11)
	    			{
	    				$dateErr = "Inavlid Date!";
	    				$i=1;
	    			}
	    		}
	    		continue;
	    	}
			else
			{
	    		$year=substr($date, $x, strlen($date)-1);
	    		$yr=(int)$year;
	    		if(strlen($year)!=4 || $yr<1900)
	    		{
	    			$dateErr = "You're too old!";
	    			$i=1;
	    			break;
	    		}
	    		
	    		break;
	    	}

	    }
	    if($m==2)
		{
			if($yr%4==0 && $d==29)
			{	
				if($yr%100==0 && $yr%400==0)
				{
					break;
				}
				else if($yr%100==0)
				{
					$dateErr = "Inavlid Date!";
					$i=1;
				}		
			}
			else if ($d>28)
			{
				$dateErr = "Inavlid Date!";
				$i=1;
			}
		}

		}
		$present=getdate(date("U"));
		
		if($yr>$present['year'])
		{
			$dateErr = "Date cannot be in future!";
			$i=1;
		}
		else if($yr==$present['year'] && $m>$present['mon'])
		{
			$dateErr = "Date cannot be in future!";
			$i=1;
		}
		else if($yr==$present['year'] && $m==$present['mon']&& $d>$present['mday'])
		{
			$dateErr = "Date cannot be in future!";
			$i=1;
		}

	if (empty($_POST["contact"])) 
  	{
    	$contactErr = "Contact is required";
    	$i=1;
  	}
  	else
  	{
  		$contact = test_input($_POST["contact"]);
  		if(!preg_match("/^[0-9]{10}$/",$contact))
  		{
  			$contactErr = "Only numbers allowed";
  			$i=1;
  		}
  	}
  	if (empty($_POST["location"])) 
  	{
    	$locationErr = "Location is required";
    	$i=1;
  	}
  	else
  	{
  		$location = test_input($_POST["location"]);
  	}

  	if (empty($_POST["disc"])) 
  	{
    	$discErr = "Select one";
    	$i=1;
  	} 
  	else 
  	{
    	$disc = test_input($_POST["disc"]);
    	if($disc == 'Decline')
    	{
    		$i = 1;
    		$discErr = "You have to accept our T & C to use our application.";
    	}
  	}
  	//$cont=(int)$contact;
  	if($i==0)
  	{
  		$sql = "INSERT INTO user (f_name, l_name, email, password, contact, DOB, location,disclamer) VALUES ('$fname', '$lname','$email', '$pwrd', '$contact','$date', '$location', '$disc')";
  		if ($conn->query($sql) === TRUE) 
  		{
    		//echo '<br/><br/>Added Succesfully<br/><br/>';
    		$i=2;
    	}
    	else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
    	}

    	$sql = "SELECT user_id FROM user WHERE email='$email'";
  		$result = $conn->query($sql);

  		if ($result->num_rows > 0)
  		{
    		$row = $result->fetch_assoc();
    		$user_id = $row['user_id'];
    	}
    	if($i==2)
    	{
    		$sql = "INSERT INTO login (user_id, email, password) VALUES ('$user_id', '$email', '$pwrd')";
    	}
    	if ($conn->query($sql) === TRUE) 
  		{
    		//echo '<br/><br/>Added Succesfully<br/><br/>';
    		header('Location: https://www.paypal.com/us/home');
    		$i=2;

    	}
    	else {
    		echo "Error: " . $sql . "<br>" . $conn->error;
    	}
  }
}
  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

  if ($_SERVER["REQUEST_METHOD"] == "GET" || $i==1){
  	echo'<section>
      <div style = "margin: auto; width: 30%; padding: 10px;" class="container">
      <h3>Register
	<span style="color: red;"">* - required field.</span></h3>
  	<form action = "'.$_SERVER['PHP_SELF'].'" method="post" action="">
	<br>
	<div class="form-group">
	  <label for="fname">First Name:&nbsp&nbsp&nbsp</label><span style="color: red;">*'.$fnameErr.'</span>
	  <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name" value="'.$fname.'" autofocus>
	  </div>
	  <div class="form-group">
	  <label for="lname">Last Name:&nbsp&nbsp&nbsp</label><span style="color: red;">*'.$lnameErr.'</span>
	  <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter last name" value="'.$lname.'" >
	  </div>
	  <div class="form-group">
	  <label for="email">Email:&nbsp&nbsp&nbsp</label> <span style="color: red;">*'.$emailErr.'</span>
	  <input type="text" class="form-control" id="email" name="email" placeholder="Enter email id" value="'.$email.'">
	  </div>
	  <div class="form-group">
	  <label for="pwrd">Password:&nbsp&nbsp&nbsp</label><span style="color: red;">*'.$pwrdErr.'</span>
	  <input type="password" class="form-control" id="pwrd" name="pwrd" placeholder="Enter password" value="">
	  </div>
	  <div class="form-group">
	  <label for="cpwrd">Confirm Password:&nbsp&nbsp&nbsp</label><span style="color: red;">*'.$cpwrdErr.'</span>
	  <input type="password" class="form-control" id="cpwrd" name="cpwrd" placeholder="Enter password" value="">
	  </div>
	  <div class="form-group">
	  <label for="dob">Date of Birth:&nbsp&nbsp&nbsp</label><span style="color: red;">*'.$dateErr.'</span>
	  <input type="text" id="date" class="form-control" name="date" placeholder="MM/DD/YY" value="'.$date.'">
	  </div>
	  <div class="form-group">
	  <label for="contact">Contact:&nbsp&nbsp&nbsp</label><span style="color: red;">*'.$contactErr.'</span>
	  <input type="text" class="form-control" id="contact" name="contact" placeholder="xxx-xxx-xxxx [10 digits]" value="'.$contact.'">
	  </div>
	  <div class="form-group">
	  <label for="location">Location:&nbsp&nbsp&nbsp</label><span style="color: red;">*'.$locationErr.'</span>
	  <select class="form-control" id="location" name="location">
	  	<option value="" selected>Select one</option>
	  	<option value="AL">Alabama</option>
		<option value="AK">Alaska</option>
		<option value="AZ">Arizona</option>
		<option value="AR">Arkansas</option>
		<option value="CA">California</option>
		<option value="CO">Colorado</option>
		<option value="CT">Connecticut</option>
		<option value="DE">Delaware</option>
		<option value="DC">District Of Columbia</option>
		<option value="FL">Florida</option>
		<option value="GA">Georgia</option>
		<option value="HI">Hawaii</option>
		<option value="ID">Idaho</option>
		<option value="IL">Illinois</option>
		<option value="IN">Indiana</option>
		<option value="IA">Iowa</option>
		<option value="KS">Kansas</option>
		<option value="KY">Kentucky</option>
		<option value="LA">Louisiana</option>
		<option value="ME">Maine</option>
		<option value="MD">Maryland</option>
		<option value="MA">Massachusetts</option>
		<option value="MI">Michigan</option>
		<option value="MN">Minnesota</option>
		<option value="MS">Mississippi</option>
		<option value="MO">Missouri</option>
		<option value="MT">Montana</option>
		<option value="NE">Nebraska</option>
		<option value="NV">Nevada</option>
		<option value="NH">New Hampshire</option>
		<option value="NJ">New Jersey</option>
		<option value="NM">New Mexico</option>
		<option value="NY">New York</option>
		<option value="NC">North Carolina</option>
		<option value="ND">North Dakota</option>
		<option value="OH">Ohio</option>
		<option value="OK">Oklahoma</option>
		<option value="OR">Oregon</option>
		<option value="PA">Pennsylvania</option>
		<option value="RI">Rhode Island</option>
		<option value="SC">South Carolina</option>
		<option value="SD">South Dakota</option>
		<option value="TN">Tennessee</option>
		<option value="TX">Texas</option>
		<option value="UT">Utah</option>
		<option value="VT">Vermont</option>
		<option value="VA">Virginia</option>
		<option value="WA">Washington</option>
		<option value="WV">West Virginia</option>
		<option value="WI">Wisconsin</option>
		<option value="WY">Wyoming</option>
		<option value="">-- Union Territories --</option>
		<option value="AS">American Samoa</option>
		<option value="GU">Guam</option>
		<option value="MP">Northern Mariana Islands</option>
		<option value="PR">Puerto Rico</option>
		<option value="UM">United States Minor Outlying Islands</option>
		<option value="VI">Virgin Islands</option>
		<option value="">-- Armed Forces --</option>
		<option value="AA">Armed Forces Americas</option>
		<option value="AP">Armed Forces Pacific</option>
		<option value="AE">Armed Forces Others</option>	
	  </select>
	  </div>
	  <div class="form-group">
	  <label for="disc">Disclamer:&nbsp&nbsp&nbsp</label><span style="color: red;">*'.$discErr.'</span>
	  <h3>T & C.</h3>
	  <input class="radio" type="radio" id="disc" name="disc" value="Accept">Accept&nbsp&nbsp&nbsp
	  <input class="radio" type="radio" id="disc" name="disc" value="Decline"> Decline
	  </div>
	  
	  <button class="btn btn-defaul" type="submit" name="submit"><img src="img/Paypal-logo-1.png" height="27" width=85"></button>';
	  //<button class="btn btn-defaul" type="submit" name="submit" value="Submit"/>Submit
	echo'</form>
	</div>
	</section>
	</br>';}

	$conn->close();
	?>
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