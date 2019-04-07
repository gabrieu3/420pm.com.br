<?php

require('../api/Remote.php');
require('../controller/MovieController.php');

$pages = (int) (isset($_GET['pages']) ? $_GET['pages'] : '1');

$c = new MovieController();

$movieObj = new MovieDto();



for ($x = $pages; $x >= 1; $x--) {

if ($x >=2){
  $apiUrl = "http://filmestorrentfull.com/page/".$x."/";
}else {
  $apiUrl = "http://filmestorrentfull.com/";
}

$remote = new Remote();
$html = $remote->fetchJSON($apiUrl);


 $obj = $remote->html_to_obj($html, $apiUrl);

$json_text = json_encode($obj, JSON_PRETTY_PRINT);
//echo $json_text;
$json      = json_decode($json_text);

//LOOP de POSTS
foreach($json->children as $movie) { //foreach element in $arr
  if (property_exists($movie, "children")) {

    // LOOP DE POST
    foreach($movie->children as $movie2) { //foreach element in $arr

      //ELEMENTO
      if (property_exists($movie2, "children")) {
        foreach($movie2->children as $movie3) { //foreach element in $arr
          //PARTE 1
          if (property_exists($movie3, "html")){
            $movieObj->setTitle($movie3->html);
            echo $movie3->html.'</br>';
          }

          if (property_exists($movie3, "href")){
            $movieObj->setLink($movie3->href);
            echo $movie3->href.'</br>';
          }

          //PARTE 2
          if (property_exists($movie3, "children")) {
            foreach($movie3->children as $movie4) { //foreach element in $arr

              if (property_exists($movie4, "children")) {
                foreach($movie4->children as $movie5) { //foreach element in $arr
                  if (property_exists($movie5, "title")){
                    echo $movie5->title.'</br>';
                  }

                  if (property_exists($movie5, "src")){
                    $movieObj->setSrc($movie5->src);
                    $movieObj->setType('Filmestorrentfull.com');
                    echo $movie5->src.'</br></br>';
                    $c->insertMovie($movieObj);
                  }

                }
              }
            }
          }
          //FIM PARTE 2
        }
      }
    }
  }
}
 }

?>
