
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Import Gmail Contact</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
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
    <?php
$client_id = '822743733345-84qc52psgjnadlk19kilngibbu84nr48.apps.googleusercontent.com';
$client_secret = 'c1MABQBP8vUa2LiHF5DV3b_X';
$redirect_uri = 'http://localhost/import-gmail-contact/oauth.php';
$max_results = 10;

$auth_code = $_GET["code"];

function curl_file_get_contents($url)
{
 $curl = curl_init();
 $userAgent = 'Mozilla/40.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
 
 curl_setopt($curl,CURLOPT_URL,$url);	//The URL to fetch. This can also be set when initializing a session with curl_init().
 curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);	//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
 curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);	//The number of seconds to wait while trying to connect.	
 
 curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);	//The contents of the "User-Agent: " header to be used in a HTTP request.
 curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);	//To follow any "Location: " header that the server sends as part of the HTTP header.
 curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);	//To automatically set the Referer: field in requests where it follows a Location: redirect.
 curl_setopt($curl, CURLOPT_TIMEOUT, 10);	//The maximum number of seconds to allow cURL functions to execute.
 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);	//To stop cURL from verifying the peer's certificate.
 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
 
 $contents = curl_exec($curl);
 curl_close($curl);
 return $contents;
}

$fields=array(
    'code'=>  urlencode($auth_code),
    'client_id'=>  urlencode($client_id),
    'client_secret'=>  urlencode($client_secret),
    'redirect_uri'=>  urlencode($redirect_uri),
    'grant_type'=>  urlencode('authorization_code')
);
$post = '';
foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
$post = rtrim($post,'&');

$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
curl_setopt($curl,CURLOPT_POST,5);
curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
$result = curl_exec($curl);
curl_close($curl);

$response =  json_decode($result);
$accesstoken = $response->access_token;

$url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&oauth_token='.$accesstoken;
$xmlresponse =  curl_file_get_contents($url);
if((strlen(stristr($xmlresponse,'Authorization required'))>0) && (strlen(stristr($xmlresponse,'Error '))>0)) //At times you get Authorization error from Google.
{
	echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
	exit();
}
echo "<h3>Email Addresses:</h3>";
$xml =  new SimpleXMLElement($xmlresponse);
$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
$result = $xml->xpath('//gd:email');
$email_list = '';
$count = 1;
foreach ($result as $title) {
  $email_list.= '<tr>
  					<td width="413">'.$count.'--'.$title->attributes()->address.'</td>
      				<td width="241"><input type="checkbox" name="check[]" value="badminton" style="transform: scale(1.5)"></td>
	  			</tr>';
  
  $count++;
}
?>

<table width="670" border="1">
  <tbody>
<?php echo $email_list;?>
    <tr>
      <td><input type="button" name="button" id="button" value="Import selected to badminton group" /></td>
      </tr>
  </tbody>
</table>


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