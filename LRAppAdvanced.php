<!DOCTYPE HTML>  
<html>
<!--
To run the program, use 
localhost/php_workspace/LRAppAdvanced.php

using LRApp will use the unmodified version

From here, type in your information and press submit to see your submission
Some fields are required and will validate input
If you don't input those, an error will occur

Name, email, start year, address are required and validated
Wrong input will give error here as well
Name must be only letters and whitespace
Email must be a valid email
Start year must be only numbers and >2000
Address must be filled in

Gender is already chosen, and must be picked, but cannot be unclicked
Birthday and Major are not required and can be filled out later. 
-->
<head>
<style>
/* Adding width and height to picture */
#wrapper, img{
    width:80%;
    height: 150px
}
/* Changing h2 texts to LR red color */
h2{
  color:#a80532;
}
/* Changing page background to a grey, and font to bold */
body{
  background-color:#D3D3D3;
  font-weight: bold;
}
/* Changing error fields to LR red */
.error {color: #006400;}
</style>
</head>
<body>  

<?php
// define variables and set to empty values
$name = $email = $gender = $termYear = $birthday = $address = $major = "";
//define error values
$nameErr = $emailErr = $termErr = $addressErr = "";
//get input from server, send all input to the testinput function

if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $gender = test_input($_POST["gender"]);
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $termYear = test_input($_POST["termYear"]);
  $address = test_input($_POST["address"]);
  $birthday = test_input($_POST["birthday"]);
  $major = test_input($_POST["major"]);
}

//check name field for errors and validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

//check email field for errors and validation
 if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

//check start year field for errors and validation
 if (empty($_POST["termYear"])) {
    $termErr = "Start Year is required";
  } else {
    $termYear = test_input($_POST["termYear"]);
    // check if term year is properly input
      if($termYear<2000) {
        $termErr="Please enter a current year (>2000)";
      }
     
    }

 //check address field for blank, address will be manually validated after
	if (empty($_POST["address"])) {
    $addressErr = "Address is required";
  } else {
    $address = test_input($_POST["address"]);
  }

}




//takes out all improper data included special characters, and any error causing chars
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!--Adds a picture of LR to the top with id of wrapper for CSS-->
<div id="wrapper">
	<img src = "https://dbukjj6eu5tsf.cloudfront.net/sidearm.sites/lenoirrhyne.sidearmsports.com/images/responsive_2020/footer-uni.png">
</div>
 
<!--Creating the form with all proper variables and sending to current page-->
<h2>Lenoir-Rhyne University Application</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span> <!--Add name error-->
  <br><br>
  E-mail: <input type="text" name="email">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Start Year: <input type="number" name="termYear">
 <span class="error">* <?php echo $termErr;?></span>
  <br><br>
  Address: <textarea name="address" rows="5" cols="50"></textarea>
  <span class="error">* <?php echo $addressErr;?></span>
  <br><br>
  Gender:
  <input type="radio" name="gender" value="female">Female
  <input type="radio" name="gender" value="male">Male
  <input type="radio" name="gender" value="other" checked>Other
  <br><br>
  Birthday: <input type="date" name="birthday">
  <br><br>
  Major:<select name="major" id="major" selected="CS">
	<option value="CS">CS</option>
      <option value="Math">Math</option>
      <option value="IT">IT</option>
  </select>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
//display a submission piece, displays each submission from the user
echo "<h2>Your Submission</h2>";
echo "Name: ". $name;
echo "<br>";
echo "Email: ".$email;
echo "<br>";
echo "Start Year: ".$termYear;
echo "<br>";
echo "Address: ".$address;
echo "<br>";
echo "Gender: ".$gender;
echo "<br>";
echo "Birthday: ".$birthday;
echo "<br>";
echo "Major: ".$major;
?>

<?php
date_default_timezone_set("America/New_York");
echo "<br><br>The date and time is " . date("d/F/Y-h:i:sa");
?>

</body>
</html>