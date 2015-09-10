<?php
	require "scripts/connect.php";
		
	mysqli_set_charset($link, 'utf8');
	$name_list1 = '';
	$sql1 = mysqli_query($link, "SELECT * FROM `badminton`");

	$count1 = mysqli_num_rows($sql1);
	while ($row1 = mysqli_fetch_array($sql1, MYSQLI_ASSOC)){		
		$name1 = $row1['name'];
		$name_list1 .= '<span style="color:blue">'.$name1.'</span>
     					 <br/>';
		}
	$name_list2 = '';
	$sql2 = mysqli_query($link, "SELECT * FROM `social`");
	$count2 = mysqli_num_rows($sql2);
	while ($row2 = mysqli_fetch_array($sql2, MYSQLI_ASSOC)){
		$name2 = $row2['name'];
		$name_list2 .= '<span style="color:blue">'.$name2.'</span>
     					 <br/>';
		}
	$name_list3 = '';
	$sql3 = mysqli_query($link, "SELECT * FROM `other`");
	$count3 = mysqli_num_rows($sql3);
	while ($row3 = mysqli_fetch_array($sql3, MYSQLI_ASSOC)){
		$name3 = $row3['name'];
		$name_list3 .= '<span style="color:blue">'.$name3.'</span>
     					 <br/>';
		}		
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ADD NEW BLOG</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/tooplate_style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" language="javascript"> 
</script>
</head>
<body>

<div id="tooplate_wrapper"><span id="top"></span>
	<div id="tooplate_header">
    	<div id="site_title"><h1><a href="#">Personal Website</a></h1></div>
        <div id="tooplate_menu">
            <ul>
                <li><a href="../index.php"><span class="home"></span>Home</a></li>
                <li><a href="blog_add.php"><span class="services"></span>Add New</a></li>              	
                <li><a href="index.php"><span class="portfolio"></span>Article List</a></li>
                <li><a href="admin_logout.php"><span class="aboutus"></span>Log out</a></li>
<!--                <li class="last"><a href="#contact"><span class="contactus"></span>Contact</a></li>-->
            </ul>    	
        </div> <!-- end of tooplate_menu -->
		
        <div class="cleaner"></div>
    </div> <!-- end of header -->
    
    <div id="tooplate_main">
    	
		
        <div class="content_bottom"></div>
        

        
        <div class="content_top"><span id="portfolio"></span></div>

      <div class="content">
		
    	<h1>Jolly Dragon</h1>                   
            <div class="cleaner h30"></div>
            
			<table width="723" height="398" border="1">
  <tbody align="center">
    <tr>
      <td width="230" height="66"><h2>Activity</h2></td>
      <td width="322"><h2>People joined</h2></td>
      <td width="149"><h2>Join</h2></td>
    </tr>
    <tr>
      <td><h3>Badminton <span style="color:red">(<?php echo $count1;?>)</span></h3></td>
      <td>
		<?php echo $name_list1;?>
      </td>
      <td><input type="checkbox" name="check[]" value="badminton" style="transform: scale(1.5)"></td>
    </tr>
    <tr>
      <td><h3>Social <span style="color:red">(<?php echo $count2;?>)</span></h3></td>
      <td><?php echo $name_list2;?></td>
      <td><input type="checkbox" name="check[]" value="badminton" style="transform: scale(1.5)"></td>
    </tr>
    <tr>
      <td><h3>Other <span style="color:red">(<?php echo $count3;?>)</span></h3></td>
      <td><?php echo $name_list3;?></td>
      <td><input type="checkbox" name="check[]" value="badminton" style="transform: scale(1.5)"></td>
    </tr>
    <tr>
      <td height="98" colspan="3">
          <a href="admin_login.php">
            <input type="button" name="button" id="button" value="Sign up or login to join us" style="transform: scale(1.5)"/>
          </a>
          <br/>
          <br/>
        	<a style="margin-top:20px" href="https://accounts.google.com/o/oauth2/auth?client_id=822743733345-63kvc1r16hdv8jh532r8jq4rhlhkj3o3.apps.googleusercontent.com&redirect_uri=http://localhost/import-gmail-contact/oauth.php&scope=https://www.google.com/m8/feeds/&response_type=code"><input type="button" value="Import your contacts from Gmail" style="transform: scale(1.5)" /></a>
      </td>
      </tr>
  </tbody>
</table>

          <div class="cleaner h30"></div>
            <div class="cleaner"></div>
    	</div>
		
        <div class="content_bottom"></div>
        
    	<div class="cleaner"></div>
    </div> <!-- end of main -->
	
    <div id="tooplate_footer">
    
        Copyright © <a href="mickeychu.cf">Mickey</a>
    
    </div> <!-- end of tooplate_footer -->
	
</div>

</body>
</html>