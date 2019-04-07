<?php
require('../controller/'.'MovieController.php');

$search = (isset($_GET['search']))   ? $_GET['search']   : "";

$controller = new MovieController();

echo $controller->getQtPages($search);
