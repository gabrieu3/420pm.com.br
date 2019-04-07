<?php

include("..\MovieDao.php");

echo("MovieDao");
echo("<br>");
echo("<br>");

$dao = new MovieDao();

$movieList = $dao->getMovies(3);

 

while ($dados = $movieList->fetch_array()) {
	echo 'Cod: ' . $dados['cod'] . '<br>';
	echo 'Title: ' . $dados['title'] . '<br>';
	echo 'Type: ' . $dados['type'] . '<br>';
	echo 'Star: ' . $dados['star'] . '<br>';
}

