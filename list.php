<?php 
//Collect data to show full list¨
    // Connect to the MySQL database  
    require "scripts/connect.php";
$username = "mickey";
$email_list = "";
$sql = mysqli_query($link, "SELECT * FROM `imported_email`");
$number = 0;
$email_count = mysqli_num_rows($sql); // count the amount of email in database
if ($email_count > 0) {
	while($row = mysqli_fetch_array($sql, MYSQLI_ASSOC)) {
		$email_ID = $row["email_ID"];
		$email = $row["email"];
		$number++;
		$email_list .='<tr>
						  <td width="59">'.$number.'</td>
						  <td width="419" align="center">'.$email.'</td>
						  <td width="125"><input type="checkbox" name="check[]" value="'.$email.'" style="transform: scale(1.5)"></td>
					   </tr>';
		}
}
else {
	$email_list = "You have no email yet!";
}
?>
<?php
//Add selected email to badminton_list
if (isset ($_POST['badminton']))
{
	$emails = $_POST['check'];
	$username = "mickey";
	foreach($emails as $email)
	{
		$sql = "INSERT INTO `jolly`.`badminton_list` (`id`, `email`, `username`) VALUES (NULL, '$email', '$username');";
 		$query = mysqli_query($link, $sql) or die(mysqli_error($link));
	}
	echo "imported OK!!!";
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
      <h1 style="font-size:18px">Welcome <span style="color:#4C5EED; text-transform:uppercase"><?php echo $username?></span></h1>
      <form action="list.php" method="post">
		<table width="625" height="147" border="1">
  <tbody>
    <tr>
      <td colspan="3">&nbsp;</td>
      </tr>
	<?php echo $email_list;?>
    <tr>
      <td colspan="3">
      	<input type="hidden" name ="badminton" value="badminton"/>
      	<input type="submit" name="add" id="add" value="Add to Badminton Group" style="width:auto" />
      </td>
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