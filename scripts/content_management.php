<?php
require 'connect.php';

$query = "SELECT `content` FROM `content_portfolio` WHERE 1";
$result = mysqli_query($link, $query)
or die (mysqli_error($link));

$head_title = mysqli_fetch_array($result,MYSQLI_ASSOC);

?>


