<?php
require('../controller/'.'MovieController.php');

$controller = new MovieController();

echo $controller->getQtMovies();
