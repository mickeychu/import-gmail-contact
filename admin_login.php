<?php 
ini_set('session.save_path', dirname(__FILE__));
session_start();
if (isset($_SESSION["admin"])) {
    header("location: list.php"); 
    exit();
}
?>
<?php 
// Parse the log in form if the user has filled it out and pressed "Log In"
if (isset($_POST["username"]) && isset($_POST["password"])) {

	$admin = $_POST["username"]; 
    $pass = $_POST["password"];
	
    // Connect to the MySQL database  
    require "scripts/connect.php"; 
	
    $sql = mysqli_query($link, "SELECT * FROM `admin` WHERE username='$admin' AND password='$pass'"); // query the person
    while ($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
		$username = $row["username"];
		$password = $row["password"];
		}
    if ($admin == $username && $pass == $password ) { 
		 $_SESSION["admin"] = $admin;
		 header("location: list.php");
         exit();
    } else {
		echo 'That information is incorrect, try again <a href="index.php">Click Here</a>';
		exit();
	}
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Login PHP</title>
	<link rel="stylesheet" href="css/login_style.css" />
	<link href="http://fonts.googleapis.com/css?family=Oleo+Script" rel="stylesheet" type="text/css">

</head>
<body>
	<div class="lg-container">
		<h1>Please log in to join us</h1>
		<form action="admin_login.php" id="lg-form" name="lg-form" method="post">
			
			<div>
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" placeholder="username"/>
			</div>
			
			<div>
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" placeholder="password" />
			</div>
			
			<div>				
				<button type="submit" id="login">Login</button>
			</div>
			
		</form>
		<div id="message"></div>
	</div>
</body>
</html>