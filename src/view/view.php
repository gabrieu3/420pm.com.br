<?php
require('../controller/MovieController.php');

$cod = (int) (isset($_POST['cod']))   ? $_POST['cod']  : '0';
$link = (isset($_POST['link']))   ? $_POST['link']  : '0';

if ($link <> '0'){
  $c = new MovieController();
  $c->insertView($cod);
  header('Location: '.$link);
}

echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/icon.png">
    <meta http-equiv="refresh" content="5;url=../../#">
    <title>Dizzy Crazy Stuffs</title>

    <!-- Bootstrap core CSS -->
		<link rel="stylesheet" type="text/css"  href="./../../css/stylezin.css">
		<link rel="stylesheet" type="text/css"  href="./../../css/bootstrap.css">
</head>
<body>
<div id="info" class="alert alert-info" role="alert">
  <p class="text-center">Sorry! Shit happens...</p>
  </br>
  <p class="text-center">Redirecting wait please!</p>
</div>
</body>';
?>
