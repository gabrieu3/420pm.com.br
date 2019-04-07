<?php
require('../controller/MovieController.php');

$cod = (int) (isset($_POST['cod']))   ? $_POST['cod']  : '0';


if ($cod <> '0'){
  $c = new MovieController();
  $c->insertView($cod);
  echo $c->getView($cod);
}
?>
