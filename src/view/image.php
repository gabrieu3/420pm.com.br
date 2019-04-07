<?php
require('../controller/MovieController.php');

$cod = (int) $_GET['cod'];
$c = new MovieController();
$image = $c->getImage($cod);
ob_start();
header("Content-Type: image/jpeg");
header("Content-Disposition: inline");
echo $image['image'];
ob_end_flush();

?>
