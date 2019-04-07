<?php
include("..\controller\MovieController.php");

$controller = new MovieController();

/*$movieList = $controller->getMovies(10);

while ($dados = $movieList->fetch_array()){
	echo 'Cod: ' . $dados['cod'] . '<br>';
	echo 'Title: ' . $dados['title'] . '<br>';
	echo 'Type: ' . $dados['type'] . '<br>';
	echo 'Star: ' . $dados['star'] . '<br>';
}*/
	echo $controller->getSearchImdb(0,'WuKong Torrent (2018) Legendado BluRay 720p | 1080p – Download');
