<?php 
ini_set('session.save_path', dirname(__FILE__));
session_start();
if (!isset($_SESSION["admin"])) {
    header("location: admin_login.php"); 
    exit();
}
// Be sure to check that this admin SESSION value is in fact in the database
//$adminID = $_SESSION["id"]; // filter everything but numbers and letters
$admin = $_SESSION["admin"]; // filter everything but numbers and letters
// Run mySQL query to be sure that this person is an admin and that their password session var equals the database information
// Connect to the MySQL database  
require "scripts/connect.php"; 
$sql = mysqli_query($link, "SELECT * FROM `admin` WHERE username='$admin' "); // query the person
// ------- MAKE SURE PERSON EXISTS IN DATABASE ---------
$existCount = mysqli_num_rows($sql); // count the row nums
if ($existCount == 0) { // evaluate the count
	 echo 'Your login session data is not on record in the database and try again <a href="admin_login.php">Click Here</a>';
     exit();
}
?>
<?php
if (isset ($_POST['submit']))
{
	$items = $_POST['check'];
$name = $_POST['admin'];
for ($i = 0; $i<sizeof($items);$i++){
	if ($items[$i] == "badminton"){
		$sql1 = mysqli_query($link, "INSERT INTO `badminton` (`id`, `name`) VALUES (NULL, '$name');");
		}
	else if ($items[$i] == "social"){
		$sql2 = mysqli_query($link, "INSERT INTO `social` (`id`, `name`) VALUES (NULL, '$name');");
		}
	else if ($items[$i] == "other"){
		$sql3 = mysqli_query($link, "INSERT INTO `other` (`id`, `name`) VALUES (NULL, '$name');");
	}
	
}
		 header("location: index.php");
         exit();
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADMIN AREA</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript">
	function delete_id(id)
	{
		 if(confirm('Sure To Remove This Article ?'))
		 {
		  	window.location.href='index.php?deleteID='+id;
		 }
	}
</script>
<link href="css/tooplate_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="tooplate_wrapper"><span id="top"></span>
  <div id="tooplate_header">
    <div id="site_title">
      <h1><a href="#">Personal Website</a></h1>
    </div>
    <div id="tooplate_menu">
      <ul>
        <li><a href="../index.php"><span class="home"></span>Home</a></li>
        <li><a href="blog_add.php"><span class="services"></span>Add New</a></li>
        <li><a href="index.php"><span class="portfolio"></span>Article List</a></li>
        <li><a href="admin_logout.php"><span class="aboutus"></span>Log out</a></li>
        <!--                <li class="last"><a href="#contact"><span class="contactus"></span>Contact</a></li>-->
      </ul>
    </div>
    <!-- end of tooplate_menu -->
    
    <div class="cleaner"></div>
  </div>
  <!-- end of header -->
  
  <div id="tooplate_main">
    <div class="content_bottom"></div>
    <div class="content_top"><span id="portfolio"></span></div>
    <div class="content">
      <h1 style="font-size:18px">Welcome <span style="color:#4C5EED; text-transform:uppercase"><?php echo $admin?></span>, What activities do you want to join?</h1>
      <form action="list.php" method="post">
      <table width="404" height="322" border="1">
  <tbody align="center">
    <tr>
      <td width="327"><h2>Activiy</h2></td>
      <td width="61"></td>
    </tr>
    <tr>
      <td><h2>Badminton</h2></td>
      <td><input type="checkbox" name="check[]" value="badminton" style="transform: scale(1.5)"></td>
    </tr>
    <tr>
      <td><h2>Social</h2></td>
      <td><input type="checkbox" name="check[]" value="social" style="transform: scale(1.5)"></td>
    </tr>
    <tr>
      <td><h2>Other</h2></td>
      <td><input type="checkbox" name="check[]" value="other" style="transform: scale(1.5)"></td>
    </tr>
    <tr>
      <td><h2>
      <input type="hidden" value="<?php echo $admin?>" name="admin"/>
        <input type="submit" value="Complete" name="submit">
      </h2></td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

      </form>
      <div class="cleaner"></div>
    </div>
    <div class="content_bottom"></div>
    <div class="cleaner"></div>
  </div>
  <!-- end of main -->
  
  <div id="tooplate_footer"> Copyright © <a href="mickeychu.cf">Mickey</a> </div>
  <!-- end of tooplate_footer --> 
  
</div>
</body>
</html>